<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CarController extends Controller
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

	public function index()
	{
		$cars = DB::select('select * from tblCars', [1]);

		return view('index', ['cars' => $cars]);
	}

	public function add()
	{
		return view('cars/index');
	}
}
