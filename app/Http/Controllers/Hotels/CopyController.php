<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CopyController extends Controller
{
	public function index()
	{
        return view('hotel.copy.index');
	}
}
