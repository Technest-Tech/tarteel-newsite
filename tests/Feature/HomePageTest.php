<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_home_page_loads_in_english_with_every_section(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('<html lang="en" dir="ltr"', false);
        $response->assertSee('Tarteel Academy', false);
        $response->assertSee('Learn with heart.', false);

        foreach (['id="programs"', 'id="why-us"', 'id="journey"', 'id="stories"', 'id="faq"', 'id="enroll"'] as $section) {
            $response->assertSee($section, false);
        }
    }

    public function test_the_arabic_copy_ships_alongside_the_english_default(): void
    {
        // Both languages are in the markup; the toggle swaps them client-side,
        // so the Arabic copy must be present even on the English-first render.
        $response = $this->get('/');

        $response->assertSee('data-ar="أكاديمية ترتيل"', false);
        $response->assertSee('رتّل بثقة،', false);
    }

    public function test_the_contact_details_and_whatsapp_button_are_rendered(): void
    {
        $response = $this->get('/');

        $response->assertSee('mailto:tarteelacademy24@gmail.com', false);
        $response->assertSee('tel:+201120600803', false);
        $response->assertSee('https://wa.me/201120600803', false);
        $response->assertSee('class="whatsapp-fab"', false);
        $response->assertSee('https://www.facebook.com/share/1JC9M2ehfm/', false);
    }

    public function test_the_whatsapp_button_disappears_when_no_number_is_configured(): void
    {
        config(['tarteel.contact.whatsapp' => '']);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertDontSee('class="whatsapp-fab"', false);
    }

    public function test_the_home_page_exposes_seo_metadata_and_the_corrected_hero(): void
    {
        $response = $this->get('/');

        $response->assertSee('rel="canonical"', false);
        $response->assertSee('EducationalOrganization', false);
        $response->assertSee('images/hero-quran-online-modest.webp', false);
        $response->assertSee('images/hero-quran-online-modest.png', false);
        $response->assertSee('twitter:card', false);
    }
}
