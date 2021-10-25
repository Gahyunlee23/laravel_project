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
                <th colspan="3">
                    호텔 오픈 요청
                </th>
            </tr>
            <tr>
                <th colspan="3">
                    {{$recommendation->recommendations->count()}}개의 신청 내역
                </th>
            </tr>
            </thead>
            <thead style="border:1px solid #ededed;padding: 1rem 0.5rem;">
            <tr>
                <th colspan="3">
                    호텔 정보
                </th>
            </tr>
            <tr>
                <th colspan="1" style="border:1px solid #ededed;padding: 1rem 0.5rem;">IDX</th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">호텔명</th>
            </tr>
            </thead>
            <tbody>
            @foreach($recommendation->recommendations as $item)
            <tr>
                <td colspan="1" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{ $loop->index+1 }}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{ $item ?? '정보없음'}}
                </td>
            </tr>
            @endforeach
            </tbody>

            <thead style="border:1px solid #ededed;padding: 1rem 0.5rem;">
            <tr>
                <th colspan="3">
                    추천자 정보
                </th>
            </tr>
            <tr>
                <th colspan="1" style="border:1px solid #ededed;padding: 1rem 0.5rem;">연락처</th>
                <th colspan="1" style="border:1px solid #ededed;padding: 1rem 0.5rem;">개인정보동의</th>
                <th colspan="1" style="border:1px solid #ededed;padding: 1rem 0.5rem;">마케팅</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="1" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        {{ $recommendation->tel ?? '정보없음'}}
                    </td>
                    <td colspan="1" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        @if($recommendation->privacy)
                            동의
                        @else
                            미동의
                        @endif
                    </td>
                    <td colspan="1" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        @if($recommendation->marketing)
                            동의
                        @else
                            미동의
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
