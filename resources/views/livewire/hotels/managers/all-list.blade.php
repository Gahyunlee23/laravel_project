@inject('formatter', 'App\Formatter')
<div x-data="{ showModal : false}">
    <div class="z-20 relative">
        <div class="flex flex-wrap space-y-8">

            <div class="w-full flex">
                <div class="flex-1 relative pr-2 border border-solid border-white rounded-sm">
                    <div class="h-full absolute right-0 mr-2 pointer-events-none">
                        <div class="h-full flex items-center">
                            <div class="text-white z-index-10">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25">
                                    <g fill="none" fill-rule="evenodd">
                                        <g>
                                            <path fill="#30373F" d="M0 0H1920V1249H0z" transform="translate(-918 -359)"/>
                                            <g>
                                                <g transform="translate(-918 -359) translate(360 167) translate(0 177.5)">
                                                    <rect width="597" height="51" x=".5" y="1" stroke="#FFF" rx="2"/>
                                                    <g>
                                                        <g>
                                                            <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(558 15)"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <label for="flitter">
                        <select class="AppSdGothicNeoR text-white w-full h-full px-2 py-4 bg-tm-c-30373F appearance-none box-shadow-none outline-none"
                                wire:model="flitter" wire:change="flitterChange">
                            <option value="">모든 데이터</option>
                            @if($list==='all-list')
                                <option value="주문">주문 완료 리스트</option>
                                <option value="확정 필요">확정 필요 리스트</option>
                                <option value="확정">확정 리스트</option>
                                <option value="예정">예정 리스트</option>
                                <option value="취소">취소 리스트</option>
                                <option value="완료">투어&퇴실 완료 리스트</option>
                            @elseif($list === 'month-list')
                                <option value="주문">주문 완료 리스트</option>
                                <option value="확정 필요">입주 확정 필요 리스트</option>
                                <option value="확정">입주 확정 리스트</option>
                                <option value="예정">입주 예정 리스트</option>
                                <option value="입주 중">입주 중 리스트</option>
                                <option value="취소">입주 취소 리스트</option>
                                <option value="완료">퇴실 완료 리스트</option>
                            @elseif($list === 'tour-list')
                                <option value="주문">주문 완료 리스트</option>
                                <option value="확정 필요">투어 확정 필요 리스트</option>
                                <option value="확정">투어 확정 리스트</option>
                                <option value="예정">투어 예정 리스트</option>
                                <option value="투어 노쇼">투어 노쇼 리스트</option>
                                <option value="취소">투어 취소 리스트</option>
                                <option value="완료">투어 완료 리스트</option>
                            @endif
                        </select>
                    </label>
                </div>

                <div class="flex-1 pl-2 flex flex-wrap w-max-content">
                    <div class="flex-1 relative px-1 border border-solid border-white rounded-sm">

                        <div class="h-full absolute right-0 mr-2 pointer-events-none">
                            <div class="h-full flex items-center">
                                <div class="text-white z-index-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25">
                                        <g fill="none" fill-rule="evenodd">
                                            <g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g transform="translate(-1518 -359) translate(360 167) translate(0 178.5) translate(610) translate(548 14)">
                                                                <circle cx="10" cy="10" r="7.5" stroke="#FFF"/>
                                                                <path fill="#FFF" d="M18.389 13.889H19.389V23.889H18.389z" transform="rotate(-45 18.89 18.89)"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <input type="text" wire:model="search"
                               placeholder="고객명으로 검색"
                               class="AppSdGothicNeoR text-white placeholder-tm-c-979b9f w-full py-4 px-2 bg-tm-c-30373F appearance-none box-shadow-none outline-none"
                               style="min-width: 120px;">
                    </div>
                    @if(!is_null($search) && $order_names && $order_names->count()>=1)
                        <div class="w-full relative">
                            <div class="z-20 absolute w-full mt-2 rounded-sm h-40 overflow-y-auto bg-tm-c-30373F border border-solid border-tm-c-d7d3cf divide-y divide-tm-c-ED">
                                @foreach ($order_names as $order_name)
                                    <div
                                        class="AppSdGothicNeoR bg-tm-c-30373F mr-1 px-2 py-3 rounded-sm cursor-pointer text-tm-c-ED text-lg hover:bg-tm-c-ED hover:bg-opacity-25"
                                        :class="{'bg-tm-c-C1A485 bg-opacity-25' : '{{$search}}' === '{{$order_name}}'}"
                                        wire:click="searchExampleClick('{{$loop->index}}')">{{$order_name ?? '오류'}}</div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if($list==='month-list')
            <div class="w-full flex flex-wrap">
                <div class="flex space-x-1 items-center w-full">
                    <div class="relative h-full px-1 border border-solid border-white rounded-sm">
                        <div class="h-full absolute right-0 mr-2 pointer-events-none">
                            <div class="h-full flex items-center">
                                <div class="text-white z-index-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4" viewBox="0 0 24 25">
                                        <g fill="none" fill-rule="evenodd">
                                            <g>
                                                <path fill="#30373F" d="M0 0H1920V1249H0z" transform="translate(-918 -359)"/>
                                                <g>
                                                    <g transform="translate(-918 -359) translate(360 167) translate(0 177.5)">
                                                        <rect width="597" height="51" x=".5" y="1" stroke="#FFF" rx="2"/>
                                                        <g>
                                                            <g>
                                                                <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(558 15)"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <label for="date_option">
                            <select id="date_option" wire:model="date_option"
                                    style="min-width: 80px;"
                                    class="AppSdGothicNeoR text-white w-full h-full px-2 bg-tm-c-30373F appearance-none box-shadow-none outline-none">
                                <option value="confirmation">확정</option>
                                <option value="payment">결제</option>
                            </select>
                        </label>
                    </div>
                    <div class="flex flex-1">
                        <div class="w-full relative px-1 border border-solid border-white rounded-sm">
                            <label>
                                @if($date_option === 'confirmation')
                                    <div class="w-full absolute -mt-5 text-center text-white">입주</div>
                                @endif
                                    <input type="date" wire:model="flitter_date_start"
                                           class="AppSdGothicNeoR text-white w-full h-full px-2 py-3 bg-tm-c-30373F appearance-none box-shadow-none outline-none">
{{--                                <div class="relative" x-data="app()" x-init="[initDate(), getNoOfDays()]">--}}
{{--                                    <input type="date" wire:model="flitter_date_start" id="flitter_date_start" x-on:click="showDatepicker = !showDatepicker"--}}
{{--                                           class="AppSdGothicNeoR text-white w-full h-full px-2 py-3 bg-tm-c-30373F appearance-none box-shadow-none outline-none">--}}

