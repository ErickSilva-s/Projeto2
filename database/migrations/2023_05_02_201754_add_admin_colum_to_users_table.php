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
        //
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_cliente')->default(true);
            $table->boolean('is_vendedor')->default(false);
            $table->boolean('is_entregador')->default(false); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('is_admin');
            $table->dropColumn('is_cliente');
            $table->dropColumn('is_vendedor');
            $table->dropColumn('is_entregador');
        });
    }
};
