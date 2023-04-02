<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTdAsignDocenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('td_asign_docen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asignatura_id')->nullable()->references('id')->on('asignaturas')->onDelete('cascade');
            $table->foreignId('docente_id')->nullable()->references('id')->on('docentes')->onDelete('cascade');
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
        Schema::dropIfExists('td_asign_docen');
    }
}
