<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
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
            DB::table('tbl_kelass')->insert([
                'id' => $faker->unique()->numberBetween(1, 3),
                'nama_kelas' => $faker->randomElement(['Kelas 7', 'Kelas 8', 'Kelas 9']),
            ]);
        }
    }
}