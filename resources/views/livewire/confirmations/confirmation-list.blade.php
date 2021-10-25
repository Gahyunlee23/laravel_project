@inject('formatter', 'App\Formatter')
<div>
    <div class="w-full py-2 font-bold text-black text-xl">
        진행 확정 정보
    </div>
    <div class="overflow-x-scroll">
        <table class="table-auto w-full rounded-sm border border-solid border-tm-c-ED rounded-sm">
            <thead class="bg-gray-200">
                <tr class="divide-x divide-white">
                    <td class="text-center px-2 py-2 whitespace-pre">IDX</td>
                    <td class="text-center px-4 py-2 whitespace-pre">스케쥴러</td>
                    <td class="text-center px-4 py-2 whitespace-pre">ID</td>
                    <td class="text-center px-4 py-2 whitespace-pre">룸타입</td>
                    <td class="text-center px-4 py-2 whitespace-pre">입실</td>
                    <td class="text-center px-4 py-2 whitespace-pre">퇴실</td>
                    <td class="text-center px-4 py-2 whitespace-pre">총 추가 박수</td>
                    <td class="text-center px-4 py-2 whitespace-pre">메모</td>
                    <td class="text-center px-4 py-2 whitespace-pre">추가정보</td>
                    <td class="text-center px-4 py-2 whitespace-pre">삭제</td>
                </tr>
            </thead>
            @foreach ($confirmations as $confirmation)
            @php
                $check=null;
                if($loop->index!==0){
                    $check = $confirmations->skip($loop->index-1)->first();
                }
            @endphp
            <tbody class="bg-gray-100 hover:bg-gray-300">
                <tr class="divide-x divide-white">
                    <td class="text-center px-2 py-1">
                        {{$loop->index+1}}@if($loop->index+1 === $confirmations->count())-현재@endif
                    </td>
                    <td class="text-center px-2 py-1">
                        @switch($confirmation->status)
                            @case('0')
                            <div class="px-2 py-1 bg-red-500 hover:bg-red-600 cursor-pointer rounded-md text-white" onclick="event.preventDefault();if(confirm('스케쥴러 ON 하시겠습니까?')){ Livewire.emit('confirmationListEventScheduler', true, {{$confirmation->id}}); }">
                                OFF
                            </div>
                            @break
                            @case('1')
                            <div class="px-2 py-1 bg-blue-500 hover:bg-blue-600 cursor-pointer rounded-md text-white" onclick="event.preventDefault();if(confirm('스케쥴러 OFF 하시겠습니까?')){ Livewire.emit('confirmationListEventScheduler', false, {{$confirmation->id}}); }">
                                ON
                            </div>
                            @break
                            @case('2') 중도퇴실 @break
                            @case('3') 확정대기 @break
                            @default 오류
                        @endswitch
                    </td>
                    <td class="text-center px-2 py-1">
                        {{$confirmation->id}}
                    </td>
                    <td class="text-center px-2 py-1 whitespace-pre @if($check!==null && $check->room_type !== $confirmation->room_type)text-red-500 @endif">{{$confirmation->room_type}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre @if($check!==null && $check->start_dt !== $confirmation->start_dt)text-red-500 @endif">{{$formatter->carbonFormat($confirmation->start_dt, 'Y년 m월 d일(요일) H시 i분')}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre @if($check!==null && $check->end_dt !== $confirmation->end_dt)text-red-500 @endif">{{$formatter->carbonFormat($confirmation->end_dt, 'Y년 m월 d일(요일) H시 i분')}}</td>
                    <td class="text-center px-2 py-1                @if($check!==null && $check->add_days !== $confirmation->add_days)text-red-500 @endif">{{$confirmation->add_days}}</td>
                    <td class="text-center px-2 py-1">{{$confirmation->memo ?? '정보없음'}}</td>
                    <td class="text-center px-2 py-1">{{$confirmation->add_memo ?? '정보없음'}}</td>
                    <td class="text-center px-2 py-1">
                        <div class="px-1 py-1 bg-red-500 rounded-md cursor-pointer text-white"
                            onclick="confirm('정말 삭제 하시겠습니까?\n임시 삭제 처리됩니다.') || event.stopImmediatePropagation()"
                            wire:click="confirmationDelete({{$confirmation->id}})">
                            삭제
                        </div>
                    </td>
                </tr>
            </tbody>
            @endforeach

            @if($confirmations->count()===0)
                <tbody class="bg-gray-100 hover:bg-gray-300 text-center">
                    <td colspan="100%">이전 확정 정보 없음</td>
                </tbody>
            @endif
        </table>
    </div>
    <div class="w-full py-2 font-bold text-black text-xl">
        삭제 확정 정보
    </div>
    <div class="overflow-x-scroll">
        <table class="table-auto w-full rounded-sm border border-solid border-tm-c-ED rounded-sm">
            <thead class="bg-gray-200">
            <tr class="divide-x divide-white">
                <td class="text-center px-2 py-2 whitespace-pre">IDX</td>
                <td class="text-center px-4 py-2 whitespace-pre">ID</td>
                <td class="text-center px-4 py-2 whitespace-pre">룸타입</td>
                <td class="text-center px-4 py-2 whitespace-pre">입실</td>
                <td class="text-center px-4 py-2 whitespace-pre">퇴실</td>
                <td class="text-center px-4 py-2 whitespace-pre">총 추가 박수</td>
                <td class="text-center px-4 py-2 whitespace-pre">메모</td>
                <td class="text-center px-4 py-2 whitespace-pre">기능</td>
                <td class="text-center px-4 py-2 whitespace-pre">완전</td>
            </tr>
            </thead>
            @foreach ($confirmationsOnlyTrashd as $confirmation)
                @php
                    $check=null;
                    if($loop->index!==0){
                        $check = $confirmationsOnlyTrashd->skip($loop->index-1)->first();
                    }
                @endphp
                <tbody class="bg-gray-100 hover:bg-gray-300">
                <tr class="divide-x divide-white">
                    <td class="text-center px-2 py-1">
                        {{$loop->index+1}}
                    </td>
                    <td class="text-center px-2 py-1">
                        {{$confirmation->id}}
                    </td>
                    <td class="text-center px-2 py-1 whitespace-pre @if($check!==null && $check->room_type !== $confirmation->room_type)text-red-500 @endif">{{$confirmation->room_type}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre @if($check!==null && $check->start_dt !== $confirmation->start_dt)text-red-500 @endif">{{$formatter->carbonFormat($confirmation->start_dt, 'Y년 m월 d일(요일) H시 i분')}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre @if($check!==null && $check->end_dt !== $confirmation->end_dt)text-red-500 @endif">{{$formatter->carbonFormat($confirmation->end_dt, 'Y년 m월 d일(요일) H시 i분')}}</td>
                    <td class="text-center px-2 py-1                @if($check!==null && $check->add_days !== $confirmation->add_days)text-red-500 @endif">{{$confirmation->add_days}}</td>
                    <td class="text-center px-2 py-1">{{$confirmation->memo ?? '정보없음'}}</td>
                    <td class="text-center px-2 py-1">
                        <div class="px-1 py-1 bg-blue-500 rounded-md cursor-pointer text-white"
                             onclick="confirm('정말 삭제 취소 하시겠습니까?') || event.stopImmediatePropagation()"
                             wire:click="confirmationRestore({{$confirmation->id}})">
                            삭제취소
                        </div>
                    </td>
                    <td class="text-center px-2 py-1">
                        <div class="px-1 py-1 bg-red-500 rounded-md cursor-pointer text-white"
                             onclick="confirm('정말 삭제 하시겠습니까?\n실제 데이터 완전 삭제 됩니다.') || event.stopImmediatePropagation()"
                             wire:click="confirmationForceDelete({{$confirmation->id}})">
                            삭제
                        </div>
                    </td>
                </tr>
                </tbody>
            @endforeach
            @if($confirmationsOnlyTrashd->count()===0)
                <tbody class="bg-gray-100 hover:bg-gray-300 text-center">
                    <td colspan="100%">정보 없음</td>
                </tbody>
            @endif
        </table>
    </div>
    @if(session()->has('result'))
        <div class="mt-4 px-2 py-3 bg-green-400 rounded-md">
            <div class="text-white font-bold">
                {{ session()->pull('result') }}
            </div>
        </div>
    @endif
</div>
