<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
     Schema::create('factures', function (Blueprint $table) {
    $table->id();
    $table->float('montant');
    $table->date('date');
    $table->foreignId('article_id')->constrained()->onDelete('cascade'); // facture is for a stock refill of an article
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
