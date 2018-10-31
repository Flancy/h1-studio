<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Projects;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            $project = DB::table('projects')->insert([
                'title' => $faker->realText(rand(20,30)),
                'service_name' => $faker->realText(rand(10,20)),
                'description' => $faker->realText(rand(500,1000)),
                'created_at' => now()
            ]);
        }

        $user = User::find(2);
        $project = Projects::find(1);
        $project = $project->users()->save($user);
    }
}
