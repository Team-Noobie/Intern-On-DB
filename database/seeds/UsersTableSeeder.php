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

        $user4 = new User();
        $user4->username = 'ADMIN';
        $user4->password = bcrypt('ADMIN');
        $user4->type = 'administrator';
        $user4->save();

        $student = new User_Student();
        $student->user_ID = $user1->id;
        $student->student_firstname = 'Rian Kristoffer';
        $student->student_lastname = 'Viloria';
        $student->student_email = 'rian@gmail.com';
        $student->student_birthday = '1997-02-28';
        $student->student_address = 'Tomas Morato';
        $student->student_contact_no = '09753535424';
        $student->student_course = 'Course Outline';
        $student->student_department = 'Department of Justice';
        $student->student_institute = 'Institute of Hokage';
        $student->student_school = 'Far Eastern Far';
        $student->student_gender = 'Male';
        $student->save();

        $company = new User_Company();
        $company->user_ID = $user2->id;
        $company->company_name = 'afrotecH Industry';
        $company->company_overview = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati nemo amet quo adipisci, tempora dolore suscipit earum provident aperiam voluptatum. Placeat tempore nam velit, nostrum sint architecto, iure nesciunt et.';
        $company->company_contact_no = '1234 567 890';
        $company->company_address = '#123 abcd efgh jkl';
        $company->company_email = 'sharina@afrotech.com';
        $company->company_website = 'www.AI.com';
        $company->company_spoken_lang = 'English';
        $company->company_industry = 'IT,Engineering';
        $company->company_benefits = 'friends with,ex with';
        $company->company_job_salary = 'tatlo dos';
        $company->company_why_join_us = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda eius dolor delectus accusantium. Sunt cumque, deserunt inventore consequuntur. Alias, corrupti quis debitis velit magni voluptatum commodi provident? Sapiente, cupiditate, placeat?';
        $company->company_logo = '#image';
        $company->save();

        $coordinator = new User_Coordinator();
        $coordinator->user_ID = $user3->id;
        $coordinator->coordinator_firstname = 'Mars';
        $coordinator->coordinator_lastname = 'Canita';
        $coordinator->coordinator_department = 'Math';
        $coordinator->coordinator_institute = 'IAS';
        $coordinator->coordinator_school = 'FEU';
        $coordinator->coordinator_contact_no = '09268121145';
        $coordinator->coordinator_address = 'sampaloc manila';
        $coordinator->coordinator_email = 'mvpcanita@gmail.com';
        $coordinator->save();
    }
}
