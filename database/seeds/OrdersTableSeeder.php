<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
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
            DB::table('orders')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'phone' => $faker->phoneNumber,
                'description' => $faker->realText(rand(40,200)),
                'subject' => $faker->realText(rand(20,30)),
                'status' => 'Новая заявка',
                'url' => $faker->url,
                'utm' => $faker->realText(rand(20,30)),
                'date' => $faker->dateTime($max = 'now')
            ]);
        }
    }
}
