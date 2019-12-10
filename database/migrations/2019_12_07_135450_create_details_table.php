<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function(Blueprint $table)
        {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('player_id')->unsigned();
            $table->decimal('form', 8, 2);
            $table->integer('total_points')->unsigned();
            $table->decimal('influence', 8, 2);
            $table->decimal('creativity', 8, 2);
            $table->decimal('threat', 8, 2);
            $table->decimal('ict', 8, 2);
            $table->timestamps();
            $table->softDeletes();
            $table->index('player_id');

            $table->foreign('player_id')
                ->references('id')->on('players')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
    }
}
