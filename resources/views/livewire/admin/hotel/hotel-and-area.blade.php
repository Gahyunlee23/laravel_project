<div x-data="{show : false}">
    <div
        class="flow-root px-4 py-2 bg-gray-400 cursor-pointer hover:bg-gray-500 hover:text-white"
        x-on:click="show=!show"
        wire:click="dataLoad"
    >
        <div class="float-left font-bold text-black">호텔 정보/위치</div>
        <div class="float-right">✨🏨📸</div>
    </div>
    <div wire:loading wire:target="dataLoad" class="w-full bg-gray-200 border-gray-700">
        <div class="px-4 py-3 text-2xl">
            데이터 가져오는 중..
        </div>
    </div>
    <div x-show="show" x-cloak>
        @if($item !== null)
        <table class="table-auto w-full bg-gray-200 border-gray-700 text-left">
            <thead>
            <tr>
                <th class="border px-4 py-2">명칭</th>
                <th class="border px-4 py-2">영 명칭</th>
                @isset($item->options[0]->area)
                    <th class="border px-4 py-2">지역</th>
                    <td class="border px-4 py-2">{{$item->options[0]->area ?? '정보없음'}}</td>
                @endisset
            </tr>
            </thead>
            <tbody>
            <tr>
                <td rowspan="2"
                    class="border px-4 py-2">{{$item->options[0]->title ?? '정보없음'}}</td>
                <td rowspan="2"
                    class="border px-4 py-2">{{$item->options[0]->title_en ?? '정보없음'}}</td>
                @isset($item->options[0]->area)
                    <th class="border px-4 py-2">경도</th>
                    <td class="border px-4 py-2">{{$item->options[0]->lat ?? '정보없음'}}</td>
                @endisset
            </tr>
            <tr>
                @isset($item->options[0]->area)
                    <th class="border px-4 py-2">위도</th>
                    <td class="border px-4 py-2">{{$item->options[0]->lng ?? '정보없음'}}</td>
                @endisset
            </tr>
            <tr>
                @isset($item->options[0]->explanation)
                    <th colspan="2" class="border px-4 py-2">설명</th>
                @endisset
                @isset($item->options[0]->sub_explanation)
                    <th colspan="2" class="border px-4 py-2">서브설명</th>
                @endisset
            </tr>
            <tr>
                @isset($item->options[0]->explanation)
                    <td colspan="2"
                        class="border px-4 py-2">{{$item->options[0]->explanation ?? '정보없음'}}</td>
                @endisset
                @isset($item->options[0]->sub_explanation)
                    <td colspan="2"
                        class="border px-4 py-2">{{$item->options[0]->sub_explanation ?? '정보없음'}}</td>
                @endisset
            </tr>
            <tr>
                @isset($item->options[0]->facilities)
                    <th colspan="2" class="border px-4 py-2">시설</th>
                @endisset
                @isset($item->options[0]->amenities)
                    <th colspan="2" class="border px-4 py-2">도구</th>
                @endisset
            </tr>
            <tr>
                @isset($item->options[0]->facilities)
                    <td colspan="2"
                        class="border px-4 py-2">{{$item->options[0]->facilities ?? '정보없음'}}</td>
                @endisset
                @isset($item->options[0]->amenities)
                    <td colspan="2"
                        class="border px-4 py-2">{{$item->options[0]->amenities ?? '정보없음'}}</td>
                @endisset
            </tr>
            </tbody>
            <tbody>
            <tr class="bg-gray-300">
                @isset($item->images)
                    <th colspan="4" class="border px-4 py-2">이미지 정보</th>
                @endisset
            </tr>
            <tr>
                @isset($item->images)
                    <th class="border px-4 py-2">명칭</th>
                    <th colspan="2" class="border px-4 py-2">설명</th>
                    <th class="border px-4 py-2">정보</th>
                @endisset
            </tr>
            @foreach($item->images as $index=>$block_images)
                <tr>
                    @isset($block_images)
                        <td class="border px-4 py-2">{{$block_images->title ?? '정보없음'}}</td>
                        <td colspan="2"
                            class="border px-4 py-2">{{$block_images->explanation ?? '정보없음'}}</td>
                        <td class="border px-4 py-2">{{$block_images->sub_explanation ?? '정보없음'}}</td>
                    @endisset
                </tr>
                <tr>
                    @isset($block_images)
                        <th class="border px-4 py-2">{{$fileTitles[$index]}}
                            이미지
                        </th>
                        <td colspan="3" class="border px-4 py-2">
                            <div class="flex flex-wrap">
                                @foreach(\Illuminate\Support\Str::of($block_images->images)->explode('|') as $index=>$image)
                                    <img class="p-2 w-20 h-24"
                                         src="{{ secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$image) }}"
                                         alt="">
                                @endforeach
                            </div>
                        </td>
                    @endisset
                </tr>
            @endforeach
            </tbody>
            <tbody>

            <tr class="bg-gray-300">
                <th colspan="4" class="border px-4 py-2">체크포인트</th>
            </tr>
            <tr>
                <th class="border px-4 py-2">No.</th>
                <th class="border px-4 py-2">이미지</th>
                <th class="border px-4 py-2">제목</th>
                <th class="border px-4 py-2">설명</th>
            </tr>
            @isset($item->checkPoints[0])
                <tr>
                    <td class="border px-4 py-2">1</td>
                    <td class="border px-4 py-2">
                        <img
                            src="{{ secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$item->checkPoints[0]->image1) }}"
                            alt="" class="float-left w-20 h-24">
                    </td>
                    <td class="border px-4 py-2">{{$item->checkPoints[0]->title1}}</td>
                    <td class="border px-4 py-2">{{$item->checkPoints[0]->explanation1}}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">2</td>
                    <td class="border px-4 py-2">
                        <img
                            src="{{ secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$item->checkPoints[0]->image2) }}"
                            alt="" class="float-left w-20 h-24">
                    </td>
                    <td class="border px-4 py-2">{{$item->checkPoints[0]->title2}}</td>
                    <td class="border px-4 py-2">{{$item->checkPoints[0]->explanation2}}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">3</td>
                    <td class="border px-4 py-2">
                        <img
                            src="{{ secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$item->checkPoints[0]->image3) }}"
                            alt="" class="float-left w-20 h-24">
                    </td>
                    <td class="border px-4 py-2">{{$item->checkPoints[0]->title3}}</td>
                    <td class="border px-4 py-2">{{$item->checkPoints[0]->explanation3}}</td>
                </tr>
            @endisset
            </tbody>
        </table>
        @endif
    </div>
</div>
