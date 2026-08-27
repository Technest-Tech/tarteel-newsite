<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * A single enrollment request submitted from the public landing page.
 */
#[Fillable([
    'name',
    'email',
    'phone',
    'country',
    'student_type',
    'age',
    'program',
    'preferred_language',
    'availability',
    'message',
    'status',
    'source_locale',
])]
class Enrollment extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'age' => 'integer',
        ];
    }

    /**
     * Allowed values for one of the enrollment enums, taken from config.
     *
     * @return array<int, string>
     */
    public static function allowed(string $enum): array
    {
        return array_keys(config("tarteel.enums.{$enum}", []));
    }

    /**
     * The bilingual label for an enum value, falling back to the raw value.
     */
    public static function label(string $enum, ?string $value, string $locale = 'en'): string
    {
        if ($value === null || $value === '') {
            return '—';
        }

        return config("tarteel.enums.{$enum}.{$value}.{$locale}", $value);
    }

    public function statusLabel(string $locale = 'en'): string
    {
        return static::label('status', $this->status, $locale);
    }

    public function programLabel(string $locale = 'en'): string
    {
        return static::label('program', $this->program, $locale);
    }

    public function studentTypeLabel(string $locale = 'en'): string
    {
        return static::label('student_type', $this->student_type, $locale);
    }

    public function preferredLanguageLabel(string $locale = 'en'): string
    {
        return static::label('preferred_language', $this->preferred_language, $locale);
    }

    /**
     * Search across the fields an admin is likely to type into the box.
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        $term = trim((string) $term);

        if ($term === '') {
            return $query;
        }

        return $query->where(function (Builder $builder) use ($term) {
            foreach (['name', 'email', 'phone', 'country'] as $column) {
                $builder->orWhere($column, 'like', '%'.$term.'%');
            }
        });
    }

    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        return in_array($status, static::allowed('status'), true)
            ? $query->where('status', $status)
            : $query;
    }
}
