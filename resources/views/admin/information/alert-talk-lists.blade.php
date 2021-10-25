@extends('layouts.app')

@section('content')
@php
   $formatter = new \App\Formatter();
@endphp
<div class="max-w-1200 mx-auto">
    <div class="flex justify-center">
        <div class="block w-full">
            <div class="flex flex-wrap justify-center items-center pb-6">
                <div class="w-full max-w-6xl">
                    <div class="bg-white rounded-sm">
                        <div class="divide-y divide-gray-500 px-4">
                            <div class="p-4 flex flex-wrap gap-2">
                                <div>
                                    총 개수
                                </div>
                                <div>
                                    {{$alertTalkLists->count()}}
                                </div>
                            </div>
                            @foreach ($alertTalkLists as $list)
                                <div class="p-4 flex flex-wrap gap-2">
                                    <div>
                                        {{$list->catalog}}
                                    </div>
                                    <div class="space-y-2">
                                        <div>{{ $formatter->carbonFormat($list->send_at, 'Y년 m월 d일 H시i분') }}</div>
                                        <div class="whitespace-pre">{!! $list->template !!}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
    </div>
</div>

@endsection
@section('bottom-script')
<script type="text/javascript">

</script>
@endsection
