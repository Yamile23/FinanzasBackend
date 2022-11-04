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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->String("Tipo")->nullable();
            $table->String("Concepto")->nullable();
            $table->timestamps();
        });
        Schema::table("movimientos", function (Blueprint $table){
            $table->unsignedBigInteger("categoria_id")->nullable();
            $table->foreign("categoria_id")->references("id")->on("categorias")
                ->on("categorias")->
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
        Schema::dropIfExists('categorias');
    }
};
