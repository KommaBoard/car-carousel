<?php

use Illuminate\Database\Seeder;

class SalaryScaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salary_scale')->insert([
            [
                'years_experience' => 0,
                'minimum_salary' => 1758.94,
            ],
            [
                'years_experience' => 1,
                'minimum_salary' => 1769.02,
            ],
            [
                'years_experience' => 2,
                'minimum_salary' => 1779.13,
            ],
            [
                'years_experience' => 3,
                'minimum_salary' => 1789.31,
            ],
            [
                'years_experience' => 4,
                'minimum_salary' => 1803.03,
            ],
            [
                'years_experience' => 5,
                'minimum_salary' => 1816.99,
            ],
            [
                'years_experience' => 6,
                'minimum_salary' => 1827.54,
            ],
            [
                'years_experience' => 7,
                'minimum_salary' => 1853.93,
            ],
            [
                'years_experience' => 8,
                'minimum_salary' => 1880.37,
            ],
            [
                'years_experience' => 9,
                'minimum_salary' => 1906.72,
            ],
            [
                'years_experience' => 10,
                'minimum_salary' => 1933.26,
            ],
            [
                'years_experience' => 11,
                'minimum_salary' => 1955.60,
            ],
            [
                'years_experience' => 12,
                'minimum_salary' => 1977.67,
            ],
            [
                'years_experience' => 13,
                'minimum_salary' => 2000.03,
            ],
            [
                'years_experience' => 14,
                'minimum_salary' => 2022.16,
            ],
            [
                'years_experience' => 15,
                'minimum_salary' => 2044.44,
            ],
            [
                'years_experience' => 16,
                'minimum_salary' => 2051.65,
            ],
            [
                'years_experience' => 17,
                'minimum_salary' => 2058.80,
            ],
            [
                'years_experience' => 18,
                'minimum_salary' => 2066.11,
            ],
            [
                'years_experience' => 19,
                'minimum_salary' => 2073.29,
            ],
            [
                'years_experience' => 20,
                'minimum_salary' => 2080.53,
            ],
            [
                'years_experience' => 21,
                'minimum_salary' => 2087.89,
            ],
            [
                'years_experience' => 22,
                'minimum_salary' => 2095.00,
            ],
            [
                'years_experience' => 23,
                'minimum_salary' => 2102.24,
            ],
            [
                'years_experience' => 24,
                'minimum_salary' => 2109.47,
            ],
            [
                'years_experience' => 25,
                'minimum_salary' => 2116.66,
            ],
            [
                'years_experience' => 26,
                'minimum_salary' => 2123.90,
            ],
        ]);
    }
}
