<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_items', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('last_review_date')->nullable();
            $table->date('next_review_date')->nullable();
			$table->text('description');
			$table->integer('level')->default(0);
			$table->boolean('mastered')->default(false);
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
        Schema::drop('review_items');
    }
}
