<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fname', 191);
			$table->string('lname', 191);
			$table->date('dob')->nullable();
			$table->date('doa')->nullable();
			$table->string('mobile', 191)->nullable();
			$table->string('email', 191)->unique();
			$table->string('password', 191);
			$table->string('address', 191)->nullable();
			$table->string('married_status', 191)->nullable();
			$table->integer('city_id')->unsigned()->nullable();
			$table->integer('state_id')->unsigned()->nullable();
			$table->integer('country_id')->unsigned()->nullable();
			$table->string('gender', 191)->nullable();
			$table->string('pin_code', 191)->nullable();
			$table->boolean('status')->default(1);
			$table->boolean('verified');
			$table->string('user_img', 191)->nullable();
			$table->string('role', 191)->default('user');
			$table->dateTime('email_verified_at')->nullable();
			$table->text('detail')->nullable();
			$table->integer('braintree_id');
			$table->string('fb_url', 191)->nullable();
			$table->string('twitter_url', 191)->nullable();
			$table->string('youtube_url', 191)->nullable();
			$table->string('linkedin_url', 191)->nullable();
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
