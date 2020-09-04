<?php

use Illuminate\Database\Seeder;

class portoEmbarqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portoembarque')->insert ([
            'nome' => 'jin-woo',
            'pais' => 'China',
        ]);
    }
}
