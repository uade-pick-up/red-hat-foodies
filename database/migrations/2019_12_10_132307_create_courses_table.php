<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('category_id');
            $table->string('subcategory_id');
            $table->string('childcategory_id');
            $table->string('language_id');
            $table->string('title')->nullable();
            $table->text('short_detail')->nullable();
            $table->text('detail')->nullable();
            $table->text('requirement')->nullable();
            $table->string('price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('day')->nullable();
            $table->string('video')->nullable();
            $table->string('url')->nullable();
            $table->enum('featured',['1','0'])->nullable();
            $table->string('slug')->nullable();
            $table->enum('status',['1','0'])->nullable();
            $table->string('preview_image')->nullable();
            $table->string('video_url')->nullable();
            $table->string('preview_type')->nullable();
            $table->enum('type',['1','0'])->nullable();
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
        Schema::dropIfExists('courses');
    }
}
