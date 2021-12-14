<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string("bussiness_name");
            $table->string("tin_number");
            $table->string('first_name');
            $table->string('phone_number',20)->unique();
            $table->string('last_name');
            $table->string('country');
            $table->string('district');
            $table->string('province');
            $table->string('cell');
            $table->string('sector');
            $table->string('village');
            $table->string('avatar')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('verified')->default(true);
            $table->integer("frequently_product")->nullable();
            $table->integer("registered_by")->nullable();
            $table->longText("description");
            $table->string('password');
            $table->integer("bussiness_category_id");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
