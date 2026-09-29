<?php

namespace Tests\Feature;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KaryawanTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsAdmin(): User
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        return $user;
    }

    public function test_daftar_karyawan_menampilkan_data(): void
    {
        $this->actingAsAdmin();

        Karyawan::factory()->create(['nama' => 'Budi Santoso']);

        $this->get(route('karyawan.index'))
            ->assertOk()
            ->assertSee('Budi Santoso');
    }

    public function test_pencarian_menyaring_daftar_karyawan(): void
    {
        $this->actingAsAdmin();

        Karyawan::factory()->create(['nama' => 'Budi Santoso', 'jabatan' => 'Frontend Developer']);
        Karyawan::factory()->create(['nama' => 'Siti Aminah', 'jabatan' => 'Data Analyst']);

        $this->get(route('karyawan.index', ['q' => 'Frontend']))
            ->assertOk()
            ->assertSee('Budi Santoso')
            ->assertDontSee('Siti Aminah');
    }

    public function test_halaman_tambah_dapat_diakses(): void
    {
        $this->actingAsAdmin();

        $this->get(route('karyawan.create'))->assertOk();
    }

    public function test_menyimpan_karyawan_baru(): void
    {
        $this->actingAsAdmin();

        $this->post(route('karyawan.store'), [
            'nama' => 'Budi Santoso',
            'email' => 'budi@karyawan.test',
            'jabatan' => 'Frontend Developer',
        ])->assertRedirect(route('karyawan.index'));

        $this->assertDatabaseHas('karyawans', ['email' => 'budi@karyawan.test']);
    }

    public function test_validasi_gagal_bila_data_kurang(): void
    {
        $this->actingAsAdmin();

        $this->post(route('karyawan.store'), [])
            ->assertSessionHasErrors(['nama', 'email', 'jabatan']);

        $this->assertSame(0, Karyawan::count());
    }

    public function test_email_karyawan_harus_unik(): void
    {
        $this->actingAsAdmin();

        Karyawan::factory()->create(['email' => 'budi@karyawan.test']);

        $this->post(route('karyawan.store'), [
            'nama' => 'Budi Santoso',
            'email' => 'budi@karyawan.test',
            'jabatan' => 'Frontend Developer',
        ])->assertSessionHasErrors('email');
    }

    public function test_memperbarui_karyawan(): void
    {
        $this->actingAsAdmin();

        $karyawan = Karyawan::factory()->create();

        $this->put(route('karyawan.update', $karyawan), [
            'nama' => 'Nama Baru',
            'email' => $karyawan->email,
            'jabatan' => 'Product Manager',
        ])->assertRedirect(route('karyawan.index'));

        $this->assertDatabaseHas('karyawans', [
            'id' => $karyawan->id,
            'nama' => 'Nama Baru',
            'jabatan' => 'Product Manager',
        ]);
    }

    public function test_menghapus_karyawan(): void
    {
        $this->actingAsAdmin();

        $karyawan = Karyawan::factory()->create();

        $this->delete(route('karyawan.destroy', $karyawan))
            ->assertRedirect(route('karyawan.index'));

        $this->assertDatabaseMissing('karyawans', ['id' => $karyawan->id]);
    }

    public function test_halaman_edit_menampilkan_data_karyawan(): void
    {
        $this->actingAsAdmin();

        $karyawan = Karyawan::factory()->create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@karyawan.test',
            'jabatan' => 'Frontend Developer',
        ]);

        $this->get(route('karyawan.edit', $karyawan))
            ->assertOk()
            ->assertSee('Budi Santoso')
            ->assertSee('budi@karyawan.test');
    }

    public function test_email_tetap_valid_saat_memperbarui_data_yang_sama(): void
    {
        $this->actingAsAdmin();

        $karyawan = Karyawan::factory()->create(['email' => 'budi@karyawan.test']);

        $this->put(route('karyawan.update', $karyawan), [
            'nama' => 'Budi Santoso',
            'email' => 'budi@karyawan.test',
            'jabatan' => 'Frontend Developer',
        ])->assertSessionHasNoErrors();
    }
}
