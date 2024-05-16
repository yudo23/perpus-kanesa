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
        Schema::table('biblio', function (Blueprint $table) {
            $table->string("synopsis_url",255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biblio', function (Blueprint $table) {
            $table->dropColumn(["synopsis_url"]);
        });
    }
};
