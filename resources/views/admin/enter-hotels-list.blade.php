@extends('layouts.app')

@section('top-style')

@endsection

@section('content')
<div class="max-w-1200 mx-auto px-2 pb-10">
    <div class="flex justify-center">
        <div class="block w-full">
            <div class="flex justify-center items-center">
                <div class="w-full max-w-1200 bg-white rounded-sm divide-y-2 p-4">
                    <div>
                        전체 신청 수 : {{ \App\Enter::count()}}개
                        /
                        오늘 신청 수 : {{ \App\Enter::where(function ($query){
                            $query->whereDay('created_at','=', date('d'));
                        })->count() }}개
                        /
                        어제 신청 수 : {{ \App\Enter::where(function ($query){
                            $query->whereDay('created_at','=', \Carbon\Carbon::now()->subDays(1)->format('d'));
                        })->count() }}개
                        /
                        그제 신청 수 : {{ \App\Enter::where(function ($query){
                            $query->whereDay('created_at','=', \Carbon\Carbon::now()->subDays(2)->format('d'));
                        })->count() }}개
                    </div>
                    @foreach ($enter_hotels as $hotel)
                        <div class="my-4 py-3 px-2 bg-gray-200 bg-opacity-70 rounded-md">
                            <table class="w-full table-fixed">
                                <tr>
                                    <td colspan="7">
                                        작성:{{$hotel->created_time}}/{{$hotel->created_at}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        호텔 명칭
                                    </td>
                                    <td>
                                        호텔 주소
                                    </td>
                                    <td>
                                        호텔 웹주소
                                    </td>
                                    <td>
                                        매니저 성함
                                    </td>
                                    <td>
                                        직책
                                    </td>
                                    <td>
                                        이메일
                                    </td>
                                    <td>
                                        연락처
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{$hotel->hotel_name}}
                                    </td>
                                    <td>
                                        {{$hotel->hotel_address}}
                                    </td>
                                    <td class="break-all">
                                        {{$hotel->hotel_web_address}}
                                    </td>
                                    <td>
                                        {{$hotel->manager_name}}
                                    </td>
                                    <td>
                                        {{$hotel->manager_rank}}
                                    </td>
                                    <td class="break-all">
                                        {{$hotel->manager_email}}
                                    </td>
                                    <td>
                                        {{$hotel->manager_hp}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="h-px bg-gray-300">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <table class="w-full table-fixed">
                                            <tr>
                                                <td>룸 타입</td>
                                                <td>1달</td>
                                                <td>3주</td>
                                                <td>2주</td>
                                                <td>1주</td>
                                                <td>단기</td>
                                            </tr>
                                            @foreach($hotel->rooms as $room)
                                            <tr>
                                                <td>{{$room->type}}</td>
                                                <td>{{number_format($room->supply_price_month)}}</td>
                                                <td>{{number_format($room->supply_price_3_weeks)}}</td>
                                                <td>{{number_format($room->supply_price_2_weeks)}}</td>
                                                <td>{{number_format($room->supply_price_1_weeks)}}</td>
                                                <td>{{number_format($room->supply_price_short_day)}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="h-px bg-gray-300">
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="7">
                                        <table class="w-full table-fixed">
                                            <tr>
                                                <td>어메니티</td>
                                                <td>시설</td>
                                                <td>혜택</td>
                                            </tr>
                                            <tr>
                                                <td>{{$hotel->option->amenities}}</td>
                                                <td>{{$hotel->option->facilities}}</td>
                                                <td>{{$hotel->option->benefit}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('bottom-script')
    <script type="text/javascript">

    </script>
@endsection
