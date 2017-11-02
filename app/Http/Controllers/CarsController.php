<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
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
		$cars = Cars::all();

		return view('index', ['cars' => $cars]);
	}

	public function overview()
	{
		return view('cars/create');
	}
}
