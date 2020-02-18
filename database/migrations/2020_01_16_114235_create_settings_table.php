<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_title')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('cpy_txt')->nullable();
            $table->string('logo_type')->nullable();
            $table->boolean('rightclick')->default(true);
            $table->boolean('inspect')->default(true);
            $table->string('meta_data_desc')->nullable();
            $table->string('meta_data_keyword')->nullable();
            $table->string('google_ana')->nullable();
            $table->string('fb_pixel')->nullable();
            $table->boolean('fb_login_enable')->nullable();
            $table->boolean('google_login_enable')->nullable();
            $table->boolean('gitlab_login_enable')->nullable();
            $table->boolean('stripe_enable')->nullable();
            $table->boolean('instamojo_enable')->nullable();
            $table->boolean('paypal_enable')->nullable();
            $table->boolean('paytm_enable')->nullable();
            $table->boolean('braintree_enable')->nullable();
            $table->boolean('razorpay_enable')->nullable();
            $table->boolean('paystack_enable')->nullable();
            $table->boolean('w_email_enable')->nullable();
            $table->string('wel_email')->nullable();
            $table->longtext('default_address')->nullable();
            $table->string('default_phone')->nullable();
            $table->boolean('instructor_enable')->nullable();
            $table->boolean('debug_enable')->default(true);
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
        Schema::dropIfExists('settings');
    }
}
