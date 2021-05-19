<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBCMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_c_m_s', function (Blueprint $table) {
            $table->id();
            $table->integer('mode')->nullable();
            $table->integer('year')->nullable();
            $table->integer('subject_assistant_id')->nullable();
            $table->integer('edition')->nullable();
            $table->string('publication')->nullable();
            $table->string('file_name')->nullable();
            $table->integer('medium')->nullable();
            $table->integer('downloaded')->default(0);
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
        Schema::dropIfExists('b_c_m_s');
    }
}
