<div class="flex items-center h-screen py-4 AppSdGothicNeoR" x-data="{ 'type' : @entangle('period_type') }">
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <div class="pb-3 overflow-y-auto bg-tm-c-30373F text-white border border-solid border-tm-c-979b9f rounded-md shadow-lg"
         style="max-height: 80%;">
        <div class="p-4 sm:p-8">
            <div class="space-y-3">
                <div>
                    <label>
                        투어
                        <input type="radio" wire:model="period_type" value="tour" wire:click="$set('period_type','tour')">
                    </label>
                    <label>
                        입주
                        <input type="radio" wire:model="period_type" value="price" wire:click="$set('period_type','price')">
                    </label>
                </div>
                <div class="space-y-3">
                    <div x-show="type === 'tour'">
                        <div>
                            <div>
                                투어 세팅
                            </div>
                        </div>
                    </div>
                    <div x-show="type === 'price'">
                        <div>
                            <div>
                                입주 가격 세팅
                            </div>
                        </div>

                        <div class="px-2 py-2 rounded-md">
                            <div class="text-xl leading-relaxed">
                                룸 타입 선택하기
                            </div>

                            <div class="grid grid-cols-1 gap-2 md:gap-4">
                                @foreach ($hotel->visibleRoomTypes as $index=>$roomType)
                                    <div class="py-3 col-span-2 md:col-span-1">
                                        <div class="flex items-center justify-start space-x-2">
                                            <div>
                                                <img src="https://d2pyzcqibfhr70.cloudfront.net/{{$roomType->image}}" class="w-24 h-18" alt="룸 이미지">
                                            </div>
                                            <div class="space-y-px">
                                                <div>
                                                    [{{$roomType->id}}]&nbsp;{{$roomType->name}}
                                                </div>
                                                <div>
                                                    {{$roomType->main_explanation}}
                                                </div>
                                                <div>
                                                    {{$roomType->sub_explanation}}
                                                </div>
                                                <div>
                                                    솔드아웃:{{$roomType->sold_out === '0' ? 'X' : 'O'}}
                                                </div>
                                            </div>
                                        </div>
                                        @isset($roomTypePeriod[$index])
                                        <div class="space-y-4 divide-y divide-white divide-dashed">
                                            @foreach ($roomTypePeriod[$index] as $i=>$item)
                                                @continue($item===null)
                                                <div class="pt-4" x-data="{
                                                    options : false, timer : 0
                                                }" x-on:click.away="options=false;timer=0;">

                                                    <div class="w-full flex flex-wrap items-center space-y-2">
                                                        <div class="w-full hover:bg-black hover:bg-opacity-20 rounded-md">
                                                            <div class="relative">
                                                                <input type="number" wire:model="form.{{$index}}.{{$i}}.date" wire:change="checkFormDate('{{$index}}','{{$i}}')" placeholder="박 수" class="appearance-none AppSdGothicNeoR w-full px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                                                                <div class="absolute h-full right-0 top-0 mr-2 select-none">
                                                                    <div class="h-full flex items-center">
                                                                        박
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="hover:bg-black hover:bg-opacity-20 rounded-md">
                                                            <div class="">
                                                                <input type="number" wire:model="form.{{$index}}.{{$i}}.price" wire:keyup="calcPrice('price','{{$index}}', '{{$i}}')" placeholder="원가" class="appearance-none AppSdGothicNeoR w-full px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                                                            </div>
                                                        </div>
                                                        <div class="px-1">
                                                            @if($discount_method === '원')
                                                                -
                                                            @else
                                                                %
                                                            @endif
                                                        </div>
                                                        <div class="hover:bg-black hover:bg-opacity-20 rounded-md">
                                                            <div class="relative">
                                                                <input type="number" wire:model="form.{{$index}}.{{$i}}.discount" wire:keyup="calcPrice('discount','{{$index}}', '{{$i}}')" placeholder="할인" class="appearance-none AppSdGothicNeoR w-full px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                                                                <div class="absolute h-full right-0 top-0 mr-2 select-none">
                                                                    <div class="h-full flex items-center">
                                                                        {{$discount_method}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="px-1">
                                                            =
                                                        </div>
                                                        <div class="hover:bg-black hover:bg-opacity-20 rounded-md">
                                                            <div class="relative">
                                                                <input type="number" wire:model="form.{{$index}}.{{$i}}.sale_price" wire:keyup="calcPrice('sale_price','{{$index}}', '{{$i}}')" placeholder="실 판매가" class="appearance-none AppSdGothicNeoR w-full px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                                                                <div class="absolute h-full right-0 top-0 mr-2 select-none">
                                                                    <div class="h-full flex items-center">
                                                                        원
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="ml-4 hover:bg-black hover:bg-opacity-20 rounded-md">
                                                            <div class="relative">
                                                                <input type="number" wire:model="form.{{$index}}.{{$i}}.refund" wire:keyup="calcPrice('sale_price','{{$index}}', '{{$i}}')" placeholder="환불금" class="appearance-none AppSdGothicNeoR w-full px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                                                                <div class="absolute h-full right-0 top-0 mr-2 select-none">
                                                                    <div class="h-full flex items-center">
                                                                        1박 환불금😥
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="ml-2 flex space-x-2">
                                                            <div class="w-full relative">
                                                            <span class="absolute inline-flex h-full w-full rounded-full bg-blue-500 opacity-10"
                                                                  x-bind:class="{ 'animate-ping' : (options === true && timer !== 0), 'hidden' : (options === false || timer === 0) }"
                                                            ></span>
                                                                <div class="flex items-center justify-center w-12 h-12 text-center rounded-sm text-white cursor-pointer text-3xl hover:bg-tm-c-77b1ff"
                                                                     x-bind:class="{ 'bg-tm-c-77b1ff' : options === true,  'bg-blue-500' : options === false }"
                                                                     x-on:click="options = true;timer=1;setTimeout(function(){ timer = 0; },800);"
                                                                >
                                                                    <div x-bind:class="{'hidden' : !options}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20">
                                                                            <g fill="none" fill-rule="evenodd" stroke-linejoin="round">
                                                                                <g stroke="#FFFFFF">
                                                                                    <g>
                                                                                        <g>
                                                                                            <g>
                                                                                                <g>
                                                                                                    <path d="M2 0h2c1.105 0 2 .895 2 2v12.66h0L3 19l-3-4.34V2C0 .895.895 0 2 0zM.444 14.244L5.637 14.244M.444 3.244L5.637 3.244" transform="translate(-280 -86) translate(16 60) translate(261 21.5) translate(4.5 5) rotate(45 6 16.743)"/>
                                                                                                </g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </svg>
                                                                    </div>
                                                                    <div x-bind:class="{'hidden' : options}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 18 18">
                                                                            <g id="ic/setting" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <path d="M10.6571429,1 L11.3203023,2.39372207 C12.1487129,2.68467096 12.9058556,3.12703214 13.5585251,3.68760032 L15.0996318,3.56487219 L16.7567747,6.43512781 L15.8810132,7.70801376 C15.9591461,8.12675055 16,8.5586043 16,9 C16,9.44174741 15.9590809,9.87393766 15.8808264,10.2929872 L16.7567747,11.5648722 L15.0996318,14.4351278 L13.5585251,14.3123997 C12.9058556,14.8729679 12.1487129,15.315329 11.3203023,15.6062779 L10.6571429,17 L7.34285714,17 L6.67959926,15.6062433 C5.85148689,15.3153852 5.09459336,14.873223 4.44208881,14.3129269 L2.9003682,14.4351278 L1.24322534,11.5648722 L2.11917365,10.2929872 C2.04091907,9.87393766 2,9.44174741 2,9 C2,8.5586043 2.04085394,8.12675055 2.1189868,7.70801376 L1.24322534,6.43512781 L2.9003682,3.56487219 L4.44208881,3.68707307 C5.09459336,3.12677697 5.85148689,2.68461479 6.67959926,2.39375665 L7.34285714,1 L10.6571429,1 Z" id="Combined-Shape" stroke="#FFFFFF" stroke-linejoin="round"></path>
                                                                                <circle id="Oval" stroke="#FFFFFF" cx="9" cy="9" r="4"></circle>
                                                                            </g>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="w-full">
                                                                <div class="flex items-center justify-center w-12 h-12 text-center else bg-tm-c-da5542 hover:bg-tm-c-ff7777 {{--@if(empty($form[$index][$i]['date'])) bg-tm-c-979b9f @else bg-tm-c-da5542 @endif --}}rounded-sm text-white cursor-pointer"
                                                                     wire:click="roomTypePeriodRemove('{{$index}}','{{$i}}')" wire:key="roomTypePeriodRemove-{{$index}}-{{$i}}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" {{--class="@if(!isset($form[$index][$i]['date'])) opacity-50 @endif"--}} viewBox="0 0 23 24">
                                                                        <g fill="none" fill-rule="evenodd">
                                                                            <g>
                                                                                <g>
                                                                                    <g>
                                                                                        <g transform="translate(-378 -1008) translate(360 608) translate(0 383) translate(18 17)">
                                                                                            <rect width="23" height="1" y="3" fill="#FFF" rx=".5"/>
                                                                                            <path stroke="#FFF" d="M2.5 3.5H20.5V23.5H2.5z"/>
                                                                                            <rect width="1" height="11" x="6" y="8" fill="#FFF" rx=".5"/>
                                                                                            <rect width="1" height="11" x="11" y="8" fill="#FFF" rx=".5"/>
                                                                                            <rect width="7" height="1" x="8" fill="#FFF" rx=".5"/>
                                                                                            <rect width="1" height="11" x="16" y="8" fill="#FFF" rx=".5"/>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if($errors->has('form.'.$index.'.'.$i.'.date') || $errors->has('form.'.$index.'.'.$i.'.price')
                                                        || $errors->has('form.'.$index.'.'.$i.'.sale_price') || $errors->has('form.'.$index.'.'.$i.'.refund') )
                                                        <div class="mt-2 col-span-5 pb-1">
                                                            @error('form.'.$index.'.'.$i.'.date')
                                                            <div class="">
                                                                <div class="text-sm">{{$message}}</div>
                                                            </div>
                                                            @enderror
                                                            @error('form.'.$index.'.'.$i.'.price')
                                                            <div class="">
                                                                <div class="text-sm">{{$message}}</div>
                                                            </div>
                                                            @enderror
                                                            @error('form.'.$index.'.'.$i.'.sale_price')
                                                            <div class="">
                                                                <div class="text-sm">{{$message}}</div>
                                                            </div>
                                                            @enderror
                                                            @error('form.'.$index.'.'.$i.'.refund')
                                                            <div class="">
                                                                <div class="text-sm">{{$message}}</div>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    @endif

                                                    <div x-show="options" x-cloak
                                                         x-transition:enter="transition ease-in duration-200"
                                                         x-transition:enter-start="transform opacity-50"
                                                         x-transition:enter-end="transform opacity-100"
                                                         x-transition:leave="transition ease-out duration-200"
                                                         x-transition:leave-start="transform opacity-100"
                                                         x-transition:leave-end="transform opacity-50"
                                                         class="col-span-5 mt-4 mb-2 py-2 px-2 border border-solid border-gray-700 shadow-inner space-y-2 bg-tm-c-292f36 bg-opacity-20 rounded-md">
                                                        {{--  wire:click="roomTypePeriodOptions('{{$index}}','{{$i}}')" wire:key="roomTypePeriodOptions-{{$index}}-{{$i}}"--}}
                                                        <div class="space-y-2">
                                                            <div class="flex justify-between items-center py-2">
                                                                <div class="font-bold text-lg">옵션 추가하기</div>
                                                                <div class="flex justify-end items-center space-x-2">
                                                                    <div>비활성화</div>
                                                                    <div>
                                                                        <label>
                                                                            <input type="checkbox" wire:model.lazy="options.disabled.{{$index}}.{{$i}}" class="form-checkbox text-tm-c-da5542 appearance-none AppSdGothicNeoR w-full px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="flex items-center">
                                                                <div class="w-2/12 flex-shrink pl-2">
                                                                    옵션 메모
                                                                </div>
                                                                <div class="w-10/12 flex-1">
                                                                    <input type="text" wire:model.lazy="options.memo.{{$index}}.{{$i}}" class="form appearance-none AppSdGothicNeoR w-full px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                                                                </div>
                                                            </div>

                                                            <div class="flex items-center">
                                                                <div class="w-2/12 flex-shrink pl-2">
                                                                    혜택 추가
                                                                </div>
                                                                <div class="w-10/12 flex-1 flex space-x-2">
                                                                    <div class="flex-1">
                                                                        <input type="text" wire:model.lazy="benefit.name.{{$index}}.{{$i}}" class="form appearance-none AppSdGothicNeoR w-full px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                                                                    </div>
                                                                    <div class="w-auto font-bold text-sm bg-tm-c-292f36 hover:bg-tm-c-979b9f rounded-sm select-none leading-5 cursor-pointer"
                                                                         wire:click="benefitSaving({{$index}},{{$i}})">
                                                                        <div class="flex items-center h-full px-4 sm:px-8">
                                                                            추가
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('benefit.name.'.$index.'.'.$i)
                                                            <div class="mt-1 text-sm text-tm-c-da5542">
                                                                {{$message ?? '오류'}}
                                                            </div>
                                                            @enderror

                                                            <div class="flex items-center">
                                                                <div class="w-2/12 flex-shrink text-left space-y-1 pl-2">
                                                                    <div>호텔 혜택</div>
                                                                    <div>리스트</div>
                                                                </div>
                                                                <div class="w-10/12 p-2 border border-solid border-tm-c-ED">
                                                                    <div class="flex flex-wrap select-none">
                                                                        <div class="flex flex-wrap">
                                                                            @forelse($benefits as $benefit)
                                                                                @if(isset($options['benefits'][$index][$i]) && \Illuminate\Support\Arr::get($options['benefits'][$index][$i],$benefit->id))
                                                                                    <div class="flex items-center py-1 px-2 my-1 mr-2 border border-solid border-tm-c-979b9f text-tm-c-979b9f rounded-full cursor-not-allowed">
                                                                                        {{$benefit->name}}
                                                                                    </div>
                                                                                @else
                                                                                    <div class="flex items-center py-1 px-2 my-1 mr-2 border border-solid border-white rounded-full cursor-pointer"
                                                                                         wire:click="benefitPush('{{$index}}','{{$i}}','{{$benefit->id}}')">
                                                                                        {{$benefit->name}}
                                                                                    </div>
                                                                                @endif
                                                                            @empty
                                                                                <div class="py-2">저장 혜택 리스트 없음</div>
                                                                            @endforelse
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="flex items-center">
                                                                <div class="w-2/12 flex-shrink text-left space-y-1 pl-2">
                                                                    <div>선택 혜택</div>
                                                                    <div>리스트</div>
                                                                </div>
                                                                <div class="w-10/12 flex-1 p-2 border border-solid border-tm-c-ED">
                                                                    <div class="flex flex-wrap select-none">
                                                                        @isset($options['benefits'][$index][$i])
                                                                            <div class="flex flex-wrap">
                                                                                @forelse($options['benefits'][$index][$i] as $benefit)
                                                                                    <div class="flex items-center py-1 px-2 my-1 mr-2 border border-solid border-white rounded-full cursor-pointer"
                                                                                         wire:click="benefitRemove('{{$index}}','{{$i}}','{{$benefit['id']}}')">
                                                                                        {{$benefit['name']}}
                                                                                    </div>
                                                                                @empty
                                                                                    <div class="py-2 border border-solid border-transparent">선택 혜택 리스트 없음</div>
                                                                                @endforelse
                                                                            </div>
                                                                        @else
                                                                            <div class="py-2 border border-solid border-transparent">선택 혜택 리스트 없음</div>
                                                                        @endisset
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="bg-tm-c-292f36 hover:bg-tm-c-979b9f rounded-sm cursor-pointer"
                                                             x-on:click="options=false">
                                                            <div class="py-3 AppSdGothicNeoR flex items-center justify-center">
                                                                확인
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                        @endisset

                                        <div class="mt-3 rounded-sm cursor-pointer bg-tm-c-292f36 hover:bg-tm-c-979b9f" wire:click="roomTypePeriodAdd('{{$index}}')" wire:key="roomTypePeriodAdd-{{$index}}">
                                            <div class="AppSdGothicNeoR text-center px-2 py-3">
                                                박 추가
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="hover:bg-black hover:bg-opacity-20 px-2 py-2 rounded-md">
                        <div class="flex justify-between">
                            <div class="text-xl leading-relaxed">
                                세팅 시간
                            </div>
                            <div>
                                <button class="px-2 py-1 text-md rounded-sm hover:bg-tm-c-979b9f focus:outline-none" wire:click="timerDefaultSet">
                                    기본 시간 가져오기
                                </button>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <input type="time" wire:model.lazy="form.start_time" class="appearance-none AppSdGothicNeoR px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                            <input type="time" wire:model.lazy="form.end_time" class="appearance-none AppSdGothicNeoR px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                        </div>
                        @error('form.start_time')
                        <div class="pt-1">
                            <div class="text-sm">{{$message}}</div>
                        </div>
                        @enderror
                        @error('form.end_time')
                        <div class="pt-1">
                            <div class="text-sm">{{$message}}</div>
                        </div>
                        @enderror
                    </div>

                    @isset($period_ranges)
                        <div class="col-span-2 px-2">
                            <div class="text-xl text-white py-3">
                                선택 일정
                            </div>
                            <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 xl:grid-cols-12 gap-3">
                                @foreach($period_ranges as $period_range)
                                    <div>
                                        {{$period_range}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endisset
                    <div>
                        <div>
                            예시
                        </div>
                        <div class="flex">
                            <div class="px-2 py-1 rounded-md" style="background-color: {{$this->colors['color']}}">
                                <div style="color: {{$this->colors['textColor']}}">
                                    예시 글자 {{$this->colors['textColor'] ?? ''}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            배경 색상
                        </div>
                        <div class="flex flex-wrap space-x-2 p-3">
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-white">색상</div>
                                    <input type="radio" wire:model.lazy="colors.color" value="#FFFFFF" class="text-white form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-white focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-black">색상</div>
                                    <input type="radio" wire:model.lazy="colors.color" value="#000000" class="text-black form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-black focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-tm-c-0D5E49">색상</div>
                                    <input type="radio" wire:model.lazy="colors.color" value="#0D5E49" class="text-tm-c-0D5E49 form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-tm-c-0D5E49 focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-tm-c-da5542">색상</div>
                                    <input type="radio" wire:model.lazy="colors.color" value="#da5542" class="text-tm-c-da5542 form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-tm-c-da5542 focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-tm-c-C1A485">색상</div>
                                    <input type="radio" wire:model.lazy="colors.color" value="#C1A485" class="text-tm-c-C1A485 form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-tm-c-C1A485 focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-tm-c-77b1ff">색상</div>
                                    <input type="radio" wire:model.lazy="colors.color" value="#77b1ff" class="text-tm-c-77b1ff form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-tm-c-77b1ff focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-tm-c-979b9f">색상</div>
                                    <input type="radio" wire:model.lazy="colors.color" value="#979b9f" class="text-tm-c-979b9f form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-tm-c-979b9f focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div style="color: #849773;">색상</div>
                                    <input type="radio" wire:model.lazy="colors.color" value="#849773" class="form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid focus:outline-none" style="color: #849773; border-color: #849773;">
                                </div>
                            </label>
                            <div class="flex flex-wrap space-x-1">
                                <div>자율 색상</div>
                                <input type="color" wire:model.lazy="colors.color" class="appearance-none AppSdGothicNeoR bg-transparent focus:outline-none">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div>
                            글자 색상
                        </div>
                        <div class="flex flex-wrap space-x-2 p-3">
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-white">색상</div>
                                    <input type="radio" wire:model.lazy="colors.textColor" value="#FFFFFF" class="text-white form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-white focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-black">색상</div>
                                    <input type="radio" wire:model.lazy="colors.textColor" value="#000000" class="text-black form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-black focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-tm-c-0D5E49">색상</div>
                                    <input type="radio" wire:model.lazy="colors.textColor" value="#0D5E49" class="text-tm-c-0D5E49 form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-tm-c-0D5E49 focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-tm-c-da5542">색상</div>
                                    <input type="radio" wire:model.lazy="colors.textColor" value="#da5542" class="text-tm-c-da5542 form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-tm-c-da5542 focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-tm-c-C1A485">색상</div>
                                    <input type="radio" wire:model.lazy="colors.textColor" value="#C1A485" class="text-tm-c-C1A485 form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-tm-c-C1A485 focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-tm-c-77b1ff">색상</div>
                                    <input type="radio" wire:model.lazy="colors.textColor" value="#77b1ff" class="text-tm-c-77b1ff form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-tm-c-77b1ff focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div class="text-tm-c-979b9f">색상</div>
                                    <input type="radio" wire:model.lazy="colors.textColor" value="#979b9f" class="text-tm-c-979b9f form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid border-tm-c-979b9f focus:outline-none">
                                </div>
                            </label>
                            <label>
                                <div class="flex flex-wrap space-x-1">
                                    <div style="color: #849773;">색상</div>
                                    <input type="radio" wire:model.lazy="colors.textColor" value="#849773" class="form-radio appearance-none AppSdGothicNeoR bg-transparent border border-solid focus:outline-none" style="color: #849773; border-color: #849773;">
                                </div>
                            </label>
                            <div class="flex flex-wrap space-x-1">
                                <div>자율 색상</div>
                                <input type="color" wire:model.lazy="colors.textColor" class="appearance-none AppSdGothicNeoR bg-transparent focus:outline-none">
                            </div>
                        </div>
                    </div>
                    {{--@isset($schedulers)
                        <div class="col-span-2 sm:col-span-4 grid grid-cols-2">
                            @foreach($schedulers as $index=>$scheduler)
                                <div class="flex flex-wrap">
                                    <div class="hover:bg-black hover:bg-opacity-20 px-2 py-2 rounded-md">
                                        <div class="text-sm leading-relaxed">시작 기간</div>
                                        <div class="flex space-x-2">
                                            <input type="date" wire:model.lazy="form.{{$index}}.start.date" class="appearance-none AppSdGothicNeoR px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                                        </div>
                                    </div>

                                    <div class="hover:bg-black hover:bg-opacity-20 px-2 py-2 rounded-md">
                                        <div class="text-sm leading-relaxed">종료 기간</div>
                                        <div class="flex space-x-2">
                                            <input type="date" wire:model.lazy="form.{{$index}}.end.date" class="appearance-none AppSdGothicNeoR px-3 py-3 bg-transparent border border-solid border-white rounded-sm focus:outline-none">
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        @error('form.'.$index.'.end.date')
                                        <div class="pt-1">
                                            <div class="text-sm">{{$message}}</div>
                                        </div>
                                        @enderror
                                        @error('form.'.$index.'.start.date')
                                        <div class="pt-1">
                                            <div class="text-sm">{{$message}}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endisset--}}
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="p-2 rounded-lg">
                <ul class="space-y-1 text-tm-c-da5542">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex justify-end px-2 pt-4 space-x-2">
            <div class="flex justify-center items-center px-4 h-8 bg-tm-c-292f36 hover:bg-tm-c-979b9f rounded-sm shadow-lg cursor-pointer" wire:click="$emitUp('schedulerModalClose')">
                <div class="text-sm text-white font-bold">
                    닫기
                </div>
            </div>
            <div class="flex justify-center items-center w-32 h-8 bg-tm-c-C1A485 hover:bg-tm-c-897763 rounded-sm shadow-lg cursor-pointer" wire:click="SchedulerSubmit">
                <div class="text-sm text-white">
                    저장
                </div>
            </div>
        </div>
    </div>
</div>
