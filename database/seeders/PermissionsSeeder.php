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
                        'user_basic',
                        'admin_users',
                        'admin_formulas',
                        'crear_registros',
                        'editar_registros',
                        'ver_registros',
                        'alta_registros',
                        'baja_registros',
                        'descargar_excel',
                        'solicitar_firma',
                        'firmar_documentos',
                        'descargar_documentos',
                        'consultar_historial_acciones'
                    ];

        foreach($permisos as $permiso)
            Permission::create(['name'=>$permiso]);
    }
}
