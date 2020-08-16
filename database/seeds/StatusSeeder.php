<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['descripcion' => 'Ingresado']);
        Status::create(['descripcion' => 'Reparado']);
        Status::create(['descripcion' => 'Egresado']);
    }
}
