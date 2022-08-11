<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'     => 'Hamada User',
                'email'    => 'hamada.undetected@gmail.com',
                'password' => 'HamadaUser123',
                'nik'      => '1234567890123456',
                'role'     => 'user',
                'product'  => 'Salad'
            ],
            [
                'name'     => 'Hamada Admin',
                'email'    => 'hamada.admin@gmail.com',
                'password' => 'HamadaAdmin123',
                'nik'      => '1111111111111111',
                'role'     => 'admin',
                'product'  => 'Chip'
            ],
        ];

        for ($i=0; $i < count($users); $i++) { 
            User::updateOrCreate([
                'id' => $i + 1
            ], $users[$i]);
        }
    }
}
