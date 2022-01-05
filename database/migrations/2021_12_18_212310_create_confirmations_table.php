<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('register_service_id')->nullable();
            $table->foreign('register_service_id')->references('id')->on('register_services');
            
            $table->string('confirmation_first_name')->nullable();
            $table->string('confirmation_middle_name')->nullable();
            $table->string('confirmation_last_name')->nullable();
            $table->string('confirmation_complete_address')->nullable();
            $table->string('confirmation_gender')->nullable();
            $table->string('confirmation_age')->nullable();
            $table->string('confirmation_contact_no')->nullable();

            $table->string('start_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_date')->nullable();
            $table->string('end_time')->nullable();
            // $table->string('confirm')->nullable();
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
        Schema::dropIfExists('confirmations');
    }
}