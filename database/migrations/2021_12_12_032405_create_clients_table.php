<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('fullname',50)->nullable();
            $table->string('address',100)->nullable();
            $table->string('contact_no',15)->nullable();
            $table->string('email',50)->nullable();
            // $table->string('selected_date',15)->nullable();
            // $table->string('selected_time',15)->nullable();
            // $table->string('status',10)->default('Pending');
            $table->string('username')->nullable();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
