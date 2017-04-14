<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsColumnToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //添加字段
            $table->string('keywords');
            $table->string('description');
            $table->string('thumbnail');
            $table->tinyInteger('order');
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->drop_column('keywords');
            $table->drop_column('description');
            $table->drop_column('thumbnail');
            $table->drop_column('order');
            $table->drop_column('status');
        });
    }
}
