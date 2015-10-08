<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /**
         * Seed, along others, one default user with
         * known name
         */
        DB::table('users')->insert([
            'name' => 'testy',
            'email' => 'testy@test.com',
            'password' => bcrypt('secret'),
            'created_at' => '2015-10-08 09:00:00',
            'updated_at' => '2015-10-08 09:00:00',
            'remember_token' => str_random(10),
        ]);

        $this->call(UserTableSeeder::class);
        $this->call(ReviewTableSeeder::class);

        Model::reguard();
    }
}
