@if(session::has('message'))
    <div class="bg-blue-400 border-t border-b border-blue-500 text-white px-4 py-3" role="alert">
        {{ session::pull('message') }}
    </div>
@endif

<div>
    {{-- 전체(큐레이터+메인) 배너 시작--}}
    <div>
        <div class="text-white text-xl">메인 배너 리스트</div>
        <table class="bg-white">
            <thead class="border-b-2 border-solid border-white">
            <tr>
                <th>썸네일</th>
                <th>타이틀</th>
                <th>설명</th>
                <th>순서</th>
                <th>이벤트</th>
                <th>뷰</th>
                <th>메모</th>
                <th>시작일</th>
                <th>종료일</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($banners as $banner)
                @if($banner->view === 'main' || $banner->view === 'all')
                    <tr class="mb-20">
                        <th class="w-20 mb-10"><img src="https://d2pyzcqibfhr70.cloudfront.net/{{$banner->images}}"></th>
                        <th>{{$banner->title}}</th>
                        <th>{{$banner->explanation}}</th>
                        <th>{{$banner->order}}</th>
                        <th>{{$banner->event}}</th>
                        <th>{{$banner->view}}</th>
                        <th>{{$banner->memo}}</th>
                        <th>{{$banner->start_dt}}</th>
                        <th>{{$banner->end_dt}}</th>
                        <th>
                            <div>
                                <form action="{{ route('admin.banner.edit', ['banner'=>$banner->id])}}" method="post">
                                    @csrf
                                    @method('post')
                                    <button type="submit">
                                        수정하기
                                    </button>
                                </form>
                            </div>
                        </th>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    {{-- 전체(큐레이터+메인) 배너 끝--}}

    {{-- 큐레이터 배너 시작--}}
    <div class="mt-30">
        <div class="text-white text-xl">큐레이터 배너 리스트</div>
        <table class="bg-white">
            <thead class="border-b-2 border-solid border-white">
            <tr>
                <th>썸네일</th>
                <th>타이틀</th>
                <th>설명</th>
                <th>순서</th>
                <th>이벤트</th>
                <th>뷰</th>
                <th>메모</th>
                <th>큐레이터</th>
                <th>시작일</th>
                <th>종료일</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($banners as $banner)
                @if($banner->view === 'curator')
                    <tr class="mb-20">
                        <th class="w-20 mb-10"><img src="https://d2pyzcqibfhr70.cloudfront.net/{{$banner->images}}"></th>
                        <th>{{$banner->title}}</th>
                        <th>{{$banner->explanation}}</th>
                        <th>{{$banner->order}}</th>
                        <th>{{$banner->event}}</th>
                        <th>{{$banner->view}}</th>
                        <th>{{$banner->memo}}</th>
                        <th>{{$banner->curator->user_id ?? 'all'}}</th>
                        <th>{{$banner->start_dt}}</th>
                        <th>{{$banner->end_dt}}</th>
                        <th>
                            <div>
                                <form action="{{ route('admin.banner.edit', ['banner'=>$banner->id])}}" method="post">
                                    @csrf
                                    @method('post')
                                    <button type="submit">
                                        수정하기
                                    </button>
                                </form>
                            </div>
                        </th>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    {{-- 큐레이터 배너 끝--}}
</div>

