<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Services\CarsService;
use Illuminate\Http\Request;
use App\Car;

class CRUDController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$cars = Car::all()->sortBy('cost')->toArray();

        return view('cars.create', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'type'  => 'required',
            'cost'  => 'required',
            'image' => 'required|mimes:png|dimensions:max_width=950,min_height=500|dimensions:min_width=950,max_height=500'
        ]);

        $this->carsService->storeNewCar(
            $request->get('brand'),
            $request->get('model'),
            $request->get('type'),
            $request->get('cost'),
            $request->image
        );

        return redirect('/cars');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);

        return view('cars.edit', compact('car','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$car = Car::find($id);

        $car->brand = $request->get('brand');
		$car->model = $request->get('model');
        $car->type = $request->get('type');
        $car->cost = $request->get('cost');

        $car->save();

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$car = Car::find($id);
		$filename = $car->filepath;
		//need to remove all 3 pictures
        Storage::disk('car-image-uploads')->delete($filename);
        Storage::disk('car-image-uploads')->delete(substr($filename, 0, -4) . '-medium.png');
        Storage::disk('car-image-uploads')->delete(substr($filename, 0, -4) . '-small.png');

        $car->delete();

		return redirect('/cars');
    }
}
