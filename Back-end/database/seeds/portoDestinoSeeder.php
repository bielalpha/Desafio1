<?php

use Illuminate\Database\Seeder;

class portoDestinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portodestino')->insert ([
            'nome' => 'portin22',
            'pais' => 'Brasil',
        ]);
    }
}
