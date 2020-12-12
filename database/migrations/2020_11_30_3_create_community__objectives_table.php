<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql-community')->create('objectives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained('ignug.states');
            $table->foreignId('project_id')->constrained('community.projects');
            $table->text('indicator');
            $table->json('means_verification')->nullable();
            $table->text('description')->nullable();//linea base
            $table->foreignId('type')->constrained('ignug.catalogues');//crear tipo de catologos
            $table->foreignId('children')->nullable()->constrained('objectives');//tabla recusiva
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
        Schema::dropIfExists('objectives');
    }
}
