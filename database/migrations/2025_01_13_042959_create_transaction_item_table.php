<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


    /**
     * Reverse the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_transaction_item_table.php

public function up()
{
    Schema::create('transaction_item', function (Blueprint $table) {
        $table->id();
        $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
        $table->foreignId('item_id')->constrained()->onDelete('cascade');
        $table->integer('quantity');
        $table->decimal('unit_price', 8, 2);
        $table->decimal('total_price', 8, 2);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('transaction_item');
}

};
