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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('cliente_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('contador_id');
            $table->string('cliente_nome', 155);
            $table->string('cliente_cpf_cnpj',14);
            $table->string('cliente_email', 255);
            $table->string('cliente_senha', 255);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contador_id')->references('contador_id')->on('contadores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropForeign('clientes_contador_id_foreign');
            $table->dropForeign('clientes_user_id_foreign');
        });
        Schema::dropIfExists('clientes');
    }
};
