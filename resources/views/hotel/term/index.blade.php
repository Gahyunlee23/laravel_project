@extends('layouts.app')

@section('top-style')
    <style type="text/css">

    </style>
@endsection

@section('meta-tag')
    @php
        $keywords ='';
        $meta_title=env('APP_NAME');
        $ogDescription='';
        $ogUrl=secure_url('/');
        $ogTitle=env('APP_NAME');
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
    <div class="max-w-1200 mx-auto">
        <div class="flex justify-center">
            <div class="w-full">

                <div class="w-full card-body p-3 space-y-4">
                    @foreach($hotels as $index=>$hotel)
                        <div class="w-full">
                            <div class="inline-block w-full p-4 border-2 border-solid rounded-md">
                                <div class="">
                                    <div>
                                        <div class="relative h-full">
                                            <div class="absolute z-20 text-white">
                                                <div class="pt-4 pl-4">
                                                    <div class="text-xl font-bold">
                                                        {{$hotel->options->where('disable','=','N')->first()->title}}
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="relative w-full h-60" src="{{ secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.Str::of($hotel->images[0]->images)->explode('|')[0]) }}" alt="">
                                        </div>
                                        <div class="text-white">
                                            <div class="py-2">투어 가능시간 <span class="tour_start">{{$hotel->tour_start ?? '설정안됨'}}</span> ~ <span class="tour_end">{{$hotel->tour_end ?? '설정안됨'}}</span></div>
                                            <div class="text-black-50">
                                                수정
                                                <input type="time" onchange="changeToTourAccess()" name="tour_start" id="tour_start" value="{{$hotel->tour_start ?? '설정안됨'}}"
                                                       class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                ~
                                                <input type="time" onchange="changeToTourAccess()" name="tour_end" id="tour_end" value="{{$hotel->tour_end ?? '설정안됨'}}"
                                                       class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                (15분간격)
                                            </div>
                                        </div>
                                        <div>
                                            <div class="container mx-auto py-4">
                                                <div id="calendar"></div>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="w-full py-4">
                    <div class="flex">
                        <div onclick="location.href='{{url()->previous()}}'"
                             class="bg-gray-500 text-white px-4 py-2 border rounded-md hover:border-gray-700 cursor-pointer">
                            돌아가기
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
@section('bottom-script')
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script>
    var calendar_el=$('#calendar');
    var calendar;
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        calendar = new FullCalendar.Calendar(calendar_el, {
            timeZone: 'Asia/Seoul',
            initialView: 'dayGridMonth',
            events: "{{route('fullcalender',['hotel_id'=>$id])}}",
            editable: true,
            selectable: true,
            selectHelper: true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            eventClick: function(info) {
                if(confirm('삭제하시겠습니까?')){
                    $.ajax({
                        url:  "{{route('fullcalenderAjax')}}",
                        data: {
                            id: info.id,
                            type: 'delete'
                        },
                        type: "POST",
                        success: function (data) {
                            displayMessage("삭제","호텔 기간 블록 세팅");
                        }
                    });
                }
            },
            eventDrop: function (event, delta) {
                console.log(event,delta);
            },
            select:function(start,end,allDay){
                var title = prompt('[입주,투어]를 입력해주세요','입주');
                var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
                var end = moment(end, 'DD.MM.YYYY').subtract(1,'days').format('YYYY-MM-DD')+' 09:00:00';
                $.ajax({
                    url:  "{{route('fullcalenderAjax')}}",
                    data: {
                        hotel_id: '{{$id}}',
                        title: title,
                        start: start,
                        end: end,
                        type: 'add'
                    },
                    type: "POST",
                    success: function (data) {
                        displayMessage("추가","호텔 기간 블록 세팅");
                    }
                });
            }
        });
        calendar.render();
    });

    function changeToTourAccess(){
        $.ajax({
            url:  "{{route('fullcalenderAjax')}}",
            data: {
                hotel_id: '{{$id}}',
                tour_start: $('#tour_start').val(),
                tour_end: $('#tour_end').val(),
                type: 'tour_access_update'
            },
            type: "POST",
            success: function (data) {
                var ts='';
                var te='';
                if(data.tour_start.length <= 5){
                    ts=':00';
                }
                if(data.tour_end.length <= 5){
                    te=':00';
                }
                $('.tour_start').html(data.tour_start+ts);
                $('.tour_end').html(data.tour_end+te);
                displayMessage("수정","호텔 투어 시간 블록 세팅");
            }
        });
    }

    function addSource(data){
        console.log(data);

        calendar.fullCalendar('renderEvent', {
            id: data.id,
            title: data.title,
            start: data.start,
            end: data.end,
            allDay: data.allDay
        },true);
        calendar.fullCalendar('unselect');
    }
    function displayMessage(message,catalog) {
        toastr.success(message, catalog);
    }

</script>
@endsection
