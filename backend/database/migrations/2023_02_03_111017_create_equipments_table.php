<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipment_category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('serial_number');
            $table->timestamp('buy_date');
            $table->timestamps();

            $table->foreign('equipment_category_id')
                ->references('id')
                ->on('equipment_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

                $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipments');
    }
}
