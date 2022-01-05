<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBurialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('burials', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('register_service_id')->nullable();
            $table->foreign('register_service_id')->references('id')->on('register_services');
            
            $table->string('burial_first_name')->nullable();
            $table->string('burial_middle_name')->nullable();
            $table->string('burial_last_name')->nullable();
            $table->string('burial_gender')->nullable();
            $table->string('burial_complete_address')->nullable();
            $table->string('burial_birth_of_date')->nullable();
            $table->string('burial_birth_of_place')->nullable();
            $table->string('burial_date_died')->nullable();
            $table->string('burial_place_died')->nullable();

            // $table->string('scheduled_date')->nullable();
            // $table->string('scheduled_time_form')->nullable();
            // $table->string('scheduled_time_to')->nullable();
            $table->string('start_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_date')->nullable();
            $table->string('end_time')->nullable();
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('burials');
    }
}
