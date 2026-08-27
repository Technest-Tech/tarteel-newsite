@extends('admin.layout')

@section('title', 'Enrollment #'.$enrollment->id)

@section('content')
    <div class="admin-head">
        <div>
            <a class="admin-back" href="{{ route('admin.enrollments.index') }}">← Back to all requests</a>
            <h1>{{ $enrollment->name }}</h1>
            <p>Request #{{ $enrollment->id }} · submitted {{ $enrollment->created_at->format('d M Y, H:i') }}</p>
        </div>
        <span class="status-pill" data-status="{{ $enrollment->status }}">{{ $enrollment->statusLabel() }}</span>
    </div>

    @if (session('status_updated'))
        <p class="admin-alert" role="status">Status updated to “{{ session('status_updated') }}”.</p>
    @endif

    <div class="detail-grid">
        <section class="admin-panel">
            <h2 class="panel-title">Submitted details</h2>

            <div class="contact-actions">
                <a class="admin-button" href="mailto:{{ $enrollment->email }}">Email {{ Str::before($enrollment->email, '@') }}</a>
                <a class="admin-button admin-button-ghost" href="tel:{{ $enrollment->phone }}">Call {{ $enrollment->phone }}</a>
            </div>

            <dl class="detail-list">
                <div>
                    <dt>Full name</dt>
                    <dd>{{ $enrollment->name }}</dd>
                </div>
                <div>
                    <dt>Email</dt>
                    <dd><a href="mailto:{{ $enrollment->email }}" dir="ltr">{{ $enrollment->email }}</a></dd>
                </div>
                <div>
                    <dt>Phone / WhatsApp</dt>
                    <dd><a href="tel:{{ $enrollment->phone }}" dir="ltr">{{ $enrollment->phone }}</a></dd>
                </div>
                <div>
                    <dt>Country</dt>
                    <dd @class(['is-empty' => ! $enrollment->country])>{{ $enrollment->country ?: 'Not provided' }}</dd>
                </div>
                <div>
                    <dt>Student type</dt>
                    <dd>{{ $enrollment->studentTypeLabel() }}</dd>
                </div>
                <div>
                    <dt>Age</dt>
                    <dd @class(['is-empty' => ! $enrollment->age])>{{ $enrollment->age ?: 'Not provided' }}</dd>
                </div>
                <div>
                    <dt>Program</dt>
                    <dd>{{ $enrollment->programLabel() }}</dd>
                </div>
                <div>
                    <dt>Support language</dt>
                    <dd>{{ $enrollment->preferredLanguageLabel() }}</dd>
                </div>
                <div>
                    <dt>Preferred days &amp; times</dt>
                    <dd @class(['is-empty' => ! $enrollment->availability])>{{ $enrollment->availability ?: 'Not provided' }}</dd>
                </div>
                <div>
                    <dt>Form language</dt>
                    <dd>{{ \App\Models\Enrollment::label('source_locale', $enrollment->source_locale) }}</dd>
                </div>
                <div class="detail-wide">
                    <dt>Message / current level</dt>
                    <dd class="message-body @if (! $enrollment->message) is-empty @endif">{{ $enrollment->message ?: 'Not provided' }}</dd>
                </div>
            </dl>
        </section>

        <aside class="admin-panel">
            <h2 class="panel-title">Update status</h2>

            <form method="POST" action="{{ route('admin.enrollments.update', $enrollment) }}" class="status-form">
                @csrf
                @method('PATCH')

                <div class="admin-field">
                    <label for="status">Current status</label>
                    <select name="status" id="status">
                        @foreach ($statuses as $value => $labels)
                            <option value="{{ $value }}" @selected($enrollment->status === $value)>{{ $labels['en'] }}</option>
                        @endforeach
                    </select>
                </div>

                @error('status')<p class="admin-alert admin-error" role="alert">{{ $message }}</p>@enderror

                <button type="submit" class="admin-button">Save status</button>
            </form>

            <div class="timestamps">
                <div>
                    <span>Created</span>
                    <strong><time datetime="{{ $enrollment->created_at->toIso8601String() }}">{{ $enrollment->created_at->format('d M Y, H:i') }}</time></strong>
                </div>
                <div>
                    <span>Last updated</span>
                    <strong><time datetime="{{ $enrollment->updated_at->toIso8601String() }}">{{ $enrollment->updated_at->format('d M Y, H:i') }}</time></strong>
                </div>
            </div>
        </aside>
    </div>
@endsection
