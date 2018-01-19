<?php

namespace App\Http\Controllers;

use App\Configuration;

use Illuminate\Http\Request;


class ConfigurationsController extends Controller
{
    public function index()
    {
    	$data=Configuration::all();
    	return view("configuration.index",compact("data"));
    }

   	public function store(Request $request)
   	{

   		return Configuration::update($request->data);
   	}
}
