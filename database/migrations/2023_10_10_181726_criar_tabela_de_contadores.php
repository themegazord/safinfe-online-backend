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
        Schema::create('contadores', function (Blueprint $table) {
            $table->id('contador_id');
            $table->unsignedBigInteger('user_id');
            $table->string('contador_nome', 155);
            $table->string('contador_email', 255);
            $table->string('contador_senha', 255);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contadores', function (Blueprint $table) {
            $table->dropForeign('contadores_user_id_foreign');
        });
        Schema::dropIfExists('contadores');
    }
};
