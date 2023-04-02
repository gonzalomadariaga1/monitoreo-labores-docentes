<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosAsignaturasDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_asignaturas_docentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->nullable()->references('id')->on('cursos')->onDelete('cascade');
            $table->foreignId('docente_id')->nullable()->references('id')->on('docentes')->onDelete('cascade');
            $table->foreignId('asignatura_id')->nullable()->references('id')->on('asignaturas')->onDelete('cascade');
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
        Schema::dropIfExists('cursos_asignaturas_docentes');
    }
}
