<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaptismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baptisms', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('register_service_id')->nullable();
            $table->foreign('register_service_id')->references('id')->on('register_services');

            $table->string('child_first_name')->nullable();
            $table->string('child_middle_name')->nullable();
            $table->string('child_last_name')->nullable();
            $table->string('child_date_of_birth')->nullable();
            $table->string('child_gender')->nullable();
            $table->string('child_birth_of_place')->nullable();
            $table->string('child_complete_address')->nullable();

            $table->string('parent_mother_first_name')->nullable();
            $table->string('parent_mother_middle_name')->nullable();
            $table->string('parent_mother_last_name')->nullable();
            $table->string('parent_mother_contact_no')->nullable();
            $table->string('parent_father_first_name')->nullable();
            $table->string('parent_father_middle_name')->nullable();
            $table->string('parent_father_last_name')->nullable();
            $table->string('parent_father_contact_no')->nullable();
            $table->string('parent_complete_address')->nullable();

            $table->string('god_father_first_name')->nullable();
            $table->string('god_father_middle_name')->nullable();
            $table->string('god_father_last_name')->nullable();
            $table->string('god_father_contact_no')->nullable();
            $table->string('god_father_complete_address')->nullable();

            $table->string('god_mother_first_name')->nullable();
            $table->string('god_mother_middle_name')->nullable();
            $table->string('god_mother_last_name')->nullable();
            $table->string('god_mother_contact_no')->nullable();
            $table->string('god_mother_complete_address')->nullable();
            $table->string('baptized')->nullable();
            
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
        Schema::dropIfExists('baptisms');
    }
}
