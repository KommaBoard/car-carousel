<?php

namespace App\Http\Controllers;

use App\Services\CarsService;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /** @var  CarsService $carsService */
    private $carsService;

    /**
     * Create a new controller instance.
     *
     * @param CarsService $carsService
     */
	public function __construct(CarsService $carsService)
	{
		$this->carsService = $carsService;
	}

	public function get(Request $request)
	{
		$items = Item::orderBy('id','DESC')->paginate(5);
		return view('ItemCRUD.index',compact('items'))
		->with('i', ($request->input('page', 1) - 1) * 5);
	}

	public function index()
	{
		return view('index',
                    [
                        'types' => $this->carsService->getAvailableValuesOfCars('type'),
                        'brands' => $this->carsService->getAvailableValuesOfCars('brand')
                    ]);
	}

	public function overview()
	{
		return view('cars/create');
	}

	public function calculateCars(Request $request)
    {
        $request->validate([
            'experience' => 'required|numeric',
            'salary'     => 'required|numeric|min:1758'
        ]);

        $experience = $request->get('experience');
        $salary = $request->get('salary');
        $brand = $request->get('carbrand');
        $type = $request->get('cartype');

        $cars = $this->carsService->getCars($salary, $experience, $brand, $type);

        if ($cars->isEmpty()) {
            return redirect()
                    ->to('/')
                    ->with(
                            'message',
                            'Helaas zijn er geen wagens gevonden.
                             We raden aan geen voorkeurs type mee te geven.'
                    );
        }

        return view('car-select',
                    [
                        'cars'              => $cars,
                        'types'             => $this->carsService->getAvailableValuesOfCars('type'),
                        'brands'            => $this->carsService->getAvailableValuesOfCars('brand'),
                        'experience'        => $experience,
                        'salary'            => $salary,
                        'maxBudgetToSpend'  => $this->carsService->getMaxBudgetBasedOnSalary($salary, $experience),
                        'salaryToSpend'     => $this->carsService->getMaxBudgetBasedOnSalary($salary, $experience)
                    ]
        );
    }

    public function updateCars(Request $request)
    {
        $newSalaryToLose = $request->get('newSalaryToLose');
        $experience = $request->get('experience');
        $salary = $request->get('salary');
        $brand = $request->get('carbrand');
        $type = $request->get('cartype');

        $cars = $this->carsService->getUpdatedCars(
                                                $newSalaryToLose,
                                                $experience,
                                                $brand,
                                                $type
                                            );

        if ($cars->isEmpty()) {
            return redirect()
                ->to('/')
                ->with(
                    'message',
                    'Helaas zijn er geen wagens gevonden.
                             We raden aan geen voorkeurs type mee te geven.'
                );
        }

        return view('car-select',
            [
                'cars'              => $cars,
                'types'             => $this->carsService->getAvailableValuesOfCars('type'),
                'brands'            => $this->carsService->getAvailableValuesOfCars('brand'),
                'experience'        => $experience,
                'salary'            => $salary,
                'maxBudgetToSpend'  => $this->carsService->getMaxBudgetBasedOnSalary($salary, $experience),
                'salaryToSpend'     => $newSalaryToLose
            ]
        );
    }
}
