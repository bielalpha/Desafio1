<?php

use Illuminate\Database\Seeder;

class clienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cliente')->insert ([
            'nome' => 'Gabriel',
        
        ]);
    }
}
