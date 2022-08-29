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
        //Rol Gestor
        $rol_gestor = Role::create(['name'=>'gestor']);
        $rol_gestor->givePermissionTo(['crear_registros',
                                'editar_registros',
                                'ver_registros',
                                'baja_registros',
                                'alta_registros',
                                'solicitar_firma',
                                'descargar_excel',
                                'descargar_documentos',
                                'consultar_historial_acciones']); 


        //Rol Funcionario
        $rol_funcionario = Role::create(['name'=>'funcionario']);
        //$rol = Role::findByName('Funcionario');
        $rol_funcionario->givePermissionTo(['admin_formulas',
                                'ver_registros',
                                'descargar_excel',
                                'firmar_documentos',
                                'descargar_documentos',
                                'consultar_historial_acciones']);

        
        //Rol Administrador de Acceso
        $rol_administrador_acceso = Role::create(['name'=>'administrador_de_acceso']);
        //$rol4 = Role::findByName('Informatica');
        $rol_administrador_acceso->givePermissionTo(['admin_lista_roles',
                                'admin_crear_roles',
                                'admin_editar_roles',
                                'admin_eliminar_roles',
                                'admin_users',
                                'consultar_historial_acciones']);




        //Rol Data Entry
        $rol_data_entry = Role::create(['name'=>'data_entry']);
        $rol_data_entry->givePermissionTo(['crear_registros',
                                'editar_registros',
                                'ver_registros',
                                'baja_registros',
                                'alta_registros',
                                'descargar_excel']);   



        //Rol Consultor
        $rol_consultor = Role::create(['name'=>'consultor']);
        $rol_consultor->givePermissionTo(['ver_registros']);  


        //Rol Usuario Externo
        $rol_usuario_externo = Role::create(['name'=>'usuario_externo']);
        $rol_usuario_externo->givePermissionTo(['ver_registros',
                                                'descargar_documentos']); 

    }
}
