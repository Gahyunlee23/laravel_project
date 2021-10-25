<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FullCalenderController extends Controller
{
    /**
     * Write code on Method
     *
     * @param $hotel_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($hotel_id): \Illuminate\Http\JsonResponse
    {
        $terms = Term::whereHotelId($hotel_id)->get();
        $data = [];
        foreach ($terms as $item){
            $data[]= [
              'id'=>$item->id,
              'title'=>$item->memo,
              'start'=>Carbon::parse($item->start_dt)->format('Y-m-d H:i:s'),
              'end'=>Carbon::parse($item->end_dt)->format('Y-m-d H:i:s'),
            ];
        }
        return response()->json($data);
    }

    /**
     * Write code on Method
     *
     * @param Request $request
     * @return response|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function ajax(Request $request)
    {
        $data = [];
        switch ($request->type) {
            case 'add':
                $type=0;
                if($request->title === '입주'){
                    $type=1;
                }elseif($request->title === '투어'){
                    $type=0;
                }
                $term = Term::create([
                    'hotel_id' => $request->hotel_id,
                    'memo' => $request->title,
                    'start_dt' => $request->start,
                    'end_dt' => $request->end,
                    'type'=>$type
                ]);

                $data[]= [
                    'id'=>$term->id,
                    'title'=>$term->memo,
                    'start'=>Carbon::parse($term->start_dt)->format('Y-m-d H:i:s'),
                    'end'=>Carbon::parse($term->end_dt)->format('Y-m-d H:i:s'),
                ];
                return response()->json($data);

            case 'tour_access_update':
                $hotel = Hotel::find($request->hotel_id);
                $hotel->tour_start=$request->tour_start;
                $hotel->tour_end=$request->tour_end;
                $hotel->save();
                return response()->json($hotel);

            case 'delete':
                $event = Term::find($request->id)->delete();

                return response()->json($event);

            default:
                break;
        }
    }
}
