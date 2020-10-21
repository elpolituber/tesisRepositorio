<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql-authentication')->create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('uri')->comment('La direccion de la ruta');
            $table->string('label')->comment('Nombre de la ruta');
            $table->string('icon')->nullable()->comment('Icono de la libreria que se usa en el frontend');
            $table->integer('order')->comment('Orden que apareceran las rutas en la interfaz');
            $table->foreignId('parent_id')->nullable()->comment('Una ruta puede tener rutas hijas')->constrained('routes');
            $table->foreignId('module_id')->comment('Cada ruta debe pertenecer a un modulo del sistema')->constrained('ignug.catalogues');
            $table->foreignId('state_id')->constrained('ignug.states');
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
        Schema::connection('pgsql-authentication')->dropIfExists('routes');
    }
}
