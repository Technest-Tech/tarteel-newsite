<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('landing', [
            'stats' => config('tarteel.stats'),
            'pricing' => config('tarteel.pricing'),
            'testimonials' => config('tarteel.testimonials'),
            'contact' => config('tarteel.contact'),
            'social' => array_filter(config('tarteel.social')),
            'rating' => config('tarteel.rating'),
            'whatsapp' => config('tarteel.contact.whatsapp'),
            // A blank or still-placeholder number is hidden from the page
            // rather than shown as a dead link.
            'phoneIsPlaceholder' => in_array(
                config('tarteel.contact.phone'),
                ['', null, '+000000000000'],
                true,
            ),
        ]);
    }
}
