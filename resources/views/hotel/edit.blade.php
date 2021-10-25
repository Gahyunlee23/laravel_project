@extends('layouts.app')

@section('content')
    <div class="max-w-1200 mx-auto">
        <div class="w-full">
            <div class="" style="padding: 0;">

                <div class="card-body p-3 mb-32 bg-white bg-opacity-10 rounded-md" >

                    <form name="CreateForm" id="CreateForm" action="{{ route('hotel.update',['hotel'=>$hotel->id]) }}"
                          enctype="multipart/form-data" method="post" autocomplete="off">
                        @csrf
                        @method('put')

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
                            $fileTitles=['메인'];
                        @endphp

                        <div
                            class="form-group w-full mx-auto px-4 py-2 bg-gray-100 rounded-lg border-2 border-solid border-gray-200">

                            <div class="">
                                <div class="py-2 text-4xl text-block font-bold text-tm-c-C1A485">
                                    호텔 수정
                                </div>

                                <div class="">
                                    <div class="mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="hotel_order">
                                            호텔 정렬순 * 1~ 숫자로
                                        </label>
                                        <input type="text" name="hotel_order" id="hotel_order" placeholder="정렬"
                                               value="{{$hotel->order}}"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>
                                    <div class="mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="hotel_title">
                                            호텔 정보 *
                                        </label>
                                        {{--<input type="text" name="id" id="id" placeholder="호텔 ID" value="{{$hotel_max_id}}" disabled class="shadow appearance-none border rounded w-32 py-2 px-3 text-gray-800 leading-tight border rounded outline-none bg-white border-gray-500">--}}

                                        <input type="text" name="hotel_title" id="hotel_title" placeholder="명칭"
                                               value="{{$hotel->options[0]->title}}"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="hotel_title_en" id="hotel_title_en" placeholder="영어 명칭"
                                               value="{{$hotel->options[0]->title_en}}"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>

                                    <div class="mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="hotel_subway_station">
                                            호텔 위치 *
                                        </label>
                                        {{--<input type="text" name="id" id="id" placeholder="호텔 ID" value="{{$hotel_max_id}}" disabled class="shadow appearance-none border rounded w-32 py-2 px-3 text-gray-800 leading-tight border rounded outline-none bg-white border-gray-500">--}}
                                        <input type="text" name="hotel_subway_station" id="hotel_subway_station" placeholder="역과의 거리"
                                               value="{{$hotel->options[0]->subway_station}}"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="hotel_area" id="hotel_area" placeholder="위치명"
                                               value="{{$hotel->options[0]->area}}"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="hotel_lat" id="hotel_lat" placeholder="위도"
                                               value="{{$hotel->options[0]->lat}}"
                                               class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="text" name="hotel_lng" id="hotel_lng" placeholder="경도"
                                               value="{{$hotel->options[0]->lng}}"
                                               class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>

                                    <div class="mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="hotel_price">
                                            투어 가격 *
                                        </label>
                                        <input type="number" name="hotel_price" id="hotel_price" placeholder="원가" min="0" step="100"
                                               value="{{$hotel->options[0]->price}}"
                                               class="shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="number" name="hotel_discount_rate" id="hotel_discount_rate" placeholder="%"
                                               min="0" value="{{$hotel->options[0]->discount_rate}}" max="100"
                                               class="shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="number" name="hotel_sale_price" id="hotel_sale_price" placeholder="판매가" min="0"
                                               value="{{$hotel->options[0]->sale_price}}"
                                               class="shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <input type="number" name="hotel_refund_amount" id="hotel_refund_amount"
                                               placeholder="취소환불금액" value="{{$hotel->options[0]->refund_amount}}"
                                               min="0"
                                               class="shadow appearance-none border rounded w-2/6 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>

                                    <div class="mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="hotel_sale_url">
                                            투어 판매 URL *
                                        </label>
                                        <div class="space-x-1">
                                            <input type="text" name="hotel_sale_url" id="hotel_sale_url" placeholder="투어 판매 url ex] https://~" value="{{$hotel->options[0]->sale_url}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        </div>
                                    </div>

                                    <div class="mt-1 mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="hotel_explanation">
                                            호텔에삶 설명/ 할인조건설명 *
                                        </label>
                                        <textarea
                                            class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="hotel_explanation" id="hotel_explanation" type="text" placeholder="설명..."
                                            rows="3">{{$hotel->options[0]->explanation}}</textarea>

                                        <textarea
                                            class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="hotel_sub_explanation" id="hotel_sub_explanation" type="text"
                                            placeholder="서브 설명..."
                                            rows="3">{{$hotel->options[0]->sub_explanation}}</textarea>
                                    </div>
                                    <div class="mt-1 mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="hotel_facilities">
                                            시설 *
                                            <span class="text-xs">분류  | </span>
                                        </label>
                                        <textarea
                                            class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="hotel_facilities" id="hotel_facilities" type="text" placeholder="시설..."
                                            rows="3">{{$hotel->options[0]->facilities}}</textarea>
                                    </div>
                                    <div class="mt-1 mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="hotel_amenities">
                                            도구 *
                                            <span class="text-xs">분류  | </span>
                                        </label>
                                        <textarea
                                            class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="hotel_amenities" id="hotel_amenities" type="text"
                                            placeholder="도구..."
                                            rows="3">{{$hotel->options[0]->amenities}}</textarea>
                                    </div>

                                    <div class="mt-1 mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="hotel_benefit">
                                            혜택 *
                                        </label>
                                        <div class="space-y-2">
                                            <div class="benefit_container">
                                                @php
                                                    $benefits = Str::of($hotel->options[0]->benefit)->explode('|');
                                                    $benefits_only = Str::of($hotel->options[0]->benefit_only)->explode('|');
                                                    $benefits_type = Str::of($hotel->options[0]->benefit_type)->explode('|');
                                                @endphp
                                                @foreach($benefits as $index=>$benefit)
                                                    @if(!is_null($benefit))
                                                    @if(!empty($benefit))
                                                    <input type="text" name="hotel_benefit[]" id="hotel_benefit" placeholder="혜택" value="{{$benefit}}" class="w-6/12 benefit shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                    <select name="hotel_benefit_only[]" id="hotel_benefit_only" class="shadow border rounded ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                        <option value="0" @if($benefits_only[$index]==='0') selected @endif>Only Off</option>
                                                        <option value="1" @if($benefits_only[$index]==='1') selected @endif>Only On</option>
                                                    </select>
                                                    <select name="hotel_benefit_type[]" id="hotel_benefit_type" class="shadow border rounded ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                        <option value="0" @if(($benefits_type[$index] ?? '' )==='0') selected @endif>공통 혜택</option>
                                                        <option value="1" @if(($benefits_type[$index] ?? '' )==='1') selected @endif>기간별 혜택</option>
                                                    </select>
                                                    @endif
                                                    @endif
                                                @endforeach
                                            </div>

                                            <div>
                                                <div onclick="benefitAppend()" class="text-center text-lg bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg select-none cursor-pointer">
                                                    Benefit ++
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="py-4 border-t-2 border-solid border-gray-500">
                                        <div class="text-2xl font-bold">
                                            호텔 상품
                                        </div>
                                        <div>
                                            <livewire:admin.hotel.rooms :hotel="$hotel"></livewire:admin.hotel.rooms>
                                        </div>
                                    </div>

                                    <div class="py-4 border-t-2 border-solid border-gray-500">
                                        <div class="text-2xl font-bold">
                                            호텔 룸 타입
                                        </div>
                                        <div>
                                            <livewire:admin.hotel.room-types :hotel="$hotel"></livewire:admin.hotel.room-types>
                                        </div>
                                    </div>

                                    <div class="mt-1 mb-3">

                                        <label class="block text-gray-700 text-sm font-bold mb-2">
                                            호텔 이미지 *
                                        </label>
                                        <div class="grid pb-2 space-y-2">
                                        @foreach([0] as $index)
                                            @if (isset($hotel->images[$index]))
                                                <div class="bg-gray-200 p-2">
                                                    <div class="space-y-2">
                                                        <div class="">
                                                            메인
                                                        </div>
                                                        <div class="bg-gray-300">
                                                            제목 {{$hotel->images[$index]->title}}
                                                        </div>
                                                        <div class="bg-gray-400">
                                                            설명 {{$hotel->images[$index]->explanation}}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        @php
                                                            $images = Str::of($hotel->images[$index]->images)->explode('|');
                                                        @endphp
                                                        @foreach($images as $image)
                                                            <img
                                                                src="{{ secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$image) }}"
                                                                data-idx="{{$hotel->images[$index]->type}}"
                                                                class="thumbnail-img-C float-left p-1 w-20 h-24"
                                                                alt="">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        </div>

                                        @foreach([0] as $index)
                                            <div class="">
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
                                                                    class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                            <textarea class="tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                                      name="file{{$index}}_explanation[]" id="file{{$index}}_explanation" type="text" placeholder="{{$fileTitles[$index]}} 설명" rows="3"
                                                            ></textarea>
                                                            @if (isset($hotel->images[$index]->images))
                                                                <textarea class="tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                                          name="file{{$index}}_order[]" id="file{{$index}}_order" type="text" placeholder="{{$fileTitles[$index]}} 순서" rows="5"
                                                                >{{$hotel->images[$index]->images}}</textarea>
                                                            @endif
                                                            @if($index===0)
                                                            <div>
                                                                메인,상세 페이지 이미지 포지션 0%=최상단 100%=최하단
                                                                <input type="text" name="position_y" id="position_y" value="{{$hotel->images[$index]->position_y ?? 0}}" placeholder="100%,100%" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
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
                                                   value="{{$hotel->checkPoints[0]->title1 ?? ''}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <textarea class="tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                      name="check_point_explanation1" id="check_point_explanation1" type="text" placeholder="체크포인트 1 설명" rows="3">{{$hotel->checkPoints[0]->explanation1 ?? ''}}</textarea>
                                            <div class="check_point_thumbnail_img_box w-full overflow-x-hidden overflow-y-scroll"
                                                 data-idx="1">
                                                @if(isset($hotel->checkPoints[0]->image1))
                                                <img
                                                    src="{{ secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$hotel->checkPoints[0]->image1) }}"
                                                    class="thumbnail-img-C float-left p-1 w-20 h-24"
                                                    alt="">
                                                @endif
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
                                                   value="{{$hotel->checkPoints[0]->title2 ?? ''}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <textarea class="tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                      name="check_point_explanation2" id="check_point_explanation2" type="text" placeholder="체크포인트 2 설명" rows="3">{{$hotel->checkPoints[0]->explanation2 ?? ''}}</textarea>
                                            <div class="check_point_thumbnail_img_box w-full overflow-x-hidden overflow-y-scroll"
                                                 data-idx="2">
                                                @if(isset($hotel->checkPoints[0]->image2))
                                                <img
                                                    src="{{ secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$hotel->checkPoints[0]->image2) }}"
                                                    class="thumbnail-img-C float-left p-1 w-20 h-24"
                                                    alt="">
                                                @endif
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
                                                   value="{{$hotel->checkPoints[0]->title3 ?? ''}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <textarea class="tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                      name="check_point_explanation3" id="check_point_explanation3" type="text" placeholder="체크포인트 3 설명" rows="3">{{$hotel->checkPoints[0]->explanation3 ?? ''}}</textarea>
                                            <div class="check_point_thumbnail_img_box w-full overflow-x-hidden overflow-y-scroll"
                                                 data-idx="3">
                                                @if(isset($hotel->checkPoints[0]->image3))
                                                <img
                                                    src="{{ secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$hotel->checkPoints[0]->image3) }}"
                                                    class="thumbnail-img-C float-left p-1 w-20 h-24"
                                                    alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="faq_list mt-1 mb-3 space-y-2">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                            호텔 FAQ
                                        </label>
                                            @foreach ($hotel->faqs as $index=>$faq)
                                                <div class="pb-1">
                                                    FAQ {{$index+1}}..
                                                </div>
                                            <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/3 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                   name="faq_answer_name[]" id="faq_answer_name" placeholder="작성자 {{$index+1}}" value="{{$faq->answer_name}}">
                                            <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/2 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                   name="faq_answer_job[]" id="faq_answer_job" placeholder="직업 {{$index+1}}" value="{{$faq->answer_job}}">
                                            <textarea
                                                class="faq_question autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                name="faq_question[]" id="faq_question" type="text" placeholder="제목 {{$index+1}}..."
                                                rows="3">{{$faq->question}}</textarea>
                                            <textarea
                                                class="faq_answer autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                name="faq_answer[]" id="faq_answer" type="text" placeholder="내용 {{$index+1}}..."
                                                rows="3">{{$faq->answer}}</textarea>
                                            @endforeach
                                    </div>
                                    <div>
                                        <div onclick="faqAppend()" class="cursor-pointer text-center text-lg bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                                            FAQ ++
                                        </div>
                                    </div>

                                    <div class="py-2">
                                        <livewire:admin.review.form :hotel="$hotel"></livewire:admin.review.form>
                                    </div>

