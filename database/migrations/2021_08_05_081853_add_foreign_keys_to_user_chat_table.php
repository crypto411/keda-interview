<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_chat', function (Blueprint $table) {
            $table->foreign('chat_id')->references('id')->on('chat')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_chat', function (Blueprint $table) {
            $table->dropForeign('user_chat_chat_id_foreign');
            $table->dropForeign('user_chat_user_id_foreign');
        });
    }
}
