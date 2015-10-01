<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentAndLinkFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('review_items', function(Blueprint $table) {
			$table->text('comment')->nullable();
			$table->text('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('review_items', function(Blueprint $table) {
            $table->dropColumn(['comment', 'link']);
        });
    }
}
