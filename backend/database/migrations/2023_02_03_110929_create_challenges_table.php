<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('challenge_category_id');
            $table->unsignedBigInteger('equipment_category_id')->nullable();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('challenge_category_id')
                ->references('id')
                ->on('challenge_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('equipment_category_id')
                ->references('id')
                ->on('equipment_categories')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
