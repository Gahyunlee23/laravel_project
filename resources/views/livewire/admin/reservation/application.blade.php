<div class="AppSdGothicNeoR" x-data="{ tab : 'modify'}">
    @inject('formatter', 'App\Formatter')
    <div class="flex justify-center">
        <div class="flex space-x-4">
            <div @click=" tab = 'modify'; "
                 wire:click="$emit('tabChangeEvent','modify')"
                 class="flex-1 text-2xl cursor-pointer"
                 :class="{
                    'text-white font-bold border-b-2 border-b-solid border-b-white' : tab === 'modify',
                    'text-gray-700' : tab !== 'modify'
                }">
                변경 신청 내역
            </div>
            <div @click=" tab = 'cancel'; "
                 wire:click="$emit('tabChangeEvent','cancel')"
                 class="flex-1 text-2xl cursor-pointer"
                 :class="{
                    'text-white font-bold border-b-2 border-b-solid border-b-white' : tab === 'cancel',
                    'text-gray-700' : tab !== 'cancel'
                }">
                취소 신청 내역
            </div>
        </div>
    </div>

    <div class="px-2 py-8">

        <div x-show="tab === 'modify'" x-cloak>
            @isset($list)
                <div class="space-y-4 bg-tm-c-ED divide-dashed divide-y-2 divide-tm-c-30373F">
                @foreach ($list as $item)
                    <div class="py-6 px-4 space-y-2">
                        <div class="flex items-center">
                            <div class="text-2xl text-black font-bold">
                                {{$item->user->name}}
                                <span class="text-lg">&nbsp;{{$item->user->id}}</span>
                            </div>
                            <div class="ml-auto">
