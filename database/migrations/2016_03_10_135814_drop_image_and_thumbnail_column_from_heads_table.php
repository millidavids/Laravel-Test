<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropImageAndThumbnailColumnFromHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('heads', function (Blueprint $table) {
            $table->dropColumn('image_path');
            $table->dropColumn('thumbnail_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('heads', function (Blueprint $table) {
            $table->string('image_path')->nullable();
            $table->string('thumbnail_path')->nullable();
        });
    }
}
