<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'name' => 'h1-studio-admin',
            'full_name' => 'H1-Studio',
            'email' => 'flancyk.flancyk@yandex.ru',
            'password' => Hash::make('admin'),
            'company' => 'H1-Studio',
            'description' => 'Маркетинговое digital-агентство H1-STUDIO',
        ]);

        $role = Role::find(1);
        $role->users()->save($user);
    }
}
