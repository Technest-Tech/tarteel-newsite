<?php

namespace Tests\Feature;

use App\Models\Enrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentSubmissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, mixed>
     */
    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'سارة أحمد',
            'email' => 'sarah@example.com',
            'phone' => '+201000000000',
            'country' => 'Egypt',
            'student_type' => 'child',
            'age' => 9,
            'program' => 'quran',
            'preferred_language' => 'both',
            'availability' => 'Weekday evenings',
            'message' => 'She is a complete beginner.',
            'source_locale' => 'ar',
        ], $overrides);
    }

    public function test_a_valid_submission_creates_exactly_one_enrollment(): void
    {
        $response = $this->post('/enroll', $this->payload());

        $response->assertRedirect(route('home').'#enroll');
        $response->assertSessionHas('enrollment_success', 'ar');

        $this->assertSame(1, Enrollment::count());
        $this->assertDatabaseHas('enrollments', [
            'email' => 'sarah@example.com',
            'name' => 'سارة أحمد',
            'program' => 'quran',
            'status' => 'new',
            'source_locale' => 'ar',
        ]);
    }

    public function test_an_invalid_submission_is_rejected_and_stores_nothing(): void
    {
        $response = $this->from('/')->post('/enroll', $this->payload([
            'name' => '',
            'email' => 'not-an-email',
            'program' => 'astrophysics',
            'age' => 2,
        ]));

        $response->assertSessionHasErrors(['name', 'email', 'program', 'age']);
        $this->assertSame(0, Enrollment::count());
    }

    public function test_the_honeypot_field_blocks_automated_submissions(): void
    {
        $response = $this->from('/')->post('/enroll', $this->payload([
            'website' => 'https://spam.example.com',
        ]));

        $response->assertSessionHasErrors('website');
        $this->assertSame(0, Enrollment::count());
    }

    public function test_english_submissions_are_stored_with_their_locale(): void
    {
        $this->post('/enroll', $this->payload([
            'email' => 'omar@example.com',
            'source_locale' => 'en',
        ]));

        $this->assertDatabaseHas('enrollments', [
            'email' => 'omar@example.com',
            'source_locale' => 'en',
        ]);
    }

    public function test_a_missing_source_locale_falls_back_to_english(): void
    {
        $payload = $this->payload();
        unset($payload['source_locale']);

        $response = $this->post('/enroll', $payload);

        $response->assertSessionHas('enrollment_success', 'en');
        $this->assertDatabaseHas('enrollments', [
            'email' => 'sarah@example.com',
            'source_locale' => 'en',
        ]);
    }
}
