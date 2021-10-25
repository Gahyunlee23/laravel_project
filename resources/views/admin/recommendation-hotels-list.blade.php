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
                        전체 신청 수 : {{ \App\Recommendation::count()}}개
                        /
                        오늘 신청 수 : {{ \App\Recommendation::where(function ($query){
                            $query->whereDay('created_at','=', date('d'));
                        })->count() }}개
                        /
                        어제 신청 수 : {{ \App\Recommendation::where(function ($query){
                            $query->whereDay('created_at','=', \Carbon\Carbon::now()->subDays(1)->format('d'));
                        })->count() }}개
                        /
                        그제 신청 수 : {{ \App\Recommendation::where(function ($query){
                            $query->whereDay('created_at','=', \Carbon\Carbon::now()->subDays(2)->format('d'));
                        })->count() }}개
                    </div>
                    <div>
                        @foreach ($recommendations as $recommendation)
                            <div class="my-4 py-3 px-2 bg-gray-200 bg-opacity-70 rounded-md">
                                <table class="w-full table-fixed">
                                    <tr>
                                        <td colspan="4">
                                            작성:{{$recommendation->created_time}}/{{$recommendation->created_at}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            추천 항목
                                        </td>
                                        <td>
                                            신청자 연락처
                                        </td>
                                        <td>
                                            개인정보
                                        </td>
                                        <td>
                                            마케팅
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$recommendation->recommendation}}
                                        </td>
                                        <td>
                                            {{$recommendation->tel}}
                                        </td>
                                        <td>
                                            @switch($recommendation->privacy)
                                                @case('1')
                                                동의
                                                @break
                                                @case('0')
                                                미동의
                                                @break
                                                @default
                                                미동의
                                            @endswitch
                                        </td>
                                        <td>
                                            @switch($recommendation->marketing)
                                                @case('1')
                                                동의
                                                @break
                                                @case('0')
                                                미동의
                                                @break
                                                @default
                                                미동의
                                            @endswitch
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
</div>

@endsection
@section('bottom-script')
    <script type="text/javascript">

    </script>
@endsection
