<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnrollmentRequest;
use App\Models\Enrollment;
use Illuminate\Http\RedirectResponse;

class EnrollmentController extends Controller
{
    public function store(StoreEnrollmentRequest $request): RedirectResponse
    {
        $enrollment = Enrollment::create(
            $request->safe()->except('website') + ['status' => 'new']
        );

        return redirect()
            ->route('home')
            ->withFragment('enroll')
            ->with('enrollment_success', $enrollment->source_locale);
    }
}
