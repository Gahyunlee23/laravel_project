<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\PeriodPrice;
use App\Scheduler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;
use App\Payment\INIStdPayUtil;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function test(Request $request, $reservation = '') {

        $SignatureUtil = new INIStdPayUtil();


        $input = "oid=" . $request["oid"] . "&price=" . $request["price"] . "&timestamp=" . $request["timestamp"];

        $output['signature'] = array(
            ///'signature' => $SignatureUtil->makeHash($input, "sha256")
            'signature' => hash("sha256", $input)
        );

        echo json_encode($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 개별 호텔의 스케줄러 리스트 가져오기
     *
     * @param Request $request
     * @return array
     */
    public function lists(Request $request)
    {
        $events = [];

        $schedulers = Scheduler::whereHotelId($request->get('hotel'))->get();
        foreach ($schedulers as $scheduler){
            foreach (collect($scheduler->periodPrices()->groupBy(['room_type_id','range_d'])->get())->chunk(5) as $chunk){
                foreach ($chunk as $periodPrice) {
                    if($periodPrice->type === 'price'){

                        $inArr = PeriodPrice::whereHotelId($periodPrice->hotel_id)->whereRangeD($periodPrice->range_d)->where(function($q) use ($periodPrice) {
                            $q->where('room_type_id', '=', $periodPrice->room_type_id)
                                ->orWhere('room_type_name', '=', $periodPrice->room_type_name);
                        })->get();
                        $inText='';
                        if($inArr->count()===1){
                            $benefits='혜택 : 미설정';
                            if(isset($periodPrice->option->benefits)){
                                $benefits='혜택 : ';
                                $count = $periodPrice->option->benefits->count();
                                foreach ($periodPrice->option->benefits as $index=>$benefit){
                                    $benefits .= $benefit->name;
                                    if($count !== ($index+1)){
                                        $benefits.= ', ';
                                    }
                                }
                            }
                            $inText =
                                '<div class="flex items-center">'
                                .'<div class="flex-1 whitespace-pre pr-2">'.$periodPrice->date.'박</div>'
                                .'<div class="w-full h-px bg-tm-c-979b9f"></div>'
                                .'</div>'
                                .'<div>원가 : '. number_format($periodPrice->price ?? 0).'원</div>'
                                .'<div class="text-tm-c-979b9f">할인 : '. ($periodPrice->discount !== null ? number_format($periodPrice->price-$periodPrice->sale_price).'원 ('.$periodPrice->discount.'%)' : number_format($periodPrice->price-$periodPrice->sale_price).'원').'</div>'
                                .'<div class="text-tm-c-77b1ff">판매가 : '. number_format($periodPrice->sale_price ?? 0).'원</div>'
                                .'<div class="text-tm-c-da5542">환불금 : '. number_format($periodPrice->refund ?? 0).'원</div>'
                                .'<div>'
                                .$benefits
                                .'</div>'
                                .'<div class="flex items-center py-1">'
                                .'<div class="w-full h-px bg-tm-c-979b9f"></div>'
                                .'</div>';
                        }else{
                            foreach ($inArr as $item) {
                                $benefits='혜택 : 미설정';
                                if(isset($item->option->benefits)){
                                    $benefits='혜택 : ';
                                    $count = $item->option->benefits->count();
                                    foreach ($item->option->benefits as $index=>$benefit){
                                        $benefits .= $benefit->name;
                                        if($count !== ($index+1)){
                                            $benefits.= ', ';
                                        }
                                    }
                                }
                                $inText .=
                                    '<div class="flex items-center">'
                                    .'<div class="flex-1 whitespace-pre pr-2">'.$item->date.'박</div>'
                                    .'<div class="w-full h-px bg-tm-c-979b9f"></div>'
                                    .'</div>'
                                    .'<div>원가 : '. number_format($item->price ?? 0).'원</div>'
                                    .'<div class="text-tm-c-979b9f">할인 : '. ($item->discount !== null ? number_format($periodPrice->price-$periodPrice->sale_price).'원 ('.$periodPrice->discount.'%)' : number_format($periodPrice->price-$periodPrice->sale_price).'원').'</div>'
                                    .'<div class="text-tm-c-77b1ff">판매가 : '. number_format($item->sale_price ?? 0).'원</div>'
                                    .'<div class="text-tm-c-da5542">환불금 : '. number_format($item->refund ?? 0).'원</div>'
                                    .'<div>'
                                    .$benefits
                                    .'</div>'
                                    .'<div class="flex items-center py-1">'
                                    .'<div class="w-full h-px bg-tm-c-979b9f"></div>'
                                    .'</div>';
                            }
                        }

                        $description = '<div>'
                            .'<div class="flex justify-start">'
                            .'<div>'.($periodPrice->room_type_name ?? $periodPrice->roomType->name).'</div>'
                            .'</div>'
                            .'<div><span class="font-bold">'.$periodPrice->range_d.'</span> | '.$periodPrice->start_time.' ~ '.$periodPrice->end_time.'</div>'
                            .$inText
                            .'</div>';

                        $events[] = [
                            'id' => $scheduler->id.'.'.$periodPrice->id,
                            'description'=>$description,
                            'title' =>($periodPrice->room_type_name ?? $periodPrice->roomType->name),
                            'start' => Carbon::parse($periodPrice->range_d)->toDateString(),

                            'scheduler'=>$scheduler->id,
                            'periodPrice'=>$periodPrice->id,
                            'range_d'=>$periodPrice->range_d,
                            'date'=>$periodPrice->date,
                            'price'=>$periodPrice->price,
                            'timeZone'=>'KST',
                            'color'=>$scheduler->bg_color,
                            'textColor'=>$scheduler->text_color,
                        ];
                    }
                    if($periodPrice->type === 'tour'){
                        $events[] = [
                            'id' => $scheduler->id.'.'.$periodPrice->id,
                            'description'=>'<div>'
                                .'<div>투어 가능 시간 설정</div>'
                                .'<div><span class="font-bold">'.$periodPrice->range_d.'</span> | '.$periodPrice->start_time.' ~ '.$periodPrice->end_time.'</div>'
                                .'</div>',
                            'title' =>'투어',
                            'start' => Carbon::parse($periodPrice->range_d)->toDateString(),

                            'scheduler'=>$scheduler->id,
                            'periodPrice'=>$periodPrice->id,
                            'range_d'=>$periodPrice->range_d,
                            'timeZone'=>'KST',
                            'color'=>$scheduler->bg_color,
                            'textColor'=>$scheduler->text_color,
                        ];
                    }
                }
            }

        }
        return $events;
    }
    /**
     * Display the specified resource.
     *
     * @param Scheduler $scheduler
     * @return \Illuminate\Http\Response
     */
    public function show(Scheduler $scheduler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Scheduler $scheduler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scheduler $scheduler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Scheduler $scheduler
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scheduler $scheduler)
    {
        //
    }
}
