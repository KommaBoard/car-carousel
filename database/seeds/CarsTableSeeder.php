<?php

use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tblCars')->insert([
            [
                'brand' => 'Mercedes',
                'model' => 'S Klasse',
                'cost' => '200 000',
            ],
            [
                'brand' => 'Volvo',
                'model' => 'S90',
                'cost' => '50 000',
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Arteon',
                'cost' => '40 000',
            ],
            [
                'brand' => 'Audi',
                'model' => 'A8',
                'cost' => '80 000',
            ],
        ]);
    }
}
