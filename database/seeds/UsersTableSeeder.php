<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\User_Student;
use App\Models\User_Company;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User();
        $user1->email = 'alex@gmail.com';
        $user1->password = bcrypt('123');
        $user1->type = 'student';
        $user1->save();

        $user2 = new User();
        $user2->email = 'company@gmail.com';
        $user2->password = bcrypt('123');
        $user2->type = 'company';
        $user2->save();

        $student = new User_Student();
        $student->user_ID = $user1->id;
        $student->student_name = 'Sequena, Alexander R.';
        $student->save();

        $company = new User_Company();
        $company->user_ID = $user2->id;
        $company->company_name = 'Team Noobie';
        $company->save();
        

    }
}
