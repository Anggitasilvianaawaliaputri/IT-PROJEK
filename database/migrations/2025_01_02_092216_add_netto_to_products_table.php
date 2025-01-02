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
    Schema::table('products', function (Blueprint $table) {
        $table->decimal('netto', 8, 2)->nullable(); // Menambahkan kolom netto
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('netto');
    });
}

};