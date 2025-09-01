<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('factures', function (Blueprint $table) {
            $table->integer('quantite')->after('article_id');
        });
    }

    public function down(): void {
        Schema::table('factures', function (Blueprint $table) {
            $table->dropColumn('quantite');
        });
    }
};

