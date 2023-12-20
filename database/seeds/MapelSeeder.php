<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
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
            DB::table('tbl_mapels')->insert([
                'id' => $faker->unique()->numberBetween(1, 10),
                'id_guru' => $faker->numberBetween(1, 6),
                'nama_mapel' => $faker->word,
                'hari' => $faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
                'jam_mulai' => $faker->time('H:i:s'),
                'jam_selesai' => $faker->time('H:i:s'),
            ]);
        }

    }
}
