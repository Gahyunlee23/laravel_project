<?php

namespace App\Http\Controllers\Hotels;

use App\AlertTalk;
use App\AlertTalkList;
use App\CertifiedKey;
use App\Curator;
use App\External;
use App\Formatter;
use App\Hotel;
use App\HotelCheckPoint;
use App\HotelFaq;
use App\HotelImage;
use App\HotelOption;
use App\HotelReservation;
use App\HotelReview;
use App\HotelRoom;
use App\HotelRoomType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreHotel;
use App\Payment;
use App\Template;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HotelController extends Controller
{
    public function hotelSort(Hotel $hotel)
    {
        return view('hotel.sort.index',[
            'hotel'=>$hotel
        ]);
    }
    /**
     * 호텔 리스트 전달 > 뷰
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function index()
    {
        return response()->view('hotel.index');
    }
    /**
     * 호텔 리스트 전달 > 뷰
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function hotelCurator()
    {
        return response()->view('hotel.curator');
    }

    /**
     * 호텔 주문 관리
     *
     * @param null $type
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function reservations(Request $request)
    {
        $now_status = $request->order_status ?? null;
        $now_type = $request->order_type ?? null;
        $pagenat = $request->pageant ?? 10;
        $user_data = $request->user_data ?? null;
        $curator_visible = $request->curator_visible ?? null;
        $curator_data = $request->curator_data ?? null;
        $payment_status = $request->payment_status ?? null;


        $reservations = HotelReservation::where(function ($query) use ($curator_data) {
            if ($curator_data !== '' && $curator_data !== null) {
                $query->whereHas('curator', function ($query) use ($curator_data) {
                    $query->where('user_id', 'like', '%' . $curator_data . '%');
                    $query->orwhere('user_page', 'like', '%' . $curator_data . '%');
                    $query->orwhere('name', 'like', '%' . $curator_data . '%');
                    $query->orwhere('email', 'like', '%' . $curator_data . '%');
                });
            }
        })->where(function ($query) use ($now_status) {
            if ($now_status !== '' && $now_status !== null) {
                $query->whereOrderStatus($now_status);
            }
        })->where(function ($query) use ($now_type) {
            if ($now_type !== '' && $now_type !== null) {
                $query->whereType($now_type);
            }
        })->where(function ($query) use ($user_data) {
            if ($user_data !== '' && $user_data !== null) {
                $query->where('order_name', 'like', '%' . $user_data . '%');
                $query->orwhere('order_email', 'like', '%' . $user_data . '%');
                $query->orwhere('order_hp', 'like', '%' . $user_data . '%');
            }
        })->where(function ($query) use ($curator_visible) {
            if ($curator_visible === '1') {
                $query->whereNull('curator_id');
            } else if ($curator_visible === '0') {
                $query->whereNotNull('curator_id');
            }
        })->where(function ($query) use ($payment_status) {
            if($payment_status!=='' && $payment_status !==null) {
                $query->whereHas('payment', function ($query) use($payment_status) {
                    if($payment_status!=='' && $payment_status !==null) {
                        $query->where('message', '=', $payment_status);
                    }
                });
            }
        })->where('order_status','!=',1)
            ->orderBy('id','DESC')
            ->orderBy('updated_at','DESC')
            ->paginate($pagenat);


        return response()
            ->view('hotel.reservations',
                [
                    'reservations' => $reservations,
                    'now_status' => $now_status,
                    'now_type' => $now_type,
                    'pagenat' => $pagenat,
                    'user_data' => $user_data,
                    'curator_visible' => $curator_visible,
                    'curator_data' => $curator_data,
                    'payment_status' => $payment_status,
                ],
                200);
    }

    /* 주문 상태 변경 처리 */
    public function reservationOrderStatus(HotelReservation $reservation, $type)
    {
        $reservation->order_status = $type;
        $reservation->save();

        /* 결제 상태와 동기화 1-진행중 2-주문완료 3-결제완료시 9-보류 0=취소시*/
        if($type==='1'||$type==='2'||$type==='3'||$type==='4'||$type==='9'||$type==='0')
            Payment::whereReservationId($reservation->id)->update([
                'status'=>$type
        ]);

        return redirect()->route('hotel.reservations');
    }

    /**
     * 호텔 생성 폼으로 접근
     *
     * @return Response
     */
    public function create()
    {
        return response()
            ->view('hotel.create', [
                'hotel_max_id' => Hotel::max('id') + 1
            ], 200);
    }

    /**
     * 호텔 생성 처리
     *
     * @param Request $request
     * @return false|Response|string
     */
    public function store(StoreHotel $request)
    {
        $hotel_id = Hotel::max('id') + 1;

        /*중복 새로고침 시 N 처리*/
        HotelImage::whereHotelId($hotel_id)->whereDisable('N')->update(['disable' => 'Y']);

        foreach ($request->all() as $id => $value) {
            $all_path = '';
            $num = Str::after(Str::before($id, '_'), 'file');

            if (Str::contains($id, 'images')) {
                foreach ($value as $file) {
                    $all_path .= Storage::disk('s3-Public')->put('images/' . $num . '/' . date('Y-m-d'), $file) . '|';
                }
                $request->merge([
                    'hotel_id' => $hotel_id,
                    'user_id' => Auth::user()->id,
                    'type' => $num,
                    'images' => Str::beforeLast($all_path, '|'),
                    'position_y' => $request->position_y
                ]);
                HotelImage::create(
                    $request->only('hotel_id', 'user_id', 'type', 'images', 'position_y')
                );
            }
        }

        if (is_file($request->check_point_image1)
            || is_file($request->check_point_image2)
            || is_file($request->check_point_image3)) {

            $CPI = false;
            if (is_file($request->check_point_image1)) {
                $check_point_image1 = Storage::disk('s3-Public')->put('checkpoint/' . $hotel_id . '/' . date('Y-m-d') . '/1', $request->check_point_image1);
                $request->merge([
                    'image1' => $check_point_image1
                ]);
                $CPI = true;
            }
            if (is_file($request->check_point_image2)) {
                $check_point_image2 = Storage::disk('s3-Public')->put('checkpoint/' . $hotel_id . '/' . date('Y-m-d') . '/2', $request->check_point_image2);
                $request->merge([
                    'image2' => $check_point_image2
                ]);
                $CPI = true;
            }
            if (is_file($request->check_point_image3)) {
                $check_point_image3 = Storage::disk('s3-Public')->put('checkpoint/' . $hotel_id . '/' . date('Y-m-d') . '/3', $request->check_point_image3);
                $request->merge([
                    'image3' => $check_point_image3
                ]);
                $CPI = true;
            }
            if ($CPI) {
                HotelCheckPoint::updateOrCreate(
                    $request->only('hotel_id'),
                    $request->only('hotel_id', 'image1', 'image2', 'image3')
                );
            }
        }
        if ($request->check_point_title1) {
            $request->merge([
                'title1' => $request->check_point_title1
            ]);
        }
        if ($request->check_point_title2) {
            $request->merge([
                'title2' => $request->check_point_title2
            ]);
        }
        if ($request->check_point_title3) {
            $request->merge([
                'title3' => $request->check_point_title3
            ]);
        }
        if ($request->check_point_explanation1) {
            $request->merge([
                'explanation1' => $request->check_point_explanation1
            ]);
        }
        if ($request->check_point_explanation2) {
            $request->merge([
                'explanation2' => $request->check_point_explanation2
            ]);
        }
        if ($request->check_point_explanation3) {
            $request->merge([
                'explanation3' => $request->check_point_explanation3
            ]);
        }

        HotelCheckPoint::updateOrCreate(
            $request->only('hotel_id'),
            $request->all()
        );

        if (isset($request->file0_title[0]) && isset($request->file0_explanation[0])) {
            $hotelImage = HotelImage::whereHotelId($hotel_id)->whereType('0')->firstOrFail();
            $hotelImage->title = $request->file0_title[0];
            $hotelImage->explanation = $request->file0_explanation[0];
            $hotelImage->save();
        }
        if (isset($request->file1_title[0]) && isset($request->file1_explanation[0])) {
            $hotelImage = HotelImage::whereHotelId($hotel_id)->whereType('1')->firstOrFail();
            $hotelImage->title = $request->file1_title[0];
            $hotelImage->explanation = $request->file1_explanation[0];
            $hotelImage->save();
        }
        if (isset($request->file2_title[0]) && isset($request->file2_explanation[0])) {
            $hotelImage = HotelImage::whereHotelId($hotel_id)->whereType('2')->firstOrFail();
            $hotelImage->title = $request->file2_title[0];
            $hotelImage->explanation = $request->file2_explanation[0];
            $hotelImage->save();
        }
        if (isset($request->file3_title[0]) && isset($request->file3_explanation[0])) {
            $hotelImage = HotelImage::whereHotelId($hotel_id)->whereType('3')->firstOrFail();
            $hotelImage->title = $request->file3_title[0];
            $hotelImage->explanation = $request->file3_explanation[0];
            $hotelImage->save();
        }

        for ($i = 0, $iMax = count($request->faq_question); $i < $iMax; $i++) {
            if (!is_null($request->faq_question[$i]) && !is_null($request->faq_answer[$i])) {
                HotelFaq::create([
                    'hotel_id' => $hotel_id,
                    'user_id' => Auth::user()->id,
                    'answer_name' => $request->faq_answer_name[$i],
                    'answer_job' => $request->faq_answer_job[$i],
                    'question' => $request->faq_question[$i],
                    'answer' => $request->faq_answer[$i]
                ]);
            }
        }

        if (isset($request->type_name[0])) {
            for ($i = 0, $iMax = count($request->type_name); $i < $iMax; $i++) {
                $file_path='';
                if(isset($request->type_file_image[$i])){
                    $file_path = Storage::disk('s3-Public')->put('/images/' . $hotel_id . '/room-type/' . date('Y-m-d'), $request->type_file_image[$i]);
                }
                if (!is_null($request->type_name[$i])) {
                    HotelRoomType::create([
                        'hotel_id' => $hotel_id,
                        'user_id' => Auth::user()->id,
                        'name' => $request->type_name[$i],
                        'main_explanation' => $request->type_main_explanation[$i],
                        'sub_explanation' => $request->type_sub_explanation[$i],
                        'visible' => $request->type_visible[$i],
                        'upgrade' => $request->type_upgrade[$i],
                        'order' => $request->type_order[$i],
                        'image' => $file_path,
                    ]);
                }
            }
        }

        if (isset($request->room_name[0])) {
            for ($i = 0, $iMax = count($request->room_name); $i < $iMax; $i++) {
                if (!is_null($request->room_name[$i]) && !is_null($request->room_sale_price[$i])) {
                    HotelRoom::create([
                        'hotel_id' => $hotel_id,
                        'user_id' => Auth::user()->id,
                        'title' => $request->room_title[$i],
                        'name' => $request->room_name[$i],
                        'nights' => $request->room_nights[$i],
                        'days' => $request->room_days[$i],
                        'coupon' => $request->room_coupon[$i],
                        'price' => $request->room_price[$i],
                        'sale_price' => $request->room_sale_price[$i],
                        'discount_rate' => $request->room_discount_rate[$i],
                        'refund_amount' => $request->room_refund_amount[$i],
                        'main_explanation' => $request->room_main_explanation[$i],
                        'explanation' => $request->room_explanation[$i],
                        'sub_explanation' => $request->room_sub_explanation[$i],
                        'visible' => $request->room_visible[$i],
                        'order' => $request->room_order[$i]
                    ]);
                }
            }
        }

        $request->merge([
            'hotel_id' => $hotel_id,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'title_en' => $request->title_en,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'discount_rate' => $request->discount_rate,
            'refund_amount' => $request->refund_amount,
            'sale_url' => $request->sale_url,
            'explanation' => $request->explanation,
            'sub_explanation' => $request->sub_explanation,
            'facilities' => $request->facilities,
            'amenities' => $request->amenities,
            'benefit' => implode('|', $request->benefit),
            'benefit_only' => implode('|', $request->benefit_only),
            'benefit_type' => implode('|', $request->benefit_type),
            'area' => $request->area,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);
        HotelOption::create(
            $request->only('hotel_id',
                'title', 'title_en',
                'price', 'sale_price', 'discount_rate', 'refund_amount',
                'explanation', 'sub_explanation',
                'facilities', 'amenities', 'benefit', 'benefit_only','benefit_type',
                'area', 'lat', 'lng')
        );

        /* 호텔 status 완료 처리 */
        Hotel::create(['id' => $hotel_id, 'status' => 2, 'order' => $request->order]);

        return redirect()->route('hotel.index');
    }

    /**
     * 단일 호텔 뷰
     *
     * @param Hotel $hotel
     * @return Application|Factory|Response|View
     */
    public function show(Hotel $hotel)
    {
        $options = HotelOption::whereHotelId($hotel->id)->get();
        $images = HotelImage::whereHotelId($hotel->id)->get();
        $faqs = HotelFaq::whereHotelId($hotel->id)->get();

        return view('hotel.show',
            [
                'hotel' => $hotel,
                'options' => $options,
                'images' => $images,
                'faqs' => $faqs,
            ]
        );
    }


    /**
     * 단일 호텔 수정 폼
     *
     * @param Hotel $hotel
     * @return Application|Factory|Response|View
     */
    public function edit(Hotel $hotel)
    {
        $hotel_detail = Hotel::with(['options' => function ($query) {
            $query->whereDisable('N');
            $query->orderBy('id');
        },
            'images' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            },
            'faqs' => function ($query) {
                $query->orderBy('id');
            },
            'rooms' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            },
            'room_types' => function ($query) {
                $query->whereVisible('1');
                $query->orderBy('order');
            },
            'checkPoints' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            }])->whereBetween('status', ['1', '5'])
            ->where('id', $hotel->id)->first();

        return view('hotel.edit', ['hotel' => $hotel_detail]);
    }

    /**
     * 단일 호텔 수정
     *
     * @param StoreHotel $request
     * @param Hotel $hotel
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request, Hotel $hotel): RedirectResponse
    {
        $hotel_id = $hotel->id;
        $hotel_order = Hotel::find($hotel_id);
        //$request->room_room_type_upgrade[0]=array_filter($request->room_room_type_upgrade[0], function($value) { return !is_null($value) && $value !== ''; });

        if ($hotel_order) {
            $hotel_order->order = $request->hotel_order;
            $hotel_order->save();
        }

        /*중복 새로고침 시 N 처리*/
        $HotelImage = HotelImage::find($hotel_id);
        $request->merge([
            'hotel_id' => $hotel_id
        ]);

        foreach ($request->all() as $id => $value) {
            $all_path = '';
            $num = Str::after(Str::before($id, '_'), 'file');

            if (Str::contains($id, 'images')) {
                if($value !== null && is_array($value)){
                    foreach ($value as $file) {
                        $all_path .= Storage::disk('s3-Public')->put('images/' . $num . '/' . date('Y-m-d'), $file) . '|';
                    }
                    $request->merge([
                        'hotel_id' => $hotel_id,
                        'user_id' => Auth::user()->id,
                        'type' => $num,
                        'images' => Str::beforeLast($all_path, '|'),
                        'position_y' => $request->position_y
                    ]);
                    HotelImage::updateOrCreate(
                        $request->only('hotel_id'),
                        $request->only('type', 'images', 'position_y')
                    );
                }
            } else if ($num !== 'review' && Str::contains($id, '_order')) {
                $request->merge([
                    'hotel_id' => $hotel_id,
                    'user_id' => Auth::user()->id,
                    'type' => $num,
                    'images' => $value[0] ?? null,
                    'position_y' => $request->position_y
                ]);

                HotelImage::updateOrCreate(
                    $request->only('hotel_id'),
                    $request->only('type', 'images', 'position_y')
                );
            }
        }

        if (is_file($request->check_point_image1)) {
            $check_point_image1 = Storage::disk('s3-Public')->put('checkpoint/' . $hotel_id . '/' . date('Y-m-d') . '/1', $request->check_point_image1);
            $request->merge([
                'image1' => $check_point_image1
            ]);
        }
        if (is_file($request->check_point_image2)) {
            $check_point_image2 = Storage::disk('s3-Public')->put('checkpoint/' . $hotel_id . '/' . date('Y-m-d') . '/2', $request->check_point_image2);
            $request->merge([
                'image2' => $check_point_image2
            ]);
        }
        if (is_file($request->check_point_image3)) {
            $check_point_image3 = Storage::disk('s3-Public')->put('checkpoint/' . $hotel_id . '/' . date('Y-m-d') . '/3', $request->check_point_image3);
            $request->merge([
                'image3' => $check_point_image3
            ]);
        }
        if ($request->check_point_title1) {
            $request->merge([
                'title1' => $request->check_point_title1
            ]);
        }
        if ($request->check_point_title2) {
            $request->merge([
                'title2' => $request->check_point_title2
            ]);
        }
        if ($request->check_point_title3) {
            $request->merge([
                'title3' => $request->check_point_title3
            ]);
        }
        if ($request->check_point_explanation1) {
            $request->merge([
                'explanation1' => $request->check_point_explanation1
            ]);
        }
        if ($request->check_point_explanation2) {
            $request->merge([
                'explanation2' => $request->check_point_explanation2
            ]);
        }
        if ($request->check_point_explanation3) {
            $request->merge([
                'explanation3' => $request->check_point_explanation3
            ]);
        }
        //ddd($request->all());
        HotelCheckPoint::whereDisable('N')->updateOrCreate(
            $request->only('hotel_id'),
            $request->only(
                'image1', 'image2', 'image3',
                'title1', 'title2', 'title3',
                'explanation1', 'explanation2', 'explanation3')
        );

        if (isset($request->file0_title[0]) && isset($request->file0_explanation[0])) {
            $hotelImage = HotelImage::whereHotelId($hotel_id)->whereType('0')->firstOrFail();
            $hotelImage->title = $request->file0_title[0];
            $hotelImage->explanation = $request->file0_explanation[0];
            $hotelImage->save();
        }
        if (isset($request->file1_title[0]) && isset($request->file1_explanation[0])) {
            $hotelImage = HotelImage::whereHotelId($hotel_id)->whereType('1')->firstOrFail();
            $hotelImage->title = $request->file1_title[0];
            $hotelImage->explanation = $request->file1_explanation[0];
            $hotelImage->save();
        }
        if (isset($request->file2_title[0]) && isset($request->file2_explanation[0])) {
            $hotelImage = HotelImage::whereHotelId($hotel_id)->whereType('2')->firstOrFail();
            $hotelImage->title = $request->file2_title[0];
            $hotelImage->explanation = $request->file2_explanation[0];
            $hotelImage->save();
        }
        if (isset($request->file3_title[0]) && isset($request->file3_explanation[0])) {
            $hotelImage = HotelImage::whereHotelId($hotel_id)->whereType('3')->firstOrFail();
            $hotelImage->title = $request->file3_title[0];
            $hotelImage->explanation = $request->file3_explanation[0];
            $hotelImage->save();
        }

        if (isset($request->faq_question) && isset($request->faq_answer)) {
            HotelFaq::where('hotel_id', $hotel_id)->delete();
            for ($i = 0, $iMax = count($request->faq_question); $i < $iMax; $i++) {
                if (!is_null($request->faq_question[$i]) && !is_null($request->faq_answer[$i])) {
                    HotelFaq::Create([
                        'hotel_id' => $hotel_id,
                        'user_id' => Auth::user()->id,
                        'answer_name' => $request->faq_answer_name[$i],
                        'answer_job' => $request->faq_answer_job[$i],
                        'question' => $request->faq_question[$i],
                        'answer' => $request->faq_answer[$i]
                    ]);
                }
            }
        }
