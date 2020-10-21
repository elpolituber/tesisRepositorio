<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql-teacher-eval')->create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('order');
            $table->string('name')->unique();
            $table->string('value');
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
        Schema::dropIfExists('answers');
    }
}
