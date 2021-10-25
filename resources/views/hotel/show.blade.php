@extends('layouts.app')

@section('top-style')
    <style type="text/css">

    </style>
@endsection

@section('meta-tag')
    @php
        $keywords ='';
        $meta_title=env('APP_NAME');
        $ogDescription='';
        $ogUrl=secure_url('/');
        $ogTitle=env('APP_NAME');
        $ogImage='';
    @endphp
    <meta name="copyright" property="copyright" content="&copy;트래블메이커::개인 맞춤형 여행 플랫폼">
    <meta name="content-language" content="kr">
    <meta name="build" content="">
    <meta name="keywords" property="keywords" content="{{$keywords}}">
    <meta name="title" property="title" content="{{$meta_title}}">
    <meta name="description" property="description" content="{{$ogDescription}}">

    <meta name="og:site_name" property="og:site_name" content="TravelMakers Korea"/>
    <meta name="og:url" property="og:url" content="{{$ogUrl}}">
    <meta name="og:title" property="og:title" content="{{$ogTitle}}">
    <meta name="og:description" property="og:description" content="{{$ogDescription}}">
    <meta name="og:image" property="og:image" content="{{$ogImage}}">

    <meta name="twitter:url" property="twitter:url" content="{{$ogUrl}}">
    <meta name="twitter:title" property="twitter:title" content="{{$ogTitle}}">
    <meta name="twitter:description" property="twitter:description" content="{{$ogDescription}}">
    <meta name="twitter:image" property="twitter:image" content="{{$ogImage}}">
@endsection

@section('content')
    @php
        function get_S3_resource($url){
            $response='error';
            if (function_exists('curl_init')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
                $response = curl_exec($ch);
                curl_close($ch);
            }else if ($fp = fopen($url, 'r')) {
                while ($line = fgets($fp, 1024)) {
                    $response .= $line;
                }
            }
            return $response;
        }

        $apple_mAgent = array("iPhone","iphone", "iPod", "ipad");
        $android_mAgent = array("Android", "Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony");
        $android_chkMobile = false;
        $apple_chkMobile = false;
        $mobile_chk = 'false';
        for ($i = 0,$iMax = sizeof($android_mAgent); $i < $iMax; $i++) {
            if (stripos($_SERVER['HTTP_USER_AGENT'], $android_mAgent[$i])) {
                $android_chkMobile = true;
                $mobile_chk = 'true';
                break;
            }
        }

        for ($i = 0,$iMax = sizeof($apple_mAgent); $i < $iMax; $i++) {
            if (stripos($_SERVER['HTTP_USER_AGENT'], $apple_mAgent[$i])) {
                $apple_chkMobile = true;
                $mobile_chk = 'true';
                break;
            }
        }

    @endphp
    <div class="container mx-auto">
        <div class="max-w-1200 mx-auto">
            <div class="">

                <div class="max-w-1200 mx-auto p-3 mb-32" style="background-color: #ffffff;">

                    <x-hotel.detail hotel="{{$hotel}}" hotelId="{{$hotel->id}}"></x-hotel.detail>
                   {{$options}}
                   {{$images}}
                   {{$faqs}}
                </div>

            </div>

        </div>
    </div>

@endsection
@section('bottom-script')
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script type="text/javascript">

        /*카톡 공유*/
        function shareKakaoLink(){
            Kakao.init('7ecc88f4a16173c33025206c3fb0dc08');
            Kakao.Link.sendDefault({
                objectType: "feed",
                content: {
                    title: KakaoTitle,   // 콘텐츠의 타이틀
                    description: KakaoDescription,   // 콘텐츠 상세설명
                    imageUrl: KakaoImageUrl,  // 썸네일 이미지
                    link: {
                        mobileWebUrl: window.location.href,   // 모바일 카카오톡에서 사용하는 웹 링크 URL
                        webUrl: window.location.href // PC버전 카카오톡에서 사용하는 웹 링크 URL
                    }
                },
                social: {
                    likeCount: 0,       // LIKE 개수
                    commentCount: 0,    // 댓글 개수
                    sharedCount: 0,     // 공유 회수
                },
                buttons: [
                    {
                        title: KakaoButtonsTitle,    // 버튼 제목
                        link: {
                            mobileWebUrl: window.location.href,   // 모바일 카카오톡에서 사용하는 웹 링크 URL
                            webUrl: window.location.href // PC버전 카카오톡에서 사용하는 웹 링크 URL
                        }
                    }
                ],
                fail : function () {
                    alert('카카오톡이 설치된 기기에서만 이용 가능합니다.');
                }
            });
            setTimeout(function () {
                Kakao.cleanup();
            },2000);
        }

        function shareFaceBook() {
            var linkUrl = window.location.href;
            window.open('https://www.facebook.com/sharer.php?u=' + encodeURIComponent(linkUrl));
        }

        function shareTwitter() {
            window.open('https://twitter.com/intent/tweet'
                + '?via=TravelMakers'
                + '&text=' + encodeURIComponent($('title').text()) // Title in this html document
                + '&url=' + encodeURIComponent(window.location.href)
            );
        }

        function shareLine() {
            window.open('https://social-plugins.line.me/lineit/share?url=' + encodeURIComponent(window.location.href));
        }

        const CopyUrlToClipboard = function () {
            var obShareUrl = document.getElementById("ShareUrl");
            obShareUrl.value = window.document.location.href;  // 현재 URL 을 세팅해 줍니다
            obShareUrl.select();  // 해당 값이 선택되도록 select() 합니다
            document.execCommand("copy"); // 클립보드에 복사합니다.
            obShareUrl.blur(); // 선택된 것을 다시 선택안된것으로 바꿈니다.
            alert('링크가 복사되었습니다');
        };

        function agree_box(){
            $(".information-text").toggle();
            if ($(".information-text").css("display") === "none") {
                $('span.information-agree').text('(약관 확인하기)');
            }else{
                $('span.information-agree').text('(닫기)');
            }
        }
    </script>
@endsection