{{--                                    <div class="absolute top-0 right-0 h-full">--}}
{{--                                        <div class="h-full flex items-center">--}}
{{--                                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />--}}
{{--                                            </svg>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <livewire:form.input.date-picker--}}
{{--                                        model="flitter_date_start"--}}
{{--                                    ></livewire:form.input.date-picker>--}}
{{--                                </div>--}}
                            </label>
                        </div>
                    </div>

                    @if($date_option === 'confirmation')
                        <div class="flex flex-1">
                            <div class="w-full relative px-1 border border-solid border-white rounded-sm">
                            <label>
                                <div class="w-full absolute -mt-5 text-center text-white">퇴실</div>

                                <input type="date" wire:model="flitter_date_end"
                                       class="AppSdGothicNeoR text-white w-full h-full px-2 py-3 bg-tm-c-30373F appearance-none box-shadow-none outline-none">
                            </label>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    @if(Session::has('result'))
    <div class="py-4 px-2 mt-6 bg-tm-c-0D5E49 text-white rounded-sm leading-none">
        {{ Session::pull('result') ?? '처리 오류 입니다.' }}
    </div>
    @endif
    <div class="mt-8 overflow-x-auto overflow-y-visible h-full rounded-t-sm px-4 bg-tm-c-ED">
        <table class="table-auto w-full AppSdGothicNeoR">
            <thead>
            <tr>
                <td class="px-4 py-3 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">종류</td>
                @if(auth()->check() && auth()->user()->hasAnyRole('개발'))
                <td class="px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">ID</td>
                @endif
                <td class="px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">고객 상태</td>
                <td class="px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">고객 성명</td>
                <td class="px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">연락처</td>
{{--            <td class="px-10 py-3 whitespace-pre text-center">상태</td>--}}
                <td class="w-20 text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">입주/퇴실 기간</td>
                <td class="px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F" wire:click="sortBy('updated_at')">최근 변경 @include('includes._sort-icon', ['field' => 'updated_at'])</td>
                <td class="px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">상세 정보</td>
{{--                <td class="px-2 pt-3 pb-2 whitespace-pre text-tm-c-30373F AppSdGothicNeoR font-bold text-center border-b border-solid border-tm-c-30373F">진행 현황</td>--}}
            </tr>
            </thead>
            @if(isset($reservations) && $reservations->count() >= 1)
                @foreach ($reservations as $reservation)
                    <tbody>
                    <tr>
                        <td class="px-2 py-3 whitespace-pre text-center font-bold"><x-form.reservation.type :type="$reservation->type"></x-form.reservation.type></td>
                        @if(auth()->check() && auth()->user()->hasAnyRole('개발'))
                            <td class="px-2 py-3 whitespace-pre text-center">{{$reservation->id}}</td>
                        @endif
                        <td class="py-3 text-center">
                            <x-hotels.status-box :key="$reservation->id" :reservation="$reservation"></x-hotels.status-box>
                        </td>
                        <td class="px-2 py-3 #whitespace-pre text-center font-medium text-tm-c-30373F">{{$reservation->order_name}}</td>
                        <td class="px-2 py-3 text-center font-medium text-tm-c-30373F">
                            @if(isset($reservation->confirmation) && $reservation->confirmation->status === '1' && ( $reservation->order_status !== '0' && $reservation->order_status !== '10' && $reservation->order_status !== '11'))
                                @if($reservation->order_hp !== '' && $reservation->order_hp!==null)
                                    <div>{{phone($reservation->order_hp, 'kr')}}</div>
                                @else
                                <div>정보 없음</div>
                                @endif
                            @else
                                <div class="font-bold text-sm whitespace-pre">확정 후 확인 가능</div>
                            @endif
                        </td>
{{--                        <td class="px-2 py-3 text-center"><x-form.reservation.status-observer :reservation="$reservation"></x-form.reservation.status-observer></td>--}}
                        @if(isset($reservation->confirmation) && $reservation->confirmation->status === '1')
                            @if($reservation->type === 'month')
                                <td class="px-2 py-3 text-center space-y-1">
                                    <div class="w-max-content whitespace-pre flex items-center justify-start space-x-2"><div class="w-8 text-sm text-tm-c-979b9f border border-solid border-tm-c-979b9f rounded-full leading-5">in</div><div class="text-tm-c-30373F">{{$formatter->carbonFormat($reservation->confirmation->start_dt, 'Y년 m월 d일(요일) H시 i분')}}</div></div>
                                    <div class="w-max-content whitespace-pre flex items-center justify-start space-x-2"><div class="w-8 text-sm text-tm-c-979b9f border border-solid border-tm-c-979b9f rounded-full leading-5">out</div><div class="text-tm-c-30373F">{{$formatter->carbonFormat($reservation->confirmation->end_dt, 'Y년 m월 d일(요일) H시 i분')}}</div></div>
                                </td>
                            @else
                                <td class="px-2 py-3 text-center">
                                    <div class="w-max-content whitespace-pre flex items-center justify-start space-x-2"><div class="w-8 text-sm text-tm-c-979b9f border border-solid border-tm-c-979b9f rounded-full leading-5">확정</div><div class="text-tm-c-30373F">{{$formatter->carbonFormat($reservation->confirmation->start_dt, 'Y년 m월 d일(요일) H시 i분')}}</div></div>
                                </td>
                            @endif
                        @else
                        @if(!is_null($reservation->order_desired_dt))
                            <td class="px-2 py-3 text-center">
                                <div class="w-max-content whitespace-pre flex items-center justify-start space-x-2"><div class="w-8 text-sm text-tm-c-979b9f border border-solid border-tm-c-979b9f rounded-full leading-5">희망</div><div class="text-tm-c-30373F">{{$formatter->carbonFormat($reservation->order_desired_dt, 'Y년 m월 d일(요일) H시 i분')}}</div></div>
                            </td>
                        @else
                            <td class="px-2 py-3 text-center">
                                <div class="w-max-content whitespace-pre flex items-center justify-start space-x-2"><div class="w-8 text-sm text-tm-c-979b9f border border-solid border-tm-c-979b9f rounded-full leading-5">희망</div><div class="text-tm-c-30373F">{{$formatter->carbonFormat($reservation->order_desired_dt, 'Y년 m월 d일(요일) H시 i분')}}</div></div>
                            </td>
                        @endif
                        @endif
                        @if(!is_null($reservation->updated_at))
                            <td class="px-2 py-3 whitespace-pre text-center text-tm-c-30373F">{{$formatter->carbonFormat($reservation->updated_at, 'Y년 m월 d일 H시 i분')}}</td>
                        @else
                            <td class="px-2 py-3 whitespace-pre text-center text-tm-c-30373F">{{$reservation->updated_at ?? '정보없음'}}</td>
                        @endif
                        <td class="px-2 py-3 text-center">
                            <div class="underline font-bold text-tm-c-30373F cursor-pointer whitespace-pre"
                                 @click="showModal=true;$('body').css('overflow','hidden');"
                                wire:click="openDetailModal({{$reservation->id}})">상세 정보 보기</div>
                        </td>
{{--                        <td class="px-2 py-3 text-center">--}}
{{--                            <div class="flex items-center justify-center w-full">--}}
{{--                                <label for="toggle-{{$loop->index}}" class="flex items-center cursor-pointer">--}}
{{--                                    <div class="relative">--}}
{{--                                        @if($reservation->type === 'month')--}}
{{--                                            <input type="checkbox" id="toggle-{{$loop->index}}" class="sr-only" wire:change=""--}}
{{--                                                @if(isset($reservation->confirmation) && $reservation->confirmation->status === '1') checked @endif>--}}
{{--                                            <div class="checkbox-bg block bg-tm-c-d7d3cf w-20 h-8 rounded-full">--}}
{{--                                                <div class="select-none h-full flex items-center justify-center text-sm text-gray-500 ml-4 font-medium">--}}
{{--                                                    @if(isset($reservation->confirmation) && $reservation->confirmation->status === '1')--}}
{{--                                                        <div class="leading-relaxed">확정</div>--}}
{{--                                                    @else--}}
{{--                                                        <div class="leading-relaxed">취소</div>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="checkbox-dot absolute bg-white w-6 h-6 rounded-full transition"--}}
{{--                                                 style="top: .25rem;left: .25rem;"></div>--}}
{{--                                        @else--}}
{{--                                            @if(isset($reservation->confirmation))--}}
{{--                                                @if($reservation->confirmation->status === '1' && $reservation->confirmation->start_dt > now())--}}
{{--                                                    투어 완료--}}
{{--                                                @else--}}
{{--                                                    취소--}}
{{--                                                @endif--}}
{{--                                            @else--}}
{{--                                                미확정--}}
{{--                                            @endif--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </td>--}}
                    </tr>
                    </tbody>
                @endforeach
            @endif
        </table>
    </div>

    <div class="px-2 bg-tm-c-ED border-t border-solid border-tm-c-979b9f rounded-b-sm">
        @if(isset($reservations) && $reservations->count()===0)
            <div class="w-full text-xl text-center">
                <div class="py-2">
                    데이터 없음
                </div>
            </div>
        @elseif(isset($reservations) && $reservations->count()>=1)
            <div class="w-full">
                <div class="py-2">
                    {{$reservations->links('vendor.livewire.tailwind.center-paginate')}}
                </div>
            </div>
        @endif
    </div>

    <div class="z-30 DetailModal fixed w-full h-full top-0 left-0" x-show.transition.in.duration.200ms.out.duration.400ms="showModal" x-cloak>
        @if(isset($detail_reservation))
        <div class="z-20 absolute w-full bg-black bg-opacity-75">
            <div class="flex justify-center h-screen items-center antialiased">
                <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-md shadow-xl bg-tm-c-ED"
                     x-show.transition.in.duration.1500ms.out.duration.200ms="showModal"
                     @click.away="showModal=false;$('body').css('overflow','visible');">

