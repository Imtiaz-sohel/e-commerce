<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('billing_id');
            $table->foreignId('s_country_id');
            $table->foreignId('s_state_id');
            $table->foreignId('s_city_id');
            $table->string('s_full_name');
            $table->string('s_company_name');
            $table->string('s_email');
            $table->string('s_phone');
            $table->string('s_address');
            $table->string('s_zip_code');
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
        Schema::dropIfExists('shippings');
    }
}
