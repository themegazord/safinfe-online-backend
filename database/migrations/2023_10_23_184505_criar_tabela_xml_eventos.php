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
        Schema::create('xml_eventos', function(Blueprint $table) {
            $table->id('xml_eventos_id');
            $table->unsignedBigInteger('xml_id');
            $table->string('justificativa', 155);
            $table->timestamps();

            $table->foreign('xml_id')->references('xml_id')->on('xml');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('xml_eventos', function(Blueprint $table) {
            $table->dropForeign('xml_eventos_xml_id_foreign');
        });
        Schema::dropIfExists('xml_eventos');
    }
};
