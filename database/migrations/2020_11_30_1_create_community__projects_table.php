<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql-community')->create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiary_institution')->connstrained('beneficiary_institutions');                 
            $table->foreignId('school_period')->nullable()->connstrained('ignug.school_periods'); //pgsql-ignug
            $table->foreignId('career_id')->constrained('ignug.careers');
            $table->string('code',100);
            $table->text('title',500);
            $table->foreignId('status_id')->constrained('ignug.catalogues');//catalogo propio una fk 
            $table->foreignId('state_id')->constrained('ignug.states');
            $table->string('field',100);//campo de area de vinculacion
            $table->foreignId('frequency_activities')->constrained('ignug.catalogues');//frecuencia de actividades
            $table->json('cycle')->nullable();//ciclo
            $table->foreignId('location_id')->nullable()->constrained('ignug.catalogues');//crear tabla de localizacion fk
            $table->integer('lead_time');//plazo de ejecucion
            $table->date('delivery_date')->nullable();// tiempo
            $table->date('start_date')->nullable();// tiempo
            $table->date('end_date')->nullable();//tienmpo
            $table->text('description',1000);//DESCRIPCION GENERAL  DEL PROYECTO.
            $table->json('indirect_beneficiaries')->nullable();
            $table->json('direct_beneficiaries')->nullable();
            $table->text('introduction');
            $table->text('situational_analysis',300);//ANALISIS SITUACIONAL (DIAGNOSTICO)
            $table->text('foundamentation');
            $table->text('justification');
            $table->foreignId('create_by')->connstrained('ignug.users');
            $table->json('observations')->nullable();
            $table->json('bibliografia')->nullable();//pendiente
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
        Schema::dropIfExists('projects');
    }
}
