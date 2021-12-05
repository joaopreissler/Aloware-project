<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsRepliesConnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments_replies_conn', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('comment_id')->foreign()->reference('id')->on('comments');
            $table->bigInteger('reply_id')->foreign()->reference('id')->on('comments_replies');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments_replies_conn');
    }
}
