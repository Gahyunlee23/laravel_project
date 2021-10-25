<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ secure_url('css/app.css') }}" type="text/css" rel="stylesheet">
    <title>호텔에삶</title>
</head>
<body>
<div>
    <div>
        <table style="table-layout:auto;width: 100%;background-color: #ffffff;border:1px solid #7d7d7d;text-align: center;">
            <thead style="border:1px solid #ededed;padding: 1rem 0.5rem;">
            <tr>
                <th colspan="10">
                    호텔 입점 신청
                </th>
            </tr>
            </thead>
            <thead style="border:1px solid #ededed;padding: 1rem 0.5rem;">
            <tr>
                <th colspan="10">
                    호텔 정보
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">명칭</th>
                <th colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">주소</th>
                <th colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">웹주소</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$enter->hotel_name ?? '정보없음'}}
                </td>
                <td colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$enter->hotel_address ?? '정보없음'}}
                </td>
                <td colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    @if(isset($enter->hotel_web_address))
                        <a href="{{$enter->hotel_web_address}}" style="color:#6574cd;font-weight: bold;">{{$enter->hotel_web_address}}</a>
                        @else
                        정보없음
                    @endif
                </td>
            </tr>
            </tbody>

            <thead>
            <tr>
                <th colspan="10" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    호텔 담당자 정보
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    성함
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    직책
                </th>
                <th colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    이메일
                </th>
                <th colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    연락처
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$enter->manager_name ?? '정보없음'}}
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$enter->manager_rank ?? '정보없음'}}
                </th>
                <th colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$enter->manager_email ?? '정보없음'}}
                </th>
                <th colspan="3" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$enter->manager_hp ?? '정보없음'}}
                </th>
            </tr>
            </tbody>
            <thead>
            <tr>
                <th colspan="10" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    호텔 상품 정보
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    객실 명칭
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    한달 살기
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    3주 살기
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    2주 살기
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    1주 살기
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    단기 살기
                </th>
            </tr>
            </thead>
            @foreach(\App\EnterRoom::whereEnterId($enter->id)->get() as $room)
            <tbody>
            <tr>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$room->type ?? '정보없음'}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{ number_format($room->supply_price_month ?? '0') }}원
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{ number_format($room->supply_price_3_weeks ?? '0')}}원
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{ number_format($room->supply_price_2_weeks ?? '0')}}원
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{ number_format($room->supply_price_1_weeks ?? '0')}}원
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{ number_format($room->supply_price_short_day ?? '0')}}원
                </td>
            </tr>
            </tbody>
            @endforeach
            @php($option = \App\EnterOption::whereEnterId($enter->id)->first())
            <thead>
            <tr>
                <th colspan="10" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    룸 옵션 선택 정보
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="5" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    Amenities
                </td>
                <td colspan="5" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    Facilities
                </td>
            </tr>
            <tr>
                <td colspan="5" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$option->amenities ?? '정보없음'}}
                </td>
                <td colspan="5" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$option->facilities ?? '정보없음'}}
                </td>
            </tr>
            </tbody>

            <tbody>
            <tr>
                <td colspan="10" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    benefit
                </td>
            </tr>
            <tr>
                <td colspan="10" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$option->benefit ?? '정보없음'}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
