<?php

use Illuminate\Database\Seeder;

class fichaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ficha')->insert ([
            'mes' => 11,
            'ano' => 2000,
            'numero da ordem de venda' => 555,
            'quantidade orçada' => 200000,
            'porto_destino_id' => 1,
            'porto_embarque_id' => 1,
            'usina_id' => 1,
            'Cliente_id' => 1,
        ]);
    }
}
