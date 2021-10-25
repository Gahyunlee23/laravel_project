@extends('layouts.app')

@section('content')
    <div class="max-w-1200 mx-auto">
        <div class="text-white text-center px-2 space-y-4">
            <div class="">
                <div class="flex">
                    <div class="ml-auto p-1 bg-gray-500 rounded-sm">
                        <a href="{{route('hotel.index')}}">
                            뒤로가기
                        </a>
                    </div>
                </div>
                <div class="py-2 text-2xl">
                    {{ $hotel->option->title }}
                </div>
                <div>
                    <div>
                        <div>

                        </div>
                        <div></div>
                    </div>
                </div>
                <div class="space-y-2">
                    @foreach ($hotel->sorts as $sort)
                        <div>
                            <table class="py-2 table-flex w-full border border-solid border-gray-100">
                                <thead>
                                <tr class="">
                                    <td class="p-2 w-2/12">
                                        메인
                                    </td>
                                    <td class="p-2 w-2/12">
                                        서브
                                    </td>
                                    <td class="p-2 w-2/12">
                                        Type
                                    </td>
                                    <td class="p-2 w-3/12">
                                        정렬
                                    </td>
                                    <td class="p-2 w-3/12">
                                        설명
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="">
                                    <td class="p-2">{{$sort->main}}</td>
                                    <td class="p-2">{{$sort->sub}}</td>
                                    <td class="p-2">{{$sort->type}}</td>
                                    <td class="p-2">
                                        @if(Str::of($sort->order)->contains(','))
                                            @foreach (Str::of($sort->order)->explode(',') as $item)
                                                <div>
                                                    {{ \App\Hotel::find($item)->option->title }}
                                                </div>
                                            @endforeach
                                        @else
                                            {{$sort->order}}
                                        @endif
                                    </td>
                                    <td>{{$sort->memo}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
