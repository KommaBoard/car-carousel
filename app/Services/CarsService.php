<?php

namespace App\Services;

use App\Models\Cars;
use App\SalaryScale;

class CarsService
{
    private $maxYearsExperience = 26;

    private $standardBudgetMinimum = 450;

    private $standardBudgetMaxmimum = 650;

    private $maxAgeCategory = 15;

    private $budgetBasedOnYearsExperience = [
                                                5 => 550,
                                                6 => 550,
                                                7 => 550,
                                                8 => 550,
                                                9 => 550,
                                                10 => 550,
                                            ];
    /**
     * Returns the minimum salary based on years experience.
     *
     * @param int $experience
     *
     * @return int
     */
    private function getMinimumSalary($experience)
    {
        if ($experience > $this->maxYearsExperience) {
            $experience = $this->maxYearsExperience;
        }

        return SalaryScale::where('years_experience', $experience)->first()->minimum_salary;
    }

    /**
     * Returns the maximum budget based on the salary.
     *
     * @param int $salary
     * @param int $experience
     *
     * @return int
     */
    public function getMaxBudgetBasedOnSalary($salary, $experience)
    {
        return $salary - $this->getMinimumSalary($experience);
    }

    /**
     * Returns the standard budget based on years of experience.
     *
     * @param int $experience
     *
     * @return int|mixed
     */
    private function getStandardBudget($experience)
    {
        $standardBudget = $this->standardBudgetMinimum;

        if (array_key_exists($experience, $this->budgetBasedOnYearsExperience)) {
            $standardBudget = $this->budgetBasedOnYearsExperience[$experience];
        }

        if ($experience > $this->maxAgeCategory) {
            $standardBudget = $this->standardBudgetMaxmimum;
        }

        return $standardBudget;
    }


    /**
     * Returns the total maximum budget that the user can use to select a car.
     *
     * @param int $salary
     * @param int $experience
     *
     * @return int|mixed
     */
    private function getTotalBudget($salary, $experience)
    {
        $maxBudget = $this->getMaxBudgetBasedOnSalary($salary, $experience);
        $standardBudget = $this->getStandardBudget($experience);

        return $maxBudget + $standardBudget;
    }

    /**
     * Adds the correct salary the user will lose based on standard budget and experience.
     *
     * @param int       $salary
     * @param int       $experience
     * @param string    $type
     *
     * @return array
     */
    private function calculateSalaryToLosePerCar($salary, $experience, $type)
    {
        $totalBudget = $this->getTotalBudget($salary, $experience);

        $maxBudgetBasedOnSalary = $this->getMaxBudgetBasedOnSalary($salary, $experience);

        if ($maxBudgetBasedOnSalary < 100) {
            $totalBudget = $this->standardBudgetMinimum;
        }

        if ($type == 'all' || $type === null) {
            $cars = Cars::where('cost', '<=', $totalBudget)
                            ->get()->take(-7)->sortByDesc('cost');
        } else {
            $cars = Cars::where([
                ['cost', '<=', $totalBudget],
                ['type', '=', $type]
            ])->get()->take(-7)->sortByDesc('cost');
        }

        foreach($cars as $car) {
            $standardBudget = $this->getStandardBudget($experience);

            $car['salaryToLose'] = $car->cost - $standardBudget;
        }

        return $cars;
    }

    /**
     * Returns all the cars a user can choose from
     *
     * @param int       $salary
     * @param int       $experience
     * @param string    $type
     *
     * @return array
     */
    public function getCars($salary, $experience, $type)
    {
        return $this->calculateSalaryToLosePerCar($salary, $experience, $type);
    }

    /**
     * Returns all the different car types that are available
     *
     * @return array
     */
    public function getTypes()
    {
        return Cars::orderBy('type','asc')->groupBy('type')->select('type')->get();
    }
}
