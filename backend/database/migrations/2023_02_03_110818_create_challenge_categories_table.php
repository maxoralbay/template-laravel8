<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenge_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->default('images/avatar.png');
            $table->string('image_checked')->default('images/avatar.png');
            $table->string('color')->default('#00F1A4');
            $table->softDeletes();
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
        Schema::dropIfExists('challenge_categories');
    }
}