<!--                                진행 상태 1=신청 2=문의중 3=확정 4=미확정(재문의) 0=변경 취소 -->
                                <div class="py-1 px-4 bg-tm-c-C1A485 text-white rounded-md">
                                    변경 <x-switch.reservation-modify.process process="{{$item->process}}"></x-switch.reservation-modify.process>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <div class="p-1 bg-gray-100">
                                <div class="font-bold">
                                    호텔
                                </div>
                                <div>
                                    {{ $item->reservation->hotel->option->title ?? '정보없음'}}
                                </div>
                                @isset($item->reservation->room)
                                <div class="font-bold">
                                    상품 정보
                                </div>
                                <div>
                                    {{ $item->reservation->room->title}}
                                    ({{ $item->reservation->room->nights}}박
                                    {{ $item->reservation->room->days}}일)
                                     Coupon:{{ $item->reservation->room->coupon ?? '없음'}}
                                </div>
                                @endisset
                                @isset($item->reservation->roomType)
                                <div class="font-bold">
                                    입주 예정 룸 정보
                                </div>
                                <div>
                                    {{ $item->reservation->roomType->name ?? '정보없음'}}
                                    {{ $item->reservation->roomTypeUpgrade->name ?? '업그레이드 없음'}}
                                </div>
                                @endisset
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="p-1 bg-gray-100">
                                <div class="font-bold">
                                    신청 시간
                                </div>
                                <div>
                                    {{ $formatter->carbonFormat($item->send_dt, 'Y년 m월 d일(요일) H시 i분') }}
                                </div>
                            </div>
                            <div class="p-1 bg-gray-100">
                                <div class="font-bold">
                                    이전 기간
                                </div>
                                <div>
                                    @if($item->reservation->type === 'month')
                                        {{ $formatter->carbonFormat($item->before_start_dt, 'Y년 m월 d일(요일) H시 i분') }}
                                        ~
                                        {{ $formatter->carbonFormat($item->before_end_dt, 'Y년 m월 d일(요일) H시 i분') }}
                                    @else
                                        {{ $formatter->carbonFormat($item->before_start_dt, 'Y년 m월 d일(요일) H시 i분') }}
                                    @endif
                                </div>
                            </div>
                            <div class="p-1 bg-gray-100">
                                <div class="font-bold">
                                    변경 신청 기간
                                </div>
                                <div>
                                    @if($item->reservation->type === 'month')
                                        {{ $formatter->carbonFormat($item->start_dt, 'Y년 m월 d일(요일) H시 i분') }}
                                        ~
                                        {{ $formatter->carbonFormat($item->end_dt, 'Y년 m월 d일(요일) H시 i분') }}
                                    @else
                                        {{ $formatter->carbonFormat($item->start_dt, 'Y년 m월 d일(요일) H시 i분') }}
                                    @endif
                                </div>
                            </div>
                            <div class="pt-2">
                                <button
                                    class="py-1 px-2 bg-blue-500 text-white rounded-sm hover:bg-blue-600"
                                    onclick="location.href='{{route('admin.reservation.application.show', ['reservation'=> $item->reservation_id])}}'">
                                    상세보기
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endisset
        </div>

        <div x-show="tab === 'cancel'" x-cloak>
            @isset($list)
                <div class="space-y-4 bg-tm-c-ED divide-dashed divide-y-2 divide-tm-c-30373F">
                @foreach ($list as $item)
                    <div class="py-6 px-4 space-y-2">
                        <div class="flex items-center">
                            <div class="text-2xl text-black font-bold">
                                {{$item->user->name}}
                                <span class="text-lg">&nbsp;{{$item->user->id}}</span>
                            </div>
                            <div class="ml-auto">
                                <div class="py-1 px-4 bg-tm-c-C1A485 text-white rounded-md">
                                    취소 <x-switch.reservation-cancel.process process="{{$item->process}}"></x-switch.reservation-cancel.process>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <div class="p-1 bg-gray-100">
                                <div class="font-bold">
                                    호텔
                                </div>
                                <div>
                                    {{ $item->reservation->hotel->option->title ?? '정보없음'}}
                                </div>
                                @isset($item->reservation->room)
                                    <div class="font-bold">
                                        상품 정보
                                    </div>
                                    <div>
                                        {{ $item->reservation->room->title}}
                                        ({{ $item->reservation->room->nights}}박
                                        {{ $item->reservation->room->days}}일)
                                        Coupon:{{ $item->reservation->room->coupon ?? '없음'}}
                                    </div>
                                @endisset
                                @isset($item->reservation->roomType)
                                    <div class="font-bold">
                                        입주 예정 룸 정보
                                    </div>
                                    <div>
                                        {{ $item->reservation->roomType->name ?? '정보없음'}}
                                        {{ $item->reservation->roomTypeUpgrade->name ?? '업그레이드 없음'}}
                                    </div>
                                @endisset
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="p-1 bg-gray-100">
                                <div class="font-bold">
                                    신청 시간
                                </div>
                                <div>
                                    {{ $formatter->carbonFormat($item->send_dt, 'Y년 m월 d일(요일) H시 i분') }}
                                </div>
                            </div>

                            <div class="pt-2">
                                <button
                                    class="py-1 px-2 bg-blue-500 text-white rounded-sm hover:bg-blue-600"
                                    onclick="location.href='{{route('admin.reservation.application.show', ['reservation'=> $item->reservation_id])}}'">
                                    상세보기
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endisset
        </div>

        <div wire:loading class="bg-tm-c-ED w-full py-6">
            <livewire:form.loading
                type="circle-spine"
                borderTopColor="#c1a485"
                loadingColorClass="text-tm-c-30373F"></livewire:form.loading>
        </div>

        @if(empty($list) || (isset($list) && $list->count() === 0))
            <div class="bg-tm-c-ED w-full py-6">
                <livewire:form.loading
                    type="not-lists"
                    iconColorClass="text-tm-c-30373F"
                    loadingText="정보 없음"
                    loadingColorClass="text-tm-c-30373F"
                ></livewire:form.loading>
            </div>
        @endif
    </div>
</div>
