@inject('formatter', 'App\Formatter')
<div class="bg-tm-c-C1A485">
    <div>
        <table style="table-layout:auto;width: 100%;background-color: #ffffff;border:1px solid #7d7d7d;text-align: center;">
            <thead>
            <tr>
                <th colspan="8" style="font-size:20px;">
                    투어 노쇼
                </th>
            </tr>
            <tr>
                <th colspan="8">
                    투어 회원 정보
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">투어 고객 성명</th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">투어 고객 연락처</th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">투어 고객 이메일</th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">투어 일자</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$noShow->reservation->order_name}}님
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$noShow->reservation->order_hp}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$noShow->reservation->order_email}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{ $formatter->carbonFormat(\Carbon\Carbon::parse($noShow->reservation->order_desired_dt)->format('Y-m-d H:i:s'), 'Y년 m월 d일(요일) H시 i분') }}
                </td>
            </tr>
            </tbody>

            @isset($noShow->reservation->hotel)
                <thead>
                <tr>
                    <th colspan="8" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        호텔 정보
                    </th>
                </tr>
                <tr>
                    <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        호텔명
                    </th>
                    <th colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        지역명
                    </th>
                    <th colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        호텔 관리자 이메일
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        {{$noShow->reservation->hotel->option->title}}
                    </td>
                    <td colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        {{$noShow->reservation->hotel->option->area}}
                    </td>
                    <td colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        @if($noShow->reservation->type==='month')
                            {{$noShow->reservation->hotel->email ?? '정보없음'}}
                            @else
                            {{$noShow->reservation->hotel->tour_email ?? '정보없음'}}
                        @endif
                    </td>
                </tr>
                </tbody>
            @endisset


            @isset($noShow->reservation->curator)
                <thead>
                <tr>
                    <th colspan="8" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        판매 큐레이터 정보
                    </th>
                </tr>
                <tr>
                    <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        큐레이터 ID
                    </th>
                    <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        큐레이터 Page
                    </th>
                    <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        큐레이터 성명
                    </th>
                    <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        큐레이터 연락처
                    </th>
                    <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        큐레이터 이메일
                    </th>
                    <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        메모
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        {{$noShow->reservation->curator->user_id}}
                    </td>
                    <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        {{$noShow->reservation->curator->user_page}}
                    </td>
                    <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        {{$noShow->reservation->curator->name}}
                    </td>
                    <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        {{$noShow->reservation->curator->tel}}
                    </td>
                    <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        {{$noShow->reservation->curator->email}}
                    </td>
                    <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        {{$noShow->reservation->curator->explanation}}
                    </td>
                </tr>
                </tbody>
            @endisset
        </table>
    </div>
</div>
