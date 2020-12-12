<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql-community')->create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained('ignug.states');
            $table->foreignId('user_id')->connstrained('ignug.users');
            $table->foreignId('project_id')->constrained();
            $table->string('position')->nullable();
            $table->foreignId('type')->constrained('ignug.catalogues');//rector estudiante coordinador profesor
            $table->integer('working_hours')->nullable();//horas de trabajo
            $table->foreignId('function')->constrained('ignug.catalogues');//rol asignado catalogo 
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
        Schema::dropIfExists('teacher_participants');
    }
}
