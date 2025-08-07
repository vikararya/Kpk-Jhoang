<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('customer_name');
        $table->string('phone_number');
        $table->decimal('total_price', 10, 2)->default(0);
        $table->timestamps();
    });
}

};
