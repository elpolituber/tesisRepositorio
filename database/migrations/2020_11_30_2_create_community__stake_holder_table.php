<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityStakeHolderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql-community')->create('stake_holders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained('ignug.states');
            $table->foreignId('project_id')->constrained();
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('identification');
            $table->string('position');
            $table->foreignId('type')->constrained('ignug.catalogues');//coordinador o representate legal
        //    $table->foreignId('function')->nullable()->constrained('ignug.catalogues');//rol asignado catalogo 
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
        Schema::dropIfExists('student_participants');
    }
}
