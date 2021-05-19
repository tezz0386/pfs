<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeeNebAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('see_neb_assistants', function (Blueprint $table) {
            $table->id();
            $table->integer('subject_id');
            $table->string('subject_code')->unique();
            $table->string('assign')->default(0);
            $table->integer('class')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->integer('level_id');
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
        Schema::dropIfExists('see_neb_assistants');
    }
}
