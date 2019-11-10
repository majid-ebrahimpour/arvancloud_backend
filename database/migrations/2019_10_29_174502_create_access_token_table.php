<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Module\Application\Entity\AccessTokenEntity;

class CreateAccessTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_token', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('access_token', 256);
            $table->dateTime('create_at');
            $table->dateTime('expire_at');

            /**
             * unique
             */
            $table->unique('access_token', 'unique_access_token');
            $table->unique('user_id', 'unique_user_id');

            /**
             * foreign
             */
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('cascade');

            /**
             * index
             */
            $table->index(['access_token']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('access_token');
    }
}
