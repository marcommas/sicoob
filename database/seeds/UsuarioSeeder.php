<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name'=>'Marco', 
            'email'=>'marcommas@gmail.com',
            'password'=> bcrypt('123456')
                ];
        
        DB::table('users')->insert($user);
    }
}
