@extends('layouts.app')

@section('top-style')
    <style type="text/css">

    </style>
@endsection

@section('meta-tag')
    @php
        $keywords ='';
        $meta_title=env('APP_NAME');
        $ogDescription='';
        $ogUrl=secure_url('/');
        $ogTitle=env('APP_NAME');
        $ogImage='';
    @endphp
    <meta name="copyright" property="copyright" content="&copy;트래블메이커::개인 맞춤형 여행 플랫폼">
    <meta name="content-language" content="kr">
    <meta name="build" content="">
    <meta name="keywords" property="keywords" content="{{$keywords}}">
    <meta name="title" property="title" content="{{$meta_title}}">
    <meta name="description" property="description" content="{{$ogDescription}}">

    <meta name="og:site_name" property="og:site_name" content="TravelMakers Korea"/>
    <meta name="og:url" property="og:url" content="{{$ogUrl}}">
    <meta name="og:title" property="og:title" content="{{$ogTitle}}">
    <meta name="og:description" property="og:description" content="{{$ogDescription}}">
    <meta name="og:image" property="og:image" content="{{$ogImage}}">

    <meta name="twitter:url" property="twitter:url" content="{{$ogUrl}}">
    <meta name="twitter:title" property="twitter:title" content="{{$ogTitle}}">
    <meta name="twitter:description" property="twitter:description" content="{{$ogDescription}}">
    <meta name="twitter:image" property="twitter:image" content="{{$ogImage}}">
@endsection

