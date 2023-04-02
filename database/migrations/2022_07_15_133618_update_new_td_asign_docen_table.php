<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNewTdAsignDocenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('td_asign_docen', function (Blueprint $table) {

            $table->foreignId('curso_id')->nullable()->references('id')->on('cursos')->onDelete('cascade');
            $table->tinyInteger('estado')->default('1');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
