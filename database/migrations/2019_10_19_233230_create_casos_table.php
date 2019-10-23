<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casos', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('fecha_creado');
            $table->string('nombre_caso');
            $table->text('descripcion');
            $table->datetime('fecha_finalizado')->nullable();
            $table->unsignedInteger('tipo_casos_id')->nullable();
            $table->foreign('tipo_casos_id')->references('id')->on('tipo_casos');
            $table->unsignedInteger('etapa_casos_id')->nullable();
            $table->foreign('etapa_casos_id')->references('id')->on('etapa_casos');

            $table->unsignedInteger('usuario_crear')->nullable();
            $table->foreign('usuario_crear')->references('id')->on('users');
            $table->unsignedInteger('oficina_id')->nullable();
            $table->foreign('oficina_id')->references('id')->on('oficinas');
            $table->unsignedInteger('empresa_id')->nullable();
            $table->foreign('empresa_id')->references('id')->on('empresas');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casos');
    }
}
