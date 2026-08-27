<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminEnrollmentController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->value();
        $status = $request->string('status')->trim()->value();

        $enrollments = Enrollment::query()
            ->search($search)
            ->status($status)
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.enrollments.index', [
            'enrollments' => $enrollments,
            'summary' => $this->summary(),
            'search' => $search,
            'status' => in_array($status, Enrollment::allowed('status'), true) ? $status : '',
            'statuses' => config('tarteel.enums.status'),
        ]);
    }

    public function show(Enrollment $enrollment): View
    {
        return view('admin.enrollments.show', [
            'enrollment' => $enrollment,
            'statuses' => config('tarteel.enums.status'),
        ]);
    }

    public function update(Request $request, Enrollment $enrollment): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(Enrollment::allowed('status'))],
        ]);

        $enrollment->update($validated);

        return back()->with('status_updated', $enrollment->statusLabel());
    }

    /**
     * Stream the current result set as CSV. The UTF-8 BOM is what makes Excel
     * open Arabic names correctly instead of showing mojibake.
     */
    public function export(Request $request): StreamedResponse
    {
        $search = $request->string('search')->trim()->value();
        $status = $request->string('status')->trim()->value();

        $fileName = 'tarteel-enrollments-'.now()->format('Y-m-d').'.csv';

        return Response::streamDownload(function () use ($search, $status) {
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF");

            fputcsv($output, [
                'ID', 'Name', 'Email', 'Phone', 'Country', 'Student type', 'Age',
                'Program', 'Support language', 'Availability', 'Message',
                'Status', 'Form language', 'Submitted at', 'Updated at',
            ]);

            Enrollment::query()
                ->search($search)
                ->status($status)
                ->latest()
                ->chunk(200, function ($rows) use ($output) {
                    foreach ($rows as $row) {
                        fputcsv($output, [
                            $row->id,
                            $row->name,
                            $row->email,
                            $row->phone,
                            $row->country,
                            $row->studentTypeLabel(),
                            $row->age,
                            $row->programLabel(),
                            $row->preferredLanguageLabel(),
                            $row->availability,
                            $row->message,
                            $row->statusLabel(),
                            Enrollment::label('source_locale', $row->source_locale),
                            optional($row->created_at)->format('Y-m-d H:i'),
                            optional($row->updated_at)->format('Y-m-d H:i'),
                        ]);
                    }
                });

            fclose($output);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /**
     * Totals for the dashboard cards, with every status present even at zero.
     *
     * @return array<string, int>
     */
    private function summary(): array
    {
        $counts = Enrollment::query()
            ->selectRaw('status, count(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        $summary = ['total' => (int) $counts->sum()];

        foreach (Enrollment::allowed('status') as $status) {
            $summary[$status] = (int) $counts->get($status, 0);
        }

        return $summary;
    }
}
