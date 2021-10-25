@extends('layouts.app')

@section('content')
    <div class="max-w-1200 mx-auto select-none">
        <div class="p-4">
            <div class="py-4 px-2 bg-gray-200 rounded-lg space-y-6">
                <div class="text-3xl font-normal text-tm-c-C1A485">
                    @auth
                        관리자 로그인
                    @elseauth('guest')
                        게스트 로그인 로그인
                    @endauth
                </div>
                @auth
                    <div class="p-2 space-y-2" x-data="{ passwordFormShow : false }">
                        <div>
                            😊{{ \Illuminate\Support\Facades\Auth::user()->name }}(권한 {{ \Illuminate\Support\Facades\Auth::user()->roles[0]->name }})
                        </div>
                        <div @click="passwordFormShow=!passwordFormShow"
                            class="flex w-max-content" style="background-color: #F1404B;">
                            <div class="px-2 py-2 rounded-md text-white">
                                비밀 번호 변경
                            </div>
                        </div>
                        <div x-show="passwordFormShow" x-cloak>
                            <form id="admin-form" method="POST">
                                @csrf
                                @method('POST')
                                <label>
                                    비밀번호
                                    <input type="password" name="password" class="form-input"
                                           value="{{old('password')}}">
                                </label>

                                <button
                                    class="submit-btn inline-block whitespace-nowrap mx-auto text-center text-lg bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg"
                                    style="min-width: 88px;"
                                    onclick="event.preventDefault();
                                        if(confirm('비밀번호를 변경하시겠습니까?')){
                                        document.getElementById('admin-form').action='{{route('admin.password.update', ['user'=>Auth::user()->id])}}'
                                        document.getElementById('admin-form').submit();}">
                                    변경
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="">
                        <div class="flex flex-wrap px-2 py-4 rounded-lg text-gray-700 font-bold text-center"
                            style="background-color: #F9D5D3;">
                            <div class="flex-1 p-2">
                                <a href="{{ route('hotel.index') }}">
                                    <div class="flex flex-wrap justify-center space-y-2">
                                        <div class="w-full text-7xl">
                                            <i class="fas fa-h-square"></i>
                                        </div>
                                        <div class="w-max-content text-xl">
                                            {{ __('호텔 리스트') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="flex-1 p-2">
                                <a href="{{ route('hotel.reservations') }}">
                                    <div class="flex flex-wrap justify-center space-y-2">
                                        <div class="w-full text-7xl">
                                            <i class="fad fa-file-import"></i>
                                        </div>
                                        <div class="w-max-content text-xl">
                                            {{ __('주문 관리') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @if(auth()->check() && auth()->user()->hasPermissionTo('curator manager'))
                            <div class="flex-1 p-2">
                                <a href="{{ route('curator.index') }}">
                                    <div class="flex flex-wrap justify-center space-y-2">
                                        <div class="w-full text-7xl">
                                            <i class="fab fa-mendeley"></i>
                                        </div>
                                        <div class="w-max-content text-xl">
                                            {{ __('큐레이터 관리') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif
                            <div class="flex-1 p-2">
                                <a href="{{ route('information.index') }}">
                                    <div class="flex flex-wrap justify-center space-y-2">
                                        <div class="w-full text-7xl">
                                            <i class="fad fa-book-spells"></i>
                                        </div>
                                        <div class="w-max-content text-xl">
                                            {{ __('마스터 테이블') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="flex-1 p-2">
                                <a href="{{ route('users-master-table') }}">
                                    <div class="flex flex-wrap justify-center space-y-2">
                                        <div class="w-full text-7xl">
                                            <i class="fad fa-users"></i>
                                        </div>
                                        <div class="w-max-content text-xl">
                                            {{ __('유저 테이블') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @hasrole('admin|super-admin')
                            <div class="flex-1 p-2">
                                <a href="{{ route('enter.hotels.list') }}">
                                    <div class="flex flex-wrap justify-center space-y-2">
                                        <div class="w-full text-7xl">
                                            <i class="fas fa-key"></i>
                                        </div>
                                        <div class="w-max-content text-xl">
                                            {{ __('입점 리스트') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="flex-1 p-2">
                                <a href="{{ route('hotels.recommendation') }}">
                                    <div class="flex flex-wrap justify-center space-y-2">
                                        <div class="w-full text-7xl">
                                            <i class="fas fa-hand-holding-heart"></i>
                                        </div>
                                        <div class="w-max-content text-xl">
                                            {{ __('고객 추천') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endhasrole
                            <div class="flex-1 p-2">
                                <a href="{{ route('admin.reservation.application.index') }}">
                                    <div class="flex flex-wrap justify-center space-y-2">
                                        <div class="w-full text-7xl">
                                            <i class="fad fa-clipboard-list-check"></i>
                                        </div>
                                        <div class="w-max-content text-xl">
                                            {{ __('취소, 변경 신청 리스트') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @if(auth()->check() && auth()->user()->hasPermissionTo('settlement manager'))
                            <div class="flex-1 p-2">
                                <a href="{{route('admin.settlements.index')}}">
                                    <div class="flex flex-wrap justify-center space-y-2">
                                        <div class="w-full text-7xl">
                                            <i class="fad fa-calculator-alt"></i>
                                        </div>
                                        <div class="w-max-content text-xl">
                                            {{ __('정산 리스트') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif
                            @if(auth()->check() && auth()->user()->hasPermissionTo('schedulers permission'))
                            <div class="flex-1 p-2">
                                <a href="{{route('admin.schedulers.index')}}">
                                    <div class="flex flex-wrap justify-center space-y-2">
                                        <div class="w-full text-7xl">
                                            <i class="fad fa-calendar-alt"></i>
                                        </div>
                                        <div class="w-max-content text-xl">
                                            {{ __('호텔 스케줄러') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            @if(auth()->check() && auth()->user()->hasPermissionTo('hotel copy'))
                                <div class="flex-1 p-2">
                                    <a href="{{route('admin.hotel-copy.index')}}">
                                        <div class="flex flex-wrap justify-center space-y-2">
                                            <div class="w-full text-7xl">
                                                <i class="fad fa-copy"></i>
                                            </div>
                                            <div class="w-max-content text-xl">
                                                {{ __('호텔 복사') }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @if(auth()->check() && auth()->user()->hasPermissionTo('getListEnterHotel'))
                                <div class="flex-1 p-2">
                                    <a href="{{route('admin.hotel-enter.index')}}">
                                        <div class="flex flex-wrap justify-center space-y-2">
                                            <div class="w-full text-7xl">
                                                <i class="fas fa-lightbulb-on"></i>
                                            </div>
                                            <div class="w-max-content text-xl">
                                                {{ __('호텔 입점 리스트') }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
{{--                            @if(auth()->check() && auth()->user()->hasPermissionTo('banner manager'))--}}
{{--                                <div class="flex-1 p-2">--}}
{{--                                    <a href="{{route('admin.banner.core')}}">--}}
{{--                                        <div class="flex flex-wrap justify-center space-y-2">--}}
{{--                                            <div class="w-full text-7xl">--}}
{{--                                                <i class="fas fa-scanner-image"></i>--}}
{{--                                            </div>--}}
{{--                                            <div class="w-max-content text-xl">--}}
{{--                                                {{ __('배너 매니저') }}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            @endif--}}
                        </div>
                    </div>


                    <div>
                        {{--                        <a href="{{route('import')}}">주문정보(개발자용)</a>--}}
                        <div class="flex flex-wrap px-2 py-4 text-white rounded-lg font-bold text-center"
                             style="background-color: #807F89;">
                            @hasrole('super-admin')
                            @if(auth()->user()->hasPermissionTo('permission application'))
                            <div class="flex-1 p-2">
                                <a class="dropdown-item" href="{{ route('admin.permission') }}">
                                    <i class="fas fa-user-cog text-7xl"></i>
                                    {{ __('권한 관리') }}
                                </a>
                            </div>
                            @endif
                            <div class="flex-1 p-2">
                                <a class="dropdown-item" href="{{ route('my-page.main') }}">
                                    <i class="fad fa-user-circle text-7xl"></i>
                                    {{ __('마이페이지') }}
                                </a>
                            </div>
                            @endhasrole
                            <div class="flex-1 p-2">
                                <a class="dropdown-item" href="{{ route('admin.dev.index') }}">
                                    <i class="fab fa-dev text-7xl"></i>
                                    {{ __('DEV') }}
                                </a>
                            </div>
                            <div class="flex-1 p-2">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <div class="flex flex-wrap justify-center space-y-2">
                                        <div class="w-full text-7xl">
                                            <i class="fas fa-sign-out-alt"></i>
                                        </div>
                                        {{ __('로그아웃') }}
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap p-4 bg-opacity-75 rounded-md"
                        style="background-color: #99A89E;" x-data="{ buttonCheck : true, show : false }">
                        <div>
                            <div class="px-4 text-white font-bold space-y-2">
                                <div class="text-2xl">
                                    엑셀
                                </div>
                                <div>
                                    <i class="fal fa-table text-7xl"></i>
                                </div>
                            </div>
                            <div x-show="!buttonCheck" x-cloak>
                                <div class="text-xl text-tm-c-da5542 font-bold" x-on:click="buttonCheck=!buttonCheck">
                                    다운 클릭 후 잠시 대기 해주시면 다운로드 진행됩니다. (추가 출력 필요시 클릭)
                                </div>
                            </div>
                            <div class="grid grid-cols-2 xs:grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-2 sm:gap-3 text-white font-bold"
                                x-show="buttonCheck">
                                <div class="flex p-2 bg-gray-500 rounded-md"
                                    @mouseenter="show = true" @mouseleave="show = false">
                                    <form action="{{route('excel.hotel.reservation.option')}}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div>주문 리스트</div>
                                        <div class="space-y-1 text-black" x-show="show" x-cloak>
                                            <div>
                                                <select name="order_statue" id="">
                                                    <option value="전체">전체 (Big)</option>
                                                    <option value="취소완료">취소완료</option>

                                                    <option value="투어예정">투어예정</option>
                                                    <option value="투어완료">투어완료</option>

                                                    <option value="입주예정">입주예정</option>
                                                    <option value="입주중">입주중</option>
                                                    <option value="퇴실완료">퇴실완료</option>
                                                    <option value="결제완료">결제완료</option>
                                                </select>
                                            </div>
                                            <div>
                                                <button class="px-3 py-1 rounded-md border border-solid border-blue-500 bg-blue-600 hover:bg-blue-700 text-white"
                                                        x-on:click="buttonCheck = !buttonCheck">엑셀출력</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <a href="{{route('excel.recommendation')}}" x-on:click="buttonCheck = !buttonCheck">
                                        호텔 추천 리스트
                                    </a>
                                </div>
                                <div>
                                    <a href="{{route('excel.unpaid')}}" x-on:click="buttonCheck = !buttonCheck">
                                        주문>미결제 유저 리스트 (Big)
                                    </a>
                                </div>
                                <div>
                                    <a href="{{route('excel.user.all')}}" x-on:click="buttonCheck = !buttonCheck">
                                        회원 리스트 {{\App\User::count() ?? '0'}}명
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="flex p-4 bg-opacity-75 rounded-md font-bold"
                         style="background-color: #D7DBD1;color:#5A9367;">
                        <div class="px-4 space-y-2">
                            <div class="text-2xl">메일 템플릿 예시</div>
                            <div>
                                <i class="fas fa-mail-bulk text-7xl"></i>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 xs:grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-2 sm:gap-3">
                            <div>
                                <a href="{{route('admin.mails.test.confirmation', ['type'=>'확정', 'reservation'=>13128])}}" target="_blank">
                                    테스트용 확정 필요
                                </a>
                            </div>
                            <div>
                                <a href="{{route('admin.mails.test.confirmationComplete', ['reservation'=>13128])}}" target="_blank">
                                    테스트용 확정 결과
                                </a>
                            </div>
                            <div>
                                <a href="{{route('admin.mails.test.reschedule', ['type'=>'확정', 'reservation'=>13128])}}" target="_blank">
                                    테스트용 확정 문의
                                </a>
                            </div>
                            <div>
                                <a href="{{route('admin.mails.test.confirmation', ['type'=>'확정'])}}" target="_blank">
                                    확정
                                </a>
                            </div>
                            <div>
                                <a href="{{route('admin.mails.test.confirmation', ['type'=>'변경'])}}" target="_blank">
                                    확정 변경
                                </a>
                            </div>
                            <div>
                                <a href="{{route('admin.mails.test.confirmation', ['type'=>'연장'])}}" target="_blank">
                                    확정 연장
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="select-text">
                        <div class="flex flex-wrap gap-1">
                            <livewire:admin.dash-board.calculate></livewire:admin.dash-board.calculate>
                        </div>
                    </div>

                    <div class="select-text">
                        <div class="flex flex-wrap gap-1">
                            <livewire:admin.dash-board.percentage-occupancy></livewire:admin.dash-board.percentage-occupancy>
                        </div>
                    </div>
                    <div class="select-text">
                        <livewire:admin.calculation.saved-image-lists></livewire:admin.calculation.saved-image-lists>
                    </div>

                @endauth
            </div>
        </div>
    </div>
@php
    function number2hangul($number){
        $num = array('', '일', '이', '삼', '사', '오', '육', '칠', '팔', '구');
        $unit4 = array('', '만', '억', '조', '경');
        $unit1 = array('', '십', '백', '천');

        $res = array();

        $number = str_replace(',','',$number);
        $split4 = str_split(strrev((string)$number),4);

        for($i=0;$i<count($split4);$i++){
                $temp = array();
                $split1 = str_split((string)$split4[$i], 1);
                for($j=0;$j<count($split1);$j++){
                        $u = (int)$split1[$j];
                        if($u > 0) $temp[] = $num[$u].$unit1[$j];
                }
                if(count($temp) > 0) $res[] = implode('', array_reverse($temp)).$unit4[$i];
        }
        return implode(' ', array_reverse($res));
}
@endphp
@endsection

@section('bottom-script')
    <script type="text/javascript">
        window.onload=function (){
            //randomColor();
        };
        function getPaymentTotalPrice($id){
            return {
                data : 0,
                checkTotalPrice(){
                    this.data = '1'
                {{--//    {{\App\Hotel::find('\$id')->getHotelTotalPriceAttribute()}}--}}
                }
            }
        }
        function randomColor2(){
            var allowed = "ABCDEF0123456789", S = "#";

            while(S.length < 7){
                S += allowed.charAt(Math.floor((Math.random()*16)+1));
            }
            return S;
        }

        function randomColor(){
            $('.randomColor').each(function(index,item){
                $(item).css('backgroundColor',randomColor2());
            });
        }
    </script>
@endsection
