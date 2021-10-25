<div x-data="{ modal : @entangle('modal'), reasonModal : false }">
    <!-- 새로운 메일 버튼 -->
    <div>
        <div class="py-10">
            <div>현재 상태</div>
            <div class="pt-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 text-tm-c-30373F text-center ">
                <div class="h-14">
                    <div class="flex items-center justify-center w-full h-full bg-tm-c-0D5E49 text-white rounded-md">
                        <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">{{$addHotel->enter_status}}</p>
                    </div>
                </div>
            </div>
        </div>


        @if($addHotel->enter_status === '심사 대기')
        <div class="py-10">
            <div>심사 단계</div>
            <div class="pt-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 text-tm-c-30373F text-center">
                <div class="h-14">
                    <div class="flex items-center justify-center w-full h-full @if($addHotel->enter_status==='심사 중') bg-tm-c-0D5E49 text-white @else bg-white @endif rounded-md cursor-pointer"
                         onclick="confirm('심사 중으로 변경 하시겠습니까?') || event.stopImmediatePropagation()"
                         wire:click="addHotelStatusChange('심사 중')">
                        <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">심사 중</p>
                    </div>
                </div>
            </div>
        </div>


        @elseif($addHotel->enter_status === '심사 중')
        <div class="py-10">
            <div>승인 단계</div>
            <div class="w-full grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                <div class="pt-6 text-tm-c-30373F text-center">
                    <div class="h-14">
                        <div class="flex items-center justify-center w-full h-full @if($addHotel->enter_status==='입점 승인') bg-tm-c-0D5E49 text-white @else bg-white @endif rounded-md cursor-pointer"
                             onclick="confirm('입점 승인으로 변경 하시겠습니까?') || event.stopImmediatePropagation()"
                             wire:click="addHotelStatusChange('입점 승인')">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">입점 승인</p>
                        </div>
                    </div>
                </div>
                <div class="pt-6 text-tm-c-30373F text-center">
                    <div class="h-14">
                        <div class="flex items-center justify-center w-full h-full @if($addHotel->enter_status==='입점 미승인') bg-tm-c-0D5E49 text-white @else bg-white @endif rounded-md cursor-pointer"
                             x-on:click="reasonModal = true">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">입점 미승인</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        @elseif($addHotel->enter_status === '입점 승인' || $addHotel->enter_status === '입점 미승인')
        <div class="py-10">
        <div>입점 승인 받은 호텔</div>
        <div class="w-full grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <div class="pt-6 text-tm-c-30373F text-center">
                <div class="h-14">
                    <div class="flex items-center justify-center w-full h-full @if($addHotel->enter_status==='수정 요청') bg-tm-c-0D5E49 text-white @else bg-white @endif rounded-md cursor-pointer"
                         onclick="confirm('수정 요청으로 변경 하시겠습니까?') || event.stopImmediatePropagation()"
                         wire:click="addHotelStatusChange('수정 요청')">
                        <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">수정 요청</p>
                    </div>
                </div>
            </div>

            @if($addHotel->method === '수수료')
                <div class="pt-6 text-tm-c-30373F text-center">
                    <div class="h-14">
                        <div class="flex items-center justify-center w-full h-full @if($addHotel->enter_status==='고객 선호도 리스트') bg-tm-c-0D5E49 text-white @else bg-white @endif rounded-md cursor-pointer"
                             onclick="confirm('고객 선호도 리스트로 변경 하시겠습니까?') || event.stopImmediatePropagation()"
                             wire:click="addHotelStatusChange('고객 선호도 리스트')">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">고객 선호도 리스트</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

        @elseif($addHotel->enter_status === '수정 요청' || $addHotel->enter_status === '고객 선호도 리스트' || $addHotel->enter_status === '오픈 확정')
        <div class="py-10">
            <div class="">오픈 확정된 호텔</div>
            <div class="w-full grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                <div class="pt-6 text-tm-c-30373F text-center">
                    <div class="h-14">
                        <div class="flex items-center justify-center w-full h-full @if($addHotel->enter_status==='오픈 확정') bg-tm-c-0D5E49 text-white @else bg-white @endif rounded-md cursor-pointer"
                             onclick="confirm('오픈 확정으로 변경 하시겠습니까?') || event.stopImmediatePropagation()"
                             wire:click="addHotelStatusChange('오픈 확정')">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">오픈 확정<br> {{ $addHotel->method }}</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 text-tm-c-30373F text-center">
                    <div class="h-14">
                        <div class="flex items-center justify-center w-full h-full @if($addHotel->enter_status==='판매 시작') bg-tm-c-0D5E49 text-white @else bg-white @endif rounded-md cursor-pointer"
                             onclick="confirm('판매 시작으로 변경 하시겠습니까?') || event.stopImmediatePropagation()"
                             wire:click="addHotelStatusChange('판매 시작')">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">판매 시작</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

    @endif

        <div class="py-10">
            <div class="text-2xl text-white">
                메일 전송 처리
            </div>
            <div class="pt-5 space-y-1">
                <div class="text-sm text-white leading-3">
                    전송 호텔 매니저 메일 주소
                </div>
                <div class="text-white">
                    {{$addHotel->manager->email ?? '전송 가능한 메일 주소가 없음'}}
                </div>
            </div>
            <div class="pt-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 text-tm-c-30373F text-center">
                @if($addHotel->enter_status==='수정 요청' )
                    <div class="h-14" onclick="confirm('수정 필요 메일 전송하시겠습니까?') || event.stopImmediatePropagation()"
                         wire:click="mailSend('수정 요청')">
                        <div class="flex items-center justify-center w-full h-full bg-tm-c-C1A485 text-white rounded-md cursor-pointer">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">수정 필요 메일 전송</p>
                        </div>
                    </div>
                @elseif($addHotel->enter_status==='입점 승인')
                    <div class="h-14" onclick="confirm('입점 승인 완료 메일 전송하시겠습니까?') || event.stopImmediatePropagation()"
                         wire:click="mailSend('입점 승인')">
                        <div class="flex items-center justify-center w-full h-full bg-tm-c-C1A485 text-white rounded-md cursor-pointer">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">입점 승인 완료 메일 전송</p>
                        </div>
                    </div>

                @elseif($addHotel->enter_status==='오픈 확정')
                    <div class="h-14" onclick="confirm('오픈 확정 메일 전송하시겠습니까?') || event.stopImmediatePropagation()"
                         wire:click="mailSend('오픈 확정')">
                        <div class="flex items-center justify-center w-full h-full bg-tm-c-C1A485 text-white rounded-md cursor-pointer">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">오픈 확정 메일 전송</p>
                        </div>
                    </div>


                @elseif($addHotel->enter_status==='고객 선호도 리스트')
                    <div class="h-14" onclick="confirm('고객 선호도 리스트 메일 전송하시겠습니까?') || event.stopImmediatePropagation()"
                         wire:click="mailSend('고객 선호도 리스트')">
                        <div class="flex items-center justify-center w-full h-full bg-tm-c-C1A485 text-white rounded-md cursor-pointer">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">고객 선호도 리스트 메일 전송</p>
                        </div>
                    </div>

                @elseif($addHotel->enter_status==='판매 시작')
                    <div class="h-14" onclick="confirm('판매 시작 메일 전송하시겠습니까?') || event.stopImmediatePropagation()"
                         wire:click="mailSend('판매 시작')">
                        <div class="flex items-center justify-center w-full h-full bg-tm-c-C1A485 text-white rounded-md cursor-pointer">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">판매 시작</p>
                        </div>
                    </div>


                @elseif($addHotel->enter_status==='고객 선호도 리스트')
                    <div class="h-14" onclick="confirm('고객 선호도 리스트 메일 전송하시겠습니까?') || event.stopImmediatePropagation()"
                         wire:click="mailSend('고객 선호도 리스트')">
                        <div class="flex items-center justify-center w-full h-full bg-tm-c-C1A485 text-white rounded-md cursor-pointer">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">고객 선호도 리스트 메일 전송 !미완성!</p>
                        </div>
                    </div>

                @elseif($addHotel->enter_status==='판매 시작')
                    <div class="h-14" onclick="confirm('고객 선호도 리스트 메일 전송하시겠습니까?') || event.stopImmediatePropagation()"
                         wire:click="mailSend('판매 시작')">
                        <div class="flex items-center justify-center w-full h-full bg-tm-c-C1A485 text-white rounded-md cursor-pointer">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">판매 시작 !미완성!</p>
                        </div>
                    </div>

                @elseif( $addHotel->enter_status==='입점 미승인')
                    <div class="h-14" onclick="confirm('입점 미승인 메일 전송하시겠습니까?') || event.stopImmediatePropagation()"
                         wire:click="mailSend('입점 미승인')">
                        <div class="flex items-center justify-center w-full h-full bg-tm-c-C1A485 text-white rounded-md cursor-pointer">
                            <p class="AppSdGothicNeoR text-lg font-bold whitespace-pre">입점 미승인 메일 전송</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div>
            <div class="text-white font-bold py-2">미승인 사유</div>
            <div class="text-sm space-y-1 pt-1">
                @forelse($addHotel->reasons as $reason)
                    <div class="border-t border-white border-solid py-2">
                        @if($loop->first)
                            <div class="grid grid-cols-4 text-white border-b border-solid border-white">
                                <div class="pb-2">담당 관리자</div>
                                <div class="pb-2 col-span-2">사유</div>
                                <div class="pb-2">작성일</div>
                            </div>
                        @endif
                        <div class="grid grid-cols-4 text-white border-b border-solid border-white">
                            <div class="py-2">
                                {{$reason->admin->name}}
                            </div>
                            <div class="py-2 col-span-2">
                                {{$reason->explanation}}
                            </div>
                            <div class="py-2">
                                {{$reason->created_at}}
                            </div>
                        </div>
                    </div>
                @empty
                    <div>정보 없음</div>
                @endforelse
            </div>
        </div>

        <div class="pb-16 sm:pb-20">
            <livewire:admin.enter.hotel-images-and-check-points-edit :add-hotel="$addHotel"></livewire:admin.enter.hotel-images-and-check-points-edit>
            <livewire:admin.enter.room-types-edit :add-hotel="$addHotel"></livewire:admin.enter.room-types-edit>
            <livewire:admin.enter.benefits-edit :add-hotel="$addHotel"></livewire:admin.enter.benefits-edit>
            <livewire:admin.enter.items-edit :add-hotel="$addHotel"></livewire:admin.enter.items-edit>
            <livewire:admin.enter.amenities-facilities-edit :add-hotel="$addHotel"></livewire:admin.enter.amenities-facilities-edit>
            <livewire:admin.enter.other-edit :add-hotel="$addHotel"></livewire:admin.enter.other-edit>
        </div>

        @if($loading)
            <div class="w-full h-full fixed top-0 left-0">
                <div class="h-full flex items-center justify-center">
                    <div class="p-16 bg-white bg-opacity-75 rounded-lg">
                        <svg class="animate-spin h-10 w-10 text-tm-c-ff7777" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        @endif

        <div x-show.transition.origin.top="modal" x-cloak
             class="px-4 min-w-screen h-screen animated fadeIn fixed left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none"
             style="background: rgba(0,0,0,.2);" id="modal-id">
            <div class="w-full max-w-lg p-3 pt-5 relative mx-auto my-auto rounded-lg shadow-lg bg-gray-300" x-on:click.away="modal = false">
                <div class="AppSdGothicNeoR text-tm-c-30373F">
                    <div class="text-center flex-auto justify-center">
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <input type="text" wire:model="model" readonly class="w-full appearance-none form-input" placeholder="Model(필수)">
                                @if($errors->has('model'))
                                    <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                                        모델 은(는) {{$errors->first('model') ?? ''}}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <input type="text" wire:model="target" readonly class="w-full appearance-none form-input" placeholder="Target(필수)">
                                @if($errors->has('target'))
                                    <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                                        타겟 은(는) {{$errors->first('target') ?? ''}}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <input type="text" wire:model="status" class="w-full appearance-none form-input" placeholder="상태">
                                @if($errors->has('status'))
                                    <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                                        상태 은(는) {{$errors->first('status') ?? ''}}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <select wire:model="severity" class="w-full appearance-none form-select">
                                    <option value="확인필요">확인필요</option>
                                    <option value="수정필요">수정필요</option>
                                    <option value="긴급수정사항">긴급수정사항</option>
                                </select>
                                @if($errors->has('severity'))
                                    <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                                        심각성 은(는) {{$errors->first('severity') ?? ''}}
                                    </div>
                                @endif
                            </div>
                            <div class="col-span-2">
                                <textarea type="text" wire:model="content" rows="4" class="w-full appearance-none form-textarea" placeholder="수정 워딩 전달(필수)"></textarea>

                                @if($errors->has('content'))
                                    <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                                        수정사항 은(는) {{$errors->first('content') ?? ''}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-center space-x-4 md:block">
                        <button wire:click="$set('modal',false)" class="bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 focus:outline-none">
                            취소하기
                        </button>
                        <button wire:click="NeedToModifySave" class="bg-blue-500 border border-blue-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-blue-600 focus:outline-none">
                            저장하기
                        </button>
                        @if($modelDelete)
                            <button wire:click="NeedToModifyDelete" class="bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600 focus:outline-none">
                                삭제하기
                            </button>
                        @endif
                    </div>
                    @if(isset($trashed) && collect($trashed)->count() >= 1)
                        <div class="text-xs text-tm-c-ff7777">삭제리스트</div>
                        @foreach ($trashed as $item)
                            <div class="mt-1 AppSdGothicNeoR text-sm leading-4 flex justify-center">
                                <div class="px-2">{{$item->severity}}</div>
                                <div class="px-2">{{$item->status ?? ''}}</div>
                                <div class="flex-1">{{$item->content}}</div>
                                <div class="px-2">{{$item->deleted_at}}</div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        {{-- 사유 작성 --}}
        <div x-show.transition.origin.top="reasonModal" x-cloak
             class="px-4 min-w-screen h-screen animated fadeIn fixed left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none"
             style="background: rgba(0,0,0,.2);" id="reasonModal-id">
            <div class="w-full max-w-lg p-3 pt-5 relative mx-auto my-auto rounded-lg shadow-lg bg-gray-300" x-on:click.away="reasonModal = false">
                <div class="AppSdGothicNeoR text-tm-c-30373F">
                    <div class="text-center flex-auto justify-center">
                        <div class="pb-3 font-bold text-xl">
                            호텔 미 승인 사유
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="col-span-2">
                                <textarea type="text" wire:model="reason" rows="4" class="w-full appearance-none form-textarea" placeholder="사유 워딩 전달 (필수)">{{$addHotel->reason->explanation ?? ''}}</textarea>

                                @if($errors->has('reason'))
                                    <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                                        사유 은(는) {{$errors->first('reason') ?? ''}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-center space-x-4 md:block">
                        <button x-on:click="reasonModal = false" class="bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 focus:outline-none">
                            취소하기
                        </button>
                        <button
                            onclick="confirm('입점 미 승인으로 변경 하시겠습니까?') || event.stopImmediatePropagation()"
                                wire:click="reasonSave" x-on:click="reasonModal=false" class="bg-orange-400 border border-orange-600 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-orange-600 focus:outline-none">
                            미승인 처리 및 사유전달
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    ::-webkit-scrollbar-track {
        background-color: rgba(141, 138, 135, 0.2);
    }
    ::-webkit-scrollbar-thumb {
        background-color: rgba(141, 138, 135, 0.5);
    }
</style>

