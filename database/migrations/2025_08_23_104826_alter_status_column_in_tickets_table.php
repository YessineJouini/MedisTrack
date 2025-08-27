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
    Schema::table('tickets', function (Blueprint $table) {
        $table->enum('status', ['en_cours', 'en_attente', 'done', 'annuler'])
              ->default('en_cours')
              ->change();
    });
}

public function down()
{
    Schema::table('tickets', function (Blueprint $table) {
        $table->string('status')->change(); // rollback to old type
    });
}

};
