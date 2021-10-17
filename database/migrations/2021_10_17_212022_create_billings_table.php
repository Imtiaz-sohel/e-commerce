<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('full_name');
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('country_id');
            $table->foreignId('state_id');
            $table->foreignId('city_id');
            $table->string('address');
            $table->string('zip_code');
            $table->string('phone');
            $table->string('pay_type');
            $table->text('notes')->nullable();
            $table->string('different_shipping')->default(1)->comment('1=>no diff Shipping 2=>has diff shipping');
            $table->string('payment_status')->default(1)->comment('1=>unpaid 2=>paid');
            $table->string('total_amount')->nullable();
            $table->string('discount')->nullable();
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
        Schema::dropIfExists('billings');
    }
}
