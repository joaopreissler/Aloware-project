<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNestedRepliesConnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nested_replies_conn', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reply_id')->foreign()->reference('id')->on('comments_replies');
            $table->bigInteger('nested_id')->foreign()->reference('id')->on('nested_replies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nested_replies_conn');
    }
}
