<?php

use Illuminate\Database\Seeder;

class navioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('navios')->insert ([
            'nome' => 'Navio-02',
            'IMO' => '2930472',
        ]);
    }
}
