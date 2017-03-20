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
            $table->increments('ID');
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
            $table->increments('ID');
            $table->Integer('user_ID')->unique();
            $table->string('coordinator_name',30);
            $table->timestamps();
        });

        Schema::create('tbl_user_student', function (Blueprint $table) {
            $table->increments('ID');
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


        Schema::create('tbl_advertisement', function (Blueprint $table) {
			$table->increments('ID');
			$table->Integer('company_id');
            $table->string('ads_title',50);
			$table->string('ads_job_description',1000);
			// $table->string('ads_tags',255);
			$table->string('ads_contact',20);      
			$table->string('ads_work_location',200)->nullable();
			$table->string('ads_visibility',10)->nullable();
			$table->timestamps();
		});

        

         Schema::create('tbl_application', function (Blueprint $table) {
			$table->increments('ID');
			$table->Integer('student_id');
			$table->Integer('ads_id');
			$table->Integer('company_id');
            $table->string('status',255);   
            $table->timestamps();
		});


        Schema::create('tbl_application_log', function (Blueprint $table) {
			$table->increments('ID');
			$table->Integer('application_ID');           
            $table->string('remarks',1000)->nullable();
            $table->string('status',50); 
            $table->date('interview_date');
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
        Schema::dropIfExists('tbl_application_log');
    }




}
