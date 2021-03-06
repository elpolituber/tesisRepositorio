<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareersTable extends Migration
{
    public function up()
    {
        Schema::connection('pgsql-ignug')->create('careers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained();
            $table->string('code')->nullable();;
            $table->string('name');
            $table->text('description');
            $table->foreignId('modality_id')->constrained('catalogues');
            $table->string('resolution_number')->nullable();
            $table->string('title');
            $table->string('acronym');
            $table->foreignId('type_id')->constrained('catalogues');
            $table->foreignId('state_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('pgsql-ignug')->dropIfExists('careers');
    }
}
