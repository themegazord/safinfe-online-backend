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
        Schema::create('detalhes_xml', function (Blueprint $table){
            $table->id('detalhes_xml_id');
            $table->unsignedBigInteger('xml_id')->nullable();
            $table->binary('ide')->nullable();
            $table->binary('emit')->nullable();
            $table->binary('dest')->nullable();
            $table->binary('retirada')->nullable();
            $table->binary('entrega')->nullable();
            $table->binary('autXML')->nullable();
            $table->binary('det')->nullable();
            $table->binary('total')->nullable();
            $table->binary('transp')->nullable();
            $table->binary('cobr')->nullable();
            $table->binary('pag')->nullable();
            $table->binary('infIntermed')->nullable();
            $table->binary('infAdic')->nullable();
            $table->binary('exporta')->nullable();
            $table->binary('compra')->nullable();
            $table->binary('cana')->nullable();
            $table->timestamps();

            $table->foreign('xml_id')->references('xml_id')->on('xml');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalhes_xml', function(Blueprint $table) {
            $table->dropForeign('detalhes_xml_xml_id_foreign');
        });
        Schema::dropIfExists('detalhes_xml');
    }
};
