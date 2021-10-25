@extends('layouts.app')
@section('content')
    <div class="max-w-1200 mx-auto">
        <div class="flex justify-center">
            <div class="w-full">
                <div class="pt-2 px-2 space-y-6">
                    <div>
                        <a href="{{route('curator.create')}}"
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded text-center cursor-pointer">
                            생성
                        </a>
                    </div>

                    @if(Session::get('message'))
                    <div class="p-4 text-white font-bold text-xl">
                        {{Session::pull('message')}}
                    </div>
                    @endif

                    <div>
                        <div class="flex flex-col justify-between p-4 bg-gray-200 rounded-sm">
                        @if(isset($curators))
                            <div class="py-2 flex bg-gray-400 text-center font-bold text-xl rounded-md">
                                <div class="flex-1 whitespace-pre">ID</div>
                                <div class="flex-1 whitespace-pre">PAGE</div>
                                <div class="flex-1 whitespace-pre">Pass</div>
                                <div class="flex-1 whitespace-pre">성함</div>
                                <div class="flex-1 whitespace-pre">연락처</div>
                                <div class="flex-1 whitespace-pre">이메일</div>
                                <div class="flex-1 whitespace-pre">메모</div>
                                <div class="flex-1 whitespace-pre">기능</div>
                                <div class="flex-1 whitespace-pre">큐레이터 호텔</div>
                            </div>

                            <div class="text-center">
                            @foreach ($curators as $curator)
                                <div class="flex items-center py-4 @if($curator->visible) bg-gray-400 @else bg-red-400 bg-opacity-75 @endif rounded-md">
                                    <div class="flex-1">
                                        <a href="{{route('curator.edit',['curator'=>$curator->id])}}"
                                           class="font-bold text-blue-500">
                                            {{$curator->user_id}}
                                        </a>
                                    </div>
                                    <div class="flex-1">
                                        <a href="{{ secure_url('/'.$curator->user_page)}}"
                                           class="font-bold text-blue-500">
                                        {{$curator->user_page}}
                                        </a>
                                    </div>
                                    <div class="flex-1" x-data="{show : false}">
                                        <div @click="show = !show" class="cursor-pointer bg-green-400 hover:bg-green-500 rounded-md text-white py-1">
                                            확인
                                        </div>
                                        <div x-show="show" x-cloak>{{$curator->user_pass}}</div>
                                    </div>
                                    <div class="flex-1">
                                        {{$curator->name}}
                                    </div>
                                    <div class="flex-1">
                                        {{$curator->tel}}
                                    </div>
                                    <div class="flex-1">
                                        {{$curator->email}}
                                    </div>
                                    <div class="flex-1">
                                        {{$curator->explanation}}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex space-x-2 justify-center">
                                            @if($curator->visible)
                                                <a onclick="event.preventDefault();document.getElementById('destroy-form{{$curator->id}}').submit();"
                                                   class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded text-center cursor-pointer">
                                                    비활성화
                                                </a>
                                                <form id="destroy-form{{$curator->id}}" action="{{route('curator.destroy',['curator'=>$curator->id])}}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @else
                                                <a onclick="event.preventDefault();document.getElementById('build-form{{$curator->id}}').submit();"
                                                   class=" bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center cursor-pointer">
                                                    활성화
                                                </a>
                                                <form id="build-form{{$curator->id}}" action="{{route('curator.build',['curator'=>$curator->id])}}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('POST')
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div>
                                            <livewire:admin.curator.hotel-interlock :curator="$curator" :key="$curator->id"></livewire:admin.curator.hotel-interlock>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        @endif
                        </div>
                    </div>


            </div>

        </div>
    </div>

@endsection

@section('bottom-script')

@endsection
