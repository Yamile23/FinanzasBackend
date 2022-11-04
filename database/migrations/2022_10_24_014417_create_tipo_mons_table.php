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
        Schema::create('tipo_mons', function (Blueprint $table) {
            $table->id();
            $table->String('Nombre');
            $table->String('Simbolo');
            $table->timestamps();
        });
        Schema::table("movimientos", function (Blueprint $table){
            $table->unsignedBigInteger("tipo_id")->nullable();
            $table->foreign("tipo_id")->references("id")->on("tipo_mons")
                ->on("tipo_mons")->
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
        Schema::dropIfExists('tipo_mons');
    }
};
