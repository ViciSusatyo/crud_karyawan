<?php

namespace Database\Factories;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Karyawan>
 */
class KaryawanFactory extends Factory
{
    protected $model = Karyawan::class;

    public function definition(): array
    {
        $nama = fake('id_ID')->name();

        return [
            'nama' => $nama,
            'email' => Str::slug($nama, '.').'@karyawan.test',
            'jabatan' => fake('id_ID')->randomElement([
                'Frontend Developer',
                'Backend Developer',
                'UI/UX Designer',
                'Data Analyst',
                'Product Manager',
                'QA Engineer',
                'DevOps Engineer',
                'Admin HR',
            ]),
        ];
    }
}
