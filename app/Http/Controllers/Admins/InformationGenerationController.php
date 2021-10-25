<?php

namespace App\Http\Controllers\Admins;

use App\AlertTalkList;
use App\HotelReservation;
use App\Http\Controllers\Controller;
use App\InformationGeneration;
use Illuminate\Http\Request;

class InformationGenerationController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.information.generation');
    }

    public function reservationForm($order_id, $reservation_id = null)
    {
        return view('admin.information.generation.reservation.form',
            [
                'order_id' => $order_id,
                'reservation_id' => $reservation_id,
            ]
        );
    }

    public function alertTalkList($reservation_id = null)
    {
        $reservation = HotelReservation::find($reservation_id);
        return view('admin.information.alert-talk-lists', [
            'alertTalkLists' => AlertTalkList::whereReservationId($reservation->id ?? null)->orderByDesc('send_at')->get()
        ]);
    }

}
