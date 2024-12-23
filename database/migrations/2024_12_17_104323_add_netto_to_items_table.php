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
    Schema::table('items', function (Blueprint $table) {
        $table->decimal('netto', 8, 2)->after('category_id')->default(0); // Tambahkan kolom netto
    });
}

public function down(): void
{
    Schema::table('items', function (Blueprint $table) {
        $table->dropColumn('netto');
    });
}

};
