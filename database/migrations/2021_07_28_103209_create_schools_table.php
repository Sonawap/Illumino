<?php

use App\Models\Exam;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->unique();
            $table->string('access_key')->unique();
            $table->enum('account_type',['basic','premium']);
            $table->string('website')->nullable();
            $table->text('logo');
            $table->enum("account_status",['active','unactive','disabled'])->default('active');
            $table->longText('description');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }


}
