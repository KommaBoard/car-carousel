<?php

namespace App\Services;

use Intervention\Image\ImageManagerStatic as Image;
use App\SalaryScale;
use App\Car;

class CarsService
{
    private $carResultsLimit = 7;

    private $maxYearsExperience = 26;

    private $standardBudgetMinimum = 450;

    private $taxFactor = 0.8;

    private $maxExperienceCategory= 10;

    private $budgetBasedOnYearsExperience = [
                                                5 => 550,
                                                6 => 550,
                                                7 => 550,
                                                8 => 550,
                                                9 => 550,
                                                10 => 550,
                                            ];

    private function getStandardBudgetMaximum()
    {
        return Car::max('cost');
    }

    /**
     * Returns the minimum salary based on years experience.
     *
     * @param int $experience
     *
     * @return int
     */
    private function getMinimumSalary($experience)
    {
        //if the user has more experience than the max in the salary scale use the max years
        if ($experience > $this->maxYearsExperience) {
            $experience = $this->maxYearsExperience;
        }

        return SalaryScale::where('years_experience', $experience)->first()->minimum_salary;
    }

    /**
     * Returns the maximum budget to spend based on the salary.
     *
     * @param int $salary
     * @param int $experience
     *
     * @return int
     */
    public function getMaxBudgetBasedOnSalary($salary, $experience)
    {
        // multiply result with taxfactor because 1€ is actually 80cents because of tax things
        return round(($salary - $this->getMinimumSalary($experience)) * $this->taxFactor);
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
        //budget is default the minimum
        $standardBudget = $this->standardBudgetMinimum;

        if (array_key_exists($experience, $this->budgetBasedOnYearsExperience)) {
            $standardBudget = $this->budgetBasedOnYearsExperience[$experience];
        }

        if ($experience > $this->maxExperienceCategory) {
            $standardBudget = $this->getStandardBudgetMaximum();
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
     * Returns the total budget when a user selects his own salary he wants to lose.
     *
     * @param int $salaryToLose
     * @param int $experience
     *
     * @return int|mixed
     */
    private function getTotalBudgetBasedOnSalaryToLose($salaryToLose, $experience)
    {
        $standardBudget = $this->getStandardBudget($experience);

        return $salaryToLose + $standardBudget;
    }

    /**
     * Adds the correct salary the user will lose based on standard budget and experience.
     *
     * @param int       $experience
     * @param string    $type
     *
     * @return array
     */
    private function calculateSalaryToLosePerCar($budget, $experience, $brand, $type)
    {
        //brand = all or null   and type = all or null  -> get all cars
        //brand                 and type = all or null  -> get cars of all types and brand
        //brand = all or null   and type                -> get cars of all brands and type
        //brand                 and type                -> get cars of brand and type

        $cars = null;
        if(($brand === 'all' || $brand === null) && ($type === 'all' || $type === null)) {
            $cars = Car::where('cost', '<=', $budget)
                ->orderBy('cost', 'desc')->get()->take($this->carResultsLimit);
        } elseif($brand && ($type === 'all' || $type === null)) {
            $cars = Car::where([
                ['cost', '<=', $budget],
                ['brand', '=', $brand],
            ])->orderBy('cost', 'desc')->get()->take($this->carResultsLimit);
        } elseif (($brand === 'all' || $brand === null) && $type) {
            $cars = Car::where([
                ['cost', '<=', $budget],
                ['type', '=', $type]
            ])->orderBy('cost', 'desc')->get()->take($this->carResultsLimit);
        } else {
            $cars = Car::where([
                ['cost', '<=', $budget],
                ['brand', '=', $brand],
                ['type', '=', $type]
            ])->orderBy('cost', 'desc')->get()->take($this->carResultsLimit);
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
     * @param string    $brand
     * @param string    $type
     *
     * @return array
     */
    public function getCars($salary, $experience, $brand, $type)
    {
        return $this->calculateSalaryToLosePerCar(
                                                    $this->getTotalBudget($salary, $experience),
                                                    $experience,
                                                    $brand,
                                                    $type
                                                 );
    }

    /**
     * Returns all the different values(brand, type, etc.) of a car that are available
     *
     * @return array
     */
    public function getAvailableValuesOfCars($value)
    {
        return Car::orderBy($value,'asc')->groupBy($value)->select($value)->get();
    }


    /**
     * Returns all the cars a user can choose from based on his selected salary he wants to lose.
     *
     * @param $salaryToLose
     * @param $experience
     * @param $brand
     * @param $type
     *
     * @return array
     */
    public function getUpdatedCars($salaryToLose, $experience, $brand, $type)
    {
        return $this->calculateSalaryToLosePerCar(
                                                    $this->getTotalBudgetBasedOnSalaryToLose(
                                                                                                $salaryToLose,
                                                                                                $experience
                                                                                            ),
                                                    $experience,
                                                    $brand,
                                                    $type
                                                 );
    }

    /**
     * Stores a new car and images
     *
     * @param $brand
     * @param $model
     * @param $type
     * @param $cost
     * @param $image
     */
    public function storeNewCar($brand, $model, $type, $cost, $image)
    {
        //store default 950x500px image
        $path = $image->storeAs('', 'car-'.$model.'.png', 'car-image-uploads');

        //resize to medium(700x368px)
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(700, 368);
        $image_resize->save(public_path('/dist/img/examples/car-'.$model.'-medium.png'));

        //resize to small(263)
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(500, 263);
        $image_resize->save(public_path('/dist/img/examples/car-'.$model.'-small.png'));

        $car = new Car([
            'brand' => $brand,
            'model' => $model,
            'type'  => $type,
            'cost'  => $cost,
            'filepath'  => $path
        ]);

        $car->save();
    }
}
