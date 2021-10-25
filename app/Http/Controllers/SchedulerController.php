<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;

class SchedulerController extends Controller
{
    public function index(){
        return view('admin.schedulers.index');
    }

    public function hotelDetail(Hotel $hotel){
        return view('admin.schedulers.hotel-detail',[
            'hotel'=>$hotel
        ]);
    }

}
