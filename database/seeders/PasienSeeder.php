<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $rsId = RumahSakit::pluck('id')->toArray();
        foreach (range(1, 20) as $i) {
            Pasien::create([
                'nama_pasien'    => $faker->name(),
                'alamat'         => $faker->address(),
                'telepon'        => $faker->phoneNumber(),
                'rumah_sakit_id' => $faker->randomElement($rsId), // id rumah sakit yang sudah ada
            ]);
        }
    }
}
