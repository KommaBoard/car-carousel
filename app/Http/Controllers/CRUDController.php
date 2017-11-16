<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cars;

class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$cars = Cars::all()->sortBy('cost')->toArray();

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'type'  => 'required',
            'cost'  => 'required'
        ]);

		$cars = new Cars([
		    'brand' => $request->get('brand'),
            'model' => $request->get('model'),
            'type' => $request->get('type'),
            'cost' => $request->get('cost')
        ]);
        $cars->save();

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car= Cars::find($id);

        return view('cars.edit', compact('car','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$car = Cars::find($id);

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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$car = Cars::find($id);
		$car->delete();

		return redirect('/cars');
    }
}
