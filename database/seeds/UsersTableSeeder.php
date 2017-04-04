<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\User_Student;
use App\Models\User_Company;
use App\Models\User_Coordinator;
use App\Models\User_SV;
use App\Models\User_HR;
use App\Models\Section;
use App\Models\Section_Students;

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
        $user1->username = 'feu_student';
        $user1->password = bcrypt('123');
        $user1->type = 'student';
        $user1->save();

        $user2 = new User();
        $user2->username = 'company';
        $user2->password = bcrypt('123');
        $user2->type = 'company';
        $user2->save();

        $user3 = new User();
        $user3->username = 'coordinator';
        $user3->password = bcrypt('123');
        $user3->type = 'coordinator';
        $user3->save();

        $user4 = new User();
        $user4->username = 'ADMIN';
        $user4->password = bcrypt('ADMIN');
        $user4->type = 'administrator';
        $user4->save();

        // $user5 = new User();
        // $user5->username = 'hr';
        // $user5->password = bcrypt('123');
        // $user5->type = 'hr';
        // $user5->save();

        // $user6 = new User();
        // $user6->username = 'sv';
        // $user6->password = bcrypt('123');
        // $user6->type = 'sv';
        // $user6->save();

        $student = new User_Student();
        $student->user_ID = $user1->id;
        $student->student_firstname = 'Rian Kristoffer';
        $student->student_lastname = 'Viloria';
        $student->student_email = 'rian@gmail.com';
        $student->student_birthday = '1997-02-28';
        $student->student_address = 'Tomas Morato';
        $student->student_contact_no = '09753535424';
        $student->student_course = 'BS Applied Mathematics with Information Technology';
        $student->student_department = 'Mathematics Department';
        $student->student_institute = 'Institute of Arts and Sciences';
        $student->student_school = 'Far Eastern University';
        $student->student_gender = 'Male';
        $student->save();

        $company = new User_Company();
        $company->user_ID = $user2->id;
        $company->company_name = 'afrotecH Industry';
        $company->company_symbol = 'AFI';        
        $company->company_overview = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati nemo amet quo adipisci, tempora dolore suscipit earum provident aperiam voluptatum. Placeat tempore nam velit, nostrum sint architecto, iure nesciunt et.';
        $company->company_contact_no = '926-8-629';
        $company->company_address = '#123 ADB Dr. Jose San Pedro St. Pasig City';
        $company->company_email = 'HRsharina@afrotech.com';
        $company->company_website = 'www.AI.com';
        $company->company_spoken_lang = 'English';
        $company->company_industry = 'IT, Engineering';
        $company->company_benefits = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi commodi unde omnis cumque ullam. Sit, vel quaerat aut, culpa veniam, excepturi voluptatum optio maxime inventore ipsum earum officiis expedita impedit!';
        $company->company_job_salary = '';
        $company->company_why_join_us = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda eius dolor delectus accusantium. Sunt cumque, deserunt inventore consequuntur. Alias, corrupti quis debitis velit magni voluptatum commodi provident? Sapiente, cupiditate, placeat?';
        $company->company_logo = '#image';
        $company->save();

        $coordinator = new User_Coordinator();
        $coordinator->user_ID = $user3->id;
        $coordinator->coordinator_firstname = 'Mars';
        $coordinator->coordinator_lastname = 'Canita';
        $coordinator->coordinator_symbol = 'feu';
        $coordinator->coordinator_department = 'Math';
        $coordinator->coordinator_institute = 'IAS';
        $coordinator->coordinator_school = 'FEU';
        $coordinator->coordinator_contact_no = '09268121145';
        $coordinator->coordinator_address = 'Sampaloc Manila';
        $coordinator->coordinator_email = 'mvpcanita@gmail.com';
        $coordinator->save();
        
        $section = new Section();
        $section->coordinator_id = $user3->id;
        $section->section_code = 'Section1';
        $section->save();

        $sectionStudent = new Section_Students();
        $sectionStudent->section_id = $section->id;
        $sectionStudent->coordinator_id = $user3->id;
        $sectionStudent->student_id = $user1->id;
        $sectionStudent->save();

        // $hr = new User_HR();
        // $hr->user_ID = $user5->id;
        // $hr->company_id = $user2->id;        
        // $hr->hr_firstname = "Sharina" ;
        // $hr->hr_lastname = "Cruz";
        // $hr->hr_email = "HR@gmail.com";
        // $hr->save();

        // $sv = new User_SV();
        // $sv->user_ID = $user6->id;
        // $sv->company_id = $user2->id;        
        // $sv->sv_firstname = "Chris" ;
        // $sv->sv_lastname = "Mendenilla";
        // $sv->sv_email = "SV@gmail.com";
        // $sv->save();
    }
}
