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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('menu_id')->constrained()->onDelete('cascade');
        $table->string('user_name');
        $table->text('comment');
        $table->tinyInteger('rating'); // contoh: 1–5 bintang
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
