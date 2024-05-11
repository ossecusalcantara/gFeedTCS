<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::create([
            'cpf'         => '11122233345', 
            'name'        => 'Carlos', 
            'phone'       => '4899151515', 
            'birth'       => '2003-02-23', 
            'gender'      => 'M', 
            'notes'       => 'Pior Funcionario', 
            'email'       => 'carlos@gmail.com', 
            'password'    => env('PASSWORD_HASH') ? bcrypt('admin12345*') : 'admin12345*', 
        ]);
        
    }
}
