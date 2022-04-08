<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PonderacionesCompreLocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ponderaciones = [  array('desc_ponderacion'=>'Facturacion',
                                'valor_ponderacion'=>0.30), 
                            array('desc_ponderacion'=>'Gastos',
                                'valor_ponderacion'=>0.25),
                            array('desc_ponderacion'=>'Mano_Obra',
                                'valor_ponderacion'=>0.30),
                            array('desc_ponderacion'=>'Antiguedad',
                                'valor_ponderacion'=>0.05),
                            array('desc_ponderacion'=>'Dom_fiscal',
                                'valor_ponderacion'=>0.05),
                            array('desc_ponderacion'=>'Valor_Agregado',
                                'valor_ponderacion'=>0.05)];
        DB::table('ponderaciones_compre_local')->insert($ponderaciones);
    }
}
