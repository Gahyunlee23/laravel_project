<div class="py-3">
    <div class="flex justify-center items-center AppSdGothicNeoR">
        <div class="">
            <form class="form-control p-4">
                <div class="space-y-2">
                    <div class="bg-gray-100 p-4 rounded-sm space-y-2">
                        <div>
                            <b>통합 주문자 정보</b>
                        </div>
                        <div class="mt-4">
                            <span class="text-gray-700">성명</span>
                            @if(session()->pull('order_name'))
                                <span class="text-tm-c-ff7777">
                                    <i class="pl-1 fas fa-check-circle"></i>
                                </span>
                            @endif
                            <div class="mt-2">
                                <label class="block">
                                    <input type="text" name="order_name" class="form-input mt-1 block" wire:model.lazy="order_name">
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-gray-700">성별</span>
                            @if(session()->pull('gender'))
                                <span class="text-tm-c-ff7777">
                                    <i class="pl-1 fas fa-check-circle"></i>
                                </span>
                            @endif
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="gender" value="1" wire:model.lazy="gender"
                                           class="form-radio text-blue-500">
                                    <span class="ml-2">남</span>
                                </label>
                                <label class="inline-flex items-center ml-6">
                                    <input type="radio" name="gender" value="2" wire:model.lazy="gender"
                                           class="form-radio text-red-500">
                                    <span class="ml-2">여</span>
                                </label>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-2">
                            <label class="block">
                                <span class="text-gray-700">연령대</span>
                                @if(session()->pull('age_group'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-0 sm:gap-2">
                                    <input type="text" name="age_group" class="form-input mt-1 block w-full" wire:model.lazy="age_group">
                                    <select name="age_group" class="form-select mt-1 block" wire:model.lazy="age_group">
                                        <option value="">개별입력</option>
                                        @foreach(\App\CustomerExperiences::groupBy('age_group')->whereNotNull('age_group')->get() as $method)
                                            <option value="{{$method->age_group}}">{{$method->age_group}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 gap-2">
                            <label class="block">
                                <span class="text-gray-700">거주지</span>
                                @if(session()->pull('residence'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-0 sm:gap-2">
                                    <input type="text" name="residence" class="form-input mt-1 block w-full" wire:model.lazy="residence">
                                    <select name="residence" class="form-select mt-1 block" wire:model.lazy="residence">
                                        <option value="">개별입력</option>
                                        @foreach(\App\CustomerExperiences::groupBy('residence')->whereNotNull('residence')->get() as $method)
                                            <option value="{{$method->residence}}">{{$method->residence}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 gap-2">
                            <label class="block">
                                <span class="text-gray-700">근무지</span>
                                @if(session()->pull('work_place'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-0 sm:gap-2">
                                    <input type="text" name="work_place" class="form-input mt-1 block w-full" wire:model.lazy="work_place">
                                    <select name="work_place" class="form-select mt-1 block" wire:model.lazy="work_place">
                                        <option value="">개별입력</option>
                                        @foreach(\App\CustomerExperiences::groupBy('work_place')->whereNotNull('work_place')->get() as $method)
                                            <option value="{{$method->work_place}}">{{$method->work_place}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>
                        @isset($customerExperience)
                        <div class="mt-4">
                            <span class="text-gray-700">문의 수</span>
                            <div class="mt-2">
                                현재 외 : {{ \App\CustomerExperiences::where('id','!=',$customerExperience->id)->whereUserId($customerExperience->user_id)->count() }}개
                            </div>
                        </div>
                        @endisset
                    </div>
                    <div class="bg-gray-100 p-4 rounded-sm space-y-2">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 sm:gap-2">
                            <label class="block">
                                <span class="text-gray-700">문의시간</span>
                                @if(session()->pull('inquiry_at'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="">
                                    <input type="datetime-local" name="inquiry_at" class="form-input mt-1 block w-full" wire:model.lazy="inquiry_at">
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-sm space-y-2">
                        <div>
                            <b>담당자</b>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                            <label class="block">
                                <span class="text-gray-700">작성 담당자</span>
                                @if(session()->pull('manager'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <select name="manager" class="form-select mt-1 block w-full" wire:model.lazy="manager">
                                    <option value="">담당자 없음</option>
                                    @foreach (\App\User::role('운영')->get() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="block">
                                <span class="text-gray-700">정산 담당자</span>
                                @if(session()->pull('calculate_manager'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <select name="calculate_manager" class="form-select mt-1 block w-full" wire:model.lazy="calculate_manager">
                                    <option value="">담당자 없음</option>
                                    @foreach (\App\User::role('운영')->get() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="block">
                                <span class="text-gray-700">환불 담당자</span>
                                @if(session()->pull('refund_manager'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <select name="refund_manager" class="form-select mt-1 block w-full" wire:model.lazy="refund_manager">
                                    <option value="">담당자 없음</option>
                                    @foreach (\App\User::role('운영')->get() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>


                    <div class="bg-gray-100 p-4 rounded-sm">
                        <div>
                            <b>문의</b>
                        </div>
                        <div class="grid grid-cols-1 gap-2">
                            <label class="block">
                                <span class="text-gray-700">문의 채널</span>
                                @if(session()->pull('inquiry_channel'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-0 sm:gap-2">
                                <input type="text" name="inquiry_channel" class="form-input mt-1 block w-full" wire:model.lazy="inquiry_channel">
                                <select name="inquiry_channel" class="inquiry_channel form-select mt-1 block" wire:model.lazy="inquiry_channel">
                                    <option value="">개별입력</option>
                                    @foreach(\App\CustomerExperiences::groupBy('inquiry_channel')->whereNotNull('inquiry_channel')->get() as $method)
                                        <option value="{{$method->inquiry_channel}}">{{$method->inquiry_channel}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </label>
                        </div>
                        <div class="mt-4 grid grid-cols-1 gap-2">
                            <label class="block">
                                <span class="text-gray-700">문의 CX 범주</span>
                                @if(session()->pull('inquiry_type'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-0 sm:gap-2">
                                <input type="text" name="inquiry_type" class="form-input mt-1 block w-full" wire:model.lazy="inquiry_type">
                                <select name="inquiry_type" class="inquiry_type form-select mt-1 block" wire:model.lazy="inquiry_type">
                                    <option value="">개별입력</option>
                                    @foreach(\App\CustomerExperiences::groupBy('inquiry_type')->whereNotNull('inquiry_type')->get() as $method)
                                        <option value="{{$method->inquiry_type}}">{{$method->inquiry_type}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </label>
                        </div>
                        <div class="mt-4">
                            <span class="text-gray-700">문의내용</span>
                            @if(session()->pull('contact_us'))
                                <span class="text-tm-c-ff7777">
                                    <i class="pl-1 fas fa-check-circle"></i>
                                </span>
                            @endif
                            <div class="">
                                <label class="block">
                                    <textarea name="contact_us" class="form-textarea mt-1 block w-full" wire:model.lazy="contact_us"></textarea>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-gray-700">진행현황</span>
                            @if(session()->pull('progress_status'))
                                <span class="text-tm-c-ff7777">
                                    <i class="pl-1 fas fa-check-circle"></i>
                                </span>
                            @endif
                            <div class="">
                                <label class="block">
                                    <textarea name="progress_status" class="form-textarea mt-1 block w-full" wire:model.lazy="progress_status"></textarea>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-gray-700">미구매 사유</span>
                            @if(session()->pull('not_purchased_reason'))
                                <span class="text-tm-c-ff7777">
                                    <i class="pl-1 fas fa-check-circle"></i>
                                </span>
                            @endif
                            <div class="">
                                <label class="block">
                                    <textarea name="not_purchased_reason" class="form-textarea mt-1 block w-full" wire:model.lazy="not_purchased_reason"></textarea>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-sm space-y-2">
                        <div>
                            <b>결제</b>
                        </div>
                        <div class="">
                            <label class="block">
                                <span class="text-gray-700">결제 수단</span>
                                @if(session()->pull('payment_method'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-0 sm:gap-2">
                                    <input type="text" name="payment_method" class="form-input mt-1 block" wire:model.lazy.lazy="payment_method">
                                    <select name="payment_method" class="payment_method form-select mt-1 block" wire:model.lazy="payment_method">
                                        <option value="">개별입력</option>
                                        @foreach(\App\CustomerExperiences::groupBy('payment_method')->whereNotNull('payment_method')->get() as $method)
                                            <option value="{{$method->payment_method}}">{{$method->payment_method}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-sm space-y-2">
                        <div>
                            <b>환불</b>
                        </div>
                        <div class="">
                            <label class="block">
                                <span class="text-gray-700">
                                    환불 수단
                                    @if(session()->pull('refund_method'))
                                        <span class="text-tm-c-ff7777">
                                            <i class="pl-1 fas fa-check-circle"></i>
                                        </span>
                                    @endif
                                </span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-0 sm:gap-2">
                                    <input type="text" name="refund_method" class="form-input mt-1 block" wire:model.lazy="refund_method">
                                    <select name="refund_method" class="refund_method form-select mt-1 block" wire:model.lazy="refund_method">
                                        <option value="">개별입력</option>
                                        @foreach(\App\CustomerExperiences::groupBy('refund_method')->whereNotNull('refund_method')->get() as $method)
                                            <option value="{{$method->refund_method}}">{{$method->refund_method}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>
                        <div class="">
                            <label class="block">
                                <span class="text-gray-700">
                                    환불 사유
                                    @if(session()->pull('refund_reason'))
                                        <span class="text-tm-c-ff7777">
                                            <i class="pl-1 fas fa-check-circle"></i>
                                        </span>
                                    @endif
                                </span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-0 sm:gap-2">
                                    <input type="text" name="refund_reason" class="form-input mt-1 block" wire:model.lazy="refund_reason">
                                    <select name="refund_reason" class="refund_method form-select mt-1 block" wire:model.lazy="refund_reason">
                                        <option value="">개별입력</option>
                                        @foreach(\App\CustomerExperiences::groupBy('refund_reason')->whereNotNull('refund_reason')->get() as $method)
                                            <option value="{{$method->refund_reason}}">{{$method->refund_reason}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>
                        <div class="">
                            <label class="block">
                                <span class="text-gray-700">
                                    환불 진행 현황
                                    @if(session()->pull('refund_progress'))
                                        <span class="text-tm-c-ff7777">
                                            <i class="pl-1 fas fa-check-circle"></i>
                                        </span>
                                    @endif
                                </span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-0 sm:gap-2">
                                    <input type="text" name="refund_progress" class="form-input mt-1 block" wire:model.lazy="refund_progress">
                                    <select name="refund_progress" class="refund_method form-select mt-1 block" wire:model.lazy="refund_progress">
                                        <option value="">개별입력</option>
                                        @foreach(\App\CustomerExperiences::groupBy('refund_progress')->whereNotNull('refund_progress')->get() as $method)
                                            <option value="{{$method->refund_progress}}">{{$method->refund_progress}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-sm space-y-2">
                        <div>
                            <b>메모</b>
                        </div>
                        <div class="mt-4">
                            <span class="text-gray-700">입주 처리현황</span>
                            @if(session()->pull('move_in_progress'))
                                <span class="text-tm-c-ff7777">
                                    <i class="pl-1 fas fa-check-circle"></i>
                                </span>
                            @endif
                            <div class="">
                                <label class="block">
                                    <textarea name="move_in_progress" class="form-textarea mt-1 block w-full" wire:model.lazy="move_in_progress"></textarea>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-gray-700">기타 메모</span>
                            @if(session()->pull('memo'))
                                <span class="text-tm-c-ff7777">
                                    <i class="pl-1 fas fa-check-circle"></i>
                                </span>
                            @endif
                            <div class="">
                                <label class="block">
                                    <textarea name="memo" class="form-textarea mt-1 block w-full" wire:model.lazy="memo"></textarea>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-sm space-y-2">
                        <div>
                            <b>비용</b>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 sm:gap-2">
                            <label class="block">
                                <span class="text-gray-700">공급가</span>
                                @if(session()->pull('supply_price'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="">
                                    <input type="number" name="supply_price" class="form-input mt-1 block w-full" wire:model.lazy="supply_price">
                                </div>
                            </label>
                            <label class="block">
                                <span class="text-gray-700">순이익, 매출총이익</span>
                                @if(session()->pull('profit'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="">
                                    <input type="number" name="profit" class="form-input mt-1 block w-full" wire:model.lazy="profit">
                                </div>
                            </label>
                            <label class="block">
                                <span class="text-gray-700">호텔 정산 금액</span>
                                @if(session()->pull('calculate_price'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="">
                                    <input type="number" name="calculate_price" class="form-input mt-1 block w-full" wire:model.lazy="calculate_price">
                                </div>
                            </label>
                            <label class="block">
                                <span class="text-gray-700">호텔 정산 환불 금액</span>
                                @if(session()->pull('calculate_refund_price'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="">
                                    <input type="number" name="calculate_refund_price" class="form-input mt-1 block w-full" wire:model.lazy="calculate_refund_price">
                                </div>
                            </label>
                            <label class="block">
                                <span class="text-gray-700">고객 환불 금액</span>
                                @if(session()->pull('refund_price'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="">
                                    <input type="number" name="refund_price" class="form-input mt-1 block w-full" wire:model.lazy="refund_price">
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-sm">
                        <div>
                            <b>유입</b>
                        </div>
                        <div class="grid grid-cols-1 gap-2">
                            <label class="block">
                                <span class="text-gray-700">유입경로</span>
                                @if(session()->pull('inflow_path'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-0 sm:gap-2">
                                    <input type="text" name="inflow_path" class="form-input mt-1 block w-full" wire:model.lazy="inflow_path">
                                    <select name="inflow_path" class="inflow_path form-select mt-1 block" wire:model.lazy="inflow_path">
                                        <option value="">개별입력</option>
                                        @foreach(\App\CustomerExperiences::groupBy('inflow_path')->whereNotNull('inflow_path')->get() as $method)
                                            <option value="{{$method->inflow_path}}">{{$method->inflow_path}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>
                    </div>


                    <div class="bg-gray-100 p-4 rounded-sm space-y-2">
                        <div>
                            <b>시간</b>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 sm:gap-2">
                            <label class="block">
                                <span class="text-gray-700">정산처리</span>
                                @if(session()->pull('calculate_at'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="">
                                    <input type="datetime-local" name="calculate_at" class="form-input mt-1 block w-full" wire:model.lazy="calculate_at">
                                </div>
                            </label>
                            <label class="block">
                                <span class="text-gray-700">환불처리</span>
                                @if(session()->pull('refund_at'))
                                    <span class="text-tm-c-ff7777">
                                        <i class="pl-1 fas fa-check-circle"></i>
                                    </span>
                                @endif
                                <div class="">
                                    <input type="datetime-local" name="refund_at" class="form-input mt-1 block w-full" wire:model.lazy="refund_at">
                                </div>
                            </label>
                        </div>
                    </div>

                </div>
            </form>


            <div class="flex justify-center">
<!--                <div wire:click="customerExperiencesSaveEvent" class="px-4 py-2 rounded-md bg-gray-400 text-black hover:text-white hover:bg-gray-600 cursor-pointer">
                    저장
                </div>-->
{{--                <div wire:click="$emit('customerExperiencesRenderEvent')" class="px-4 py-2 rounded-md bg-gray-400 text-black hover:text-white hover:bg-gray-600 cursor-pointer">--}}
{{--                    Rerender--}}
{{--                </div>--}}
                <div wire:click="$emit('reservationIdClear')" class="px-4 py-2 rounded-md bg-gray-400 text-black hover:text-white hover:bg-gray-600 cursor-pointer">
                    닫기
                </div>
            </div>
        </div>
    </div>
</div>

<script>
</script>
