<?php

namespace App\Http\Controllers;

use App\Services\CarsService;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /** @var  CarsService $carsCalculatorService */
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
                        'types' => $this->carsService->getTypes()
                    ]);
	}

	public function overview()
	{
		return view('cars/create');
	}

	public function calculateCars(Request $request)
    {
        $request->validate([
            'experience' => 'required|numeric|max:2',
            'salary'     => 'required|numeric|min:1758'
        ]);

        $experience = $request->get('experience');
        $salary = $request->get('salary');
        $type = $request->get('cartype');

        $cars = $this->carsService->getCars($salary, $experience, $type);

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
                        'cars' => $this->carsService->getCars($salary, $experience, $type),
                        'experience' => $experience,
                        'salary' => $salary,
                        'maxBudgetToSpend' => $this->carsService->getMaxBudgetBasedOnSalary($salary, $experience)
                    ]
        );

    }
}
