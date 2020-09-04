
<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(navioSeeder::class);
        $this->call(portoDestinoSeeder::class);
        $this->call(portoEmbarqueSeeder::class);
        $this->call(usinaSeeder::class);
        $this->call(clienteSeeder::class);
        $this->call(fichaSeeder::class);
    }
}