{{--                                        <div class="review_list mt-1 mb-3 space-y-2">--}}
{{--                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">--}}
{{--                                                호텔 SNS Review--}}
{{--                                            </label>--}}
{{--                                            @foreach ($hotel->reviews as $index=>$review)--}}
{{--                                                <div class="pb-1">--}}
{{--                                                    Review {{$index+1}}..--}}
{{--                                                </div>--}}
{{--                                                <input type="hidden" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/3 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"--}}
{{--                                                       name="review_hotel_room_type_id[]" id="review_hotel_room_type_id" placeholder="룸옵션ID {{$index+1}}" value="{{$review->hotel_room_type_id ?? 0}}">--}}
{{--                                                <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/3 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"--}}
{{--                                                       name="review_name[]" id="review_name" placeholder="작성자 {{$index+1}}" value="{{$review->name}}">--}}
{{--                                                <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/2 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"--}}
{{--                                                       name="review_option[]" id="review_option" placeholder="옵션 {{$index+1}}" value="{{$review->option}}">--}}
{{--                                                <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/2 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"--}}
{{--                                                       name="review_star[]" id="review_star" placeholder="별점 {{$index+1}}" value="{{$review->star}}">--}}
{{--                                                <input type="date" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/2 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"--}}
{{--                                                       name="review_input_completed_at[]" id="review_input_completed_at" placeholder="작성일 {{$index+1}}" value="{{\Carbon\Carbon::parse($review->input_completed_at)->format('Y-m-d')}}">--}}

{{--                                                <textarea--}}
{{--                                                    class="review_content tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"--}}
{{--                                                    name="review_content[]" id="review_content" type="text" placeholder="내용 {{$index+1}}..."--}}
{{--                                                    rows="3">{{$review->content}}</textarea>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                        <div>--}}
{{--                                            <div onclick="reviewAppend()" class="cursor-pointer text-center text-lg bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">--}}
{{--                                                리뷰 ++--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                </div>
                            </div>
                        </div>
                    </form>

                    <div>
                        <div>개별 추가 설명 사항</div>
                        <div>
                            {{$hotel->option->detail_description ?? '없음'}}
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="w-full inline-flex">
                            <button
                                class="submit-btn mx-auto w-4/12 max-w-2xl text-center text-lg bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
                                onclick="$('form#CreateForm')[0].submit();">
                                수정
                            </button>
                            <button
                                class="submit-btn mx-auto w-4/12 max-w-2xl text-center text-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg"
                                onclick="location.href='{{route('hotel.index')}}';">
                                목록
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

        faqAppend = function (){
            //e.preventDefault();
            var faq_question_length = $('textarea.faq_question').length+1;
            var html = `<div class="pb-1">FAQ `+faq_question_length+`..</div>
                        <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/3 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                            name="faq_answer_name[]" id="faq_answer_name" placeholder="작성자 `+faq_question_length+`">
                        <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/2 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                            name="faq_answer_job[]" id="faq_answer_job" placeholder="직업 `+faq_question_length+`">
                        <textarea
                            class="autoexpand faq_question tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                            name="faq_question[]" id="faq_question" type="text" placeholder="제목 `+faq_question_length+`..."
                            rows="3"></textarea>
                        <textarea
                            class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                            name="faq_answer[]" id="faq_answer" type="text" placeholder="내용 `+faq_question_length+`..."
                            rows="3"></textarea>`;
            $('.faq_list').append(html);
        }

        reviewAppend = function (){
            //e.preventDefault();
            var review_question_length = $('textarea.review_content').length+1;
            var html = `<div class="pb-1">Review `+review_question_length+`..</div>
                        <input type="hidden" name="review_hotel_room_type_id[]" value="0">
                        <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/3 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                               name="review_name[]" id="review_name" placeholder="작성자 `+review_question_length+`">
                        <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/2 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                               name="review_option[]" id="review_option" placeholder="옵션 `+review_question_length+`">
                        <input type="text" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/2 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                               name="review_star[]" id="review_star" placeholder="별점 `+review_question_length+`">
                        <input type="date" class="tracking-wide py-2 px-4 mb-1 leading-relaxed shadow appearance-none block w-1/2 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                               name="review_input_completed_at[]" id="review_input_completed_at" placeholder="작성일 `+review_question_length+`">
                        <textarea
                            class="review_content tracking-wide py-2 px-4 mb-3 leading-relaxed shadow appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                            name="review_content[]" id="review_content" type="text" placeholder="내용 `+review_question_length+`"
                            rows="3"></textarea>`;
            $('.review_list').append(html);
        }

        benefitAppend = function (){
            //e.preventDefault();
            var benefit_length = $('input.benefit').length+1;
            var html = `<input type="text" name="hotel_benefit[]" id="hotel_benefit" placeholder="혜택" class="benefit shadow appearance-none border rounded w-8/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                          <select name="hotel_benefit_only[]" id="hotel_benefit_only" class="shadow border rounded w-3/12 ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="0">Only Off</option>
                            <option value="1">Only On</option>
                        </select>
                        <select name="hotel_benefit_type[]" id="hotel_benefit_type" class="shadow border rounded ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
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
                        <div>
                            룸 타입별 판매 수
                            <input type="number" name="type_sale_possibility_count[]" min="0" id="type_sale_possibility_count" placeholder="룸 타입별 판매 수" class="shadow appearance-none border rounded w-4/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>
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
                        <input type="text" name="room_name[]" id="room_name" class="type_name shadow border rounded w-6/12 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="number" name="room_order[]" min="1" id="room_order" placeholder="상품 출력순서" class="shadow appearance-none border rounded w-2/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="text" name="room_title[]" id="room_title" placeholder="옵션 명" class="shadow appearance-none border rounded w-9/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="text" name="room_nights[]" id="room_nights" placeholder="몇박" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="text" name="room_days[]" id="room_days" placeholder="몇일" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="text" name="room_coupon[]" id="room_coupon" placeholder="쿠폰있을떄 명칭" class="shadow appearance-none border rounded w-5/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="number" name="room_price[]" id="room_price" data-index="`+$('input.room_price').length+`" placeholder="Room 원가" min="0" step="100" class="room_price shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="number" name="room_discount_rate[]" id="room_discount_rate" data-index="`+$('input.room_price').length+`" placeholder="%" min="0" max="100" class="room_discount_rate shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="number" name="room_sale_price[]" id="room_sale_price" data-index="`+$('input.room_price').length+`" placeholder="Room 판매가" min="0" class="room_sale_price shadow appearance-none border rounded w-1/5 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="number" name="room_refund_amount[]" id="room_refund_amount" placeholder="Room 취소환불금액"  min="0" class="shadow appearance-none border rounded w-2/6 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="text" name="room_main_explanation[]" id="room_main_explanation" placeholder="룸 하단 설명 ex] 0박 0일 / 룸 택 1" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="text" name="room_explanation[]" id="room_explanation" placeholder="더블 침대 1개, 싱글 침대 2개" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="text" name="room_sub_explanation[]" id="room_sub_explanation" placeholder="1500mm*2000mm 1ea, 1200mm*1800mm 2ea" class="shadow appearance-none border rounded w-3/12 py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <select name="room_visible[]" id="room_visible" class="shadow border rounded w-4/12 ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="0">상품 리스트 출력 Off</option>
                        <option value="1">상품 리스트 출력 On</option>
                        </select>`;
            $('.room_list').append(html);
            /*<select name="room_upgrade[]" id="room_upgrade" class="shadow border rounded w-5/12 ml-2 py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="0">룸 업그레이드 Off</option>
                                <option value="1">룸 업그레이드 On</option>
                                <option value="2">룸 업그레이드 Sold Out</option>
                            </select>*/
        }

        function handleImgFileSelect(e) {
            var idx = $(this).data('idx');
            var thumnail = $('.thumbnail_img_box[data-idx=' + idx + ']');
            thumnail.removeClass('hidden').html('');
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            if (filesArr.length === 0) {
                thumnail.addClass('hidden').html('');
            }
            filesArr.forEach(function (f, index, array) {
                if (!f.type.match('image.*')) {
                    alert('업로드 사진 확장자는 이미지 확장자만 가능합니다');
                    return;
                }
                thumnail.append('<img src="" data-idx="' + idx + '" class="thumbnail-img-C float-left p-1 w-20 h-24 hidden" alt="">');
                self_file = f;
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('img.thumbnail-img-C[data-idx=' + idx + ']:eq(' + index + ')').attr('src', e.target.result).removeClass('hidden');
                };
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

        function agree_box() {
            $(".information-text").toggle();
            if ($(".information-text").css("display") === "none") {
                $('span.information-agree').text('(약관 확인하기)');
            } else {
                $('span.information-agree').text('(닫기)');
            }
        }

        $(document).on('change','.room_price, .room_sale_price',function(){
            var room_price = $('.room_price[data-index="'+$(this).data('index')+'"]').val();
            var room_sale_price = $('.room_sale_price[data-index="'+$(this).data('index')+'"]').val();
            var room_discount_rate=$('.room_discount_rate[data-index="'+$(this).data('index')+'"]');
            var percent = (100-Math.ceil((room_sale_price/room_price)*100));

            room_discount_rate.val(percent);

            ElMark(room_discount_rate,'bg-green-400',3);
        });

        function ElMark($class,$mark,$repeat){
            var repeat = 0;
            var timing = 500;
            var interval = setInterval(function(){
                $class.addClass($mark);
                setTimeout(function(){
                    $class.removeClass($mark);
                },(timing-200));

                repeat++;
                if(repeat===$repeat){
                    clearInterval(interval);
                    return false;
                }
            },timing);
        }
    </script>
@endsection
