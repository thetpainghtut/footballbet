<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new User;
      $user->name = 'Master';
      $user->email = 'master@gmail.com';
      $user->password = Hash::make('123456789');
      $user->save();

      $user->assignRole('master');
    }
}
