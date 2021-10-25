<div>
    <div class="py-2">
        <livewire:confirmations.confirmation-list :reservation="$reservation"></livewire:confirmations.confirmation-list>
    </div>
    <div id="confirmation_box" class="">
        <div>
            <input type="hidden" name="user_id" wire:model="confirmation.user_id" value="{{Auth::id()}}" readonly>
<!--      주문 id, 결제 id, 입주, 퇴실, 결제자 성명, 입주 룸타입(수정확인필수), 결제자 email, 연락처, + 메모     -->
            <div class="flex flex-wrap gap-2">
                <div class="w-full py-2 font-bold text-black text-xl">
                    현 확정 정보
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-2 p-3 bg-gray-100 rounded-md">
                    <div class="w-full sm:flex-1 NaNumSquare px-1 py-2 font-bold">
                        필수 정보
                    </div>
                    <div class="w-full flex flex-wrap items-center gap-1">
                        <div>
                            주문 <input type="text" name="reservation_id" wire:model="confirmation.reservation_id" readonly
                                     class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>
                        @error('confirmation.reservation_id')
                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                        <div>
                            결제 <input type="text" name="payment_id" wire:model="confirmation.payment_id" readonly
                                     class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>
                        @error('confirmation.payment_id')
                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full sm:flex-1 NaNumSquare px-1 py-2 font-bold">
                        고객 선택 룸 옵션
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        @if(isset($reservation->room_type_name))
                            {{$reservation->room_type_name}}@isset($reservation->room_type_upgrade_name) > <span class="font-bold">{{$reservation->room_type_upgrade_name}}(업그레이드 적용)</span>@endisset
                            @else
                            {{$confirmation['room_type']}}
                        @endif
                    </div>
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full sm:flex-1 NaNumSquare px-1 py-2 font-bold">
                        입주 확정 룸타입
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <input type="text" name="room_type" wire:model="confirmation.room_type"
                               class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    @error('confirmation.room_type')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-1">
                    <div class="w-full sm:flex-1 NaNumSquare px-1 py-2 font-bold">
                        확정 입주
                    </div>
                    <div class="w-full flex flex-wrap items-center gap-2">
                        <input type="date" name="start_dt1" wire:model="confirmation.start_dt1"
                               class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="time" name="start_dt2" wire:model="confirmation.start_dt2"
                               class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                       <div>
                           + 박 수
                           <input type="number" name="add_day" wire:model="confirmation.add_day"
                                  class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                       </div>
                        <div>
                            이전 총 추가 박 수
                            <input type="number" name="add_days" wire:model="confirmation.add_days"
                                   class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>
                    </div>
                    @error('confirmation.start_dt1')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                    @error('confirmation.start_dt2')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-1">
                    <div class="w-full sm:flex-1 NaNumSquare px-1 py-2 font-bold">
                        확정 퇴실
                    </div>
                    <div class="w-full flex flex-wrap items-center gap-2">
                        <input type="date" name="end_dt1" wire:model="confirmation.end_dt1"
                               class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <input type="time" name="end_dt2" wire:model="confirmation.end_dt2"
                               class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <div>
                            @if($this->reservation->room)
                                @if(isset($confirmation['add_days']) && $confirmation['add_days'] >= 1)
                                        @if(isset($confirmation['add_day']) && $confirmation['add_day'] >= 1)
                                            + {{($this->reservation->room->nights + $confirmation['add_day'] + $confirmation['add_days'])}} = 기본:{{$this->reservation->room->nights}}/추가:{{$confirmation['add_day']}}/총 추가:{{$confirmation['add_day']+$confirmation['add_days']}}
                                        @else
                                            + {{$this->reservation->room->nights + $confirmation['add_days']}} = 기본:{{$this->reservation->room->nights}}/총 추가:{{$confirmation['add_days']}}
                                        @endif
                                    @else
                                        @if(isset($confirmation['add_day']) && $confirmation['add_day'] >= 1)
                                            + {{($this->reservation->room->nights + $confirmation['add_day'])}} = 기본:{{$this->reservation->room->nights}}/총 추가:{{$confirmation['add_day']}}
                                        @else
                                            + {{$this->reservation->room->nights}} = 기본:{{$this->reservation->room->nights}}
                                        @endif
                                @endif
                            @endif
                        </div>
                        @error('confirmation.end_dt1')
                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                        @error('confirmation.end_dt2')
                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        알림톡 스케쥴 ON, OFF, 중도퇴실
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <select name="status" id="status" wire:model="confirmation.status"
                                class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="1">ON</option>
                            <option value="0">OFF</option>
                            <option value="2">중도퇴실</option>
                        </select>
                    </div>
                    @error('confirmation.status')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        관리 메모
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <textarea name="memo" id="memo" wire:model="confirmation.memo"
                                class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                    </div>
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        일수변동 자동저장 메모
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <textarea name="add_memo" id="add_memo" wire:model="confirmation.add_memo" readonly
                                class="w-full whitespace-pro shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                    </div>
                </div>

                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        알림톡
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <table class="w-full table-auto text-center">
                            <tr class="bg-gray-200 p-2">
                                <td>입주 3일전</td>
                                <td>입주 1일전</td>
                                <td>입주 후 1일전</td>
                                <td>입주 후 3일전</td>
                                <td>퇴실 3일전</td>
                                <td>퇴실 1일전</td>
                                <td>퇴실 후 1일</td>
                            </tr>
                            <tr class="bg-gray-100">
                                <td>{{ isset($confirmation['before_3day']) ? '전송'.(\Carbon\Carbon::parse($confirmation['before_3day']))->format('Y-m-d H:i:s') : '전송예정' }}</td>
                                <td>{{ isset($confirmation['before_1day']) ? '전송'.(\Carbon\Carbon::parse($confirmation['before_1day']))->format('Y-m-d H:i:s') : '전송예정' }}</td>
                                <td>{{ isset($confirmation['after_1day']) ? '전송'.(\Carbon\Carbon::parse($confirmation['after_1day']))->format('Y-m-d H:i:s') : '전송예정' }}</td>
                                <td>{{ isset($confirmation['after_3day']) ? '전송'.(\Carbon\Carbon::parse($confirmation['after_3day']))->format('Y-m-d H:i:s') : '전송예정' }}</td>
                                <td>{{ isset($confirmation['last_3day']) ? '전송'.(\Carbon\Carbon::parse($confirmation['last_3day']))->format('Y-m-d H:i:s') : '전송예정' }}</td>
                                <td>{{ isset($confirmation['last_1day']) ? '전송'.(\Carbon\Carbon::parse($confirmation['last_1day']))->format('Y-m-d H:i:s') : '전송예정' }}</td>
                                <td>{{ isset($confirmation['end_1day']) ? '전송'.(\Carbon\Carbon::parse($confirmation['end_1day']))->format('Y-m-d H:i:s') : '전송예정' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if(isset($alertTalkList))
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        알림톡 전송 내역
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        @foreach($alertTalkList as $list)
                        <div class="flex-1 px-4 py-3 bg-gray-200 rounded-md space-y-2">
                            <div class="p-1 bg-white rounded-md">{{$list->catalog}}</div>
                            <div class="whitespace-pre text-sm">{!! $list->template !!}</div>
                            <div class="p-1 bg-white rounded-md">전송시기 {{$list->send_at}}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="py-2 w-full flex flex-wrap justify-center items-center">
                    <select name="process3" id="process3" class="form-select" wire:model="process" required>
                        <option value="none" selected>저장만</option>
                        @if($reservation->type==='month')
                            @isset($reservation->payment['status'])
                                @if($reservation->payment['status'] === '3')
                                    <option value="고객_입주확정_알림톡">입주 확정 처리 + (고객_알림톡 O + 이용설명서) + (호텔관리자_메일 O)</option>
                                    <option value="고객_입주변경_알림톡">입주 변경 처리 + (고객_알림톡 O) + (호텔관리자_메일 O)</option>
                                    <option value="고객_입주연장_알림톡">입주 연장 처리 + (고객_알림톡 O) + (호텔관리자_메일 O)</option>
                                    <option value="고객_룸타입변경_알림톡">룸 타입 변경 처리 + (고객_알림톡 O) + (호텔관리자_메일 O)</option>
                                    <option value="호텔관리자_입주연장_문의">입주 연장 확정 문의 메일 전달</option>
                                    <option value="호텔관리자_입주변경_문의">입주 변경 확정 문의 메일 전달</option>
                                @endif
                            @endisset
                        @endif
                    </select>
                    @if($reservation->payment['status'] !== '3')
                        <div>
                            결제정보가(결제완료)일떄 입주확정 가능합니다
                        </div>
                    @endif
                </div>
                @if(\App\Settlement::where('payment_id', '=', $confirmation['payment_id'])->count()>=1)
                @switch($process)
                    @case('고객_입주확정_알림톡')
                    @case('고객_입주변경_알림톡')
                    @case('고객_입주연장_알림톡')
                    @case('고객_룸타입변경_알림톡')
                        <div class="w-full py-4 px-4 bg-gray-300 rounded-md">
                            <div class="font-bold text-xl">
                                호텔 정산 정보
                            </div>
                            <div class="font-bold">
                                메일 내 입금가 표기 : {{ number_format(\App\Settlement::where('payment_id', '=', $confirmation['payment_id'])->latest()->first()->calculate ?? 0) }}원
                            </div>
                            <div>
                                정산 시 결제금 : {{ number_format(\App\Settlement::where('payment_id', '=', $confirmation['payment_id'])->latest()->first()->price ?? 0) }}원
                                + 추가 연장금 : {{ number_format(\App\Settlement::where('payment_id', '=', $confirmation['payment_id'])->latest()->first()->add_price ?? 0) }}원
                            </div>
                            <div>
                                정산여부 : {{ \App\Settlement::where('payment_id', '=', $confirmation['payment_id'])->latest()->first()->calculate_yn ?? '오류' }}
                            </div>
                            <div>
                                이전 전송 : {{ \App\Settlement::where('payment_id', '=', $confirmation['payment_id'])->latest()->first()->mail_send_dt ?? '없음'}}
                            </div>
                            <div>
                                메모 : {{ \App\Settlement::where('payment_id', '=', $confirmation['payment_id'])->latest()->first()->memo ?? '없음'}}
                            </div>
                        </div>
                    @break
                @endswitch
                @endif
                <div class="w-full py-2 flex items-center">
                    <div class="flex-0 ml-auto">
                        <button type="submit"
                            @switch($process)
                                @case('고객_입주확정_알림톡')
                                    onclick="confirm('알림톡 + 호텔메일 + 확정 정보 저장하시겠습니까? :)') || event.stopImmediatePropagation()"
                                @case('고객_입주변경_알림톡')
                                    onclick="confirm('알림톡 + 호텔메일 + 변경 정보 저장하시겠습니까? :)') || event.stopImmediatePropagation()"
                                @case('고객_입주연장_알림톡')
                                    onclick="confirm('알림톡 + 호텔메일 + 연장 정보 저장하시겠습니까? :)') || event.stopImmediatePropagation()"
                                @break
                                @case('고객_룸타입변경_알림톡')
                                    onclick="confirm('알림톡 + 호텔메일 + 룸타입 정보 저장하시겠습니까? :)') || event.stopImmediatePropagation()"
                                @break
                                @case('호텔관리자_입주연장_문의')
                                    onclick="confirm('호텔 문의 메일 + 정보 저장하시겠습니까? :)') || event.stopImmediatePropagation()"
                                @break
                                @case('호텔관리자_입주변경_문의')
                                    onclick="confirm('호텔 문의 메일 + 정보 저장하시겠습니까? :)') || event.stopImmediatePropagation()"
                                @break

                                @default
                                    onclick="confirm('확정 정보 저장하시겠습니까? :)') || event.stopImmediatePropagation()"
                                @break
                            @endswitch
                            wire:click="confirmationSubmit"
                            class="inline-flex items-center justify-center py-1 px-2 border border-blue-500 rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-black active:bg-blue-700 transition duration-150 ease-in-out disabled:opacity-50">
                            <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text-base leading-6 font-medium text-white">확정 정보 저장</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if( Session::has('ConfirmationSubmit'))
        <div class="fixed bottom-0 mb-10 cursor-pointer"
             x-on:click="show=false" x-data="{ show: true }" x-show="show" x-cloak x-init="setTimeout(() => show = false, 3000)">
            <div class="p-4 rounded-md bg-gradient-to-r from-black-200 to-black-600
            @if(Session::get('ConfirmationSubmit.result')==='success') bg-gradient-to-r from-green-400 to-green-600 @endif
            @if(Session::get('ConfirmationSubmit.result')==='fall') bg-gradient-to-r from-red-400 to-red-600 @endif
            @if(Session::get('ConfirmationSubmit.result')==='save') bg-gradient-to-r from-orange-400 to-orange-600 @endif">
                <div class="flex items-center AppSdGothicNeoR font-bold gap-4">
                    @if(Session::has('ConfirmationSubmit.result'))
                        <div class="text-gray-700">
                            {{ Session::get('ConfirmationSubmit.result') }}
                        </div>
                    @endif
                    @if(Session::has('ConfirmationSubmit.outerSendResult'))
                        <div class="ml-auto text-xl text-black">
                            {{ Session::get('ConfirmationSubmit.outerSendResult') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @php
            Session::flash('ConfirmationSubmit', null);
        @endphp
    @endif
</div>
