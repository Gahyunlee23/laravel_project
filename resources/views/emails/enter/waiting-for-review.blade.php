<div>
    <div>
        <table style="table-layout:auto;width: 100%;background-color: #ffffff;border:1px solid #7d7d7d;text-align: center;">
            <thead>
            <tr>
                <th colspan="8">
                    {{ $addHotel->enter_status ?? '상태 미정'}}
                </th>
            </tr>
            </thead>
            <thead>
            <tr>
                <th colspan="8">
                    호텔 매니저 정보
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">성명</th>
                <th colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">연락처</th>
                <th colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">이메일</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                   {{$addHotel->manager->name ?? '정보없음'}}님
                </td>
                <td colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$addHotel->manager->phone ?? '정보없음'}}
                </td>
                <td colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$addHotel->manager->email ?? '정보없음'}} ({{$addHotel->manager->email_verified_at !== null ? '메일 인증완료' : '메일 미인증' }})
                </td>
            </tr>
            </tbody>
            <thead>
            <tr>
                <th colspan="8">
                    호텔 담당자 정보
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">성명</th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">연락처</th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">부서명</th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">직급</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                   {{$addHotel->other->name ?? '정보없음'}}님
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$addHotel->other->phone_number ?? '정보없음'}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$addHotel->other->department_name ?? '정보없음'}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$addHotel->other->department_position ?? '정보없음'}}
                </td>
            </tr>
            </tbody>

            <thead>
            <tr>
                <th colspan="8">
                    호텔 정보
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">호텔명</th>
                <th colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">기간</th>
                <th colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">호텔 룸타입</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$addHotel->name ?? '호텔명 미정'}}
                </td>
                <td colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    @forelse($addHotel->periods as $period)
                        <div>
                            {{$period->name}}
                        </div>
                    @empty
                        기간 정보없음
                    @endforelse
                </td>
                <td colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    @forelse($addHotel->roomTypes as $room_type)
                        <div>
                            {{$room_type->name}}
                        </div>
                    @empty
                        룸 타입 정보없음
                    @endforelse
                </td>
            </tr>
            </tbody>
            @if($addHotel->has('needToModifies'))
            <thead>
            <tr>
                <th colspan="8">
                    호텔 정보
                </th>
            </tr>
            <tr>
                <th colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">미 수정 내역</th>
                <th colspan="1" style="border:1px solid #ededed;padding: 1rem 0.5rem;">미 수정 내역</th>
                <th colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">수정 완료 내역</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    @forelse ($addHotel->needToModifies->where('status', '=',null) as $modify)
                        <div>{{$modify->model}}-{{$modify->target}}: {{$modify->content}}</div>
                    @empty
                        <div>내역 없음</div>
                    @endforelse
                </td>
                <td colspan="1" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    @forelse ($addHotel->needToModifies->where('status', '=','수정') as $modify)
                        <div>{{$modify->model}}-{{$modify->target}}: {{$modify->content}}</div>
                    @empty
                        <div>내역 없음</div>
                    @endforelse
                </td>
                <td colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    @forelse ($addHotel->needToModifies->where('status', '=','수정 확인') as $modify)
                        <div>{{$modify->model}}-{{$modify->target}}: {{$modify->content}}</div>
                    @empty
                        <div>내역 없음</div>
                    @endforelse
                </td>
            </tr>
            </tbody>
            @endif
        </table>
    </div>
</div>
