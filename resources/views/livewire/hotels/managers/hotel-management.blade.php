@if((($type === '입점 승인' || $type === '입점 미승인') && $hotels->count()>=1) || ($type !== '입점 승인' && $type !== '입점 미승인'))
    <div class="w-full h-full" x-data="{ showReason : false }">
        <div class="AppSdGothicNeoR text-lg text-white">
            {{ $title ?? ''}}
        </div>
        <div class="mt-4 overflow-x-auto overflow-y-visible h-full rounded-t-sm px-4 bg-tm-c-ED">
            <table class="table-auto w-full AppSdGothicNeoR">
                <thead>
                <tr>
                    <td class="px-4 py-2  whitespace-pre text-tm-c-30373F font-bold text-center leading-relaxed border-b border-solid border-tm-c-30373F">호텔명</td>
                    <td class="px-2 py-2 whitespace-pre text-tm-c-30373F font-bold text-center leading-relaxed border-b border-solid border-tm-c-30373F">신청 일자/시간</td>
                    <td class="px-2 py-2 whitespace-pre text-tm-c-30373F font-bold text-center leading-relaxed border-b border-solid border-tm-c-30373F">심사 단계</td>
                    <td class="px-2 py-2 whitespace-pre text-tm-c-30373F font-bold text-center leading-relaxed border-b border-solid border-tm-c-30373F">입점 신청서</td>
                </tr>
                </thead>
                @if(isset($hotels))
                    <tbody>
                    @foreach($hotels as $hotel)
                        <tr>
                            <td class="px-2 py-3 whitespace-pre text-center text-base text-tm-c-30373F">{{$hotel->name ?? '작성 중'}}</td>
                            <td class="px-2 py-3 whitespace-pre text-center text-base text-tm-c-30373F">{{\Carbon\Carbon::parse($hotel->created_at)->format('Y/m/d H:i')}}</td>
                            <td class="AppSdGothicNeoR px-2 py-3 text-center text-sm font-extrabold text-tm-c-30373F">
                                <div class="flex justify-center items-center">
                                    @switch($hotel->enter_status)
                                        @case('심사 대기') @case('작성 중') @case('입점 승인')
                                        <div class="w-full bg-white rounded-full leading-relaxed" style="max-width:5.5rem;min-width:5.5rem;">
                                            <div class="text-tm-c-0D5E49">
                                                <p class="whitespace-pre">{{$hotel->enter_status}}</p>
                                            </div>
                                        </div>
                                        @break
                                        @case('오픈 확정')
                                        <div class="w-full bg-tm-c-d7d3cf rounded-full leading-relaxed" style="max-width:5.5rem;min-width:5.5rem;">
                                            <div class="text-tm-c-979b9f">
                                                <p class="whitespace-pre">입점 승인</p>
                                            </div>
                                        </div>
                                        @break
                                        @default
                                        <div class="w-full bg-tm-c-d7d3cf rounded-full leading-relaxed" style="max-width:5.5rem;min-width:5.5rem;">
                                            <div class="text-tm-c-979b9f">
                                                <p class="whitespace-pre">심사 대기</p>
                                            </div>
                                        </div>
                                    @endswitch
                                    <div>
                                        <div class="h-px w-6 border-t border-dashed border-tm-c-979b9f"></div>
                                    </div>
                                    @switch($hotel->enter_status)
                                        @case('심사 중')
                                        <div class="w-full bg-white rounded-full leading-relaxed" style="max-width:5.5rem;min-width:5.5rem;">
                                            <div class="text-tm-c-0D5E49">
                                                <p class="whitespace-pre">{{$hotel->enter_status}}</p>
                                            </div>
                                        </div>
                                        @break
                                        @case('수정 요청')
                                        <div class="w-full bg-white rounded-full leading-relaxed" style="max-width:5.5rem;min-width:5.5rem;">
                                            <div class="text-tm-c-da5542">
                                                <p class="whitespace-pre">{{$hotel->enter_status}}</p>
                                            </div>
                                        </div>
                                        @break
                                        @case('오픈 확정')
                                        <div class="w-full bg-white rounded-full leading-relaxed" style="max-width:5.5rem;min-width:5.5rem;">
                                            <div class="text-tm-c-da5542">
                                                <p class="whitespace-pre">{{$hotel->enter_status}}</p>
                                            </div>
                                        </div>
                                        @break
                                        @default
                                        <div class="w-full bg-tm-c-d7d3cf rounded-full leading-relaxed" style="max-width:5.5rem;min-width:5.5rem;">
                                            <div class="text-tm-c-979b9f">
                                                <p class="whitespace-pre">심사 중</p>
                                            </div>
                                        </div>
                                    @endswitch
                                    <div>
                                        <div class="h-px w-6 border-t border-dashed border-tm-c-979b9f"></div>
                                    </div>
                                    @switch($hotel->enter_status)
                                        {{-- 주석 테스트 --}}
                                        @case('입점 미승인')
                                        <div class="w-full bg-white rounded-full leading-relaxed" style="max-width:5.5rem;min-width:5.5rem;">
                                            <div class="text-tm-c-0D5E49">
                                                <p class="whitespace-pre">{{$hotel->enter_status}}</p>
                                            </div>
                                        </div>
                                        @break
                                    <!-- 오픈 승인 완료 추가 끝-->
                                        @case('고객 선호도 리스트')
                                        <div class="w-full bg-white rounded-full leading-relaxed" style="max-width:5.5rem;min-width:5.5rem;">
                                            <div class="text-tm-c-da5542">
                                                <p class="whitespace-pre">{{$hotel->enter_status}}</p>
                                            </div>
                                        </div>
                                        @break
                                        @case('판매 시작')
                                        <div class="w-full bg-white rounded-full leading-relaxed" style="max-width:5.5rem;min-width:5.5rem;">
                                            <div class="text-tm-c-da5542">
                                                <p class="whitespace-pre">{{$hotel->enter_status}}</p>
                                            </div>
                                        </div>
                                        @break
                                        @default
                                        <div class="w-full bg-tm-c-d7d3cf rounded-full leading-relaxed" style="max-width:5.5rem;min-width:5.5rem;">
                                            <div class="text-tm-c-979b9f">
                                                <p class="whitespace-pre">심사 결과</p>
                                            </div>
                                        </div>
                                    @endswitch
                                </div>
                            </td>

                            <td class="text-center">
                                @if($hotel->enter_status === '심사 중')
                                    <div class="whitespace-pre underline">입점 심사 중</div>
                                @endif
                                @if($hotel->enter_status === '작성 중')
                                    <div class="px-2 py-3 cursor-pointer" onclick="location.href='{{route('hotel-entry.hotel', ['hotel'=>$hotel])}}'">
                                        <div class="whitespace-pre underline font-bold text-tm-c-30373F">입점 신청서 작성</div>
                                    </div>
                                @endif
                                @if($hotel->enter_status === '심사 대기' || $hotel->enter_status === '수정 요청')
                                    <div class="px-2 py-3 cursor-pointer" onclick="location.href='{{route('hotel-entry.update-form', ['addHotel'=>$hotel])}}'">
                                        <div class="whitespace-pre underline font-bold text-tm-c-30373F">입점 신청서 수정</div>
                                    </div>
                                @endif
                                @if($hotel->enter_status === '입점 승인')
                                    @if(auth()->check() && auth()->user()->hasAnyRole('개발'))
                                        <div></div>
                                     @endif
                                    <form id="hotel-entry-check-list-{{$hotel->id}}" action="{{route('hotel-entry.check-list', ['addHotel'=>$hotel])}}" method="post">
                                        @method('post')
                                        @csrf
                                        <button class="px-2 py-3 cursor-pointer focus:outline-none" onclick="$('form#hotel-entry-check-list-{{$hotel->id}}')[0].submit();">
                                            <div class="whitespace-pre underline text-tm-c-0D5E49 font-bold">체크리스트 등록하기</div>
                                        </button>
                                    </form>
                                @endif
                                @if($hotel->enter_status === '입점 미승인')
                                    <div class="underline text-tm-c-0D5E49 space-y-1">
                                        <div class="font-bold cursor-pointer" wire:click="seeReason({{$hotel->id}})" wire:key="seeReason-{{$hotel->id}}" x-on:click="showReason=true">
                                            <div class="whitespace-pre">미승인 사유 확인</div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>

        @if((isset($hotels) && $hotels->count()===0))
            <div class="px-2 py-3 bg-tm-c-ED">
                <div class="w-full">
                    <div class="AppSdGothicNeoR text-tm-c-979b9f text-center">
                        입점 신청 내역이 없습니다.
                    </div>
                </div>
            </div>
        @endif
        @if(isset($hotels) && ( ($currentPage === 1 && $hotels->count() >= $paginate) || ($currentPage !== 1 ) ))
            <div class="px-2 bg-tm-c-ED">
                <div class="w-full">
                    <div class="py-2">
                        {{$hotels->links('vendor.livewire.tailwind.center-paginate')}}
                    </div>
                </div>
            </div>
        @endif
        @if($type === null)
            <div class="mt-5 AppSdGothicNeoR text-tm-c-979b9f leading-normal text-sm sm:text-base">
                <p style="margin-left: .5rem;text-indent: -.5rem;">* 현재 {{\App\AddHotel::whereIn('enter_status', ['심사 대기', '심사 중', '수정 요청'])->count()+30}}개사가 파트너사 입점 대기중으로, 신청 후 회신이 늦어질 수 있는 점 양해 바랍니다.</p>
                <p style="margin-left: .5rem;text-indent: -.5rem;">* 입점 승인 완료 이후 미팅 시, 최종 결정권자가 필수로 동석해 주시기 바랍니다.</p>
                <p style="margin-left: .5rem;text-indent: -.5rem;">* 호텔 입점 승인 여부와 고객분들께 최고의 혜택을 제공하는지 검증하기 위한, 자사 임직원의 컴프 트라이얼은 필수 사항임을 알려드립니다.</p>
                <p style="margin-left: .5rem;text-indent: -.5rem;">* 입점 승인 결과는 영업일 기준 14일 내로 현재 페이지와 가입 시 입력한 이메일로 안내됩니다.</p>
            </div>
        @endif
        @if($type === '입점 승인')
            <div class="mt-5 AppSdGothicNeoR text-tm-c-979b9f leading-normal text-sm sm:text-base">
                <p style="margin-left: .5rem;text-indent: -.5rem;">* 심사 승인 이후, 호텔 오픈을 위해서 체크리스트를 필수로 작성해주시기 바랍니다.</p>
                <p style="margin-left: .5rem;text-indent: -.5rem;">* 체크리스트는 검토 후 이메일을 통해 추가 수정 요청을 드릴 수 있습니다.</p>
            </div>
        @endif
        <div x-show.transition.origin.center="showReason" x-cloak class="fixed inset-0 flex items-center justify-center w-screen h-screen px-8">
            @if($reason)
                <div class="AppSdGothicNeoR text-tm-c-30373F w-full max-w-2xl p-4 bg-white border border-solid border-tm-c-ED rounded-sm shadow-2xl" x-on:click.away="showReason = false">
                    <div class="pt-4 pb-6 flex justify-between items-center">
                        <div class="JeJuMyeongJo font-bold text-xl 2xs:text-2xl xs:text-3xl">
                            {{$reason->hotel->name ?? '호텔명 미정'}}
                        </div>
                    </div>
                    <div class="mx-16 border-b border-tm-c-0D5E49 border-solid"></div>

                    <div class="py-4">
                        <div class="text-sm text-tm-c-979b9f">
                            입점 미승인 사유
                        </div>
                    </div>

                    <div class="py-3">
                        {{$reason->explanation}}
                    </div>

                    <div class="flex justify-end">
                        <div class="cursor-pointer" x-on:click="showReason = false">
                            <div class="PtSerif font-bold text-tm-c-0D5E49 text-base">닫기</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif
