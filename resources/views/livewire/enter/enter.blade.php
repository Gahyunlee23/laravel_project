<div>
    <div class="w-full relative" style="padding: 0;">
        <div wire:loading wire:target="story" class="absolute w-full h-full z-20 bg-gray-600 bg-opacity-50">
            <div class="flex h-full justify-center items-center">
                <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/img-loading.svg"
                     class="w-16 sm:w-18 spinner" alt="">
            </div>
        </div>
        <div class="py-4">
            <div class="px-4 py-6">
                <form id="enter_form" onsubmit="store();return false;">
                    <div class="max-w-1200 mx-auto space-y-10 md:space-y-16">
                        <div class="PtSerif italic text-4xl md:text-5xl text-tm-c-C1A485">
                            Apply Here
                        </div>

                        <div class="max-w-6xl mx-auto">
                            <div>
                                <div class="flex">
                                    <div class="AppSdGothicNeoR font-bold flex-0 text-lg md:text-2xl text-tm-c-C1A485">
                                        호텔 정보
                                    </div>
                                    <div class="flex-1 px-4">
                                        <div class="h-full flex flex-wrap items-center">
                                            <div class="w-full h-px border-b-2 border-dotted border-tm-c-C1A485"></div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div>
                                        <div class="space-y-5">
                                            <div class="w-full flex-1 my-4">
                                                <div
                                                    class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('hotel_name') text-tm-c-ff7777 @enderror">
                                                    호텔명
                                                </div>
                                                <div>
                                                    <input type="text" name="hotel_name" wire:model.lazy="hotel_name"
                                                           class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                       @error('hotel_name') border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                           placeholder="호텔명을 입력해주세요." maxlength="50"
                                                           autocomplete="off" style="z-index:-1;">
                                                    @error('hotel_name') <span
                                                        class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="w-full flex-1 my-4">
                                                <div
                                                    class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('hotel_address') text-tm-c-ff7777 @enderror">
                                                    호텔 주소
                                                </div>
                                                <div>
                                                    <input type="text" name="hotel_address" wire:model.lazy="hotel_address"
                                                           class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                       @error('hotel_address') border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                           placeholder="호텔 주소를 입력해주세요." maxlength="50"
                                                           autocomplete="off" style="z-index:-1;">
                                                    @error('hotel_address') <span
                                                        class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="w-full flex-1 my-4">
                                                <div
                                                    class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('hotel_web_address') text-tm-c-ff7777 @enderror">
                                                    호텔 웹사이트 주소
                                                </div>
                                                <div>
                                                    <input type="url" name="hotel_web_address"
                                                           wire:model.lazy="hotel_web_address"
                                                           class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                       @error('hotel_web_address') border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                           placeholder="호텔 웹사이트 주소를 입력해주세요." maxlength="50"
                                                           autocomplete="off" style="z-index:-1;">
                                                    @error('hotel_web_address') <span
                                                        class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="max-w-6xl mx-auto">
                            <div class="relative">
                                <div class="flex">
                                    <div class="AppSdGothicNeoR font-bold flex-0 text-lg md:text-2xl text-tm-c-C1A485">
                                        객실별 입금가
                                    </div>
                                    <div class="flex-1 px-4">
                                        <div class="h-full flex flex-wrap items-center">
                                            <div class="w-full h-px border-b-2 border-dotted border-tm-c-C1A485"></div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div x-data="{ index : '{{$current_i}}' }">
                                        @foreach($inputs as $key => $value)
                                            <div class="grid md:grid-cols-2" x-show="index === '{{$key}}'">
                                                <div class="w-full flex-1 my-4 md:pr-2">
                                                    <div
                                                        class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('type.'.$key) text-tm-c-ff7777 @enderror">
                                                        객실 타입 {{$key+1}}
                                                    </div>
                                                    <div>
                                                        <input type="text" name="type[]" wire:model.lazy="type.{{ $key }}"
                                                               class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                           @error('type.'.$key) border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                               placeholder="객실 타입(ex. 스탠다드 더블)을 입력해주세요." maxlength="50"
                                                               autocomplete="off" style="z-index:-1;">
                                                        @error('type.'.$key) <span
                                                            class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="w-full flex-1 my-4">
                                                    <div
                                                        class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('supply_price_month.'.$key) text-tm-c-ff7777 @enderror">
                                                        한 달 살기 입금가
                                                    </div>
                                                    <div>
                                                        <input type="number" data-type="currency"
                                                               name="supply_price_month[]"
                                                               wire:model.lazy="supply_price_month.{{ $key }}"
                                                               class="w-full appearance-none bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                           @error('supply_price_month.'.$key) border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                               placeholder="29박 30일 기준(부가세 포함)으로 입력해주세요." maxlength="15"
                                                               oninput="maxLengthCheck(this)"
                                                               autocomplete="off" style="z-index:-1;">
                                                        @error('supply_price_month.'.$key) <span
                                                            class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="w-full flex-1 my-4 md:pr-2">
                                                    <div
                                                        class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('supply_price_3_weeks.'.$key) text-tm-c-ff7777 @enderror">
                                                        3주 살기 입금가
                                                    </div>
                                                    <div>
                                                        <input type="number" data-type="currency"
                                                               name="supply_price_3_weeks[]"
                                                               wire:model.lazy="supply_price_3_weeks.{{ $key }}"
                                                               class="w-full appearance-none bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                           @error('supply_price_3_weeks.'.$key) border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                               placeholder="20박 21일 기준(부가세 포함)으로 입력해주세요." maxlength="15"
                                                               oninput="maxLengthCheck(this)"
                                                               autocomplete="off" style="z-index:-1;">
                                                        @error('supply_price_3_weeks.'.$key) <span
                                                            class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="w-full flex-1 my-4">
                                                    <div
                                                        class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('supply_price_2_weeks.'.$key) text-tm-c-ff7777 @enderror">
                                                        2주 살기 입금가
                                                    </div>
                                                    <div>
                                                        <input type="number" data-type="currency"
                                                               name="supply_price_2_weeks[]"
                                                               wire:model.lazy="supply_price_2_weeks.{{ $key }}"
                                                               class="w-full appearance-none bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                            @error('supply_price_2_weeks.'.$key) border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                               placeholder="13박 14일 기준(부가세 포함)으로 입력해주세요." maxlength="15"
                                                               oninput="maxLengthCheck(this)"
                                                               autocomplete="off" style="z-index:-1;">
                                                        @error('supply_price_2_weeks.'.$key) <span
                                                            class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="w-full flex-1 my-4 md:pr-2">
                                                    <div
                                                        class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('supply_price_1_weeks.'.$key) text-tm-c-ff7777 @enderror">
                                                        1주 살기 입금가
                                                    </div>
                                                    <div>
                                                        <input type="number" data-type="currency"
                                                               name="supply_price_1_weeks[]"
                                                               wire:model.lazy="supply_price_1_weeks.{{ $key }}"
                                                               class="w-full appearance-none bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                            @error('supply_price_1_weeks.'.$key) border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                               placeholder="6박 7일 기준(부가세 포함)으로 입력해주세요." maxlength="15"
                                                               oninput="maxLengthCheck(this)"
                                                               autocomplete="off" style="z-index:-1;">
                                                        @error('supply_price_1_weeks.'.$key) <span
                                                            class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="w-full flex-1 my-4">
                                                    <div
                                                        class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('supply_price_short_day.'.$key) text-tm-c-ff7777 @enderror">
                                                        단기 거주 입금가
                                                    </div>
                                                    <div>
                                                        <input type="text" data-type="currency"
                                                               name="supply_price_short_day[]"
                                                               wire:model.lazy="supply_price_short_day.{{ $key }}"
                                                               class="w-full appearance-none bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                            @error('supply_price_short_day.'.$key) border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                               placeholder="1박 2일 기준(부가세 포함)으로 입력해주세요."
                                                               maxlength="15" oninput="maxLengthCheck(this)"
                                                               autocomplete="off" style="z-index:-1;">
                                                        @error('supply_price_short_day.'.$key) <span
                                                            class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="flex justify-center py-4">
                                            @foreach($inputs as $key => $value)
                                                <div wire:click="room_page({{$key}})"
                                                     class="p-px mr-1 text-base sm:text-lg"
                                                     :class="{ 'font-bold text-tm-c-d7d3cf cursor-default' : index === '{{$key}}' , 'text-tm-c-979b9f cursor-pointer' : index !== '{{$key}}' }"
                                                >{{$key+1}}</div>
                                            @endforeach
                                        </div>
                                        <div class="space-y-8">
                                            <div class="space-y-2 sm:space-y-4">
                                                <div class="hidden md:block text-base">
                                                    <div class="text-tm-c-C1A485">
                                                        * 호텔에삶 기존 입점 호텔의 판매가(입금가+마크업)를 참고하셔서 ‘호텔에삶’에만 제공 가능한 경쟁력 있는 가격으로
                                                        제시 바랍니다.
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex flex-wrap block md:hidden space-y-2 text-xs sm:text-base text-tm-c-C1A485">
                                                    <div class="w-full">* 호텔에삶 기존 입점 호텔의 판매가를 참고하셔서</div>
                                                    <div class="pl-2 md:pl-0">‘호텔에삶’에만 제공 가능한 경쟁력 있는 가격으로 제시 바랍니다.</div>
                                                </div>
                                                @if(!empty($room_check))
                                                <div class="room_array_check AppSdGothicNeoR text-tm-c-ff7777">
                                                    * 객실 타입 {{$room_check}}번 입력을 완료해주세요.
                                                </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div
                                                    class="flex justify-center items-center bg-tm-c-C1A485 text-white rounded-sm cursor-pointer"
                                                    onclick="room_append()">
                                                    <div class="py-4 md:py-4 flex items-center">
                                                        <div class="pr-1 md:pr-2">
                                                            <img
                                                                src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-more-2.svg"
                                                                class="w-6 md:w-7" alt="">
                                                        </div>
                                                        <div class="md:text-lg">
                                                            객실 추가 입력하기
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="max-w-6xl mx-auto">
                            <div class="relative">
                                <div class="flex">
                                    <div class="AppSdGothicNeoR font-bold flex-0 text-lg md:text-2xl text-tm-c-C1A485">
                                        부가 정보
                                    </div>
                                    <div class="flex-1 px-4">
                                        <div class="h-full flex flex-wrap items-center">
                                            <div class="w-full h-px border-b-2 border-dotted border-tm-c-C1A485"></div>
                                        </div>
                                    </div>
                                </div>
                                <div>

                                    <div class="space-y-5">
                                        <div class="w-full flex-1 my-4">
                                            <div
                                                class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('amenities') text-tm-c-ff7777 @enderror">
                                                어메니티
                                            </div>
                                            <div>
                                                <input type="text" name="amenities" wire:model.lazy="amenities"
                                                       class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                   @error('amenities') border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                       placeholder="호텔에삶 입주 고객에게 제공 가능한 어메니티를 입력해주세요."
                                                       autocomplete="off" style="z-index:-1;">
                                                @error('amenities') <span
                                                    class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror

                                            </div>
                                        </div>

                                        <div class="w-full flex-1 my-4">
                                            <div
                                                class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('facilities') text-tm-c-ff7777 @enderror">
                                                부대시설
                                            </div>
                                            <div>
                                                <input type="text" name="facilities" wire:model.lazy="facilities"
                                                       class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                   @error('facilities') border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                       placeholder="부대시설을 입력해주세요."
                                                       autocomplete="off" style="z-index:-1;">
                                                @error('facilities') <span
                                                    class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        <div class="w-full flex-1 my-4">
                                            <div
                                                class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('benefit') text-tm-c-ff7777 @enderror">
                                                호텔에삶 Only 혜택
                                            </div>
                                            <div>
                                                <input type="text" name="benefit" wire:model.lazy="benefit"
                                                       class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                   @error('benefit') border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                       placeholder="ex. 밀키트 제공, 룸 업그레이드, 공용 주방 설치 등"
                                                       autocomplete="off" style="z-index:-1;">
                                                @error('benefit') <span
                                                    class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="max-w-6xl mx-auto space-y-4">
                            <div class="relative h-full">
                                <div class="flex">
                                    <div class="AppSdGothicNeoR font-bold flex-0 text-lg md:text-2xl text-tm-c-C1A485">
                                        담당자 정보
                                    </div>
                                    <div class="flex-1 px-4">
                                        <div class="h-full flex flex-wrap items-center">
                                            <div class="w-full h-px border-b-2 border-dotted border-tm-c-C1A485"></div>
                                        </div>
                                    </div>
                                </div>
                                <div>

                                    <div class="grid md:grid-cols-2">
                                        <div class="w-full flex-1 my-4 md:pr-2">
                                            <div
                                                class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('manager_name') text-tm-c-ff7777 @enderror">
                                                담당자 성명
                                            </div>
                                            <div>
                                                <input type="text" name="manager_name" wire:model.lazy="manager_name"
                                                       class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                   @error('manager_name') border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                       placeholder="담당자 성명을 입력해주세요." maxlength="20"
                                                       autocomplete="off" style="z-index:-1;">
                                                @error('manager_name') <span
                                                    class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="w-full flex-1 my-4">
                                            <div
                                                class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('manager_rank') text-tm-c-ff7777 @enderror">
                                                담당자 직급
                                            </div>
                                            <div>
                                                <input type="text" name="manager_rank" wire:model.lazy="manager_rank"
                                                       class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                   @error('manager_rank') border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                       placeholder="담당자 직급을 입력해주세요." maxlength="20"
                                                       autocomplete="off" style="z-index:-1;">
                                                @error('manager_rank') <span
                                                    class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="w-full flex-1 my-4 md:pr-2">
                                            <div
                                                class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('manager_email') text-tm-c-ff7777 @enderror">
                                                담당자 이메일
                                            </div>
                                            <div>
                                                <input type="email" name="manager_email" wire:model.lazy="manager_email"
                                                       class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                   @error('manager_email') border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                       placeholder="담당자 이메일을 입력해주세요." maxlength="100"
                                                       autocomplete="off" style="z-index:-1;">
                                                @error('manager_email') <span
                                                    class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="w-full flex-1 my-4">
                                            <div
                                                class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf @error('manager_hp') text-tm-c-ff7777 @enderror">
                                                담당자 연락처
                                            </div>
                                            <div>
                                                <input type="tel" name="manager_hp" wire:model.lazy="manager_hp"
                                                       class="manager_hp w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf
                                                    @error('manager_hp') border-tm-c-ff7777 placeholder-tm-c-ff7777 @enderror rounded-sm"
                                                       placeholder="담당자 연락처를 입력해주세요." maxlength="20"
                                                       autocomplete="off" style="z-index:-1;">
                                                @error('manager_hp') <span
                                                    class="AppSdGothicNeoR text-tm-c-ff7777 text-xs mt-2 block">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="max-w-6xl mx-auto space-y-2">
                            <div
                                class="bg-opacity-25 px-6 py-5 bg-opacity-20 space-y-3 AppSdGothicNeoR text-tm-c-C1A485 md:text-lg leading-6 rounded-sm"
                                style="background: linear-gradient(to right, rgba(193, 164, 133, .18) 0%, rgba(193, 164, 133, .09) 100%);">
                                <div style="text-indent: -.6em;margin-left: .6em;">
                                    * 현재 약 30개사 입점 대기중으로, 회신이 늦어질 수 있는 점 양해 바랍니다.
                                </div>
                                <div style="text-indent: -.6em;margin-left: .6em;">
                                    * 입점 신청 이후 미팅 시, 최종 결정권자가 필수로 동석해 주시기 바랍니다.
                                </div>
                                <div style="text-indent: -.6em;margin-left: .6em;">
                                    * 호텔 입점 승인 여부와 고객분들께 최고의 혜택을 제공하는지 검증하기 위한, 자사 임직원의 컴프 트라이얼은 필수 사항임을 알려드립니다.
                                </div>
                                <div style="text-indent: -.6em;margin-left: .6em;">
                                    * 입점 신청 순서와 무관하게 "내부 규정" 및 "살아보고 싶은 호텔을 알려주세요" 고객 반응에 따라 오픈 순서가 변경될 수 있습니다.
                                </div>
                            </div>
                        </div>

                        <div class="max-w-6xl mx-auto space-y-2">
                            <button onclick="form_check()" id="store_button" wire:loading.attr="disabled"
                            class="store_button w-full md:max-w-xs mx-auto flex justify-center items-center bg-tm-c-C1A485 py-4 md:py-6 rounded-sm cursor-pointer disabled:bg-tm-c-897763">
                                <div class="AppSdGothicNeoR text-lg md:text-xl text-white">
                                    입점 신청하기
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div
        x-data="noticesHandler()"
        class="fixed inset-0 flex flex-col-reverse items-center justify-start h-full w-full pb-20"
        @notice.window="add($event.detail)"
        style="pointer-events:none">
        <template x-for="notice of notices" :key="notice.id">
            <div
                x-show="visible.includes(notice)"
                x-transition:enter="transition ease-in duration-200"
                x-transition:enter-start="transform opacity-0 translate-y-2"
                x-transition:enter-end="transform opacity-100"
                x-transition:leave="transition ease-out duration-500"
                x-transition:leave-start="transform translate-x-0 opacity-100"
                x-transition:leave-end="transform translate-x-full opacity-0"
                @click="remove(notice.id)"
                class="rounded mb-4 mr-6 px-6 py-4 flex items-center justify-center text-white bg-black bg-opacity-75 shadow-lg text-base 2xs:text-lg sm:text-xl rounded-sm cursor-pointer"
                style="pointer-events:all"
                x-text="notice.text">
            </div>
        </template>
    </div>
