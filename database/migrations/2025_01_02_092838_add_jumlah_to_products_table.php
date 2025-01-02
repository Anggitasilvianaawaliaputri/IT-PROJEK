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
        if (!Schema::hasColumn('produks', 'jumlah')) {
            Schema::table('produks', function (Blueprint $table) {
                $table->numeric('jumlah')->default(0);
            });
        }
    }
    
    public function down()
    {
        if (Schema::hasColumn('produks', 'jumlah')) {
            Schema::table('produks', function (Blueprint $table) {
                $table->dropColumn('jumlah');
            });
        }
    }
};    
