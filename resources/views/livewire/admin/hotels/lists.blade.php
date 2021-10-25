<div>
    <div class="max-w-1200 mx-auto pb-20">
        <div class="flex justify-center">

            <div class="w-full py-2 space-y-2">
                <div class="w-full px-3 flex">
                    <div class="flex-0">
                        <a
                            class="NaNumSquare text-lg text-center font-bold bg-green-400 hover:bg-green-600 text-white rounded-sm border py-1 px-6"
                            href="{{route('hotel.curator')}}">
                            큐레이터 호텔 리스트로 이동
                        </a>
                    </div>
                    <div class="flex-0 ml-auto space-x-2">
                        <a class="NaNumSquare text-lg text-center font-bold bg-green-400 hover:bg-green-600 text-white rounded-sm border py-1 px-6"
                           href="{{ route('hotel.create') }}">
                            {{ __('호텔 추가') }}
                        </a>
                    </div>
                </div>
                <div class="w-full card-body p-3 mb-16 space-y-4">
                    @foreach($hotels as $list_index=>$list)
                        {{--{{$list}}--}}
                        <div class="w-full">
                            <div class="inline-block w-full p-4 border-2 border-solid rounded-md
                            @switch($list->status)
                            @case(0)
                                border-red-600 bg-red-500
                                @break
                            @case(1)
                                border-gray-600 bg-gray-500
                                @break
                            @case(2)
                                border-green-700 bg-green-700 bg-opacity-40
                                @break
                            @default
                                border-yellow-600 bg-yellow-500
                            @endswitch
                                ">
                                <div class="inline-block w-full">
                                    @if($list->curator === 'Y')
                                        <div class=" p-2">
                                            <span class="text-2xl text-white AppSdGothicNeoR font-bold">큐레이터</span>
                                            <div class="pt-2 text-white">
                                                @foreach (\App\CuratorHotel::where('hotel_id','=',$list->id)->get() as $item)
                                                    [{{ $item->curator->user_id }}]
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    @isset($list->order)
                                        <div class="float-left p-2">
                                            <span class="text-2xl text-white AppSdGothicNeoR font-bold">{{$list->order}} 순위 출력</span>
                                        </div>
                                    @endisset

                                    <div class="float-right w-1/4">
                                        @switch($list->status)
                                            @case(0)
                                            <div
                                                class="max-w-sm mb-3 text-center text-lg border text-white font-bold py-2 px-4 rounded-lg">
                                                현상태 - 삭제
                                            </div>
                                            @break
                                            @case(1)
                                            <div
                                                class="max-w-sm mb-3 text-center text-lg border text-white font-bold py-2 px-4 rounded-lg">
                                                현상태 - 미오픈
                                            </div>
                                            @break
                                            @case(2)
                                            <div
                                                class="max-w-sm mb-3 text-center text-lg border text-white font-bold py-2 px-4 rounded-lg">
                                                현상태 - 오픈
                                            </div>
                                            @break
                                            @default
                                            <div
                                                class="max-w-sm mb-3 text-center text-lg border text-white font-bold py-2 px-4 rounded-lg">
                                                현상태 - 기간지남
                                            </div>
                                        @endswitch
                                    </div>

                                    <div class="flow-root py-6"></div>
                                    <div class="p-2 flex">
                                        <div class="flex-1 text-2xl text-white font-bold">{{$list->options[0]->title ?? '정보없음'}}
                                        </div>
                                        <div class="ml-auto">
                                            @if($list->grade!=='' && $list->grade!==null)
                                                <div class="px-2 pt-1 pb-2 bg-red-400 rouned-md text-lg text-white cursor-pointer"
                                                     onclick="if(confirm('택 삭제 하시겠습니까?')){ document.getElementById('hotel-grade-delete-{{$list->id}}').submit(); }else{ event.stopImmediatePropagation(); }">
                                                    {{$list->grade}}
                                                </div>
                                                <form id="hotel-grade-delete-{{$list->id}}"
                                                      action="{{route('hotel.grade.delete', ['hotel'=>$list->id])}}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    @method('POST')
                                                </form>
                                            @else
                                                <div class="px-2 pt-1 pb-2 bg-blue-400 rouned-md text-lg text-white cursor-pointer"
                                                     onclick="if(confirm('Event 택 추가 하시겠습니까?')){
                                                         document.getElementById('hotel-grade-append-{{$list->id}}').submit();
                                                         }else{ event.stopImmediatePropagation(); }">
                                                    이벤트 택 추가
                                                </div>

                                                <form id="hotel-grade-append-{{$list->id}}"
                                                      action="{{route('hotel.grade.append', ['hotel'=>$list->id])}}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="grade" value="event">
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($list->option)
                                        <div class="border hover:border-2 border-solid border-black">
                                            <livewire:admin.hotel.hotel-and-area :key="$list->id" :hotel="$list" :list-index="$list_index"></livewire:admin.hotel.hotel-and-area>
                                        </div>
                                    @endisset

                                    @isset($list->room)
                                        <livewire:admin.hotel.rooms-price :key="$list->id" :item="$list" :list-index="$list_index"></livewire:admin.hotel.rooms-price>
                                    @endisset

                                    <div class="border hover:border-2 border-solid border-black">
                                        <div
                                            class="flow-root px-4 py-2 bg-gray-400 cursor-pointer hover:bg-gray-500 hover:text-white"
                                            data-target="order_list_table" data-index="{{$list_index}}"
                                            onclick="$('.'+$(this).data('target')+'[data-index='+$(this).data('index')+']').stop().slideToggle('slow');">
                                            <div class="float-left font-bold text-black">다른 호텔 리스트 관리</div>
                                            <div class="float-right"></div>
                                        </div>
                                        <div class="order_list_table hidden" data-index="{{$list_index}}">
                                            <livewire:admin.hotels.other-hotel-list :key="$list->id" :hotel="$list"></livewire:admin.hotels.other-hotel-list>
                                        </div>
                                    </div>

                                    <div class="border border-solid border-black">
                                        <div class="flow-root px-4 py-2 bg-gray-400">
                                            <a href="{{route('hotel.term.index',$list->id)}}">
                                                <div class="float-left font-bold text-black">
                                                    기간 블록 세팅
                                                </div>
                                            </a>
                                        </div>
                                    </div>


                                </div>

                                <div class="pt-4 space-y-1">

                                    <button
                                        class="submit-btn mx-auto w-3/12 max-w-2xl text-center text-lg bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
                                        onclick="location.href='{{route('hotel.edit', ['hotel'=>$list->id])}}'">
                                        수정
                                    </button>
                                    <button
                                        class="submit-btn mx-auto w-2/12 max-w-2xl text-center text-lg bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg"
                                        onclick="event.preventDefault();if(confirm('정말 삭제 하시겠습니까?')){ document.getElementById('destroy-form{{$list->id}}').submit();}">
                                        삭제
                                    </button>

                                    @switch($list->status)
                                        @case(0)
                                        <button
                                            class="submit-btn mx-auto w-4/12 max-w-2xl text-center text-lg bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg"
                                            onclick="event.preventDefault();if(confirm('정말 미오픈으로 전환 하시겠습니까??')){ document.getElementById('close-form{{$list->id}}').submit();}">
                                            미오픈
                                        </button>
                                        @break

                                        @case(1)
                                        <button
                                            class="submit-btn mx-auto w-4/12 max-w-2xl text-center text-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg"
                                            onclick="event.preventDefault();document.getElementById('open-form{{$list->id}}').submit();">
                                            오픈
                                        </button>
                                        @break

                                        @case(2)
                                        <button
                                            class="submit-btn mx-auto w-4/12 max-w-2xl text-center text-lg bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg"
                                            onclick="event.preventDefault();if(confirm('정말 미오픈으로 전환 하시겠습니까??')){ document.getElementById('close-form{{$list->id}}').submit();}">
                                            미오픈
                                        </button>
                                        @break
                                    @endswitch

                                    <form id="open-form{{$list->id}}"
                                          action="{{route('hotel.open', ['hotel'=>$list->id])}}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('POST')
                                    </form>
                                    <form id="close-form{{$list->id}}"
                                          action="{{ route('hotel.close', ['hotel'=>$list->id])}}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('POST')
                                    </form>
                                    <form id="destroy-form{{$list->id}}"
                                          action="{{route('hotel.destroy', ['hotel'=>$list->id])}}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="fixed bottom-0 w-full px-2 bg-tm-c-ED border-t border-solid border-tm-c-979b9f rounded-b-sm">
            @if(isset($hotels)&& $hotels->count()===0)
                <div class="w-full text-xl text-center">
                    <div class="py-2">
                        데이터 없음
                    </div>
                </div>
            @elseif(isset($hotels)&& $hotels->count()>=1)
                <div class="w-full">
                    <div class="py-2">
                        {{$hotels->links('vendor.livewire.tailwind.center-paginate')}}
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if (Session::has('message'))
        <div
            class="mt-6 mr-4 p-4 fixed top-0 right-0 bg-green-400 bg-opacity-80 text-xl text-white font-bold text-center rounded-md">
            <ul>
                <li>{{ Session::get('message')}}</li>
            </ul>
        </div>
    @endif
</div>
