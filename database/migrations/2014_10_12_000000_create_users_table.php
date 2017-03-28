<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tbl_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('type');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('tbl_user_company', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_ID')->unique();
            $table->string('company_name',50)->nullable();
            $table->string('company_overview',1000)->nullable();
            $table->string('company_contact_no',50)->nullable();
            $table->string('company_address',100)->nullable();
            $table->string('company_email',50)->nullable();
            $table->string('company_website',50)->nullable();
            $table->string('company_spoken_lang',50)->nullable();
            $table->string('company_industry',50)->nullable();
            $table->string('company_job_salary',50)->nullable();
            $table->string('company_benefits',50)->nullable();
            $table->string('company_why_join_us',1000)->nullable();
            $table->string('company_logo',250)->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_user_coordinator', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_ID')->unique();
            $table->string('coordinator_firstname',30);
            $table->string('coordinator_lastname',30);
            $table->string('coordinator_department',50)->nullable();
            $table->string('coordinator_institute',50)->nullable();
            $table->string('coordinator_school',50)->nullable();
            $table->string('coordinator_contact_no',30)->nullable();
            $table->string('coordinator_address',50)->nullable();
            $table->string('coordinator_email',50)->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_user_student', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_ID')->unique();
            $table->string('student_firstname',50)->nullable();
            $table->string('student_lastname',50)->nullable();
            $table->string('student_email',50)->nullable();
            $table->string('student_gender',50)->nullable();            
            $table->date('student_birthday')->nullable();
            $table->string('student_address',50)->nullable();
            $table->string('student_contact_no',50)->nullable();
            $table->string('student_course',50)->nullable();
            $table->string('student_department',50)->nullable();
            $table->string('student_institute',50)->nullable();
            $table->string('student_school',50)->nullable();  
            $table->string('resume',50)->nullable()->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_user_hr', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_ID')->unique();  
            $table->Integer('company_id');
            $table->string('hr_firstname',50);
            $table->string('hr_lastname',50);
            $table->string('hr_email',50);
            $table->timestamps();
        });  

        Schema::create('tbl_user_sv', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_ID')->unique();
            $table->Integer('company_id');
            $table->Integer('department_id');                                
            $table->string('sv_firstname',50);
            $table->string('sv_lastname',50);
            $table->string('sv_email',50);
            $table->timestamps();
        });    
  
        Schema::create('tbl_advertisement', function (Blueprint $table) {
			$table->increments('id');
			$table->Integer('company_id');
            $table->string('ads_title',50);
			$table->string('ads_job_description',1000);
			// $table->string('ads_tags',255);
			$table->string('ads_contact',50);      
			$table->string('ads_work_location',200)->nullable();
			$table->string('ads_visibility',10)->nullable();
			$table->timestamps();
		});

        Schema::create('tbl_application', function (Blueprint $table) {
			$table->increments('id');
			$table->Integer('student_id');
			$table->Integer('ads_id');
			$table->Integer('company_id');
            $table->string('status',255);   
            $table->timestamps();
		});

        Schema::create('tbl_application_log', function (Blueprint $table) {
			$table->increments('id');
			$table->Integer('application_id');           
            $table->string('remarks',1000)->nullable();
            $table->string('status',50); 
            $table->string('reason',50);
            $table->date('interview_date');
            $table->time('interview_time');
            $table->Integer('hr_id')->nullable();
            $table->string('interviewer_type',50)->nullable();                        
            $table->timestamps();
		});

        Schema::create('tbl_company_interns', function (Blueprint $table) {
			$table->increments('id');
			$table->Integer('company_id');
            $table->Integer('student_id');
            $table->Integer('department_id');
            $table->string('status')->nullable();            
            $table->timestamps();
		});
        
        Schema::create('tbl_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section_code',20);
            $table->string('course_code',20);
            $table->timestamps();
        });
        
        Schema::create('tbl_section_students', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('section_id');
            $table->Integer('student_id');
            $table->Integer('coordinator_id');
            $table->timestamps();
        });

        Schema::create('tbl_company_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('company_id');
            $table->string('department_name',20);
            $table->timestamps();
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_user');
        Schema::dropIfExists('tbl_user_company');
        Schema::dropIfExists('tbl_user_coordinator');
        Schema::dropIfExists('tbl_user_student');
        Schema::dropIfExists('tbl_advertisement');
        Schema::dropIfExists('tbl_application');
        Schema::dropIfExists('tbl_user_hr');
        Schema::dropIfExists('tbl_user_sv');
        Schema::dropIfExists('tbl_application_log');
        Schema::dropIfExists('tbl_company_interns');
        Schema::dropIfExists('tbl_company_departments');
        Schema::dropIfExists('tbl_sections');
        Schema::dropIfExists('tbl_section_students');   
    }




}
