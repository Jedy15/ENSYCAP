<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'name' => 'lalito',
            'email' => 'admin@sarhpro.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
