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
                'filepath' => 'car-golf.png'
            ],
            [
                'brand' => 'Skoda',
                'model' => 'Octavia',
                'type'  => 'Berline',
                'cost' => '450',
                'filepath' => 'car-octavia.png'
            ],
            [
                'brand' => 'Opel',
                'model' => 'Astra',
                'type'  => 'Berline',
                'cost' => '450',
                'filepath' => 'car-astra.png'
            ],
            [
                'brand' => 'BMW',
                'model' => '114',
                'type'  => 'Berline',
                'cost' => '450',
                'filepath' => 'car-114.png'
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Golf Variant',
                'type'  => 'Break',
                'cost' => '450',
                'filepath' => 'car-golf-variant.png'
            ],
            [
                'brand' => 'Skoda',
                'model' => 'Octavia Combi',
                'type'  => 'Break',
                'cost' => '450',
                'filepath' => 'car-octavia-combi.png'
            ],
            [
                'brand' => 'Opel',
                'model' => 'Astra Sports Tourer',
                'type'  => 'Break',
                'cost' => '450',
                'filepath' => 'car-astra-sports-tourer.png'
            ],
            [
                'brand' => 'Audi',
                'model' => 'A3 Berline',
                'type'  => 'Berline',
                'cost' => '550',
                'filepath' => 'car-a3-berline.png'
            ],
            [
                'brand' => 'Skoda',
                'model' => 'Superb',
                'type'  => 'Berline',
                'cost' => '550',
                'filepath' => 'car-superb.png'
            ],
            [
                'brand' => 'Opel',
                'model' => 'Insignia Grand Sport',
                'type'  => 'Berline',
                'cost' => '550',
                'filepath' => 'car-insignia-grand-sport.png'
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Passat',
                'type'  => 'Berline',
                'cost' => '550',
                'filepath' => 'car-passat.png'
            ],
            [
                'brand' => 'BMW',
                'model' => '316',
                'type'  => 'Berline',
                'cost' => '550',
                'filepath' => 'car-316.png'
            ],
            [
                'brand' => 'Audi',
                'model' => 'A3 Sportback',
                'type'  => 'Break',
                'cost' => '550',
                'filepath' => 'car-a3-sportback.png'
            ],
            [
                'brand' => 'Skoda',
                'model' => 'Superb Combi',
                'type'  => 'Break',
                'cost' => '550',
                'filepath' => 'car-superb-combi.png'
            ],
            [
                'brand' => 'Opel',
                'model' => 'Insignia Sports Tourer',
                'type'  => 'Break',
                'cost' => '550',
                'filepath' => 'car-insignia-sports-tourer.png'
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Passat Variant',
                'type'  => 'Break',
                'cost' => '550',
                'filepath' => 'car-passat-variant.png'
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Touran',
                'type'  => 'Mono',
                'cost' => '550',
                'filepath' => 'car-touran.png'
            ],
            [
                'brand' => 'BMW',
                'model' => '216D Active Tourer',
                'type'  => 'Mono',
                'cost' => '550',
                'filepath' => 'car-216d-active-tourer.png'
            ],
            [
                'brand' => 'Audi',
                'model' => 'Q2',
                'type'  => 'SUV',
                'cost' => '550',
                'filepath' => 'car-q2.png'
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Tiguan',
                'type'  => 'SUV',
                'cost' => '550',
                'filepath' => 'car-Tiguan.png'
            ],
            [
                'brand' => 'Audi',
                'model' => 'A4',
                'type'  => 'Berline',
                'cost' => '650',
                'filepath' => 'car-a4.png'
            ],
            [
                'brand' => 'Audi',
                'model' => 'A4 Avant',
                'type'  => 'Break',
                'cost' => '650',
                'filepath' => 'car-a4-avant.png'
            ],
            [
                'brand' => 'Audi',
                'model' => 'Q3',
                'type'  => 'SUV',
                'cost' => '650',
                'filepath' => 'car-q3.png'
            ],
            [
                'brand' => 'Range Rover',
                'model' => 'Evoque',
                'type'  => 'SUV',
                'cost' => '650',
                'filepath' => 'car-evoque.png'
            ],
            [
                'brand' => 'BMW',
                'model' => '520d',
                'type'  => 'Berline',
                'cost' => '750',
                'filepath' => 'car-520d.png'
            ],
            [
                'brand' => 'Audi',
                'model' => 'A6',
                'type'  => 'Berline',
                'cost' => '750',
                'filepath' => 'car-a6.png'
            ],
            [
                'brand' => 'BMW',
                'model' => '218d',
                'type'  => 'Cabrio',
                'cost' => '650',
                'filepath' => 'car-218d.png'
            ],
            [
                'brand' => 'Mercedes',
                'model' => 'C',
                'type'  => 'Cabrio',
                'cost' => '850',
                'filepath' => 'car-c.png'
            ],
        ]);
    }
}
