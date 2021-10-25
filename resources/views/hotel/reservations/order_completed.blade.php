@extends('layouts.app')
@section('meta-tag')
    @php
        $meta_title=env('APP_TITLE');
        $ogDescription='매일을 여행하듯 사는 호텔한달살기, 호텔장기투숙 플랫폼 호텔에삶에서 만나보세요..';
        $keywords ='호텔에삶, 호텔의삶, 한달살기, 호텔한달살기, 서울한달살기, 서울한달숙소, 서울장기투숙, 호텔장기투숙, 단기월세, 한달살이, 호텔장기투숙, 국내한달살기, 호캉스, 서울무보증원룸, 보증금없는월세, 서울호캉스추천, 월세단기, 무보증월세,트래블메이커스, 트래블메이커';
        $ogTitle=env('APP_TITLE');
        $ogUrl=secure_url('/');
        $ogImage='';
    @endphp
    <meta name="copyright" property="copyright" content="&copy;트래블메이커::개인 맞춤형 여행 플랫폼">
    <meta name="content-language" content="kr">
    <meta name="build" content="">
    <meta name="keywords" property="keywords" content="{{$keywords}}">
    <meta name="title" property="title" content="{{$meta_title}}">
    <meta name="description" property="description" content="{{$ogDescription}}">

    <meta name="og:site_name" property="og:site_name" content="TravelMakers Korea"/>
    <meta name="og:url" property="og:url" content="{{$ogUrl}}">
    <meta name="og:title" property="og:title" content="{{$ogTitle}}">
    <meta name="og:description" property="og:description" content="{{$ogDescription}}">
    <meta name="og:image" property="og:image" content="{{$ogImage}}">

    <meta name="twitter:url" property="twitter:url" content="{{$ogUrl}}">
    <meta name="twitter:title" property="twitter:title" content="{{$ogTitle}}">
    <meta name="twitter:description" property="twitter:description" content="{{$ogDescription}}">
    <meta name="twitter:image" property="twitter:image" content="{{$ogImage}}">
@endsection

