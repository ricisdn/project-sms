<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i < 10; $i++) {
            DB::table('tbl_gurus')->insert([
                'id' => $faker->unique()->numberBetween(1, 10),
                'nama' => $faker->name,
                'umur' => $faker->numberBetween(25, 60),
                'nomor_telepon' => $faker->phoneNumber,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'alamat' => $faker->address,
                'status' => $faker->randomElement(['Aktif', 'Nonaktif']),
            ]);
        }
    }
}
