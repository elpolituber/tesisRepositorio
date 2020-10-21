<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql-teacher-eval')->create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('ignug.teachers');
            $table->foreignId('state_id')->constrained('ignug.states');
            $table->integer('percentage')->nullable(); //este porcentaje se tomara de la tabla evaluations types
            $table->double('result',5,2)->nullable();
            $table->foreignId('type_id')->constrained('ignug.catalogues');


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
        Schema::dropIfExists('evaluations');
    }
}
