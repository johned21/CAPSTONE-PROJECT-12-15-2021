<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('lrn')->nullable();
            $table->string('firstName', 40);
            $table->string('lastName', 40);
            $table->string('middleName', 40);
            $table->string('gender', 10);
            $table->date('birthDate');
            $table->string('birthPlace', 191);
            $table->string('civilStatus', 30);
            $table->string('nationality', 30);
            $table->string('religion', 30);
            $table->string('fatherName', 120);
            $table->string('fatherOccup', 120);
            $table->string('fatherContact', 20)->nullable();
            $table->string('motherName', 120);
            $table->string('motherOccup', 120);
            $table->string('motherContact', 20)->nullable();
            $table->string('guardianName', 120)->nullable();
            $table->string('guardianContact', 20)->nullable();
            $table->string('barangay', 191);
            $table->string('town', 191);
            $table->string('province', 191);
            $table->string('grade_LVL')->nullable();
            $table->string('elemSchool', 191);
            $table->string('elemSchlAddr', 191);
            $table->string('elemYrAttnd', 191);
            $table->string('secondarySchool', 191)->nullable();
            $table->string('secondarySchlAddr', 191)->nullable();
            $table->string('secondaryYrAttnd', 191)->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
