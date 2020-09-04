<?php

use Illuminate\Database\Seeder;

class usinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usina')->insert ([
            'nome' => 'Jin-wooo',
        
        ]);
    }
}
