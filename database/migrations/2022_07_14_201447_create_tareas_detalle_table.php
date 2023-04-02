<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tarea_id')->nullable()->references('id')->on('tarea')->onDelete('cascade');
            $table->foreignId('td_asign_docen_id')->nullable()->references('id')->on('td_asign_docen')->onDelete('cascade');
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
        Schema::dropIfExists('tareas_detalle');
    }
}
