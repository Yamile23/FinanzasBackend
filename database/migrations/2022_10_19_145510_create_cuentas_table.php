<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre")->nullable();
            $table->integer("Saldo")->nullable();
            $table->timestamps();
        });
        Schema::table("movimientos", function (Blueprint $table){
            $table->unsignedBigInteger("cuentaOrigen_id")->nullable();
            $table->foreign("cuentaOrigen_id")->references("id")->on("cuentas")
                ->on("cuentas")->
                onUpdate('cascade')->onDelete('set null');
        });
        Schema::table("movimientos", function (Blueprint $table){
            $table->unsignedBigInteger("cuentaDestino_id")->nullable();
            $table->foreign("cuentaDestino_id")->references("id")->on("cuentas")
                ->on("cuentas")->
                onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas');
    }
};
