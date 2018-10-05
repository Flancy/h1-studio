<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
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
            DB::table('articles')->insert([
                'title' => $faker->realText(rand(20,30)),
                'short_description' => $faker->realText(rand(100,300)),
                'description' => $faker->realText(rand(500,1000)),
                'photo' => '/public/storage/articles/article-default.jpg',
                'url' => $faker->unique()->realText(rand(20,30)),
                'created_at' => now()
            ]);
        }
    }
}
