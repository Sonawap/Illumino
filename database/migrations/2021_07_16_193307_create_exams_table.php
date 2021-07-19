<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('SchoolName')->unique();
            $table->string('Exam_Briefing');
            $table->string('Exam_Intructions')->nullable();
            $table->string('Exam_Questions')->nullable();
            $table->string('Option_A')->nullable();
            $table->string('Option_B')->nullable();
            $table->string('Option_C')->nullable();
            $table->string('Option_D');
            $table->string('Correct_Option');
            $table->enum('exam_status', ['inStock', 'outStock']);
            $table->string('Exam_Start');
            $table->string('Exam_Stop');
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
        Schema::dropIfExists('exams');
    }
}
