<?php

namespace App\Http\Controllers\Admins;

use App\AddHotel;
use App\Http\Controllers\Controller;

class EnterController extends Controller
{
	public function index()
	{
        if(auth()->check() && auth()->user()->hasPermissionTo('getListEnterHotel')){
            return view('admin.enter.index');
        }
	}
	public function show($addHotel)
	{
        if(auth()->check() && auth()->user()->hasPermissionTo('getListEnterHotel')){
            return view('admin.enter.show',[
                'addHotel'=>AddHotel::find($addHotel)
            ]);
        }
	}
}