</div>

<style type="text/css">
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .spinner {
        -webkit-animation: spin 2000ms linear infinite;
        -moz-animation: spin 2000ms linear infinite;
        -ms-animation: spin 2000ms linear infinite;
        animation: spin 2000ms linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg)
        }
        to {
            transform: rotate(1turn)
        }
    }
</style>
<script>
    // $("input[data-type='currency']").on({
    //    /* keyup: function() {
    //         formatNumber($(this));
    //     },*/
    //     blur: function() {
    //         $(this).val(formatNumber($(this).val()));
    //     }
    //
    // });
    function noticesHandler() {
        return {
            notices: [],
            visible: [],
            add(notice) {
                notice.id = Date.now()
                this.notices.push(notice)
                this.fire(notice.id)
            },
            fire(id) {
                this.visible.push(this.notices.find(notice => notice.id === id)) /* 실행한 notice id 체크 visible 활성화 전달*/
                const timeShown = 2000 * this.visible.length /* 현재 보이는 개수 * 2초 */
                setTimeout(() => {
                    this.remove(id);
                    if(this.notices.find(notice => notice.id === id).type === 'success'){
                        location.href = '{{route('enter.hotel')}}';
                    }
                }, timeShown)
            },
            remove(id) {
                const notice = this.visible.find(notice => notice.id === id)
                const index = this.visible.indexOf(notice)
                this.visible.splice(index, 1)
            },

        };
    }

    function form_check() {
        // var form = document.getElementById('enter_form');
        // var formData = new FormData($('form#enter_form')[0]);
        var array_check = [];
        $("input[name='type[]']").each(function (index, item) {
            if (item.value === null || item.value === '') {
                array_check[index] = 1;
            }
        });
        $("input[name='supply_price_month[]']").each(function (index, item) {
            if (item.value === null || item.value === '') {
                array_check[index] = 1;
            }
        });
        $("input[name='supply_price_4_weeks[]']").each(function (index, item) {
            if (item.value === null || item.value === '') {
                array_check[index] = 1;
            }
        });
        $("input[name='supply_price_3_weeks[]']").each(function (index, item) {
            if (item.value === null || item.value === '') {
                array_check[index] = 1;
            }
        });
        $("input[name='supply_price_2_weeks[]']").each(function (index, item) {
            if (item.value === null || item.value === '') {
                array_check[index] = 1;
            }
        });
        $("input[name='supply_price_1_weeks[]']").each(function (index, item) {
            if (item.value === null || item.value === '') {
                array_check[index] = 1;
            }
        });
        $("input[name='supply_price_short_day[]']").each(function (index, item) {
            if (item.value === null || item.value === '') {
                array_check[index] = 1;
            }
        });
        var room_array_check_visible = false;
        var room_check_num_html = '';
        array_check.forEach(function (element, index, array) {
            if (element >= 1) {
                room_check_num_html += (index + 1) + ',';
                room_array_check_visible=true;
            }
        });
        if (room_array_check_visible) {
            Livewire.emit('roomArrayCheckEvent',room_check_num_html.substring(0, room_check_num_html.length - 1));
        }
    }

    function maxLengthCheck(object) {
        if (object.value.length > object.maxLength) {
            object.value = object.value.slice(0, object.maxLength);
        }
    }

    function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatCurrency(input, blur) {
        var input_val = input.val();
        if (input_val === "") {
            return;
        }

        var original_len = input_val.length;
        var caret_pos = input.prop("selectionStart");

        if (input_val.indexOf(".") >= 0) {
            var decimal_pos = input_val.indexOf(".");
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);
            left_side = formatNumber(left_side);
            right_side = formatNumber(right_side);
            if (blur === "blur") {
                right_side += "00";
            }
            right_side = right_side.substring(0, 2);
            input_val = "" + left_side + "." + right_side;
        } else {
            input_val = formatNumber(input_val);
            input_val = "" + input_val;
            if (blur === "blur") {
                input_val += ".00";
            }
        }
        input.val(input_val);
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }

</script>
