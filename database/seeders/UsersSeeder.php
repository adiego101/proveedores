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
        //Administrador de Acceso
        $user_administrador=User::create(['name'=>'administrador_de_acceso',
                            'email'=>'admin_acceso@domain.com',
                            'password'=>Hash::make('3LwVKiSf')]);
        $user_administrador->assignRole('administrador_de_acceso');
        //Gestor
        $user_gestor=User::create(['name'=>'gestor',
                            'email'=>'gestor@domain.com',
                            'password'=>Hash::make('Ge123456')]);
        $user_gestor->assignRole('gestor');

        //Funcionario
        $user_funcionario=User::create(['name'=>'funcionario',
                            'email'=>'funcionario@domain.com',
                            'password'=>Hash::make('Fu123456')]);
        $user_funcionario->assignRole('funcionario');

        //Data Entry
        $user_data_entry=User::create(['name'=>'data_entry',
                            'email'=>'data_entry@domain.com',
                            'password'=>Hash::make('Da123456')]);
        $user_data_entry->assignRole('data_entry');

        //Consultor
        $user_consultor=User::create(['name'=>'consultor',
                            'email'=>'consultor@domain.com',
                            'password'=>Hash::make('Co123456')]);
        $user_consultor->assignRole('consultor');

        //Usuario Externo
        $user_usuario_externo=User::create(['name'=>'usuario_externo',
                            'email'=>'usuario_externo@domain.com',
                            'password'=>Hash::make('Us123456')]);
        $user_usuario_externo->assignRole('usuario_externo');

        /*
        $seededUserEmail = 'egesto@santacruz.gob.ar';
        $user = User::where('email', '=', $seededUserEmail)->first();
        $user->assignRole(['administrador_de_acceso', 'funcionario', 'gestor']);
        $seededUserEmail = 'stresguerres@gmail.com';
        $user = User::where('email', '=', $seededUserEmail)->first();
        $user->assignRole(['administrador_de_acceso', 'funcionario', 'gestor']);

        $seededUserEmail = 'avrilmatyjps@gmail.com';
        $user = User::where('email', '=', $seededUserEmail)->first();
        $user->assignRole(['administrador_de_acceso', 'funcionario', 'gestor']);

        $seededUserEmail = 'nsartini66@gmail.com';
        $user = User::where('email', '=', $seededUserEmail)->first();
        $user->assignRole(['administrador_de_acceso', 'funcionario', 'gestor']);

        $seededUserEmail = 'adiego6743@gmail.com';
        $user = User::where('email', '=', $seededUserEmail)->first();
        $user->assignRole(['administrador_de_acceso', 'funcionario', 'gestor']);
       */
    }
}
