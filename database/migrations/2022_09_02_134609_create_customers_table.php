<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->bigInteger('phone_number');
            $table->bigInteger('whatsapp_number')->nullable();
            $table->string('customer_address');
            $table->string('customer_email');
            $table->string('customer_state');
            $table->date('date_of_delivery');
            $table->text('total_cost_of_products');
            $table->char('dispatcher_id', 200);
            $table->string('products_status')->default('not processed');
            $table->text('dispatcher_note');
            $table->json('products');
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
        Schema::dropIfExists('customers');
    }
};
