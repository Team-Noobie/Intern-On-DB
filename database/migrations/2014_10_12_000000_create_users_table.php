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
            $table->string('company_name');
            $table->timestamps();
        });

        Schema::create('tbl_user_coordinator', function (Blueprint $table) {
            $table->increments('ID');
            $table->Integer('user_ID')->unique();
            $table->string('coordinator_name');
            $table->timestamps();
        });

        Schema::create('tbl_user_student', function (Blueprint $table) {
            $table->increments('ID');
            $table->Integer('user_ID')->unique();
            $table->string('student_name');
            $table->timestamps();
        });


        Schema::create('tbl_advertisement', function (Blueprint $table) {
			$table->increments('ID');
			$table->string('company_id',255);
            $table->string('ads_title',255);
			$table->string('ads_requirement',255);
			$table->string('ads_tags',255);
			$table->string('ads_responsibility',255);
			$table->string('ads_contact',255);      
			$table->string('ads_banner_photo',255)->nullable();
			$table->string('ads_visibility',255)->nullable();
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
            $table->string('status',20); 
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
