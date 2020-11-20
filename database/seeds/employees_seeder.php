<?php

use Illuminate\Database\Seeder;

class employees_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=0; $i<5; $i++){
      DB::table('employees')->insert([
              'codigo' => Str::random(10),
              'nombre' => Str::random(20),
              'salarioDolares' => '10.'.$i,
              'salarioPesos' => '200.'.$i,
              'direccion' => Str::random(25),
              'estado' => Str::random(9),
              'ciudad' => Str::random(9),
              'telefono' => Str::random(10),
              'correo' => Str::random(18),
              'activo' => '1',
              'created_at' => '2020-11-19 10:30:22',
          ]);
        }
    }
}
