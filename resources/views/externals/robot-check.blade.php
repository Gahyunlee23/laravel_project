@extends('layouts.app')

@section('top-style')
    <style type="text/css">

    </style>
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center items-center" style="height:75vh;">

            <div class="w-full max-w-4xl px-0 sm:px-2">
                <div class="">
                    <div class="bg-tm-c-ED py-10" x-data="{ robot : false }">
                        <div class="space-y-8 select-none">

{{--                            <div class="flex justify-center pb-2">--}}
{{--                                <span class="fa-stack fa-1x w-40" style="vertical-align: bottom;">--}}
{{--                                    <i class="fad fa-robot text-7xl text-tm-c-979b9f fa-stack-1x fa-inverse"></i>--}}
{{--                                    <i class="fal fa-times text-7xl fa-stack-1x" x-show="robot" x-cloak style="margin-top: -14px;"></i>--}}
{{--                                </span>--}}
{{--                            </div>--}}
                            <div class="space-y-4">
                                <div class="flex justify-center">
                                    <div class="AppSdGothicNeoR text-tm-c-30373F text-xl sm:text-2xl tracking-wide">
                                            <div class="text-center text-base sm:text-lg leading-6 sm:leading-7">
                                                체크 후 {{$type}}하기 클릭 해주세요.
                                            </div>
                                        <div class="text-center pt-4">
                                            <input type="checkbox" name="robot" id="robot" x-model="robot" class="form-checkbox text-tm-c-ff7777">
                                            <label for="robot">
                                                <span class="text-sm">체크하기</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4" x-show.transition.origin.top="robot" x-cloak>
                                    <div class="flex justify-center">
                                        <div class="noRobotBtn AppSdGothicNeoR py-2 px-8 text-white cursor-pointer text-xs 4xs:text-base 3xs:text-lg 2xs:text-xl sm:text-2xl tracking-wide text-center bg-tm-c-C1A485 rounded-md"
                                             onclick="noRobot();$('.noRobotBtn').addClass('hidden');" :data-check="robot">
                                            {{$type}}하기
                                        </div>
                                    </div>
                                    @if($type === '확정')
                                        <div class="flex justify-center">* 고객에게 확정 카카오톡 알림톡이 전달됩니다.</div>
                                    @elseif($type === '변경')
                                        <div class="flex justify-center">* 변경 요청 후 호텔에삶 담당 매니저에게 연락주세요.</div>
                                    @endif
                                </div>

                            </div>

                            <div class="flex justify-center">
                                <div>
                                    <div class="space-y-2 xl:space-y-0 xl:space-x-2 xl:flex select-auto">
                                        <div class="w-full">
                                            <a href="tel:1599-4330">
                                                <div class="text-center p-2 select-none">
                                                    <span class="JeJuMyeongJo font-bold text-base sm:text-lg">담당자 연락처</span>
                                                </div>
                                                <div class="w-full max-w-4xl bg-tm-c-C1A485 cursor-pointer py-4 sm:py-5 px-4 sm:px-12 rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763"
                                                     style="min-width: 250px">
                                                    <div class="AppSdGothicNeoR text-xl sm:text-2xl text-white text-center">
                                                        1599-4330
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="w-full">
                                            <a href="mailto:{{env('MAIL_USERNAME')}}">
                                                <div class="text-center p-2 select-none">
                                                    <span class="JeJuMyeongJo font-bold text-base sm:text-lg">담당자 이메일</span>
                                                </div>
                                                <div class="w-full max-w-4xl bg-tm-c-C1A485 cursor-pointer py-4 sm:py-5 px-4 sm:px-12 rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763"
                                                     style="min-width: 250px">
                                                    <div class="AppSdGothicNeoR text-xl sm:text-2xl text-white text-center">
                                                        {{env('MAIL_USERNAME')}}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('bottom-script')
<script>
    function noRobot(){
        if($('.noRobotBtn').data('check')){
            if(confirm('{{$type}} 처리 하시겠습니까?')){
                @switch($type)
                    @case('확정')
                        location.href='{{ route('external.hotel.confirmation', ['key'=>$key]) }}';
                    @break

                    @case('변경')
                        location.href='{{ route('external.hotel.confirmation.change', ['key'=>$key]) }}';
                    @break
                @endswitch
            }else{
                setTimeout(function(){
                    $('.noRobotBtn').removeClass('hidden');
                },500);
            }
        }
    }
</script>
@endsection
