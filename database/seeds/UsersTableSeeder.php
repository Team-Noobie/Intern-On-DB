<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = 'alex@gmail.com';
        $user->password = bcrypt('secret');
        $user->type = 'student';
        $user->save();
    }
}
