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
        DB::table('cars')->insert([
            [
                'brand' => 'Volkswagen',
                'model' => 'Golf',
                'type'  => 'Berline',
                'cost' => '450',
            ],
            [
                'brand' => 'Skoda',
                'model' => 'Octavia',
                'type'  => 'Berline',
                'cost' => '450',
            ],
            [
                'brand' => 'Opel',
                'model' => 'Astra',
                'type'  => 'Berline',
                'cost' => '450',
            ],
            [
                'brand' => 'BMW',
                'model' => '114',
                'type'  => 'Berline',
                'cost' => '450',
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Golf Variant',
                'type'  => 'Break',
                'cost' => '450',
            ],
            [
                'brand' => 'Skoda',
                'model' => 'Octavia Combi',
                'type'  => 'Break',
                'cost' => '450',
            ],
            [
                'brand' => 'Opel',
                'model' => 'Astra Sports Tourer',
                'type'  => 'Break',
                'cost' => '450',
            ],
            [
                'brand' => 'Audi',
                'model' => 'A3 Berline',
                'type'  => 'Berline',
                'cost' => '550',
            ],
            [
                'brand' => 'Skoda',
                'model' => 'Superb',
                'type'  => 'Berline',
                'cost' => '550',
            ],
            [
                'brand' => 'Opel',
                'model' => 'Insignia Grand Sport',
                'type'  => 'Berline',
                'cost' => '550',
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Passat',
                'type'  => 'Berline',
                'cost' => '550',
            ],
            [
                'brand' => 'BMW',
                'model' => '316',
                'type'  => 'Berline',
                'cost' => '550',
            ],
            [
                'brand' => 'Audi',
                'model' => 'A3 Sportback',
                'type'  => 'Break',
                'cost' => '550',
            ],
            [
                'brand' => 'Skoda',
                'model' => 'Superb Combi',
                'type'  => 'Break',
                'cost' => '550',
            ],
            [
                'brand' => 'Opel',
                'model' => 'Insignia Sports Tourer',
                'type'  => 'Break',
                'cost' => '550',
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Passat Variant',
                'type'  => 'Break',
                'cost' => '550',
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Touran',
                'type'  => 'Mono',
                'cost' => '550',
            ],
            [
                'brand' => 'BMW',
                'model' => '216D Active Tourer',
                'type'  => 'Mono',
                'cost' => '550',
            ],
            [
                'brand' => 'Audi',
                'model' => 'Q2',
                'type'  => 'SUV',
                'cost' => '550',
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Tiguan',
                'type'  => 'SUV',
                'cost' => '550',
            ],
            [
                'brand' => 'Audi',
                'model' => 'A4',
                'type'  => 'Berline',
                'cost' => '650',
            ],
            [
                'brand' => 'Audi',
                'model' => 'A4 Avant',
                'type'  => 'Break',
                'cost' => '650',
            ],
            [
                'brand' => 'Audi',
                'model' => 'Q3',
                'type'  => 'SUV',
                'cost' => '650',
            ],
            [
                'brand' => 'Range Rover',
                'model' => 'Evoque',
                'type'  => 'SUV',
                'cost' => '650',
            ],
        ]);
    }
}
