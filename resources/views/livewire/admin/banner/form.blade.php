<div>
    <div class="w-full mb-10">
        <div class="mr-5">배너 뷰 선택</div>
        <select name="view" id="view" wire:model="view"
                class="shadow border rounded ml-2 py-2 px-3 text-white leading-tight bg-transparent border border-gray-200 rounded focus:outline-none">
            <option>뷰 선택</option>
            <option value="main">메인</option>
            <option value="curator">큐레이터</option>
        </select>
    </div>

    <div class="mb-10">
        <div>라우트 선택</div>
        <select name="route" id="route" wire:model="route">
            <option>라우트 선택</option>
            <option value="hotel.view">호첼 상세보기 페이지</option>
            <option value="hotels.collect">호텔 모아보기 페이지</option>
            <option value="other">외부 링크</option>
        </select>
    </div>

    @if(isset($hotels) && $route !== 'hotels.collect')
        <div>호텔</div>
        <div>
            <select name="hotel" id="" wire:model="hotel">
                <option>호텔 선택</option>
                @foreach($hotels as $hotel)
                    <option value="{{$hotel->id}}">{{$hotel->option->title}} ({{$hotel->curator}})</option>
                @endforeach
            </select>
        </div>
    @endif$hotel->images->count >



    @if(isset($curators))
        <div class="mt-10">
            <div>큐레이터 선택</div>
            <select wire:model="curatorCheck">
                <option>큐레이터 선택해주세요</option>
                <option value="all">전체</option>
                <option value="individual">개별 선택</option>
            </select>

            @if($curatorCheck === 'individual')
                @foreach($curators as $index=>$curator)
                    <div>
                        <label>
                            <input wire:model="curator.{{$index}}" type="checkbox" value="{{$curator->id}}">
                            {{$curator->user_id}}
                        </label>
                    </div>
                @endforeach
            @endif

        </div>
    @endif

    <div class="mb-10">
        @if($route === 'hotels.collect')
            <div>탭 선택</div>
            <select wire:model="tab">
                <option>탭을 선택해주세요</option>
                <option value="seoul">서울</option>
                <option value="gyeonggiㆍincheon">경기ㆍ인천</option>
                <option value="busan">부산</option>
            </select>

            <div>
                <div>뎁스 선택</div>
                <div>
                    @if($tab === 'seoul')
                        <select wire:model="depth">
                            <option>탭을 선택해주세요</option>
                            @foreach($depthList as $depthItem)
                                <option value="{{$depthItem}}">{{$depthItem}}</option>
                            @endforeach
                        </select>
                    @else
                        <option value="전체보기">전체 보기</option>
                    @endif
                </div>
            </div>

        @elseif($route === 'other')
            <div>링크</div>
            <div><input class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm" type="text" placeholder="외부 링크 url 입력해 주세요"></div>

        @endif
    </div>

    <div class="mb-10">
        <div>배너 타이틀 입력</div>
        <div><input class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm" type="text" wire:model="title"></div>
    </div>

    <div class="mb-10">
        <div>배너 설명 입력</div>
        <div><input class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm" type="text" wire:model="explanation"></div>
    </div>

    <div class="mb-10">
        <div>배너 이벤트 입력</div>
        <div><input class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm" type="text" wire:model="event"></div>
    </div>

    <div class="mb-10">
        <div>배너 이미지 업로드</div>
    </div>

    <div class="mb-10">
        <div>배너 순서 입력</div>
        <div><input class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm" type="text" wire:model="order"></div>
    </div>

    <div class="mb-10">
        <div>배너 메모 입력</div>
        <div><input class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm" type="text" wire:model="memo"></div>
    </div>

    <div class="mb-10">
        <div>배너 시작일</div>
        <div><input class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm" type="datetime-local" wire:model="startdt"></div>
    </div>

    <div class="mb-10">
        <div>배너 종료일</div>
        <div><input class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm" type="datetime-local" wire:model="enddt"></div>
    </div>


    <button wire:click="submitBanner">
        저장
    </button>


</div>
