<?php

namespace App\Http\Controllers\Confirmation;

use App\AlertTalk;
use App\AlertTalkList;
use App\Confirmation;
use App\Formatter;
use App\HotelReservation;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{

    /* 관리자 > 주문관리 > (결제완료) > 입주 확정 처리 시 */
    public function livinginhotel(Request $request)
    {
        $formatter = new Formatter();

        $payment = Payment::find($request->payment_id);
        $reservation = HotelReservation::find($payment->reservation_id);
        $hotel_room = $reservation->room;

        $hotel_room_option = ( $hotel_room->nights !=='' ? '('.$hotel_room->nights.'박' : null ) .( $hotel_room->days !=='' ? ' '.$hotel_room->days.'일)' : null );

        $hotel_room_options = $payment->goods_option;

        $template=Template::whereCatalog('입주 확정')->whereUse('1')->first();
        $template_content = $formatter->templateFormat($template->template, [
            '#{회원명}' => $request->name,
            '#{호텔명}' => $payment->goods_name,
            '#{호텔옵션}' => $hotel_room_options,
            '#{룸타입}' => $request->room_type,
            '#{입주확정일자}' => $formatter->carbonFormat($request->start_dt, 'Y년 m월 d일(요일)'),
            '#{퇴실확정일자}' => $formatter->carbonFormat($request->end_dt, 'Y년 m월 d일(요일)'),
            '#{체크인_date}' => $formatter->carbonFormat($request->start_dt, 'Y년 m월 d일 H시i분')
        ]);

        $data = [
            'reserved_time'=>'',/*예약시간*/
            're_send'=>'Y',
            'tel' => $formatter->hpFormat($request->hp),
            'template_code' => $template->code,
            'template' => $template_content
        ];
        $buttons=[
            "button_type" => 'WL',
            "button_name" => '호텔에삶 이용 안내서',
            "button_url" => $reservation->hotel->info_notion,
            "button_url2" => $reservation->hotel->info_notion
        ];

        $at = new AlertTalk($data, $buttons);
        $at->send();
        $request->merge([
            'type' => 'LivingInHotel',
            'room_type' => $request->room_type
        ]);
        HotelReservation::find($request->reservation_id)->update(['order_status' => '5']);
        $confirmation = Confirmation::create($request->all());

        AlertTalkList::create([
            'template_id'=>$template->id,
            'reservation_id'=>$reservation->id,
            'payment_id'=>$payment->id,
            'confirmation_id'=>$confirmation->id,
            'hotel_id'=>$reservation->hotel->id,
            'room_id'=>$hotel_room->id,
            'catalog'=>$template->catalog,
            'hp'=>$formatter->hpFormat($request->hp),
            'result'=>'success',
            'template'=>$template_content,
            'send_at'=>Carbon::now(),
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Confirmation $confirmation
     * @return \Illuminate\Http\Response
     */
    public function show(Confirmation $confirmation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Confirmation $confirmation
     * @return \Illuminate\Http\Response
     */
    public function edit(Confirmation $confirmation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Confirmation $confirmation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Confirmation $confirmation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Confirmation $confirmation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Confirmation $confirmation)
    {
        //
    }
}
