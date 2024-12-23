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
        Schema::table('produks', function (Blueprint $table) {
            if (!Schema::hasColumn('sales', 'produks_id')) {
                $table->foreignId('produks_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('sales', 'produks_id')) {
                $table->dropForeign(['produks_id']);
                $table->dropColumn('produks_id');
            }
        });
    }
};
