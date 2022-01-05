<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masses', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('register_service_id')->nullable();
            $table->foreign('register_service_id')->references('id')->on('register_services');
            
            $table->string('request_by')->nullable();
            $table->json('mass_first_name')->nullable();
            $table->json('mass_middle_name')->nullable();
            $table->json('mass_last_name')->nullable();
            $table->json('mass_option')->nullable();
            
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
        Schema::dropIfExists('masses');
    }
}
