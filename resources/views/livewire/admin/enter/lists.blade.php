<div>
    <div class="AppSdGothicNeoR overflow-x-auto">
        <table class="table-auto w-full rounded-sm border border-solid border-tm-c-ED rounded-sm">
            <thead>
                <tr class="border-t border-b border-solid border-white">
                    <td class="text-lg text-white font-bold px-2 py-2 text-center whitespace-pre">ID</td>
                    <td class="text-lg text-white font-bold px-2 py-2 text-center whitespace-pre">상태</td>
                    <td class="text-lg text-white font-bold px-2 py-2 text-center whitespace-pre">호텔 매니저</td>
                    <td class="text-lg text-white font-bold px-2 py-2 text-center whitespace-pre">호텔명</td>
                    <td class="text-lg text-white font-bold px-2 py-2 text-center whitespace-pre">입점방식</td>
                    <td class="text-lg text-white font-bold px-2 py-2 text-center whitespace-pre">등록시기</td>
                    <td class="text-lg text-white font-bold px-2 py-2 text-center whitespace-pre">최근수정</td>
                    <td class="text-lg text-white font-bold px-2 py-2 text-center whitespace-pre">상세보기</td>
                </tr>
            </thead>
            <tbody class="divide-y divide-white font-bold text-black">
            @if(isset($addHotelList))
                @foreach($addHotelList as $addHotelItem)
                    <tr class="bg-white bg-opacity-75">
                        <td class="py-3 text-center">
                            <div class="whitespace-pre px-2">{{$addHotelItem->id}}</div>
                        </td>
                        <td class="py-3 text-center">
                            <div class="whitespace-pre px-2">{{$addHotelItem->enter_status}}</div>
                        </td>
                        <td class="py-3 text-center">
                            <div class="whitespace-pre px-2">{{$addHotelItem->manager->name ?? '미 입력'}}</div>
                        </td>
                        <td class="py-3 text-center">
                            <div class="whitespace-pre px-2">{{$addHotelItem->name ?? '미 입력'}}</div>
                        </td>
                        <td class="py-3 text-center">
                            <div class="whitespace-pre px-2">{{$addHotelItem->method ?? '미 입력'}}</div>
                        </td>
                        <td class="py-3 text-center">
                            <div class="whitespace-pre px-2">{{$addHotelItem->created_at ?? '정보없음'}}</div>
                        </td>
                        <td class="py-3 text-center">
                            <div class="whitespace-pre px-2">{{$addHotelItem->updated_at ?? '정보없음'}}</div>
                        </td>
                        <td class="py-3 text-center">
                            <button onclick="location.href='{{route('admin.hotel-enter.show', ['hotel'=>$addHotelItem->id])}}'" class="bg-blue-600 py-1 rounded-sm focus:outline-none">
                                <div class="text-white whitespace-pre pt-px px-2">상세보기</div>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

    <div class="px-2 bg-tm-c-ED border-t border-solid border-tm-c-979b9f rounded-b-sm">
        @if(isset($addHotelList)&& $addHotelList->count()===0)
            <div class="w-full text-xl text-center">
                <div class="py-2">
                    데이터 없음
                </div>
            </div>
        @elseif(isset($addHotelList)&& $addHotelList->count()>=1)
            <div class="w-full">
                <div class="py-2">
                    {{$addHotelList->links('vendor.livewire.tailwind.center-paginate')}}
                </div>
            </div>
        @endif
    </div>

</div>
