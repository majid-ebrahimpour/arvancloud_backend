<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {

            /**
             * columns
             */
            $table->bigIncrements('id');
            $table->char('name', 16)->nullable();
            $table->char('email', 255)->nullable();
            $table->char('password', 64)->nullable();
            $table->integer('status_id')->unsigned();
            $table->dateTime('create_at');
            $table->dateTime('last_login_at');

            /**
             * unique
             */
            $table->unique('email', 'unique_email');

            /**
             * foreign
             */
            $table->foreign('status_id')
                ->references('id')
                ->on('cfg_status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('user');
    }
}
