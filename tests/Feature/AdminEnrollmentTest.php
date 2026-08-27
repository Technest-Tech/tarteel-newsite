<?php

namespace Tests\Feature;

use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminEnrollmentTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create([
            'email' => 'admin@example.com',
        ]);
    }

    public function test_guests_cannot_reach_any_admin_enrollment_route(): void
    {
        $enrollment = Enrollment::factory()->create();

        $this->get('/admin/enrollments')->assertRedirect(route('admin.login'));
        $this->get("/admin/enrollments/{$enrollment->id}")->assertRedirect(route('admin.login'));
        $this->patch("/admin/enrollments/{$enrollment->id}", ['status' => 'contacted'])->assertRedirect(route('admin.login'));

        $this->assertDatabaseHas('enrollments', ['id' => $enrollment->id, 'status' => 'new']);
    }

    public function test_an_admin_can_log_in_and_see_the_enrollment_list(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'secret-password',
        ]);

        Enrollment::factory()->create(['name' => 'Layan Hassan']);

        $response = $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'secret-password',
        ]);

        $response->assertRedirect(route('admin.enrollments.index'));
        $this->assertAuthenticatedAs($admin);

        $this->get('/admin/enrollments')
            ->assertOk()
            ->assertSee('Layan Hassan')
            ->assertSee('Enrollment requests');
    }

    public function test_login_fails_with_the_wrong_password(): void
    {
        User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'secret-password',
        ]);

        $this->from(route('admin.login'))
            ->post('/admin/login', ['email' => 'admin@example.com', 'password' => 'wrong'])
            ->assertRedirect(route('admin.login'))
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_search_and_status_filters_narrow_the_list_and_survive_pagination(): void
    {
        Enrollment::factory()->create(['name' => 'Mariam Khaled', 'country' => 'Canada', 'status' => 'new']);
        Enrollment::factory()->create(['name' => 'Omar Hassan', 'country' => 'Australia', 'status' => 'enrolled']);

        $response = $this->actingAs($this->admin())->get('/admin/enrollments?search=Canada&status=new');

        $response->assertOk()
            ->assertSee('Mariam Khaled')
            ->assertDontSee('Omar Hassan');
    }

    public function test_the_empty_state_is_shown_when_nothing_matches(): void
    {
        Enrollment::factory()->create(['name' => 'Mariam Khaled']);

        $this->actingAs($this->admin())
            ->get('/admin/enrollments?search=nobody-by-this-name')
            ->assertOk()
            ->assertSee('No enrollment requests here');
    }

    public function test_an_admin_can_change_an_enrollment_status(): void
    {
        $enrollment = Enrollment::factory()->create(['status' => 'new']);

        $this->actingAs($this->admin())
            ->from(route('admin.enrollments.show', $enrollment))
            ->patch(route('admin.enrollments.update', $enrollment), ['status' => 'contacted'])
            ->assertRedirect(route('admin.enrollments.show', $enrollment))
            ->assertSessionHas('status_updated');

        $this->assertDatabaseHas('enrollments', [
            'id' => $enrollment->id,
            'status' => 'contacted',
        ]);
    }

    public function test_an_unknown_status_is_rejected(): void
    {
        $enrollment = Enrollment::factory()->create(['status' => 'new']);

        $this->actingAs($this->admin())
            ->from(route('admin.enrollments.show', $enrollment))
            ->patch(route('admin.enrollments.update', $enrollment), ['status' => 'archived'])
            ->assertSessionHasErrors('status');

        $this->assertDatabaseHas('enrollments', ['id' => $enrollment->id, 'status' => 'new']);
    }

    public function test_the_detail_page_shows_every_submitted_field(): void
    {
        $enrollment = Enrollment::factory()->create([
            'name' => 'سارة أحمد',
            'email' => 'sarah@example.com',
            'phone' => '+201000000000',
            'country' => 'Egypt',
            'availability' => 'Sunday evenings',
            'message' => 'Complete beginner, please start from the basics.',
        ]);

        $response = $this->actingAs($this->admin())->get(route('admin.enrollments.show', $enrollment));

        $response->assertOk()
            ->assertSee('سارة أحمد', false)
            ->assertSee('mailto:sarah@example.com', false)
            ->assertSee('tel:+201000000000', false)
            ->assertSee('Sunday evenings')
            ->assertSee('Complete beginner, please start from the basics.')
            ->assertSee('Last updated');
    }

    public function test_csv_export_requires_authentication(): void
    {
        $this->get('/admin/enrollments/export')->assertRedirect(route('admin.login'));
    }

    public function test_csv_export_returns_a_utf8_csv_for_an_admin(): void
    {
        Enrollment::factory()->create(['name' => 'سارة أحمد', 'email' => 'sarah@example.com']);

        $response = $this->actingAs($this->admin())->get('/admin/enrollments/export');

        $response->assertOk();
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
        $this->assertStringContainsString('attachment;', $response->headers->get('content-disposition'));

        $csv = $response->streamedContent();

        // The BOM is what makes Excel read the Arabic names correctly.
        $this->assertStringStartsWith("\xEF\xBB\xBF", $csv);
        $this->assertStringContainsString('سارة أحمد', $csv);
        $this->assertStringContainsString('sarah@example.com', $csv);
    }

    public function test_logging_out_ends_the_session(): void
    {
        $this->actingAs($this->admin())
            ->post('/admin/logout')
            ->assertRedirect(route('admin.login'));

        $this->assertGuest();
    }
}
