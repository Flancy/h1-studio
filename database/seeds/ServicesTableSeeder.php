<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 30;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('services')->insert([
                'title' => $faker->realText(rand(20,30)),
                'description' => $faker->realText(rand(500,700)),
                'photo' => '/img/service-default.png',
            ]);
        }
    }
}
