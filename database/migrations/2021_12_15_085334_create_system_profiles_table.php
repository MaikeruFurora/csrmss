<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('church_name')->nullable();
            $table->string('church_address')->nullable();
            $table->string('church_logo')->nullable();
            $table->string('church_image')->nullable();
            $table->string('church_body')->nullable();
            // $table->text('amount_services')->nullable();
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
        Schema::dropIfExists('system_profiles');
    }
}
