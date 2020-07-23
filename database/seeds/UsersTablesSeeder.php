<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()   //populates books table with inital sample/test users
    {
      $users = [
        [
          'name' => 'Test User',
          'email' => 'test.user@test.com',
          'password' => Hash::make('password'),
        ],

        [
          'name' => 'Test Admin',
          'email' => 'test.admin@test.com',
          'password' => Hash::make('password'),
          'is_admin' => true,
        ]

      ];
      foreach ($users as $user) {
        User::create($user);
      }

    }
}