@section('content')
    @php
        function get_S3_resource($url){
            $response='error';
            if (function_exists('curl_init')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
                $response = curl_exec($ch);
                curl_close($ch);
            }else if ($fp = fopen($url, 'r')) {
                while ($line = fgets($fp, 1024)) {
                    $response .= $line;
                }
            }
            return $response;
        }

        $apple_mAgent = array("iPhone","iphone", "iPod", "ipad");
        $android_mAgent = array("Android", "Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony");
        $android_chkMobile = false;
        $apple_chkMobile = false;
        $mobile_chk = 'false';
        for ($i = 0,$iMax = sizeof($android_mAgent); $i < $iMax; $i++) {
            if (stripos($_SERVER['HTTP_USER_AGENT'], $android_mAgent[$i])) {
                $android_chkMobile = true;
                $mobile_chk = 'true';
                break;
            }
        }

        for ($i = 0,$iMax = sizeof($apple_mAgent); $i < $iMax; $i++) {
            if (stripos($_SERVER['HTTP_USER_AGENT'], $apple_mAgent[$i])) {
                $apple_chkMobile = true;
                $mobile_chk = 'true';
                break;
            }
        }

    @endphp
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="max-w-6xl">

                <div class="card-body p-3 mb-32 bg-white rounded-md">

                    <form name="CreateForm" id="CreateForm" action="{{ route('hotel.store') }}"
                        enctype="multipart/form-data" method="post" autocomplete="off">
                        @csrf
                        @method('post')

                        @if ($errors->any())
                            <div class="alert bg-red-500 p-2 rounded-lg">
                                <ul class="space-y-1 text-white">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @php
                            $fileTitles=['메인','리뷰','서브1','서브2'];
                        @endphp
                        <input type="hidden" name="mobile_chk" value="{{$mobile_chk}}">

                        <div class="form-group w-full mx-auto max-w-2xl px-4 py-2 bg-gray-100 rounded-lg border-2 border-solid border-gray-200">

                            <div class="">
                                <div class="py-2 text-4xl text-block font-bold text-tm-c-C1A485">
                                    호텔 추가
                                </div>

                                <div class="">

                                    <div class="mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            호텔 정렬순 * 1~ 숫자로
                                        </label>
                                        <input type="text" name="order" id="order" placeholder="정렬"
                                               value="{{old('order')}}"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>

                                    <div class="mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            호텔 정보 *
                                        </label>
                                            {{--<input type="text" name="id" id="id" placeholder="호텔 ID" value="{{$hotel_max_id}}" disabled class="shadow appearance-none border rounded w-32 py-2 px-3 text-gray-800 leading-tight border rounded outline-none bg-white border-gray-500">--}}
                                            <input type="text" name="title" id="title" placeholder="명칭" value="{{old('title')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <input type="text" name="title_en" id="title_en" placeholder="영어 명칭" value="{{old('title_en')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>

                                    <div class="mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            호텔 위치 *
                                        </label>
                                        {{--<input type="text" name="id" id="id" placeholder="호텔 ID" value="{{$hotel_max_id}}" disabled class="shadow appearance-none border rounded w-32 py-2 px-3 text-gray-800 leading-tight border rounded outline-none bg-white border-gray-500">--}}
                                        <input type="text" name="subway_station" id="subway_station" placeholder="역과의 거리"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="area" id="area" placeholder="위치명"
                                               value="{{old('area')}}"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="lat" id="lat" placeholder="위도"
                                               value="{{old('lat')}}"
                                               class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="lng" id="lng" placeholder="경도"
                                               value="{{old('lng')}}"
                                               class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>

                                    <div class="mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            투어 가격 *
                                        </label>
                                        <div class="space-x-1">
                                            <input type="number" name="price" id="price" placeholder="원가" min="0" step="100" value="{{old('price')}}" class="shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <input type="number" name="discount_rate" id="discount_rate" placeholder="%" min="0" value="{{old('discount_rate')}}" max="100" class="shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <input type="number" name="sale_price" id="sale_price" placeholder="판매가" min="0" value="{{old('sale_price')}}" class="shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <input type="number" name="refund_amount" id="refund_amount" placeholder="취소환불금액" value="{{old('refund_amount')}}" min="0" class="shadow appearance-none border rounded w-2/6 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            투어 판매 URL *
                                        </label>
                                        <div class="space-x-1">
                                            <input type="text" name="sale_url" id="sale_url" placeholder="판매 url ex] https://~" value="{{old('sale_url')}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            호텔에삶 설명/ 할인조건설명 *
                                        </label>
                                        <textarea class="autoexpand tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                  name="explanation" id="explanation" type="text" placeholder="설명..." rows="3">{{old('explanation')}}</textarea>

                                        <textarea class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                  name="sub_explanation" id="sub_explanation" type="text" placeholder="서브 설명..." rows="3">{{old('sub_explanation')}}</textarea>
                                    </div>
                                    <div class="mt-1 mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            시설 설명 *
                                            <span class="text-xs">분류  | </span>
                                        </label>
                                        <textarea
                                            class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="facilities" id="facilities" type="text" placeholder="시설..."
                                            rows="3">{{old('facilities')}}</textarea>
                                    </div>
                                    <div class="mt-1 mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            도구 설명 *
                                            <span class="text-xs">분류  | </span>
                                        </label>
                                        <textarea
                                            class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="amenities" id="amenities" type="text"
                                            placeholder="도구..."
                                            rows="3">{{old('amenities')}}</textarea>
                                    </div>
                                    <div class="mt-1 mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            혜택 *
                                        </label>
                                        <div class="space-y-2">
                                            <div class="benefit_container">
                                                <input type="text" name="benefit[]" id="benefit" placeholder="혜택" value="{{old('benefit.0')}}" class="benefit shadow appearance-none border rounded w-6/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                <select name="benefit_only[]" id="benefit_only" class="shadow border rounded ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                    <option value="0">Only Off</option>
                                                    <option value="1">Only On</option>
                                                </select>

                                                <select name="benefit_type[]" id="benefit_type" class="shadow border rounded ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                    <option value="0">공통 혜택</option>
                                                    <option value="1">기간별 혜택</option>
                                                </select>
                                            </div>

                                            <div>
                                                <div onclick="benefitAppend()" class="text-center text-lg bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg select-none cursor-pointer">
                                                    Benefit ++
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="room_type_list mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            Room Type
                                        </label>
                                        <div class="pb-1 pt-1 border-t">
                                            Type 1..
                                        </div>
                                        <input type="text" name="type_name[]" id="type_name" value="{{old('type_name.0')}}"
                                               class="type_name shadow border rounded w-6/12 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="number" name="type_order[]" min="1" id="type_order" placeholder="룸 타입 출력순서" value="{{old('type_order.0')}}" class="shadow appearance-none border rounded w-4/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="type_main_explanation[]" id="type_main_explanation" placeholder="퀸 침대 1개, 싱글 침대 1개" value="{{old('type_main_explanation.0')}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="type_sub_explanation[]" id="type_sub_explanation" placeholder="룸 타입 하단 추가 설명" value="{{old('type_sub_explanation.0')}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input
                                            class="file tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                            type="file" name="type_file_image[]" id="type_file">
                                        <select name="type_visible[]" id="type_visible" class="shadow border rounded w-5/12 ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <option value="0" @if(old('type_visible.0')==='0') selected @endif>룸 타입 리스트 출력 Off</option>
                                            <option value="1" @if(old('type_visible.0')==='1') selected @endif>룸 타입 리스트 출력 On</option>
                                        </select>
                                        <select name="type_upgrade[]" id="type_upgrade" class="shadow border rounded w-5/12 ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <option value="N" @if(old('type_upgrade.0')!=='Y') selected @endif>업그레이드용 Off</option>
                                            <option value="Y" @if(old('type_upgrade.0')==='Y') selected @endif>업그레이드용 On</option>
                                        </select>
                                    </div>
                                    <div class="pb-4">
                                        <div onclick="roomTypeAppend()" class="text-center text-lg bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg select-none cursor-pointer">
                                            Room Type++
                                        </div>
                                    </div>

                                    <div class="room_list mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            호텔 Room
                                        </label>
                                        <div class="pb-1">
                                            Room 1..
                                        </div>
                                        <input type="text" name="room_name[]" id="room_name" alue="{{old('room_name.0')}}"
                                               class="type_name shadow border rounded w-6/12 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="number" name="room_order[]" min="1" id="room_order" placeholder="룸 출력순서" value="{{old('room_order.0')}}" class="shadow appearance-none border rounded w-2/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="room_title[]" id="room_title" placeholder="룸 명칭" value="{{old('room_title.0')}}" class="shadow appearance-none border rounded w-9/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="room_nights[]" id="room_nights" placeholder="몇박" value="{{old('room_nights.0')}}" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="room_days[]" id="room_days" placeholder="몇일" value="{{old('room_days.0')}}" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="room_coupon[]" id="room_coupon" placeholder="쿠폰있을시 명칭" value="{{old('room_coupon.0')}}" class="shadow appearance-none border rounded w-5/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="number" name="room_price[]" id="room_price" placeholder="Room 원가" min="0" step="100" value="{{old('room_price.0')}}" class="room_price shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="number" name="room_discount_rate[]" id="room_discount_rate" placeholder="%" min="0" value="{{old('room_discount_rate.0')}}" max="100" class="shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="number" name="room_sale_price[]" id="room_sale_price" placeholder="Room 판매가" min="0" value="{{old('room_sale_price.0')}}" class="shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="number" name="room_refund_amount[]" id="room_refund_amount" placeholder="Room 취소환불금액" value="{{old('room_refund_amount.0')}}" min="0" class="shadow appearance-none border rounded w-2/6 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="room_main_explanation[]" id="room_main_explanation" placeholder="룸 하단 설명 ex] 0박 0일 / 룸 택 1" value="{{old('room_main_explanation.0')}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="room_explanation[]" id="room_explanation" placeholder="더블 침대 1개, 싱글 침대 2개" value="{{old('room_explanation.0')}}" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="room_sub_explanation[]" id="room_sub_explanation" placeholder="1500mm*2000mm 1ea, 1200mm*1800mm 2ea" value="{{old('room_sub_explanation.0')}}" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <select name="room_visible[]" id="room_visible" class="shadow border rounded w-4/12 ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <option value="0" @if(old('room_visible.0')==='0') selected @endif>상품 리스트 출력 Off</option>
                                            <option value="1" @if(old('room_visible.0')==='1') selected @endif>상품 리스트 출력 On</option>
                                        </select>
                                    </div>
                                    <div>
                                        <div onclick="roomAppend()" class="text-center text-lg bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg select-none cursor-pointer">
                                            Room ++
                                        </div>
                                    </div>

                                    <div class="mt-1 mb-3">

                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            호텔 이미지 *
                                        </label>
                                        @foreach([0,1,2,3] as $index)
                                            <div class="space-y-1">
                                                <div class="text-xs text-black">
                                                    {{$fileTitles[$index]}}
                                                </div>
                                                <div class="imagesUploadFormImgUploadBackground w-auto position-relative">
                                                    <div class="z-50 position-relative p-2 px-3">
                                                        <div class="space-y-2">
                                                            <input
                                                                class="file tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                                data-idx="{{$index}}" type="file" name="file{{$index}}_images[]" multiple id="file" required>
                                                            <input type="text" name="file{{$index}}_title[]" id="file{{$index}}_title" placeholder="{{$fileTitles[$index]}} 제목"
                                                                   value="" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                            <textarea class="tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                                      name="file{{$index}}_explanation[]" id="file{{$index}}_explanation" type="text" placeholder="{{$fileTitles[$index]}} 설명" rows="3"></textarea>
                                                            @if($index===0)
                                                                <div>
                                                                    메인,상세 페이지 이미지 포지션 0%=최상단 100%=최하단
                                                                    <input type="text" name="position_y" id="position_y" value="{{old('position_y.'.$index)}}" placeholder="100%,100%" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                                </div>
                                                            @endif
                                                            <div class="thumbnail_img_box hidden w-full overflow-x-hidden overflow-y-scroll"
                                                                 data-idx="{{$index}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="space-y-2 divide-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2">
                                            호텔 체크포인트
                                        </label>
                                        <div class="space-y-2 pt-2">
                                            <div class="text-xs text-black">
                                                체크포인트 1
                                            </div>
                                            <input
                                                class="file2 tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                data-idx="1" type="file" name="check_point_image1" id="file">
                                            <input type="text" name="check_point_title1" id="check_point_title1" placeholder="체크포인트 1"
                                                   value="{{old('check_point_title1')}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <textarea class="tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                      name="check_point_explanation1" id="check_point_explanation1" type="text" placeholder="체크포인트 1 설명" rows="3">{{old('check_point_explanation1')}}</textarea>
                                            <div class="check_point_thumbnail_img_box hidden w-full overflow-x-hidden overflow-y-scroll"
                                                 data-idx="1">
                                            </div>
                                        </div>

                                        <div class="space-y-2 pt-2">
                                            <div class="text-xs text-black">
                                                체크포인트 2
                                            </div>
                                            <input
                                                class="file2 tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                data-idx="2" type="file" name="check_point_image2" id="file">
                                            <input type="text" name="check_point_title2" id="check_point_title2" placeholder="체크포인트 2"
                                                   value="{{old('check_point_title2')}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <textarea class="tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                      name="check_point_explanation2" id="check_point_explanation2" type="text" placeholder="체크포인트 2 설명" rows="3">{{old('check_point_explanation2')}}</textarea>
                                            <div class="check_point_thumbnail_img_box hidden w-full overflow-x-hidden overflow-y-scroll"
                                                 data-idx="2">
                                            </div>
                                        </div>

                                        <div class="space-y-2 pt-2">
                                            <div class="text-xs text-black">
                                                체크포인트 3
                                            </div>
                                            <input
                                                class="file2 tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                data-idx="3" type="file" name="check_point_image3" id="file">
                                            <input type="text" name="check_point_title3" id="check_point_title3" placeholder="체크포인트 3"
                                                   value="{{old('check_point_title3')}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <textarea class="tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                      name="check_point_explanation3" id="check_point_explanation3" type="text" placeholder="체크포인트 3 설명" rows="3">{{old('check_point_explanation3')}}</textarea>
                                            <div class="check_point_thumbnail_img_box hidden w-full overflow-x-hidden overflow-y-scroll"
                                                 data-idx="3">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="faq_list mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            호텔 FAQ
                                        </label>
                                        <div class="pb-1">
                                            FAQ 1..
                                        </div>
                                        <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/3 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                               name="faq_answer_name[]" id="faq_answer_name" placeholder="작성자 1..." value="{{old('faq_answer_name.0')}}">
                                        <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/2 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                               name="faq_answer_job[]" id="faq_answer_job" placeholder="직업 1..." value="{{old('faq_answer_job.0')}}">
                                        <textarea class="faq_question tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                  name="faq_question[]" id="faq_question" type="text" placeholder="제목 1..." rows="3">{{old('faq_question.0')}}</textarea>

                                        <textarea class="faq_answer tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                  name="faq_answer[]" id="faq_answer" type="text" placeholder="내용 ..." rows="3">{{old('faq_answer.0')}}</textarea>

                                    </div>
                                    <div>
                                        <div onclick="faqAppend()" class="text-center text-lg bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                                            FAQ ++
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </form>

                    <div class="mt-6">
                        <div class="w-full inline-flex">
                            <button
                                class="submit-btn mx-auto w-4/12 max-w-2xl text-center text-lg bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
                                onclick="$('form#CreateForm')[0].submit();">
                                저장
                            </button>
                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>

@endsection
@section('bottom-script')
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script type="text/javascript">
        const Ajax_url = '{{ route('hotel.store') }}';

        const fileSizeLimit = 20;
        const fileChkAlert = '사진을 업로드 후 저장해주세요.';

        let self_file;

        $(document).ready(function () {
            $('.file').on('change', handleImgFileSelect);
            $('.file2').on('change', handleImgFileSelectCheckPoints);
        });

        function handleImgFileSelect(e) {
            var idx=$(this).data('idx');
            var thumnail = $('.thumbnail_img_box[data-idx='+idx+']');
            thumnail.removeClass('hidden').html('');
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            if(filesArr.length===0){
                thumnail.addClass('hidden').html('');
            }
            filesArr.forEach(function (f,index,array) {
                if(!f.type.match('image.*')){
                    alert('업로드 사진 확장자는 이미지 확장자만 가능합니다');
                    return;
                }
                thumnail.append('<img src="" data-idx="'+idx+'" class="thumbnail-img-C float-left p-1 w-20 h-24 hidden" alt="">');
                self_file = f;
                var reader =new FileReader();
                reader.onload = function (e) {
                    $('img.thumbnail-img-C[data-idx='+idx+']:eq('+index+')').attr('src', e.target.result).removeClass('hidden');
                }
                reader.readAsDataURL(f);
            });
        }

        function handleImgFileSelectCheckPoints(e) {
            var idx=$(this).data('idx');
            var thumnail = $('.check_point_thumbnail_img_box[data-idx='+idx+']');
            thumnail.removeClass('hidden').html('');
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            if(filesArr.length===0){
                thumnail.addClass('hidden').html('');
            }
            filesArr.forEach(function (f,index,array) {
                if(!f.type.match('image.*')){
                    alert('업로드 사진 확장자는 이미지 확장자만 가능합니다');
                    return;
                }
                thumnail.append('<img src="" data-idx="'+idx+'" class="check_point_thumbnail-img-C float-left p-1 w-20 h-24 hidden" alt="">');
                self_file = f;
                var reader =new FileReader();
                reader.onload = function (e) {
                    $('img.check_point_thumbnail-img-C[data-idx='+idx+']:eq('+index+')').attr('src', e.target.result).removeClass('hidden');
                }
                reader.readAsDataURL(f);
            });
        }

        faqAppend = function (){
            //e.preventDefault();
            var faq_question_length = $('textarea.faq_question').length+1;

            var html = `<div class="pb-1">FAQ `+faq_question_length+`..</div>
                    <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/3 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                        name="faq_answer_name[]" id="faq_answer_name" placeholder="작성자 `+faq_question_length+`...">
                    <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/2 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                        name="faq_answer_job[]" id="faq_answer_job" placeholder="직업 `+faq_question_length+`...">
                        <textarea
                            class="faq_question autoexpand tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                            name="faq_question[]" id="faq_question" type="text" placeholder="제목"
                            rows="3"></textarea>
                        <textarea
                            class="faq_answer autoexpand tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                            name="faq_answer[]" id="faq_answer" type="text" placeholder="내용"
                            rows="3"></textarea>`;
            $('.faq_list').append(html);
        }

        benefitAppend = function (){
            //e.preventDefault();
            var benefit_length = $('input.benefit').length+1;
            var html = `<input type="text" name="benefit[]" id="benefit" placeholder="혜택" class="benefit shadow appearance-none border rounded w-6/12  py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                          <select name="benefit_only[]" id="benefit_only" class="shadow border rounded ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="0">Only Off</option>
                            <option value="1">Only On</option>
                        </select>
                        <select name="benefit_type[]" id="benefit_type" class="shadow border rounded ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="0">공통 혜택</option>
                            <option value="1">기간별 혜택</option>
                        </select>`;
            $('.benefit_container').append(html);
        }

        roomTypeAppend = function (){
            var room_type_length = $('select.type_name').length+1;

            var html = `<div class="pb-1 pt-1 border-t">
                                                Type `+room_type_length+`..
                                            </div>
                                            <input type="text" name="type_name[]" id="type_name" class="type_name shadow border rounded w-6/12 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <input type="number" name="type_order[]" min="1" id="type_order" placeholder="룸 타입 출력순서" class="shadow appearance-none border rounded w-4/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <input type="text" name="type_main_explanation[]" id="type_main_explanation" placeholder="퀸 침대 1개, 싱글 침대 1개" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <input type="text" name="type_sub_explanation[]" id="type_sub_explanation" placeholder="룸 타입 하단 추가 설명" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <input
                                                class="file tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                type="file" name="type_file_image[]" id="type_file">
                                            <select name="type_visible[]" id="type_visible" class="shadow border rounded w-5/12 ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                <option value="0">룸 타입 리스트 출력 Off</option>
                                                <option value="1">룸 타입 리스트 출력 On</option>
                                            </select>
                                            <select name="type_upgrade[]" id="type_upgrade" class="shadow border rounded w-5/12 ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                <option value="N">업그레이드용 Off</option>
                                                <option value="Y">업그레이드용 On</option>
                                            </select>`;
            $('.room_type_list').append(html);
        };
        roomAppend = function (){
            var room_question_length = $('input.room_price').length+1;

            var html = `<div class="pb-1">ROOM `+room_question_length+`..</div>
                        <div class="space-x-1 space-y-1">
                            <input type="text" name="room_name[]" id="room_name" class="type_name shadow border rounded w-6/12 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="number" name="room_order[]" min="1" id="room_order" placeholder="상품 출력순서" class="shadow appearance-none border rounded w-2/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="text" name="room_title[]" id="room_title" placeholder="룸 명칭" class="shadow appearance-none border rounded w-9/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="text" name="room_nights[]" id="room_nights" placeholder="몇박" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="text" name="room_days[]" id="room_days" placeholder="몇박" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="text" name="room_coupon[]" id="room_coupon" placeholder="쿠폰있을떄 명칭" class="shadow appearance-none border rounded w-5/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="number" name="room_price[]" id="room_price" placeholder="Room 원가" min="0" step="100" class="room_price shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="number" name="room_discount_rate[]" id="room_discount_rate" placeholder="%" min="0" max="100" class="shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="number" name="room_sale_price[]" id="room_sale_price" placeholder="Room 판매가" min="0" class="shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="number" name="room_refund_amount[]" id="room_refund_amount" placeholder="Room 취소환불금액"  min="0" class="shadow appearance-none border rounded w-2/6 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="text" name="room_main_explanation[]" id="room_main_explanation" placeholder="룸 하단 설명 ex] 0박 0일 / 룸 택 1" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="text" name="room_explanation[]" id="room_explanation" placeholder="더블 침대 1개, 싱글 침대 2개" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <input type="text" name="room_sub_explanation[]" id="room_sub_explanation" placeholder="1500mm*2000mm 1ea, 1200mm*1800mm 2ea" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <select name="room_visible[]" id="room_visible" class="shadow border rounded w-4/12 ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="0">상품 리스트 출력 Off</option>
                                <option value="1">상품 리스트 출력 On</option>
                            </select>
                        </div>`;
            $('.room_list').append(html);
            /*<select name="room_upgrade[]" id="room_upgrade" class="shadow border rounded w-5/12 ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="0">룸 업그레이드 Off</option>
                                <option value="1">룸 업그레이드 On</option>
                                <option value="2">룸 업그레이드 Sold Out</option>
                            </select>*/
        }

        function isMobile(phoneNum) {
            var regExp = /(01[016789])([0-9]{3,4})([0-9]{4})$/;
            var myArray;
            if (regExp.test(phoneNum)) {
                myArray = regExp.exec(phoneNum); // console.log(myArray[1]); // console.log(myArray[2]); // console.log(myArray[3]);
                return true;
            } else {
                return false;
            }
        }

        const fileSizeCheckSave = function () {
            // 파일 사이즈 체크
            //var maxSize = fileSizeLimit * 1024 * 1024;
            /* var file = document.getElementsByName("file").files;*/
            /*$('.file').each(function(index, item){
                console.log('item',$('.file[data-idx='+$(item).data('idx')+']')[0].files);
                var file = $('.file[data-idx='+$(item).data('idx')+']')[0].files;
                for (var i=0; file.length > i; i++){
                    if (file[i]) {
                        if (file[i].size > maxSize) {
                            alert("첨부파일 사이즈는 " + fileSizeLimit + "MB 이내로 등록 가능합니다.");
                            return false;
                        }
                    }else{
                        alert(fileChkAlert);
                        return false;
                    }
                }
            });*/
            $('form#CreateForm')[0].submit();
            /*var formData = new FormData($('form#CreateForm')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: Ajax_url,
                data: formData,
                dataType: 'json',
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var msg = '';
                    console.log(data)
                    switch (data.result) {
                        case 'success' :
                            msg = '이미지 업로드를 성공했습니다.';
                            break;

                        default :
                            msg = '업로드가 실패했습니다.\n재시도 해주세요.';
                            break;
                    }

                    $('input').attr('disabled', 'disabled').addClass('bg-gray-300');
                    $('span.help-block').removeClass('d-none');
                    $('span.help-block').addClass('d-none');

                    setTimeout(function () {

                        $('span.upload-btn').html('업로드 완료!');
                        $('button.submit-btn').html('저장 완료!');

                        $('button.submit-btn').attr('onclick', '');
                        $('div.imagesUploadFormImgUploadBackground').attr('onclick', '');

                    }, 1000);

                },
                error: function (data) {
                    $('span.help-block').removeClass('d-none');
                    $('span.help-block').addClass('d-none');
                    for(key in data.responseJSON.errors){
                        console.log('error:',key);
                        $('.'+key+'-help').removeClass('d-none');
                    }
                    $('span.upload-btn').html('업로드');
                    $('button.submit-btn').html('저장 실패!');
                    alert("저장 실패했습니다.\n재시도 해주세요.");
                }
            });*/
        };

        function agree_box(){
            $(".information-text").toggle();
            if ($(".information-text").css("display") === "none") {
                $('span.information-agree').text('(약관 확인하기)');
            }else{
                $('span.information-agree').text('(닫기)');
            }
        }
    </script>
@endsection
