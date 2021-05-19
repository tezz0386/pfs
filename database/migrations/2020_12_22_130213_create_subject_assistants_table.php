<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_assistants', function (Blueprint $table) {
            $table->id();
            $table->integer('assistant_id');
            $table->integer('subject_id');
            $table->integer('year_id');
            $table->string('subject_code')->unique();
            $table->integer('assign')->default(0);
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
        Schema::dropIfExists('subject_assistants');
    }
}
