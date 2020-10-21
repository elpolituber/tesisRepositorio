<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql-teacher-eval')->create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_type_id')->nullable()->constrained();
            $table->string('code')->unique();
            $table->integer('order');
            $table->string('name')->unique();
            $table->foreignId('type_id')->constrained('ignug.catalogues');
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
        Schema::dropIfExists('questions');
    }
}
