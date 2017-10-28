<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => bcrypt('root')
            ]
        ]);
    }
}
