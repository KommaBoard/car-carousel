<?php

	namespace App\Models;
	use Illuminate\Database\Eloquent\Model;


    class Cars extends Model
    {
		protected $table = 'tblCars';
		protected $fillable = ['brand', 'model', 'cost'];
    }