@section('content')
    <script>
        @if(isset($reservation) && $reservation->order_status === '3')
            kakaoPixel('7968131379699859784').pageView('결제 완료');
        @endif
    </script>
    <div class="container mx-auto">
        <div class="flex justify-center items-center" style="height:75vh;">
            <div class="w-full max-w-4xl px-2">
                <div class="">
                    <div class="bg-tm-c-ED py-10" style="">
                        <div class="space-y-8 select-none">

                            <div class="flex justify-center">
                                @if (isset($reservation))
                                    @switch($reservation->order_status)
                                        @case('3')
                                        @case('4')
                                        @case('5')
                                        <img src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg')}}"
                                             class="w-16" alt="">
                                        @break
                                        @default
                                        <img src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg')}}"
                                             class="w-16" alt="">
                                    @endswitch
                                @else
                                    <img src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg')}}"
                                         class="w-16" alt="">
                                @endif

                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-center">
                                    <div class="PtSerif italic text-tm-c-30373F text-3xl sm:text-5xl tracking-wide">
                                        @if (isset($reservation))
                                            @switch($reservation->order_status)
                                                @case('3')
                                                @case('4')
                                                @case('5')
                                                Thank you :)
                                                @break
                                                @default
                                                Sorry :(
                                            @endswitch
                                        @else
                                            Sorry :(
                                        @endif
                                    </div>
                                </div>

                                <div class="flex justify-center">
                                    <div class="JeJuMyeongJo text-tm-c-30373F text-2xl sm:text-3xl tracking-wide">
                                        @if (isset($reservation))
                                            @switch($reservation->order_status)
                                                @case('3')
                                                결제가 완료되었습니다.
                                                @break
                                                @case('4')
                                                @case('5')
                                                결제가 이미 완료되었습니다.
                                                @break
                                                @case('8')
                                                결제 도중 종료되었습니다.
                                                @break
                                                @default
                                                결제가 실패했습니다.
                                            @endswitch
                                        @else
                                            결제가 실패했습니다..
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- 네이버 프리미엄 로그 위한 코드 삽입 --}}
                            @if(isset($reservation->payment))
                                <input type="hidden" class="totalPrice" value="{{ $reservation->payment->total_price }}">
                            @endif

                            <div class="flex justify-center">
                                <div class="AppSdGothicNeoR text-tm-c-30373F text-lg text-center leading-7">
                                    @if (isset($reservation))
                                        @switch($reservation->order_status)
                                            @case('3')
                                            @case('4')
                                            @case('5')
                                            입주 관련 자세한 내용은 <span class="sm:hidden"><br></span>입력하신 휴대번호 카카오톡으로 연락드립니다.
                                            @break
                                            @default
                                            문의는 고객센터(1599-4330)로 연락주세요.
                                        @endswitch
                                    @else
                                        문의는 고객센터(1599-4330)로 연락주세요.
                                    @endif
                                </div>
                            </div>

                            <div class="flex justify-center flex-wrap sm:space-x-2 space-y-2 sm:space-y-0">
                                <div>
                                    <div class="">
                                        <div class="w-full select-none">
                                            <a
                                                @if($reservation->curator)
                                                    href="{{route('/',['curator_page'=>$reservation->curator->user_page ?? null])}}"
                                                @else
                                                    href="{{route('/')}}"
                                                @endif
                                            >
                                                <div class="w-full max-w-4xl @if (isset($reservation)) @if($reservation->order_status ==='3') bg-tm-c-C1A485 @else bg-tm-c-d7d3cf @endif @endif cursor-pointer py-5 sm:py-7 px-4 sm:px-12 rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763"
                                                     style="min-width: 250px">
                                                    <div class="AppSdGothicNeoR text-xl sm:text-2xl text-white text-center">
                                                        홈으로 돌아가기
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @if (isset($reservation))
                                    @switch($reservation->order_status)
                                        @case('1')@case('2')@case('0')@case('8')
                                        <div>
                                            <div class="">
                                                <div class="w-full select-none">
                                                    <a href="{{route('payment.order',['reservation'=>$reservation->id])}}">
                                                        <div class="w-full max-w-4xl bg-tm-c-C1A485 cursor-pointer py-5 sm:py-7 px-4 sm:px-12 rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763"
                                                             style="min-width: 250px">
                                                            <div class="AppSdGothicNeoR text-xl sm:text-2xl text-white text-center">
                                                                다시 결제하기
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                    @endswitch
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('bottom-script')
@if(auth()->check() && auth()->user()->hasAnyRole('개발'))
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
@endif
<script>
    window.onload = function () {
        @if($reservation->order_status === "3" && $reservation->payment->total_price > 1000)
            @if($reservation->payment->ga_check === '0')
                @php
                    \App\Payment::where('id','=',$reservation->payment->id)->limit(1)->update(['ga_check'=>'1']);
                @endphp
                gtag('event', 'purchase', {
                    "transaction_id": '{{$reservation->payment->order_id}}',
                    "value": '{{$reservation->payment->total_price}}',
                    "currency": "KRW",
                    "tax": 0,
                    "shipping": 0,
                    "items": [
                        {
                            "id": '{{$reservation->id}}',
                            "name": '{{$reservation->payment->goods_name}}',
                            "list_name": '{{$reservation->payment->goods_name}}',
                            "brand": '{{$reservation->payment->goods_name}}',
                            "category": '{{$reservation->payment->goods_option}}',
                            "price":  '{{$reservation->payment->total_price}}',
                        }
                    ]
                });
                gtag('event', 'conversion', {
                    'send_to': 'AW-753064854/gbB0CNXi7OoBEJa3i-cC',
                    'value':  '{{$reservation->payment->total_price}}',
                    'currency': 'KRW',
                    'transaction_id': '{{$reservation->payment->order_id}}'
                });
            @endif
        @endif

        setTimeout(function () {
            if(window.opener){
                window.opener.location.reload();
                window.close();
            }else{
                @if(isset($reservation->hotel_id))
                    location.href='{{route('hotel.view',['hotel'=>$reservation->hotel_id])}}';
                @else
                    location.href='/';
                @endif
            }
        },5000)
    };

{{--    @if(auth()->check() && auth()->user()->hasAnyRole('개발'))--}}
        @if(isset($reservation, $reservation->payment) && $reservation->order_status === '3')
                var _nasa={};
                _nasa['cnv'] = wcs.cnv("1", '{{$reservation->payment->total_price ?? 0 }}');
                console.log(_nasa['cnv']);
        @endif
{{--    @endif--}}
</script>
@endsection