{{--                    <div--}}
{{--                        class="flex flex-row justify-end pt-6 pr-6 rounded-tl-lg rounded-tr-lg"--}}
{{--                    >--}}
{{--                        <svg--}}
{{--                            class="w-6 h-6 cursor-pointer"--}}
{{--                            fill="none"--}}
{{--                            stroke="currentColor"--}}
{{--                            viewBox="0 0 24 24"--}}
{{--                            xmlns="http://www.w3.org/2000/svg"--}}
{{--                            @click="showModal=false;$('body').css('overflow','visible');"--}}
{{--                        >--}}
{{--                            <path--}}
{{--                                stroke-linecap="round"--}}
{{--                                stroke-linejoin="round"--}}
{{--                                stroke-width="2"--}}
{{--                                d="M6 18L18 6M6 6l12 12"--}}
{{--                            ></path>--}}
{{--                        </svg>--}}
{{--                    </div>--}}

                    <div class="flex flex-row items-center justify-center pt-8 pb-4">
                        <p class="JeJuMyeongJo font-semibold text-xl sm:text-2xl md:text-3xl text-tm-c-30373F">주문 정보</p>
                    </div>

                    <div class="flex flex-col px-4 sm:px-6 md:px-10 divide-y-2 divide-black divide-dotted">

                        <div class="flex flex-row items-center justify-center text-lg pb-4">
                            @if($detail_reservation->type ==='tour')
                                <p class="AppSdGothicNeoR text-tm-c-da5542">투어 정보</p>
                            @elseif($detail_reservation->type ==='month')
                                <p class="AppSdGothicNeoR text-tm-c-0D5E49">입주 정보</p>
                            @endif
                        </div>

                        <div class="flex py-4">
                            <table class="w-full table-auto">
                                <tr>
                                    <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">고객 성명</td>
                                    <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">{{$detail_reservation->order_name ?? ''}}</td>
                                    <td class="py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">연락처</td>
                                    <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                        @if(isset($detail_reservation->confirmation) && $detail_reservation->confirmation->status === '1' && ( $detail_reservation->order_status !== '0' && $detail_reservation->order_status !== '10' && $detail_reservation->order_status !== '11'))
                                            @if($detail_reservation->order_hp !== '' && $detail_reservation->order_hp!==null)
                                                {{phone($detail_reservation->order_hp, 'kr')}}
                                            @else
                                                정보 없음
                                            @endif
                                        @else
                                            확정 후 확인 가능
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">주문일자/시간</td>
                                    <td class="py-2 AppSdGothicNeoR text-tm-c-30373F" colspan="3">
                                        {{$formatter->carbonFormat($detail_reservation->created_at, 'Y년 m월 d일(요일) H시 i분')}}
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="py-4">
                            @if($detail_reservation->type ==='tour')
                                <table class="w-full table-auto">
                                    <tr>
                                        <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">호텔명</td>
                                        <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">{{$detail_reservation->hotel->option->title ?? '정보없음'}}</td>
                                    </tr>
                                </table>
                            @elseif($detail_reservation->type ==='month')
                                <table class="w-full table-auto">
                                    <tr>
                                        <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">호텔명</td>
                                        <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">{{$detail_reservation->hotel->option->title ?? '정보없음'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">옵션명</td>
                                        <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">{{$detail_reservation->payment->goods_option ?? '정보없음'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">룸타입</td>
                                        <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                            @if(isset($detail_reservation->roomTypeUpgrade))
                                                <p class="line-through text-tm-c-979b9f">{{$detail_reservation->roomType->name ?? '정보없음'}}</p> >> {{$detail_reservation->roomTypeUpgrade->name ?? '정보없음'}}
                                            @else
                                                {{$detail_reservation->roomType->name ?? '정보없음'}}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            @endif
                        </div>

                        <div class="py-4">
                            @if($detail_reservation->type ==='tour')
                                <table class="w-full table-auto">
                                    <tr>
                                        <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">
                                            투어
                                            @if(isset($detail_reservation->confirmation) && $detail_reservation->confirmation->status === '1')
                                                확정일
                                            @else
                                                희망일
                                            @endif
                                        </td>
                                        <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                            @if(isset($detail_reservation->confirmation) && $detail_reservation->confirmation->status === '1'
                                                && $detail_reservation->confirmation->start_dt !=='' && $detail_reservation->confirmation->start_dt !==null)
                                                {{$formatter->carbonFormat($detail_reservation->confirmation->start_dt, 'Y년 m월 d일(요일) H시 i분')}}
                                            @else
                                                {{$formatter->carbonFormat($detail_reservation->order_desired_dt, 'Y년 m월 d일(요일) H시 i분')}}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            @elseif($detail_reservation->type ==='month')
                                <table class="w-full table-auto">
                                    <tr>
                                        <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">
                                            입주
                                            @if(isset($detail_reservation->confirmation) && $detail_reservation->confirmation->status === '1')
                                                확정일
                                            @else
                                                희망일
                                            @endif
                                        </td>
                                        <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                            @if(isset($detail_reservation->confirmation) && $detail_reservation->confirmation->status === '1'
                                                && $detail_reservation->confirmation->start_dt !=='' && $detail_reservation->confirmation->start_dt !==null)
                                                {{$formatter->carbonFormat($detail_reservation->confirmation->start_dt, 'Y년 m월 d일(요일) H시 i분')}}
                                            @else
                                                {{$formatter->carbonFormat($detail_reservation->order_desired_dt, 'Y년 m월 d일(요일) H시 i분')}}
                                            @endif
                                        </td>
                                    </tr>
                                    @if(isset($detail_reservation->confirmation) && $detail_reservation->confirmation->status === '1')
                                        <tr>
                                            <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">
                                                퇴실 확정일
                                            </td>
                                            <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                                {{$formatter->carbonFormat($detail_reservation->confirmation->end_dt, 'Y년 m월 d일(요일) H시 i분')}}
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            @endif
                        </div>
                        @if($detail_reservation->type ==='month'
                            && isset($detail_reservation->confirmation) && $detail_reservation->confirmation->status === '1'
                            && $detail_reservation->confirmations->count()>=2)
                            <div class="py-4">
                                <table class="w-full table-auto">
                                    <tr>
                                        <td class="AppSdGothicNeoR font-bold text-tm-c-30373F" colspan="4">이전 확정 정보</td>
                                    </tr>
                                    @foreach ($detail_reservation->confirmations->reverse() as $confirmation)
                                        @continue($loop->index ===0)
                                        <tr>
                                            <td class="py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">
                                                입주
                                            </td>
                                            <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                                {{$formatter->carbonFormat($confirmation->start_dt, 'Y년 m월 d일(요일) H시 i분')}}
                                            </td>
                                            <td class="py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">
                                                퇴실
                                            </td>
                                            <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                                {{$formatter->carbonFormat($confirmation->end_dt, 'Y년 m월 d일(요일) H시 i분')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endif

                        <div class="flex flex-row items-center justify-end pt-4 pb-8 rounded-bl-lg rounded-br-lg">
                            <button class="w-full h-12 text-white bg-tm-c-C1A485" @click="showModal=false;$('body').css('overflow','visible');">
                                닫기
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif
    </div>

    <style>
        input[type="date"]::-webkit-calendar-picker-indicator {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 24 24"><path fill="%23bbbbbb" d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V8h16v13z"/></svg>');
        }
        /*::-webkit-calendar-picker-indicator {*/
        /*    !*padding-left: 50%;*!*/
        /*}*/
        /*input[type="date"]::-webkit-inner-spin-button,*/
        /*input[type="date"]::-webkit-calendar-picker-indicator {*/
        /*    display: none;*/
        /*    -webkit-appearance: none;*/
        /*}*/
    </style>

</div>
