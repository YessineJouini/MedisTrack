<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('article_ticket', function (Blueprint $table) {
    $table->id();
    $table->foreignId('article_id')->constrained()->onDelete('cascade');
    $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
    $table->integer('quantite_utilisee'); // how many of this article used in the ticket
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_ticket');
    }
};
