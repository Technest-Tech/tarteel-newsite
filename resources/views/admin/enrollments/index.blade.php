@extends('admin.layout')

@section('title', 'Enrollments')

@section('content')
    <div class="admin-head">
        <div>
            <h1>Enrollment requests</h1>
            <p>Newest first. {{ $enrollments->total() }} {{ Str::plural('request', $enrollments->total()) }} match the current view.</p>
        </div>
    </div>

    @if (session('status_updated'))
        <p class="admin-alert" role="status">Status updated to “{{ session('status_updated') }}”.</p>
    @endif

    <section class="summary-grid" aria-label="Summary">
        <div class="summary-card">
            <span>Total</span>
            <strong>{{ $summary['total'] }}</strong>
        </div>
        <div class="summary-card" data-status="new">
            <span>New</span>
            <strong>{{ $summary['new'] }}</strong>
        </div>
        <div class="summary-card" data-status="contacted">
            <span>Contacted</span>
            <strong>{{ $summary['contacted'] }}</strong>
        </div>
        <div class="summary-card" data-status="enrolled">
            <span>Enrolled</span>
            <strong>{{ $summary['enrolled'] }}</strong>
        </div>
    </section>

    <section class="admin-panel">
        <form method="GET" action="{{ route('admin.enrollments.index') }}" class="admin-toolbar" role="search">
            <div class="admin-field admin-field-search">
                <label for="search">Search name, email, phone or country</label>
                <input type="search" name="search" id="search" value="{{ $search }}" placeholder="e.g. Sarah, +20, Egypt">
            </div>

            <div class="admin-field">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="">All statuses</option>
                    @foreach ($statuses as $value => $labels)
                        <option value="{{ $value }}" @selected($status === $value)>{{ $labels['en'] }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="admin-button">Apply</button>

            <div class="admin-toolbar-end">
                @if ($search !== '' || $status !== '')
                    <a class="admin-button admin-button-ghost" href="{{ route('admin.enrollments.index') }}">Clear filters</a>
                @endif
                <a class="admin-button admin-button-ghost" href="{{ route('admin.enrollments.export', request()->only('search', 'status')) }}">Export CSV</a>
            </div>
        </form>

        @if ($enrollments->isEmpty())
            <div class="empty-state">
                <strong>No enrollment requests here</strong>
                @if ($search !== '' || $status !== '')
                    <p>Nothing matches the current search and filter. Try a different term, or clear the filters to see every request.</p>
                    <a class="admin-button admin-button-ghost" href="{{ route('admin.enrollments.index') }}">Clear filters</a>
                @else
                    <p>New requests submitted through the website's enrollment form will appear here automatically.</p>
                @endif
            </div>
        @else
            <div class="table-wrap">
                <table class="admin-table">
                    <caption class="visually-hidden">Enrollment requests, newest first</caption>
                    <thead>
                        <tr>
                            <th scope="col">Name &amp; contact</th>
                            <th scope="col">Program</th>
                            <th scope="col">Student</th>
                            <th scope="col">Country</th>
                            <th scope="col">Submitted</th>
                            <th scope="col">Status</th>
                            <th scope="col"><span class="visually-hidden">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrollments as $enrollment)
                            <tr>
                                <td>
                                    <span class="cell-name">
                                        <strong>{{ $enrollment->name }}</strong>
                                        <a href="mailto:{{ $enrollment->email }}">{{ $enrollment->email }}</a>
                                        <a href="tel:{{ $enrollment->phone }}">{{ $enrollment->phone }}</a>
                                    </span>
                                </td>
                                <td>{{ $enrollment->programLabel() }}</td>
                                <td>
                                    {{ $enrollment->studentTypeLabel() }}
                                    @if ($enrollment->age)
                                        <span class="cell-muted">· {{ $enrollment->age }} yrs</span>
                                    @endif
                                </td>
                                <td>{{ $enrollment->country ?: '—' }}</td>
                                <td>
                                    <time datetime="{{ $enrollment->created_at->toIso8601String() }}">{{ $enrollment->created_at->format('d M Y') }}</time>
                                    <span class="cell-muted">{{ $enrollment->created_at->format('H:i') }}</span>
                                </td>
                                <td><span class="status-pill" data-status="{{ $enrollment->status }}">{{ $enrollment->statusLabel() }}</span></td>
                                <td>
                                    <a class="table-action" href="{{ route('admin.enrollments.show', $enrollment) }}">
                                        View<span class="visually-hidden"> request from {{ $enrollment->name }}</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $enrollments->links() }}
        @endif
    </section>
@endsection
