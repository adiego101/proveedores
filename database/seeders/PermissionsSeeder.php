<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [   'admin_lista_roles',
                        'admin_crear_roles',
                        'admin_editar_roles',
                        'admin_eliminar_roles',
                        'admin_users'];
        foreach($permisos as $permiso)
            Permission::create(['name'=>$permiso]);
    }
}
