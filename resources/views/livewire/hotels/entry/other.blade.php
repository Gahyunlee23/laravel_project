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
                    <input type="text" wire:model.lazy="name" id="name" maxlength="20"
                           class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                           placeholder="성명 입력"
                    >
                    @error('name')<div class="mt-2 text-tm-c-da5542">성명 은(는)&nbsp;{{ $message }}</div>@enderror
                </div>
            </div>
            <div>
                <div class="relative">
                    <input type="tel" wire:model.lazy="phone_number" id="phone_number" maxlength="20"
                           class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                           placeholder="연락처(핫라인) 입력"
                    >
                    @error('phone_number')<div class="mt-2 text-tm-c-da5542">연락처 은(는)&nbsp;{{ $message }}</div>@enderror
                </div>
            </div>
            <div>
                <div class="relative">
                    <input type="text" wire:model.lazy="department_name" id="department_name" maxlength="20"
                           class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                           placeholder="부서명 입력"
                    >
                    @error('department_name')<div class="mt-2 text-tm-c-da5542">부서명 은(는)&nbsp;{{ $message }}</div>@enderror
                </div>
            </div>
            <div>
                <div class="relative">
                    <input type="text" wire:model.lazy="department_position" id="department_position" maxlength="20"
                           class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                           placeholder="직급 입력"
                    >
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
                <label>
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[0]) && $tour_day[0]) bg-white @else bg-transparent @endif">
                        <div class="pt-px flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-5 select-none text-tm-c-ff7777">
                            일요일
                            <input type="checkbox" wire:model="tour_day.0" id="tour_day.0" wire:key="tour_day_0" value="일" class="hidden">
                        </div>
                    </div>
                </label>
            </div>
            <div>
                <label>
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[1]) && $tour_day[1]) bg-white @else bg-transparent @endif">
                        <div class="pt-px flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-5 select-none @if(isset($tour_day[1]) && $tour_day[1]) text-tm-c-30373F @else text-white @endif">
                            월요일
                            <input type="checkbox" wire:model="tour_day.1" id="tour_day.1" value="월" class="hidden">
                        </div>
                    </div>
                </label>
            </div>
            <div>
                <label>
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[2]) && $tour_day[2]) bg-white @else bg-transparent @endif">
                        <div class="pt-px flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-5 select-none @if(isset($tour_day[2]) && $tour_day[2]) text-tm-c-30373F @else text-white @endif">
                            화요일
                            <input type="checkbox" wire:model="tour_day.2" id="tour_day.2" value="화" class="hidden">
                        </div>
                    </div>
                </label>
            </div>
            <div>
                <label>
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[3]) && $tour_day[3]) bg-white @else bg-transparent @endif">
                        <div class="pt-px flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-5 select-none @if(isset($tour_day[3]) && $tour_day[3]) text-tm-c-30373F @else text-white @endif">
                            수요일
                            <input type="checkbox" wire:model="tour_day.3" id="tour_day.3" value="수" class="hidden">
                        </div>
                    </div>
                </label>
            </div>
            <div>
                <label>
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[4]) && $tour_day[4]) bg-white @else bg-transparent @endif">
                        <div class="pt-px flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-5 select-none @if(isset($tour_day[4]) && $tour_day[4]) text-tm-c-30373F @else text-white @endif">
                            목요일
                            <input type="checkbox" wire:model="tour_day.4" id="tour_day.4" value="목" class="hidden">
                        </div>
                    </div>
                </label>
            </div>
            <div>
                <label>
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[5]) && $tour_day[5]) bg-white @else bg-transparent @endif">
                        <div class="pt-px flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-5 select-none @if(isset($tour_day[5]) && $tour_day[5]) text-tm-c-30373F @else text-white @endif">
                            금요일
                            <input type="checkbox" wire:model="tour_day.5" id="tour_day.5" value="금" class="hidden">
                        </div>
                    </div>
                </label>
            </div>
            <div>
                <label>
                    <div class="px-3 py-2 text-white border border-solid border-tm-c-979b9f rounded-sm @if(isset($tour_day[6]) && $tour_day[6]) bg-white @else bg-transparent @endif">
                        <div class="pt-px flex items-center justify-center AppSdGothicNeoR font-bold text-sm leading-5 select-none text-tm-c-77b1ff">
                            토요일
                            <input type="checkbox" wire:model.lazy="tour_day.6" id="tour_day.6" value="토" class="hidden">
                        </div>
                    </div>
                </label>
            </div>
        </div>
        @error('tour_day')<div class="mt-2 text-tm-c-da5542">투어 요일 은(는)&nbsp;{{ $message }}</div>@enderror
    </div>
    <div class="pt-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
                <input type="time" wire:model.lazy="tour_time.start" id="tour_time.start" maxlength="10"
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="투어 시작 시간 입력"
                >
                @error('tour_time.start')<div class="mt-2 text-tm-c-da5542">투어 시작 은(는)&nbsp;{{ $message }}</div>@enderror
            </div>

            <div>
                <input type="time" wire:model.lazy="tour_time.end" id="tour_time.end" maxlength="10"
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="투어 종료 시간 입력"
                >
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
                <input type="time" wire:model.lazy="check_time.start" id="check_time.start" maxlength="10"
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="체크인 시간 입력"
                >
                @error('check_time.start')<div class="mt-2 text-tm-c-da5542">체크인 은(는)&nbsp;{{ $message }}</div>@enderror
            </div>

            <div>
                <input type="time" wire:model.lazy="check_time.end" id="check_time.end" maxlength="10"
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="체크아웃 시간 입력"
                >
                @error('check_time.end')<div class="mt-2 text-tm-c-da5542">체크아웃 은(는)&nbsp;{{ $message }}</div>@enderror
            </div>
        </div>
    </div>


    <div class="pt-4 sm:pt-10 md:pt-16 pb-10 md:pb-16">
        <div class="flex flex-wrap md:flex-nowrap justify-center md:space-x-4 lg:space-x-6">
            <div class="mt-2 sm:mt-4 md:mt-0 order-2 md:order-1 py-4 w-full md:max-w-xs rounded-sm shadow-lg border border-solid border-white cursor-pointer"
                 wire:click="backRedirect(5)">
                <div class="AppSdGothicNeoR text-xl text-center text-white">
                    이전
                </div>
            </div>

            <div class="order-1 md:order-2 py-4 w-full md:max-w-xs rounded-sm shadow-lg @if($errors->count()=== 0)bg-tm-c-C1A485 cursor-pointer @else bg-tm-c-d7d3cf @endif"
                 @if($errors->count()=== 0)wire:click="submit" @endif>
                <div class="flex justify-center space-x-1 sm:space-x-2">
                    <div wire:loading wire:target="submit">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <div class="AppSdGothicNeoR text-xl text-center text-white">
                        입점 신청하기
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($errors->any())
        <div class="hidden" x-data="{error : '{{$errors->keys()[0]}}'}" x-init="fieldError = document.getElementById(error);if(fieldError){fieldError.focus({preventScroll:false});}"></div>
    @endif
</div>