//        if (isset($request->review_name) && isset($request->review_content)) {
//            HotelReview::where('hotel_id', $hotel_id)->update(['visible'=>'0']);
//            for ($i = 0, $iMax = count($request->review_name); $i < $iMax; $i++) {
//                HotelReview::Create([
//                    'hotel_id' => $hotel_id,
//                    'hotel_room_type_id' => $request->review_hotel_room_type_id[$i],
//                    'input_completed_at' => $request->review_input_completed_at[$i],
//                    'name' => $request->review_name[$i],
//                    'option' => $request->review_option[$i],
//                    'star' => $request->review_star[$i],
//                    'content' => $request->review_content[$i]
//                ]);
//            }
//        }

        if(auth()->check() && !auth()->user()->hasAnyRole('개발') && $request->room_change){
            if (isset($request->type_name)) {
                //if(!isset($request->type_file_image[0]) && !$request->type_file_image[0] !== null && !$request->type_file_image[0] !== ''){
                $old = HotelRoomType::whereHotelId($hotel_id)->whereVisible('1')->get();
                //}
                HotelRoomType::whereHotelId($hotel_id)->update(['visible' => '0', 'upgrade' => 'N']);
                for ($i = 0, $iMax = count($request->type_name); $i < $iMax; $i++) {
                    $file_path='';
                    if(isset($request->type_file_image[$i]) && $request->type_file_image[$i] !== null && $request->type_file_image[$i] !== ''){
                        $file_path = Storage::disk('s3-Public')->put('/images/' . $hotel_id . '/room-type/' . date('Y-m-d'), $request->type_file_image[$i]);
                    }else{
                        $file_path = $old[$i]->image ?? '';
                    }
                    if (!is_null($request->type_name[$i])) {
                        HotelRoomType::create([
                            'hotel_id' => $hotel_id,
                            'user_id' => Auth::user()->id,
                            'name' => $request->type_name[$i],
                            'main_explanation' => $request->type_main_explanation[$i],
                            'sub_explanation' => $request->type_sub_explanation[$i],
                            'visible' => $request->type_visible[$i],
                            'upgrade' => $request->type_upgrade[$i],
                            'order' => $request->type_order[$i],
                            'sale_possibility_count' => $request->type_sale_possibility_count[$i],
                            'image' => $file_path
                        ]);
                    }
                }
            }
        }

        $request->merge([
            'hotel_id' => $hotel_id,
            'user_id' => Auth::user()->id,
            'title' => $request->hotel_title,
            'title_en' => $request->hotel_title_en,
            'price' => $request->hotel_price,
            'sale_price' => $request->hotel_sale_price,
            'discount_rate' => $request->hotel_discount_rate,
            'refund_amount' => $request->hotel_refund_amount,
            'sale_url' => $request->hotel_sale_url,
            'explanation' => $request->hotel_explanation,
            'sub_explanation' => $request->hotel_sub_explanation,
            'facilities' => $request->hotel_facilities,
            'amenities' => $request->hotel_amenities,
            'benefit' => implode('|', $request->hotel_benefit),
            'benefit_only' => implode('|', $request->hotel_benefit_only),
            'benefit_type' => implode('|', $request->hotel_benefit_type),
            'subway_station' => $request->hotel_subway_station,
            'area' => $request->hotel_area,
            'lat' => $request->hotel_lat,
            'lng' => $request->hotel_lng,
            'detail_description' => HotelOption::whereHotelId($hotel_id)->whereDisable('N')->whereNotNull('detail_description')->latest()->first()->detail_description ?? null,
        ]);

        HotelOption::whereHotelId($hotel_id)->whereDisable('N')->update(['disable' => 'Y']);
        HotelOption::create(
            $request->all()
        );

        return redirect()->route('hotel.index');
    }

    /**
     * 호텔 삭제 처리
     *
     * @param Hotel $hotel
     * @return Application|RedirectResponse|Response|Redirector|null
     * @throws Exception
     */
    public function destroy(Hotel $hotel)
    {
        //Storage::disk('s3-Public')->delete();
        $hotel->status = 0;
        $hotel->save();
        return redirect()->route('hotel.index');
    }

    public function open(Hotel $hotel)
    {
        //Storage::disk('s3-Public')->delete();
        $hotel->status = 2;
        $hotel->save();
        return redirect()->route('hotel.index');
    }

    public function gradeAppend(Request $request, Hotel $hotel)
    {
        $hotel->grade = $request->get('grade');
        $hotel->save();
        return redirect()->route('hotel.index');
    }
    public function gradeDelete( Hotel $hotel)
    {
        $hotel->grade = null;
        $hotel->save();
        return redirect()->route('hotel.index');
    }

    public function close(Hotel $hotel)
    {
        $hotel->status = 1;
        $hotel->save();
        return redirect()->route('hotel.index');
    }


    public function detail(Request $request): JsonResponse
    {

        $hotels = Hotel::with(['options' => function ($query) {
            $query->whereDisable('N');
            $query->orderBy('id');
        },
            'images' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            },
            'faqs' => function ($query) {
                $query->orderBy('id');
            },
            'rooms' => function ($query) {
                $query->whereDisable('N');
                $query->whereVisible('1');
                $query->orderBy('order')->orderBy('id');
            },
            'checkPoints' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            }])->whereId($request->input('id'))->get();
        // ddd($hotels[0]->rooms()->get());
        return response()
            ->json([
                'hotel' => $hotels
            ]);
    }

    /*
     * 여행자 접근 주문 시작 - 호텔선택
     * */
    public function order(Request $request): JsonResponse
    {
        $userAgent=$this->UserAgent();
        if($userAgent['mobile']){
            $request->merge([
                'device' => $userAgent['device'] ?? '',
                'browser' => $userAgent['browser'] ?? '',
            ]);
        }else if(!$userAgent['mobile']){
            $request->merge([
                'os' => $userAgent['os'] ?? '',
                'browser' => $userAgent['browser'] ?? '',
            ]);
        }
        $request->merge([
            'order_status' => 1
        ]);

        $reservation = HotelReservation::Create(
            $request->all()
        );

        return response()
            ->json([
                'status' => 'success',
                'reservation' => $reservation
        ]);
    }

    /*
     * 여행자 호텔선택 > 개인정보 입력 및 동의 후 주문완료
     * */
    public function orderCompleted(Request $request): JsonResponse
    {
        $date = $request->order_desired_dt;

        if($request->type === 'tour'){
            $type = '0';
        }elseif($request->type === 'month'){
            $type = '1';
        }
        $count = Hotel::find($request->hotel_id)
            ->terms()->where('hotel_id', '=', $request->hotel_id)
            ->where('type','=', $type)->where(function ($query) use ($date){
            $query->where('start_dt', '<=', Carbon::parse($date)->format('Y-m-d'))
                ->where('end_dt', '>=', Carbon::parse($date)->format('Y-m-d'));
        })->count();
        if($count > 0){
            return response()->json([
                'status' => 'select-date-again',
                'data'=>$request->order_desired_dt
            ]);
        }
        $data = '';
        $reservation_check = HotelReservation::whereId($request->id)
            ->whereHotelId($request->hotel_id)
            ->whereType($request->type)
            ->where(function ($query) {
                $query->where('order_status', '=', 1)
                    ->orWhere('order_status', '=', 2)
                    ->orWhere('order_status', '=', 8);
            })->first();

        if($reservation_check){
            if ($reservation_check->order_status !== '3') {
                $request->merge([
                    'order_status' => 2
                ]);
            }
            if($request->time_hour !== null && $request->time_minute !== null){
                $request->merge([
                    'order_desired_dt' => Carbon::parse(($request->order_desired_dt.' '.($request->time_hour).':'.$request->time_minute.':00'))->format('Y-m-d H:i:s')
                ]);
            }

            $userAgent=$this->UserAgent();
            if($userAgent['mobile']){
                $request->merge([
                    'device' => $userAgent['device'] ?? '',
                    'browser' => $userAgent['browser'] ?? '',
                ]);
            }else if(!$userAgent['mobile']){
                $request->merge([
                    'os' => $userAgent['os'] ?? '',
                    'browser' => $userAgent['browser'] ?? '',
                ]);
            }

            if( auth()->check() ) {
                $user = auth()->user();
            }elseif(isset($request->order_name, $request->order_email, $request->order_hp)){
                if($request->country_code ==='' || $request->country_code === 'null' || $request->country_code === '+82'){
                    $user = User::firstOrCreate([
                        'email'=>$request->order_email
                    ],[
                        'name'=>$request->order_name,
                        'email'=>$request->order_email,
                        'tel'=> Str::of(phone($request->order_hp,'KR'))->replace('+82','0')->replace('-',''),
                        'phone'=>phone($request->order_hp,'KR'),
                        'country_code'=>'+82',
                        'password'=> Hash::make(Str::of(phone($request->order_hp,'KR'))->replace('+82','0')->replace('-','')),
                        'password_tmp'=> Str::of(phone($request->order_hp,'KR'))->replace('+82','0')->replace('-','')
                    ]);
                }elseif($request->country_code === '+1'){
                    $user= User::firstOrCreate([
                        'email'=>$request->order_email
                    ],[
                        'name'=>$request->order_name,
                        'email'=>$request->order_email,
                        'tel'=> Str::of(phone($request->order_hp,'US'))->replace('-',''),
                        'phone'=> Str::of(phone($request->order_hp,'US')->formatInternational())->replace('-','')->replace(' ',''),
                        'country_code'=>$request->country_code ?? '+1',
                        'password'=> Hash::make(Str::of(phone($request->order_hp,'US'))->replace('+1','')->replace('-','')),
                        'password_tmp'=> Str::of(phone($request->order_hp,'US'))->replace('+1','')->replace('-','')
                    ]);
                }

                if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                    $certified = CertifiedKey::whereTarget($request->order_hp)
                        ->where('key','=', $request->certifiedKey)
                        ->where('purpose', '=', '결제 전 인증')
                        ->where('type', '=', 'tel')
                        ->latest()->first();
                    if($certified){
                        CertifiedKey::find($certified->id)->update([
                            'user_id'=>$user->id,
                            'authentication_dt'=>now()
                        ]);
                    }
                }
            }

            $request->merge([
                'user_id'=>$user->id ?? 0
            ]);

            $reservation = HotelReservation::updateOrCreate(
                $request->only('id', 'hotel_id'),
                $request->all()
            );
            /* 투어 신청 완료 처리*/
            if ($reservation->type === 'tour') {
                $data = HotelOption::whereHotelId($request->hotel_id)->orderByDesc('id')->first();
                if($reservation->id!=='' && $reservation->id!==null){
                    if($request->country_code ==='' || $request->country_code === 'null' || $request->country_code === '+82'){
                        $ATCheck=$this->reservationByIdToAT($reservation->id, 'tour_order_completed');
                    }
                    $outerCheck=$this->outerMailSend($reservation->id);
                    $this->mailSend($reservation->id, $ATCheck, $outerCheck);
                }
            } else if ($reservation->type === 'month') {
                $data = HotelRoom::whereId($request->room_id)->orderByDesc('id')->first();
            }
            return response()
                ->json([
                    'status' => 'success',
                    'reservation' => $reservation,
                    'sale_url' => $data->sale_url
            ]);
        }
        return response()
            ->json([
                'status' => 'fall'
        ]);
    }

    public function reservationCompleted(HotelReservation $reservation): Response
    {
        if($reservation){
            if(Carbon::now()->diffInHours($reservation->user->created_at) < 24 && $reservation->user->password_tmp !== null){
                /* 알림톡 전송 */
                $this->newMembershipRegistration($reservation);
            }
        }
        return response()
            ->view('hotel.reservations.completed',
                []);
    }

    public function reservationOrderCompleted($reservation = null): Response
    {
        return response()->view('hotel.reservations.order_completed', [
            'reservation' => HotelReservation::find($reservation)
        ]);
    }

    protected function reservationByIdToAT($reservation_id, $type): ?bool
    {
        $formatter = new Formatter();
        $reservation = HotelReservation::find($reservation_id);
        if($reservation){
            $hotel_option= HotelOption::whereHotelId($reservation->hotel_id)->whereDisable('N')->first();
            //$hotel_option = $reservation->hotel->options->where('disable','=','N')->first();
            if($hotel_option && $type === 'tour_order_completed') {
                $template=Template::whereCatalog('투어 신청 완료')->whereUse('1')->first();
                $template_content = $formatter->templateFormat($template->template, [
                    '#{호텔명}' => $hotel_option->title,
                    '#{투어희망일자}' =>$formatter->carbonFormat(Carbon::parse($reservation->order_desired_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분')
                ]);

                $data = [
                    'reserved_time'=>'',/*예약시간*/
                    're_send'=>'Y',
                    'tel' => $formatter->hpFormat($reservation->order_hp),
                    'template_code' => $template->code,
                    'template' => $template_content
                ];

                $at = new AlertTalk($data);
                $at->send();

                AlertTalkList::create([
                    'template_id'=>$template->id,
                    'reservation_id'=>$reservation->id,
                    'hotel_id'=>$reservation->hotel->id,
                    'catalog'=>$template->catalog,
                    'hp'=>$formatter->hpFormat($reservation->order_hp),
                    'result'=>'success',
                    'template'=>$template_content,
                    'send_at'=>Carbon::now(),
                ]);
                return true;

            }
        }
        return false;
    }


    protected function mailSend($id, $ATCheck, $outerCheck): void
    {
        $admins = [
            /*[
                'email'=>'zuiderzee@naver.com',
                'name'=>'노한결'
            ],*/
            [
                'email'=>'hotelmanager@travelmakers.kr',
                'name'=>'정승재'
            ]
        ];

        $reservation = HotelReservation::find($id);
        if($reservation){
            $subject='';
            if($reservation->type==='month'){
                $subject='[호텔에삶/호텔/결제완료]'.$reservation->order_name . '님';
                $admins = [
                    [
                        'email'=>'hotelmanager@travelmakers.kr',
                        'name'=>'정승재'
                    ],
                    [
                        'email'=>'travelmakerkorea_k@naver.com',
                        'name'=>'김병주'
                    ]
                ];
            }else if($reservation->type==='tour'){
                $subject='[호텔에삶/투어/신청완료]'.$reservation->order_name . '님';
            }
            $data = [
                'ATCheck'=>$ATCheck,
                'outerCheck'=>$outerCheck,
                'subject'=> $subject,
                'name'=>$reservation->order_name,
                'reservation' => $reservation,
                'hotel' => Hotel::whereId($reservation->hotel_id)->whereStatus('2')->first(),
                'room' => HotelRoom::whereId($reservation->room_id)->whereDisable('N')->first(),
                'curator' => Curator::whereId($reservation->curator_id)->whereVisible('1')->first(),
                'payment' => Payment::whereReservationId($reservation->id)->orderBy('id')->first(),
            ];

            foreach ($admins as $index => $user){
                if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                    Mail::mailer('info')->send('emails.order_completed', $data, function($message) use ($user,$data) {
                        $message->to($user['email'],$user['name'])->subject($data['subject']);
                        $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME')); /*HOTEL_MANAGER_MAILER*/
                    });
                }else{
                    Mail::mailer('info')->send('emails.order_completed', $data, function($message) use ($user,$data) {
                        $message->to($user['email'],$user['name'])->subject($data['subject']);
                        $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                    });
                }
            }
        }
    }


    protected function outerMailSend ($id)
    {
        $admins = [
            [
                'email' => 'zuiderzee@naver.com',
                'name' => '노한결'
            ]
        ];

        $reservation = HotelReservation::find($id);
        if($reservation){
            $external=External::create([
                'reservation_id'=>$reservation->id,
                'hotel_id'=>$reservation->hotel_id,
                'access_key'=>Str::random(60),
                'access_at'=> Carbon::now(),
                'access_end_at'=> Carbon::now()->addDays(3),
                'memo'=>$reservation->type.' 호텔관리자에게 전달',
                'type'=>'outer-order-completed',
                'status'=>'0'
            ]);

            if($external){
                $hotel_room = HotelRoom::whereId($reservation->room_id)->first();
                $hotel = Hotel::whereId($reservation->hotel_id)->first();
                $data = [
                    'subject'=> '[호텔에삶] 호텔 투어 신청이 들어왔습니다.',
                    'name'=>$reservation->order_name,
                    'reservation' => $reservation,
                    'hotel' => $hotel,
                    'hotel_option' => HotelOption::whereHotelId($reservation->hotel_id)->whereDisable('N')->first(),
                    'room' => $hotel_room,
                    'curator' => Curator::whereId($reservation->curator_id)->whereVisible('1')->first(),
                    'payment' => Payment::whereReservationId($reservation->id)->orderBy('id')->first(),
                    'external'=>$external,
                    'formatter'=> new Formatter()
                ];
                $sendMail='';
                if(auth()->check() && auth()->user()->hasAnyRole('개발')){
                    foreach ($hotel->admin_emails as $index => $email){
                        Mail::mailer('info')->send('emails.outer.order_completed', $data, function($message) use ($data, $email) {
                            $message->to($email, '호텔 관리자님')->subject($data['subject']);
                            $message->from(env('INFO_MAIL_USERNAME'), env('INFO_MAIL_NICKNAME'));
                        });
                    }
                    $sendMail=$hotel->admin_emails;
                }else{
                    foreach ($hotel->tour_emails as $index => $email){
                        Mail::mailer('hotel-manager')->send('emails.outer.order_completed', $data, function($message) use ($data, $email) {
                            $message->to($email, '호텔 관리자님')->subject($data['subject']);
                            $message->from(env('HOTEL_MANAGER_MAIL_USERNAME'),env('HOTEL_MANAGER_MANAGER_MAIL_NICKNAME'));
                        });
                    }
                    $sendMail=$hotel->tour_emails;
                }
                return $sendMail;
            }
        }
    }

    protected function UserAgent(): array
    {
        $userAgent = $_SERVER["HTTP_USER_AGENT"];

        $appleMobileAgent = ["iPhone","iphone", "iPod", "ipad"];
        $androidMobileAgent = ["Android", "Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony"];
        $device = '';
        $mobile = false;

        for ($i = 0,$iMax = sizeof($appleMobileAgent); $i < $iMax; $i++) {
            if (stripos($userAgent, $appleMobileAgent[$i])) {
                $device = $appleMobileAgent[$i];
                $mobile = true;
                break;
            }
        }

        for ($i = 0,$iMax = sizeof($androidMobileAgent); $i < $iMax; $i++) {
            if (stripos($userAgent, $androidMobileAgent[$i])) {
                $device = $androidMobileAgent[$i];
                $mobile = true;
                break;
            }
        }

        if(preg_match('/MSIE/i',$userAgent) || preg_match('/Trident/i',$userAgent)){
            $browser = 'Explorer';
        }
        else if(preg_match('/Edg/i',$userAgent)){
            $browser = 'Edge';
        }
        else if(preg_match('/Whale/i',$userAgent)){
            $browser = 'Whale';
            if(preg_match('/1.0.0.0/i',$userAgent)){
                $browser = 'Naver';
            }
        }
        else if(preg_match('/SamsungBrowser/i',$userAgent)){
            $browser = 'SamsungBrowser';
        }
        else if(preg_match('/Firefox/i',$userAgent)){
            $browser = 'Firefox';
        }
        else if (preg_match('/Chrome/i',$userAgent)){
            $browser = 'Chrome';
        }
        else if(preg_match('/Safari/i',$userAgent)){
            $browser = 'Safari';
        }
        elseif(preg_match('/Opera/i',$userAgent)){
            $browser = 'Opera';
        }
        elseif(preg_match('/Netscape/i',$userAgent)){
            $browser = 'Netscape';
        }
        else{
            $browser = "Other";
        }

        if (preg_match('/linux/i', $userAgent)){
            $os = 'linux';}
        elseif(preg_match('/macintosh|mac os x/i', $userAgent)){
            $os = 'mac';}
        elseif (preg_match('/windows|win32/i', $userAgent)){
            $os = 'windows';}
        else {
            $os = 'Other';
        }

        return [
            'mobile'=>$mobile,
            'device'=>$device,
            'browser'=>$browser,
            'os'=>$os
        ];
    }

    /**
     * 단일 호텔 수정
     *
     * @param Request $request
     * @param Hotel $hotel
     * @return RedirectResponse
     * @throws Exception
     */
    public function roomOption(Request $request, Hotel $hotel)
    {
        $rooms = $hotel->rooms->where('visible','=', 1)->where('disable','=','N');
        if(!empty($rooms)){
            $room_index=0;
            foreach ($rooms as $room){
                $save=false;
                $update_room = HotelRoom::find($room->id);
                if($update_room){
                    if(isset($request->room_option[$room_index])){
                        $update_room->room_option = implode(',',$request->room_option[$room_index]);
                    }else{
                        $update_room->room_option=null;
                    }
                    if(isset($request->room_sold_out[$room_index])){
                        $update_room->room_sold_out = implode(',',$request->room_sold_out[$room_index]);
                    }else{
                        $update_room->room_sold_out=null;
                    }
                    if(isset($request->room_upgrade[$room_index])){
                        $update_room->room_upgrade = implode(',',$request->room_upgrade[$room_index]);
                    }else{
                        $update_room->room_upgrade=null;
                        $update_room->upgrade = 0;
                    }
                    $update_room->save();
                }
                $room_index++;
            }
        }
        \Session::flash('message', "호텔 룸 옵션 저장완료.");
        return back();
    }


    /* 결제 주문 폼 접근 테스트
     * 여행자 접근 주문 시작 - 호텔선택
     * */
    public function reservationOrder(Request $request, Hotel $hotel)
    {
        $data = collect();
        $userAgent=$this->UserAgent();
        if($userAgent['mobile']){
            $data=$data->merge([
                'device' => $userAgent['device'] ?? null,
                'browser' => $userAgent['browser'] ?? null,
            ]);
        }else if(!$userAgent['mobile']){
            $data=$data->merge([
                'os' => $userAgent['os'] ?? null,
                'browser' => $userAgent['browser'] ?? null,
            ]);
        }
        $data=$data->merge([
            'order_status' => 1,
            'hotel_id'=>$hotel->id,
            'type'=>$request->get('type'),
            'order_id'=>mt_rand(1000,9999)
        ]);
        //ddd('data',$data->all(),$userAgent);
        $reservation = HotelReservation::Create(
            $data->all()
        );
        if($reservation->order_status === 1){
            return view('hotel.reservation.order-form',[
                'hotel'=>$hotel,
                'reservation'=>$reservation
            ]);
        }
        return redirect()->route('hotel.view',['hotel'=>$hotel->id]);

//        return redirect()->route('hotel.reservation.option',[
//            'hotel'=>$hotel->id,
//            'reservation'=>$reservation
//        ]);
    }

    public function reservationOption(Hotel $hotel,HotelReservation $reservation){
        if($reservation->order_status === '1'){
            return view('hotel.reservation.option',[
                'hotel'=>$hotel,
                'reservation'=>$reservation
            ]);
        }
        return redirect()->route('hotel.view',['hotel'=>$hotel->id]);
    }

    public function hotelsCollect($tab=null,$depth=null,$curator_page = ''): Response
    {
        $curator = null;
        if ($curator_page !== '' && $curator_page !== null) {
            $curator = Curator::whereVisible('1')->whereUserPage($curator_page)->first();
        }

        return response()->view('hotel.collect.index', [
            'tabSearch'=>$tab,
            'depthSearch'=>$depth,
            'curator' => $curator
        ]);
    }

    /* 투어 오늘 회원가입 인원인 경우 알림톡 전달 */
    protected function newMembershipRegistration(HotelReservation $reservation): ?bool
    {
        if($reservation){
            $formatter = new Formatter();
            $templateCatalog = '자동 회원가입 안내';
            $template = Template::whereCatalog($templateCatalog)->whereUse('1')->first();
            if($formatter->hpFormat($reservation->order_hp) != '' && $formatter->hpFormat($reservation->order_hp) !== null){
                if(AlertTalkList::whereHp($formatter->hpFormat($reservation->order_hp))->whereCatalog($templateCatalog)->count() === 0){
                    $template_content=$formatter->templateFormat($template->template, [
                        '#{회원명}' => $reservation->order_name,
                        '#{비회원}'=>'비회원으로 ',
                        '#{상태}'=>'투어 신청 시',
                        '#{진행방식}'=>'',
                        '#{사용방법}'=>'신청 내역 확인이 가능한 ',
                        '#{접근경로}'=>'‘마이페이지 -> 개인 정보 -> 비밀번호 변경’을 '
                    ]);
                    $data = [
                        'reserved_time'=>'',
                        're_send'=>'Y',
                        'tel' => $formatter->hpFormat($reservation->order_hp),
                        'template_code' => $template->code,
                        'template' =>$template_content
                    ];
                    $buttons=[
                        "button_type" => 'WL',
                        "button_name" => '호텔에삶 보러가기',
                        "button_url" => 'https://www.livinginhotel.com/login',
                        "button_url2" => 'https://www.livinginhotel.com/login'
                    ];

                    $at = new AlertTalk($data, $buttons);
                    $at->send();

                    AlertTalkList::create([
                        'template_id'=>$template->id ?? null,
                        'reservation_id'=>$reservation->id,
                        'payment_id'=>$payment->id ?? null,
                        'confirmation_id'=>null,
                        'hotel_id'=>$reservation->hotel->id,
                        'room_id'=>$hotel_room->id ?? null,
                        'catalog'=>$template->catalog ?? null,
                        'hp'=>$formatter->hpFormat($reservation->order_hp),
                        'result'=>'success',
                        'template'=>$template_content,
                        'send_at'=>Carbon::now(),
                    ]);
                    return true;
                }
            }
        }
        return false;
    }

}
