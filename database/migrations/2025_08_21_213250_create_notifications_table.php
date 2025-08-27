<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
   Schema::create('notifications', function (Blueprint $table) {
    $table->id();
    $table->string('message');
    $table->dateTime('date')->default(now());
    $table->foreignId('article_id')
      ->constrained('articles')
      ->onDelete('cascade');

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
