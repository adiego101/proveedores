<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Administrador
        $user=User::create(['name'=>'administrador',
                            'email'=>'admin@domain.com',
                            'password'=>Hash::make('3LwVKiSf')]);
        $user->assignRole('Administrador');
        /*//Registro civil
        $user=User::create(['name'=>'registro civil',
                            'email'=>'registro.civil@domain.com',
                            'password'=>Hash::make('password')]);
        $user->assignRole('RegistroCivil');
        //Consultor
        $user=User::create(['name'=>'consultor',
                            'email'=>'consultor@domain.com',
                            'password'=>Hash::make('password')]);
        $user->assignRole('Consultor');*/
    }
}
