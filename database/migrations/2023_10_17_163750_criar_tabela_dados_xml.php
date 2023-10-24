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
        Schema::create('dados_xml', function(Blueprint $table) {
            $table->id('dados_xml_id');
            $table->unsignedBigInteger('xml_id');
            $table->unsignedBigInteger('cliente_id');
            $table->string('status', 15);
            $table->integer('modelo');
            $table->integer('serie');
            $table->integer('numeronf');
            $table->integer('numeronf_final')->nullable();
            $table->string('justificativa')->nullable();
            $table->dateTime('dh_emissao_evento');
            $table->string('chave', 45);
            $table->timestamps();

            $table->foreign('xml_id')->references('xml_id')->on('xml');
            $table->foreign('cliente_id')->references('cliente_id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dados_xml', function(Blueprint $table) {
            $table->dropForeign('dados_xml_cliente_id_foreign');
            $table->dropForeign('dados_xml_xml_id_foreign');
        });
        Schema::dropIfExists('dados_xml');
    }
};
