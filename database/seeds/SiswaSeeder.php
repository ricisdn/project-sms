<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
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
            DB::table('tbl_siswas')->insert([
                'nama' => $faker->name,
                'id_kelas' => $faker->numberBetween(1, 3),
                'tgl_lahir' => $faker->date(),
                'nomor_telepon' => $faker->phoneNumber('08##########'),
                'jenis_kelamin' => $faker->randomElement(['Laki-Laki', 'Perempuan']),
                'alamat' => $faker->address
            ]);
        }
    }
}