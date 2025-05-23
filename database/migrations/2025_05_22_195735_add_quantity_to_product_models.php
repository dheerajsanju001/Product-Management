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
        Schema::table('product_models', function (Blueprint $table) {
            $table->dropColumn('status'); 
            $table->integer('stock_in')->default(0);
            $table->integer('stock_out')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_models', function (Blueprint $table) {
            $table->boolean('status')->default(1);
            $table->dropColumn(['stock_in', 'stock_out']);
        });
    }
};
