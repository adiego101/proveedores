<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Rol Administrador
        $rol = Role::create(['name'=>'Administrador']);
        $rol->givePermissionTo(['admin_lista_roles',
                                'admin_crear_roles',
                                'admin_editar_roles',
                                'admin_eliminar_roles',
                                'admin_formulas',
                                'admin_users']);
        $rol2 = Role::create(['name'=>'Usuario']);
        $rol2->givePermissionTo(['user_basic']);

    }
}
