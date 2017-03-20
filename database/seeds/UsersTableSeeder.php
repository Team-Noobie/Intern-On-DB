<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\User_Student;
use App\Models\User_Company;
use App\Models\User_Coordinator;


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
        $user1->username = 'rian';
        $user1->password = bcrypt('123');
        $user1->type = 'student';
        $user1->save();

        $user2 = new User();
        $user2->username = 'company1';
        $user2->password = bcrypt('123');
        $user2->type = 'company';
        $user2->save();

        $user3 = new User();
        $user3->username = 'coordinator2';
        $user3->password = bcrypt('123');
        $user3->type = 'coordinator';
        $user3->save();

        $student = new User_Student();
        $student->user_ID = $user1->id;
        $student->student_firstname = 'Rian Kristoffer';
        $student->student_lastname = 'Viloria';
        $student->student_email = 'rian@gmail.com';
        $student->student_birthday = '02-28-1998';
        $student->student_address = 'Tomas Morato';
        $student->student_contact_no = '09753535424';
        $student->student_course = 'Course Outline';
        $student->student_department = 'Department of Justice';
        $student->student_institute = 'Institute of Hokage';
        $student->student_school = 'Far Eastern Far';
        $student->save();

        $company = new User_Company();
        $company->user_ID = $user2->id;
        $company->company_name = 'afrotecH Industry';
        $company->save();

        $coordinator = new User_Coordinator();
        $coordinator->user_ID = $user3->id;
        $coordinator->coordinator_name = 'Mars Canita';
        $coordinator->save();
    }
}
