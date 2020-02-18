<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'fname' => 'admin',
                'lname' => 'mediacity',
                'dob' => '0000-00-00',
                'doa' => NULL,
                'mobile' => '123456789',
                'email' => 'admin@mediacity.co.in',
                'password' => '$2y$10$nb2YnJmU.dhFgvV49ysDg.Qy9eo2eMtz6plvPW69Plc0m4HGkKqxa',
                'address' => 'abcd',
                'married_status' => '',
                'city_id' => 20513,
                'state_id' => 1429,
                'country_id' => 85,
                'gender' => 'F',
                'pin_code' => '',
                'status' => 1,
                'verified' => 0,
                'user_img' => '',
                'role' => 'admin',
                'email_verified_at' => NULL,
                'detail' => '',
                'braintree_id' => 0,
                'fb_url' => '',
                'twitter_url' => '',
                'youtube_url' => '',
                'linkedin_url' => '',
                'remember_token' => 'M8Sl4OyBKR01t2R4MQ3hQUG8oA1hl56QKfHP7MSMzwmKQ6gpYanoxoKvYXbz',
                'created_at' => '2020-02-02 19:22:23',
                'updated_at' => '2020-02-05 11:37:21',
            ),
        ));
        
        
    }
}