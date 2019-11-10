<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('title');
            $table->string('url');
            $table->integer('status_id')->unsigned();
            $table->dateTime('create_at');

            /**
             * foreign
             */
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('cascade');

            $table->foreign('status_id')
                ->references('id')
                ->on('cfg_status');

            /**
             * index
             */
            $table->index(['url']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('domain');
    }
}
