@inject('formatter', 'App\Formatter')
<div x-data="DataInit()">

    <div class="z-20 relative">
        <div class="flex flex-wrap">

            <div class="py-7 w-full flex flex-row items-center justify-start text-lg">
                <div class="px-2" wire:click="settlementsStatus('1')" :class="{ 'text-white' : '{{$status}}' === '전체', 'cursor-pointer' : '{{$status}}' !== '전체'}">전체</div>
                <div class="px-2" wire:click="settlementsStatus('2')" :class="{ 'text-white' : '{{$status}}' === '정산 완료', 'cursor-pointer' : '{{$status}}' !== '정산 완료'}">정산 완료</div>
                <div class="px-2" wire:click="settlementsStatus('3')" :class="{ 'text-white' : '{{$status}}' === '정산 예정', 'cursor-pointer' : '{{$status}}' !== '정산 예정'}">정산 예정</div>
            </div>

            <div class="flex-1 flex flex-wrap w-max-content">
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
    </div>

    <div class="mt-8 overflow-x-auto overflow-y-visible h-full rounded-t-sm px-4 bg-tm-c-ED">
        <table class="table-auto w-full AppSdGothicNeoR">
            <thead>
            <tr>
                <td class="px-4 py-3 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">상태</td>
                @if(auth()->check() && auth()->user()->hasAnyRole('개발'))
                    <td class="px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">ID</td>
                @endif
                <td class="px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">고객 성명</td>
                <td class="px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">정산 예정금</td>
                <td class="w-20 px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">입주/퇴실일</td>
                <td class="px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F" wire:click="sortBy('calculate_dt')">정산 완료 일자 @include('includes._sort-icon', ['field' => 'calculate_dt'])</td>
                <td class="px-2 whitespace-pre text-tm-c-30373F font-medium text-center border-b border-solid border-tm-c-30373F">상세 정보</td>
            </tr>
            </thead>
            @if(isset($settlements) && $settlements->count() >= 1)
                @foreach ($settlements as $settlement)
                    <tbody>
                    <tr>
                        <td class="px-2 py-3 text-center font-medium">
                            @if($settlement->calculate_yn === 'Y')
                                <div class="whitespace-pre text-tm-c-30373F">정산 완료</div>
                            @else
                                <div class="whitespace-pre text-tm-c-da5542">정산 예정</div>
                            @endif
                        </td>
                        @if(auth()->check() && auth()->user()->hasAnyRole('개발'))
                            <td class="px-2 py-3 whitespace-pre text-center">{{$settlement->id}}</td>
                        @endif
                        <td class="px-2 py-3 #whitespace-pre text-center font-medium text-tm-c-30373F">{{$settlement->reservation->order_name}}</td>
                        <td class="px-2 py-3 #whitespace-pre text-center font-medium text-tm-c-30373F">{{number_format($settlement->calculate)}}원</td>
                        @if(isset($settlement->reservation->confirmation) && $settlement->reservation->confirmation->status === '1')
                            @if($settlement->reservation->type === 'month')
                                <td class="px-2 py-3 text-center space-y-1">
                                    <div class="whitespace-pre flex items-center space-x-2"><div class="w-8 text-sm text-tm-c-979b9f border border-solid border-tm-c-979b9f rounded-full leading-5">in</div><div class="text-tm-c-30373F">{{$formatter->carbonFormat($settlement->reservation->confirmation->start_dt, 'Y년 m월 d일(요일) H시 i분')}}</div></div>
                                    <div class="whitespace-pre flex items-center space-x-2"><div class="w-8 text-sm text-tm-c-979b9f border border-solid border-tm-c-979b9f rounded-full leading-5">out</div><div class="text-tm-c-30373F">{{$formatter->carbonFormat($settlement->reservation->confirmation->end_dt, 'Y년 m월 d일(요일) H시 i분')}}</div></div>
                                </td>
                            @endif
                        @else
                            @if(!is_null($settlement->reservation->order_desired_dt))
                                <td class="px-2 py-3 text-center">
                                    <div class="whitespace-pre flex items-center space-x-2"><div class="w-8 text-sm text-tm-c-979b9f border border-solid border-tm-c-979b9f rounded-full leading-5">희망</div><div class="text-tm-c-30373F">{{$formatter->carbonFormat($settlement->reservation->order_desired_dt, 'Y년 m월 d일(요일) H시 i분')}}</div></div>
                                </td>
                            @else
                                <td class="px-2 py-3 text-center">
                                    <div class="whitespace-pre flex items-center space-x-2"><div class="w-8 text-sm text-tm-c-979b9f border border-solid border-tm-c-979b9f rounded-full leading-5">희망</div><div class="text-tm-c-30373F">{{$formatter->carbonFormat($settlement->reservation->order_desired_dt, 'Y년 m월 d일(요일) H시 i분')}}</div></div>
                                </td>
                            @endif
                        @endif

                        <td class="px-2 py-3 text-center font-medium">
                            @if(!is_null($settlement->calculate_dt) && $settlement->calculate_dt !== '' && $settlement->calculate_yn === 'Y')
                                <div class="whitespace-pre text-tm-c-30373F">{{$formatter->carbonFormat($settlement->calculate_dt, 'Y년 m월 d일 H시 i분')}}</div>
                            @else
                                <div class="whitespace-pre text-tm-c-30373F">정산 미완료</div>
                            @endif
                        </td>
                        <td class="px-2 py-3 text-center">
                            <div class="underline font-bold text-tm-c-30373F cursor-pointer whitespace-pre"
                                 @click="showModal=true;$('body').css('overflow','hidden');"
                                 wire:click="openDetailModal({{$settlement->id}})">상세 정보 보기</div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            @endif
        </table>
    </div>

    <div class="px-2 bg-tm-c-ED border-t border-solid border-tm-c-979b9f rounded-b-sm">
        @if(isset($settlements) && $settlements->count()===0)
            <div class="w-full text-xl text-center">
                <div class="py-2">
                    데이터 없음
                </div>
            </div>
        @elseif(isset($settlements) && $settlements->count()>=1)
            <div class="w-full">
                <div class="py-2">
                    {{$settlements->links('vendor.livewire.tailwind')}}
                </div>
            </div>
        @endif
    </div>

    <div class="z-30 DetailModal fixed w-full h-full top-0 left-0" x-show.transition.in.duration.200ms.out.duration.500ms="showModal" x-cloak>
        @if(isset($detail_settlement))
            <div class="z-20 absolute w-full bg-black bg-opacity-75">
                <div class="flex justify-center h-screen items-center antialiased">
                    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-md shadow-xl bg-tm-c-ED"
                         x-show.transition.in.duration.900ms.out.duration.200ms="showModal"
                         @click.away="showModal=false;$('body').css('overflow','visible');">
                        <div class="flex flex-row items-center justify-center pt-8 pb-4">
                            <p class="JeJuMyeongJo font-semibold text-xl sm:text-2xl md:text-3xl text-tm-c-30373F">정산 정보</p>
                        </div>

                        <div class="flex flex-col px-4 sm:px-6 md:px-10 divide-y-2 divide-black divide-dotted">

                            <div class="flex flex-row items-center justify-center text-lg pb-4 AppSdGothicNeoR">
                                @if($detail_settlement->calculate_yn === 'Y')
                                    <div class="whitespace-pre text-tm-c-0D5E49">정산 완료</div>
                                @else
                                    <div class="whitespace-pre text-tm-c-da5542">정산 예정</div>
                                @endif
                            </div>

                            <div class="flex py-4">
                                <table class="w-full table-auto">
                                    <tbody class="py-4 border-t-2 border-dotted border-t">
                                        <tr>
                                            <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">고객 성명</td>
                                            <td class="py-2 AppSdGothicNeoR text-tm-c-30373F whitespace-pre">{{$detail_settlement->reservation->order_name ?? ''}}</td>
                                            <td class="w-20 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">연락처</td>
                                            <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                                @if(isset($detail_settlement->reservation->confirmation) && $detail_settlement->reservation->confirmation->status === '1')
                                                    @if($detail_settlement->reservation->order_hp !== '' && $detail_settlement->reservation->order_hp!==null)
                                                        {{phone($detail_settlement->reservation->order_hp, 'kr')}}
                                                    @else
                                                        정보 없음
                                                    @endif
                                                @else
                                                    확정 후 확인 가능
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">주문일자/시간</td>
                                            <td class="py-2 AppSdGothicNeoR text-tm-c-30373F" colspan="3">
                                                {{$formatter->carbonFormat($detail_settlement->reservation->created_at, 'Y년 m월 d일(요일) H시 i분')}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex py-4">
                                <table class="w-full table-auto">
                                    <tr>
                                        <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">호텔명</td>
                                        <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">{{$detail_settlement->reservation->hotel->option->title ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">옵션명</td>
                                        <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">{{$detail_settlement->reservation->payment->goods_option ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">룸타입</td>
                                        <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                            @if(isset($detail_settlement->reservation->roomTypeUpgrade))
                                                <p class="line-through text-tm-c-979b9f">{{$detail_settlement->reservation->roomType->name ?? ''}}</p> >> {{$detail_settlement->reservation->roomTypeUpgrade->name ?? ''}}
                                            @else
                                                {{$detail_settlement->reservation->roomType->name ?? ''}}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="flex py-4">
                                <table class="w-full table-auto">
                                    <tr>
                                        <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">
                                            입주
                                            @if(isset($detail_settlement->reservation->confirmation) && $detail_settlement->reservation->confirmation->status === '1')
                                                확정일
                                            @else
                                                희망일
                                            @endif
                                        </td>
                                        <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                            @if(isset($detail_settlement->reservation->confirmation) && $detail_settlement->reservation->confirmation->status === '1'
                                                && $detail_settlement->reservation->confirmation->start_dt !=='' && $detail_settlement->reservation->confirmation->start_dt !==null)
                                                {{$formatter->carbonFormat($detail_settlement->reservation->confirmation->start_dt, 'Y년 m월 d일(요일) H시 i분')}}
                                            @else
                                                {{$formatter->carbonFormat($detail_settlement->reservation->order_desired_dt, 'Y년 m월 d일(요일) H시 i분')}}
                                            @endif
                                        </td>
                                    </tr>
                                    @if(isset($detail_settlement->reservation->confirmation) && $detail_settlement->reservation->confirmation->status === '1')
                                        <tr>
                                            <td class="py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">
                                                퇴실 확정일
                                            </td>
                                            <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                                {{$formatter->carbonFormat($detail_settlement->reservation->confirmation->end_dt, 'Y년 m월 d일(요일) H시 i분')}}
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>

                            <div class="flex py-4">
                                <table class="w-full">
                                    <tr>
                                        <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">
                                            정산 금액
                                        </td>
                                        <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                            @if($detail_settlement->calculate!=='' &&$detail_settlement->calculate!==null)
                                                {{number_format($detail_settlement->calculate)}}원
                                            @else
                                                정보 없음
                                            @endif
                                        </td>
                                    </tr>

                                    @if($detail_settlement->calculate_yn === 'N')
                                        <tr>
                                            <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">
                                                정산 예정 기간
                                            </td>
                                            <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                                {{ \Carbon\Carbon::parse($detail_settlement->mail_send_dt)->format('Y-m-d H시') }} ~ {{\Carbon\Carbon::parse($detail_settlement->mail_send_dt)->addDays(7)->format('Y-m-d H시')}}
                                            </td>
                                        </tr>
                                    @elseif($detail_settlement->calculate_yn === 'Y')
                                        <tr>
                                            <td class="w-26 py-2 AppSdGothicNeoR font-bold text-tm-c-30373F">
                                                정산 완료
                                            </td>
                                            <td class="py-2 AppSdGothicNeoR text-tm-c-30373F">
                                                {{ \Carbon\Carbon::parse($detail_settlement->calculate_dt)->format('Y-m-d H시 i분') }}
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>

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
</div>
<script>
    function DataInit (){
        return {
            'status' : '{{$status}}',
            'showModal' : false
        };
    }
</script>
