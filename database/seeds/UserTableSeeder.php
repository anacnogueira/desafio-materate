<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(\Desafio\Entities\User::class)->create([
            'name' => 'Ana Claudia',
            'email' => 'anacnogueira@gmail.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
            'image' => 'ana-claudia-29092016195252.jpg'
        ]);

        factory(\Desafio\Entities\User::class, 10)->create();
    }
}
