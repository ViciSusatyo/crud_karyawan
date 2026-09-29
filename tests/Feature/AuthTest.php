<?php

namespace Tests\Feature;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_beranda_dapat_diakses_tanpa_login(): void
    {
        $this->get(route('home'))->assertOk();
    }

    public function test_halaman_login_dapat_diakses(): void
    {
        $this->get(route('login'))->assertOk();
    }

    public function test_halaman_privat_menolak_tamu(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
        $this->get(route('karyawan.index'))->assertRedirect(route('login'));
    }

    public function test_user_bisa_login_dengan_kredensial_benar(): void
    {
        $user = User::factory()->create();

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_gagal_jika_kredensial_salah(): void
    {
        User::factory()->create();

        $this->from(route('login'))
            ->post(route('login.store'), [
                'email' => 'salah@example.com',
                'password' => 'password',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_user_bisa_logout(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_dashboard_dapat_diakses_setelah_login(): void
    {
        $this->actingAs(User::factory()->create(['name' => 'Administrator']));

        Karyawan::factory(3)->create(['jabatan' => 'Frontend Developer']);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Total Karyawan')
            ->assertSee('Frontend Developer');
    }
}
