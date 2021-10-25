<div class="py-6 px-2 max-w-1200 mx-auto">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        {{-- 복사 될 호텔 --}}
        <div class="bg-gray-300 rounded-md p-4">
            <div>
                <div class="font-bold pb-1 text-black">
                    가져올 호텔
                </div>
                <select wire:model="target_hotel" wire:change="hotelChangeCheck('target')" class="w-full form-select">
                    @foreach (\App\Hotel::where('curator', '=', 'N')->get() as $hotel)
                        <option value="{{$hotel->id}}">{{$hotel->option->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="pt-1">
                <div class="font-bold pb-1 text-black">
                    옴겨질 호텔(미 선택시 생성)
                </div>
                <select wire:model="import_hotel" class="w-full form-select">
                    <option value="">그냥 복사의 경우 미선택</option>
                    @foreach (\App\Hotel::get() as $hotel)
                        <option value="{{$hotel->id}}">{{$hotel->id.':'.$hotel->option->title ?? ''}}:큐레이터={{$hotel->curator}}</option>
                    @endforeach
                </select>
            </div>
            {{-- 복사 될 호텔 정보 노출--}}
            @if($targetHotel !== null)
                <div class="bg-gray-300 rounded-md p-4 divide-y divide-gray-500">

                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 ID</div>
                        <div class="flex items-center">
                            {{$targetHotel->id}}
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 노션</div>
                        <div class="flex items-center break-all text-right">
                            <a class="text-blue-400 hover:text-blue-500" href="{{$targetHotel->info_notion}}">
                                {{$targetHotel->info_notion}}
                            </a>
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">입주 관리자</div>
                        <div class="flex flex-wrap items-center text-right">
                            @foreach ($targetHotel->living_emails as $item)
                                <div class="w-full">{{$item}}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">투어 관리자</div>
                        <div class="flex flex-wrap items-center text-right">
                            @foreach ($targetHotel->tour_emails as $item)
                                <div class="w-full">{{$item}}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">다른 호텔 리스트</div>
                        <div class="flex flex-wrap items-center text-right">
                            @foreach (\Illuminate\Support\Str::of($targetHotel->other_hotel)->explode(',') as $item)
                                <div class="w-full">{{\App\Hotel::find($item)->option->title}}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="py-2 flex items-center">
                        <div class="flex-1 text-gray-700 font-bold text-xs text-center">
                            옵션
                        </div>
                    </div>

                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 명칭</div>
                        <div class="flex items-center">
                            {{$targetHotel->option->title}}
                        </div>
                    </div>

                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 영명칭</div>
                        <div class="flex items-center">
                            {{$targetHotel->option->title_en}}
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 지역</div>
                        <div class="flex items-center">
                            {{$targetHotel->option->area}}
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 어메니티</div>
                        <div class="flex flex-wrap items-center justify-end text-right">
                            <div class="w-full">
                                {{$targetHotel->option->AmenitiesExplode->count() ?? 0}}개
                            </div>
                            @foreach ($targetHotel->option->AmenitiesExplode as $item)
                                <div class="py-1 text-xs">{{$item}}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 시설</div>
                        <div class="flex flex-wrap items-center justify-end text-right">
                            <div class="w-full">
                                {{$targetHotel->option->FacilitiesExplode->count() ?? 0}}개
                            </div>
                            @foreach ($targetHotel->option->FacilitiesExplode as $item)
                                <div class="py-1 text-xs">{{$item}}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 혜택</div>
                        <div class="flex flex-wrap items-center justify-end text-right">
                            <div class="w-full">
                                {{$targetHotel->option->BenefitsExplode->count() ?? 0}}개
                            </div>
                            @foreach ($targetHotel->option->BenefitsExplode as $item)
                                <div class="py-1 text-xs">{{$item}}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="py-2 flex items-center">
                        <div class="flex-1 text-gray-700 font-bold text-xs text-center">
                            상품(룸)
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 룸 정보</div>
                        <div class="flex flex-wrap items-center text-right">
                            @foreach ($targetHotel->rooms->where('disable', '=' , 'N') as $room)
                                <div class="w-full py-1 text-xs">{{$room->id}} - {{$room->title}}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="py-2 flex items-center">
                        <div class="flex-1 text-gray-700 font-bold text-xs text-center">
                            룸타입
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 룸타입 정보</div>
                        <div class="flex flex-wrap items-center text-right">
                            @foreach ($targetHotel->room_types->where('visible', '=' , '1') as $roomType)
                                <div class="w-full py-1 text-xs">{{$roomType->id}} - {{$roomType->name}}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="py-2 flex items-center">
                        <div class="flex-1 text-gray-700 font-bold text-xs text-center">
                            FAQ
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 FAQ</div>
                        <div class="flex flex-wrap items-center text-right space-y-1 divide-y divide-tm-c-30373F">
                            @foreach ($targetHotel->faqs as $item)
                                <div class="flex flex-wrap w-full py-1 text-xs px-2 space-y-1">
                                    <diiv class="w-full text-lg">{{$item->question}}</diiv>
                                    <diiv class="w-full">{{$item->answer}}</diiv>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="py-2 flex items-center">
                        <div class="flex-1 text-gray-700 font-bold text-xs text-center">
                            이미지
                        </div>
                    </div>
                    <div class="py-2 flex items-center space-x-2">
                        <div class="flex-1 text-black font-bold whitespace-pre">호텔 이미지</div>
                        <div class="flex flex-wrap items-center text-right">
                            @foreach ($targetHotel->images->where('disable', '=', 'N')->where('type', '=', '0') as $item)
                                <div class="py-1 text-xs grid grid-cols-5 md:grid-cols-8 gap-2">
                                    @foreach (Str::of($item->images)->explode('|') as $item)
                                        <img src="https://d2pyzcqibfhr70.cloudfront.net/{{$item}}" class="w-full h-full" alt="">
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endif
        </div>

        {{-- 복사 할 정보 선택--}}
        <div class="bg-gray-300 rounded-md p-4 divide-y divide-gray-500">

            <div class="py-2 flex items-center space-x-2">
                <div class="flex-1 text-black font-bold">
                    <label for="all_check">
                        전체 체크
                    </label>
                </div>
                <div class="flex items-center">
                    @if(isset($copyCheckbox['all_check']) && $copyCheckbox['all_check']=== true)
                        <div class="pr-1 text-blue-600 text-sm font-bold">전체 체크</div>
                    @endif
                    <input id="all_check" type="checkbox" wire:model="copyCheckbox.all_check" wire:change="copyCheckboxAllCheck" class="form-checkbox">
                </div>
            </div>

            <div class="py-2 flex items-center space-x-2">
                <div class="flex-1 text-black font-bold">
                    <label for="curator">
                        큐레이터 용 호텔 저장
                    </label>
                </div>
                <div class="flex items-center">
                    @if(isset($copyCheckbox['curator']) && $copyCheckbox['curator']=== true)
                        <div class="pr-1 text-blue-600 text-sm font-bold">OK</div>
                    @endif
                    <input id="curator" type="checkbox" wire:model="copyCheckbox.curator" class="form-checkbox">
                </div>
            </div>

            <div class="py-2 flex items-center space-x-2">
                <div class="flex-1 text-black font-bold">
                    <label for="images">
                        이미지
                    </label>
                </div>
                <div class="flex items-center">
                    @if(isset($copyCheckbox['images']) && $copyCheckbox['images']=== true)
                        <div class="pr-1 text-blue-600 text-sm font-bold">OK</div>
                    @endif
                    <input id="images" type="checkbox" wire:model="copyCheckbox.images" class="form-checkbox">
                </div>
            </div>
            <div class="py-2 flex items-center space-x-2">
                <div class="flex-1 text-black font-bold">
                    <label for="rooms">
                        상품
                    </label>
                </div>
                <div class="flex items-center">
                    @if(isset($copyCheckbox['rooms']) && $copyCheckbox['rooms']=== true)
                        <div class="pr-1 text-blue-600 text-sm font-bold">OK</div>
                        <div class="w-full py-1 px-2 text-xs">
                            @foreach ($targetHotel->rooms->where('disable', '=' , 'N') as $room)
                                <div>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="rooms.{{$loop->index}}" value="{{$room->id}}">{{$room->title}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <input id="rooms" type="checkbox" wire:model="copyCheckbox.rooms" class="form-checkbox">
                </div>
            </div>
            <div class="py-2 flex items-center space-x-2">
                <div class="flex-1 text-black font-bold">
                    <label for="room_types">
                        룸타입
                    </label>
                </div>
                <div class="flex items-center">
                    @if(isset($copyCheckbox['room_types']) && $copyCheckbox['room_types']=== true)
                        <div class="pr-1 text-blue-600 text-sm font-bold">OK</div>
                        <div class="w-full py-1 px-2 text-xs">
                            @foreach ($targetHotel->room_types->where('visible', '=' , '1') as $roomType)
                                <div>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="room_types.{{$loop->index}}" value="{{$roomType->id}}">{{$roomType->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <input id="room_types" type="checkbox" wire:model="copyCheckbox.room_types" class="form-checkbox">
                </div>
            </div>
            <div class="py-2 flex items-center space-x-2">
                <div class="flex-1 text-black font-bold">
                    <label for="cancellation_refund_policies">
                        취소환불규정
                    </label>
                </div>
                <div class="flex items-center">
                    @if(isset($copyCheckbox['cancellation_refund_policies']) && $copyCheckbox['cancellation_refund_policies']=== true)
                        <div class="pr-1 text-blue-600 text-sm font-bold">OK</div>
                    @endif
                    <input id="cancellation_refund_policies" type="checkbox" wire:model="copyCheckbox.cancellation_refund_policies" class="form-checkbox">
                </div>
            </div>
            <div class="py-2 flex items-center space-x-2">
                <div class="flex-1 text-black font-bold">
                    <label for="check_points">
                        체크 포인트
                    </label>
                </div>
                <div class="flex items-center">
                    @if(isset($copyCheckbox['check_points']) && $copyCheckbox['check_points']=== true)
                        <div class="pr-1 text-blue-600 text-sm font-bold">OK</div>
                    @endif
                    <input id="check_points" type="checkbox" wire:model="copyCheckbox.check_points" class="form-checkbox">
                </div>
            </div>
            <div class="py-2 flex items-center space-x-2">
                <div class="flex-1 text-black font-bold">
                    <label for="faqs">
                        FAQ
                    </label>
                </div>
                <div class="flex items-center">
                    @if(isset($copyCheckbox['faqs']) && $copyCheckbox['faqs']=== true)
                        <div class="pr-1 text-blue-600 text-sm font-bold">OK</div>
                    @endif
                    <input id="faqs" type="checkbox" wire:model="copyCheckbox.faqs" class="form-checkbox">
                </div>
            </div>
            <div class="py-2 flex items-center space-x-2">
                <div class="flex-1 text-black font-bold">
                    <label for="reviews">
                        Review
                    </label>
                </div>
                <div class="flex items-center">
                    @if(isset($copyCheckbox['reviews']) && $copyCheckbox['reviews']=== true)
                        <div class="pr-1 text-blue-600 text-sm font-bold">OK</div>
                    @endif
                    <input id="reviews" type="checkbox" wire:model="copyCheckbox.reviews" class="form-checkbox">
                </div>
            </div>
        </div>

    </div>

    {{-- Session Status--}}
    @if(session()->has('result'))
        <div class="mt-2 px-2 py-3 bg-green-500 rounded-sm">
            <div class="text-white font-bold">
                {{ session()->pull('result') }}
            </div>
        </div>
    @endif

    <div class="py-2">
        <button class="w-full p-3 bg-blue-500 hover:bg-blue-600 font-bold text-white rounded-sm disabled:bg-red-500"
                @if(!isset($copyCheckbox) || (isset($copyCheckbox) && count($copyCheckbox)===0)) disabled @endif
            onclick="confirm('복사 진행 하시겠습니까?') || event.stopImmediatePropagation()"
                wire:click="copySubmit">
                COPY
        </button>
    </div>

</div>
