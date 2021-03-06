<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('students_id')
                ->nullable()
                ->constrained('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('school_id')
                ->nullable()
                ->constrained('schools')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('course_id')
                ->nullable()
                ->constrained('courses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('total_score');
            $table->string('subject1_score');
            $table->string('subject2_score');
            $table->string('subject3_score');
            $table->string('subject4_score');
            $table->string('exam_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
