<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RumahSakit::create([
            'nama_rumah_sakit' => 'RSUD Kota Semarang',
            'alamat' => 'Jl. Dokter Sutomo No. 18, Semarang',
            'email' => 'info@rsudsemarang.go.id',
            'telepon' => '0241234567',
        ]);

        RumahSakit::create([
            'nama_rumah_sakit' => 'RS Kariadi',
            'alamat' => 'Jl. Dr. Sutomo No.16, Semarang',
            'email' => 'contact@rskariadi.co.id',
            'telepon' => '0247654321',
        ]);

        RumahSakit::create([
            'nama_rumah_sakit' => 'RS Telogorejo',
            'alamat' => 'Jl. KH Ahmad Dahlan No.5 Semarang',
            'email' => 'admin@rstelogorejo.com',
            'telepon' => '02499887766',
        ]);

                // --- DATA FAKE MENGGUNAKAN FAKER ---
        $faker = Faker::create('id_ID');

        foreach (range(1, 10) as $i) {
            RumahSakit::create([
                'nama_rumah_sakit' => 'RS ' . $faker->lastName(),
                'alamat' => $faker->address(),
                'email' => $faker->unique()->safeEmail(),
                'telepon' => $faker->phoneNumber(),
            ]);
        }
    }
}
