<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;

class CarsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{
		//
	}

	public function get(Request $request)
	{
		$items = Item::orderBy('id','DESC')->paginate(5);
		return view('ItemCRUD.index',compact('items'))
		->with('i', ($request->input('page', 1) - 1) * 5);
	}

	public function index()
	{
		return view('index');
	}

	public function overview()
	{
		return view('cars/create');
	}

	public function calculateCars(Request $request)
    {
        //op basis van jaren ervaring en bruttoloon juiste wagens ophalen en deze doorsturen naar de carousel
        if (!$request->isMethod('post')) {
            return redirect()->to('/');
        }
        $experience = $request->get('experience');
        $salary = $request->get('salary');



        $cars = Cars::all();

        return view('car-select', ['cars' => $cars]);

    }
}
