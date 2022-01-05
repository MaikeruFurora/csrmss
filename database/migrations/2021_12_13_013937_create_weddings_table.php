<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('register_service_id')->nullable();
            $table->foreign('register_service_id')->references('id')->on('register_services');

            $table->string('bride_first_name')->nullable();
            $table->string('bride_middle_name')->nullable();
            $table->string('bride_last_name')->nullable();
            $table->string('bride_contact_no')->nullable();
            $table->string('bride_complete_address')->nullable();
            $table->string('groom_first_name')->nullable();
            $table->string('groom_middle_name')->nullable();
            $table->string('groom_last_name')->nullable();
            $table->string('groom_contact_no')->nullable();
            $table->string('groom_complete_address')->nullable();
            $table->string('married')->nullable();
           
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
        Schema::dropIfExists('weddings');
    }
}
