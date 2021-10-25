<div>
    <div class="pt-6 md:pt-10">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485 select-none">
                    매니저 정보
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>

    <div class="pt-6" wire:init="managerLoad">
        <div class="grid grid-cols1 sm:grid-cols-2 gap-3">
            <div>
                <div class="relative">
                    <input type="text" wire:model="name" maxlength="20" readonly
                           wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelOther', 'name')"
                           class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelOther')->whereTarget('name')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                           placeholder="성명 입력"
                    >
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelOther')->whereTarget('name')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                        </div>
                    @endforeach
                    @error('name')<div class="mt-2 text-tm-c-da5542">성명 은(는)&nbsp;{{ $message }}</div>@enderror
                </div>
            </div>
            <div>
                <div class="relative">
                    <input type="tel" wire:model="phone_number" maxlength="20" readonly
                           wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelOther', 'phone_number')"
                           class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelOther')->whereTarget('phone_number')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                           placeholder="연락처(핫라인) 입력"
                    >
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelOther')->whereTarget('phone_number')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                        </div>
                    @endforeach
                    @error('phone_number')<div class="mt-2 text-tm-c-da5542">연락처 은(는)&nbsp;{{ $message }}</div>@enderror
                </div>
            </div>
            <div>
                <div class="relative">
                    <input type="text" wire:model="department_name" maxlength="20" readonly
                           wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelOther', 'department_name')"
                           class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelOther')->whereTarget('department_name')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                           placeholder="부서명 입력"
                    >
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelOther')->whereTarget('department_name')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                        </div>
                    @endforeach
                    @error('department_name')<div class="mt-2 text-tm-c-da5542">부서명 은(는)&nbsp;{{ $message }}</div>@enderror
                </div>
            </div>
            <div>
                <div class="relative">
                    <input type="text" wire:model="department_position" maxlength="20" readonly
                           wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelOther', 'department_position')"
                           class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelOther')->whereTarget('department_position')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                           placeholder="직급 입력"
                    >
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelOther')->whereTarget('department_position')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                        </div>
                    @endforeach
                    @error('department_position')<div class="mt-2 text-tm-c-da5542">직급 은(는)&nbsp;{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>


    <div class="pt-6 md:pt-10">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485 select-none">
                    투어 가능 시간
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>
    <div class="pt-6">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>* 투어란 호텔에 입주하기 전에 미리 호텔 객실과 편의시설, 위치 등의 사항을 20분 내외로 미리 살펴보는 제도입니다.</p>
        </div>
    </div>

    <div class="pt-6" wire:init="tourLoad">
        <div class="grid grid-cols-4 sm:grid-cols-7 gap-3">
            <div>
                <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelTour', 'tour_day.0')">
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[0]) && $tour_day[0]) bg-white @else bg-transparent @endif">
                        <div class="pt-1 flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-normal select-none text-tm-c-ff7777">
                            일요일
                            <input type="checkbox" wire:model="tour_day.0" wire:key="tour_day_0" value="일" class="hidden" readonly>
                        </div>
                    </div>
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelTour')->whereTarget('tour_day.0')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
            <div>
                <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelTour', 'tour_day.1')">
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[1]) && $tour_day[1]) bg-white @else bg-transparent @endif">
                        <div class="pt-1 flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-normal select-none @if(isset($tour_day[1]) && $tour_day[1]) text-tm-c-30373F @else text-white @endif">
                            월요일
                            <input type="checkbox" wire:model="tour_day.1" value="월" class="hidden" readonly>
                        </div>
                    </div>
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelTour')->whereTarget('tour_day.1')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
            <div>
                <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelTour', 'tour_day.2')">
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[2]) && $tour_day[2]) bg-white @else bg-transparent @endif">
                        <div class="pt-1 flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-normal select-none @if(isset($tour_day[2]) && $tour_day[2]) text-tm-c-30373F @else text-white @endif">
                            화요일
                            <input type="checkbox" wire:model="tour_day.2" value="화" class="hidden" readonly>
                        </div>
                    </div>
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelTour')->whereTarget('tour_day.2')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
            <div>
                <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelTour', 'tour_day.3')">
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[3]) && $tour_day[3]) bg-white @else bg-transparent @endif">
                        <div class="pt-1 flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-normal select-none @if(isset($tour_day[3]) && $tour_day[3]) text-tm-c-30373F @else text-white @endif">
                            수요일
                            <input type="checkbox" wire:model="tour_day.3" value="수" class="hidden" readonly>
                        </div>
                    </div>
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelTour')->whereTarget('tour_day.3')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
            <div>
                <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelTour', 'tour_day.4')">
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[4]) && $tour_day[4]) bg-white @else bg-transparent @endif">
                        <div class="pt-1 flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-normal select-none @if(isset($tour_day[4]) && $tour_day[4]) text-tm-c-30373F @else text-white @endif">
                            목요일
                            <input type="checkbox" wire:model="tour_day.4" value="목" class="hidden" readonly>
                        </div>
                    </div>
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelTour')->whereTarget('tour_day.4')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
            <div>
                <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelTour', 'tour_day.5')">
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[5]) && $tour_day[5]) bg-white @else bg-transparent @endif">
                        <div class="pt-1 flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-normal select-none @if(isset($tour_day[5]) && $tour_day[5]) text-tm-c-30373F @else text-white @endif">
                            금요일
                            <input type="checkbox" wire:model="tour_day.5" value="금" class="hidden" readonly>
                        </div>
                    </div>
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelTour')->whereTarget('tour_day.5')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
            <div>
                <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelTour', 'tour_day.6')">
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[6]) && $tour_day[6]) bg-white @else bg-transparent @endif">
                        <div class="pt-1 flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-normal select-none text-tm-c-77b1ff">
                            토요일
                            <input type="checkbox" wire:model.lazy="tour_day.6" value="토" class="hidden" readonly>
                        </div>
                    </div>
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelTour')->whereTarget('tour_day.6')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @error('tour_day')<div class="mt-2 text-tm-c-da5542">투어 요일 은(는)&nbsp;{{ $message }}</div>@enderror
    </div>
    <div class="pt-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
                <input type="time" wire:model="tour_time.start" maxlength="10" readonly
                       wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelTour', 'tour_time.start')"
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelTour')->whereTarget('tour_time.start')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="투어 시작 시간 입력"
                >
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelTour')->whereTarget('tour_time.start')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
                @error('tour_time.start')<div class="mt-2 text-tm-c-da5542">투어 시작 은(는)&nbsp;{{ $message }}</div>@enderror
            </div>

            <div>
                <input type="time" wire:model="tour_time.end" maxlength="10" readonly
                       wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelTour', 'tour_time.end')"
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelTour')->whereTarget('tour_time.end')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="투어 종료 시간 입력"
                >
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelTour')->whereTarget('tour_time.end')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
                @error('tour_time.end')<div class="mt-2 text-tm-c-da5542">투어 종료 은(는)&nbsp;{{ $message }}</div>@enderror
            </div>
        </div>
    </div>



    <div class="pt-6 md:pt-10">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485 select-none">
                    체크인/아웃 시간
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>

    <div class="pt-6" wire:init="checkTimerLoad">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
                <input type="time" wire:model="check_time.start" maxlength="10" readonly
                       wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelCheck', 'check_time.start')"
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheck')->whereTarget('check_time.start')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="체크인 시간 입력"
                >
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheck')->whereTarget('check_time.start')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
                @error('check_time.start')<div class="mt-2 text-tm-c-da5542">체크인 은(는)&nbsp;{{ $message }}</div>@enderror
            </div>

            <div>
                <input type="time" wire:model="check_time.end" maxlength="10" readonly
                       wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelCheck', 'check_time.end')"
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheck')->whereTarget('check_time.end')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="체크아웃 시간 입력"
                >
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheck')->whereTarget('check_time.end')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
                @error('check_time.end')<div class="mt-2 text-tm-c-da5542">체크아웃 은(는)&nbsp;{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

</div>
