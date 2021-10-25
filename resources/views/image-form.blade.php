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
    <div class="container">
        <div class="row justify-content-center">
            <div class="" style="max-width:760px;padding: 0;">

                <div class="card-body p-3 mb-32" style="background-color: #ffffff;">


                    <form name="imageUploadForm" id="imageUploadForm" {{--action="{{ route('uploadFile') }}"--}}
                    enctype="multipart/form-data" method="post" autocomplete="off">
                        @csrf
                        <input type="hidden" name="mobile_chk" value="{{$mobile_chk}}">

                        <div class="form-group w-9/12 sm:w-9/12 md:w-8/12 mx-auto">

                            <div class="event-imagesUploadFormImgUploadBox">
                                <div
                                    class="event-imagesUploadFormImgUploadBackground w-auto position-relative"
                                    onclick="$('#file').trigger('click');">

                                    <div class="z-50 position-relative p-2 px-3 m-sm-2 bg-gray-200">
                                        <span
                                            class="position-absolute w-full upload-btn d-block break-all rounded-full text-white shadow text-center h-10 leading-9 py-1 px-3 text-base sm:text-xl sm:px-10 md:text-2xl font-black inline-block transform -translate-x-1/2 -translate-y-1/2 cursor-pointer"
                                            style="background-color: #fa775d;top:50%;left: 50%;z-index: 10;">
                                            업로드
                                        </span>
                                        <img src="" class="thumbnail-img-C w-20 h-24 hidden" alt="">
                                        <img src="" class="thumbnail-img-C w-20 h-24 hidden" alt="">
                                    </div>

                                </div>
                            </div>

                            <input
                                class="d-none shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 font-bold leading-tight focus:outline-none focus:shadow-outline"
                                type="file" name="file" id="file" required value="{{old('file')}}">

                        </div>

                    </form>

                    <div class="mt-6">
                        <div class="w-full inline-flex">
                            <button
                                class="submit-btn w-4/12 text-center text-lg text-white font-bold m-auto py-2 px-3 rounded"
                                style="min-width:180px;background-color: #fa775d;" onclick="fileSizeCheck()">저장
                            </button>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection
@section('bottom-script')
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script type="text/javascript">
        const Ajax_url = '{{ secure_url(route('uploadFile')) }}';

        const fileSizeLimit = 20;
        const fileChkAlert = '해외 여행 사진을 업로드 후 응모해주세요.';

        const KakaoTitle = '트래블메이커X삼성SDS 이벤트';
        const KakaoDescription = '여행 사진으로 비지니스클래스 타고 풀빌라 즐기기';
        const KakaoImageUrl = 'https://d1cfpvpfjd177x.cloudfront.net/images/top_01.png';
        const KakaoButtonsTitle = '응모하러 가기';

        let self_file;

        $(document).ready(function () {
            $('#file').on('change', handleImgFileSelect);
        });

        function handleImgFileSelect(e) {
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function (f,index,array) {
                console.log(index)
                if(!f.type.match('image.*')){
                    alert('업로드 사진 확장자는 이미지 확장자만 가능합니다');
                    return;
                }
                self_file = f;

                var reader =new FileReader();
                reader.onload = function (e) {
                    $('img.thumbnail-img-C:eq('+index+')').attr('src', e.target.result).removeClass('hidden');
                }
                reader.readAsDataURL(f);
            })
        }

        function isMobile(phoneNum) {
            var regExp = /(01[016789])([0-9]{3,4})([0-9]{4})$/;
            var myArray;
            if (regExp.test(phoneNum)) {
                myArray = regExp.exec(phoneNum); // console.log(myArray[1]); // console.log(myArray[2]); // console.log(myArray[3]);
                return true;
            } else {
                return false;
            }
        }

        function fileSizeCheck() {
            // 파일 사이즈 체크
            var maxSize = fileSizeLimit * 1024 * 1024;
            var file = document.getElementById("file").files[0];

            if (file) {
                if (file.size > maxSize) {
                    alert("첨부파일 사이즈는 " + fileSizeLimit + "MB 이내로 등록 가능합니다.");
                    $('input#file').val('');
                    $('input#file').focus();
                    return false;
                }
            }else{
                alert(fileChkAlert);
                return false;
            }
            /*if(!$('input#name').val()){
                alert('이름을 입력한 후 응모해주세요.');
                return false;
            }*/
            /*if(!$('#email').val()){
                alert('이메일을 입력한 후 응모해주세요.');
                return false;
            }*/

            /*if(!$('input:checkbox[id="check1"]').is(":checked")){
                alert('개인정보 수집/이용에 동의해주세요.');
                return false;
            }*/
            var formData = new FormData($('form#imageUploadForm')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: Ajax_url,
                data: formData,
                dataType: 'json',
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var msg = '';
                    switch (data.result) {
                        case 'success' :
                            msg = '이미지 업로드를 성공했습니다.';
                            break;

                        default :
                            msg = '업로드가 실패했습니다.\n재시도 해주세요.';
                            break;
                    }

                    $('input').attr('disabled', 'disabled').addClass('bg-gray-300');
                    $('span.help-block').removeClass('d-none');
                    $('span.help-block').addClass('d-none');

                    setTimeout(function () {

                        $('span.upload-btn').html('업로드 완료!');
                        $('button.submit-btn').html('이벤트 응모완료!');

                        $('button.submit-btn').attr('onclick', '');
                        $('div.event-imagesUploadFormImgUploadBackground').attr('onclick', '');

                    }, 1000);

                },
                error: function (data) {
                    $('span.help-block').removeClass('d-none');
                    $('span.help-block').addClass('d-none');
                    for(key in data.responseJSON.errors){
                        console.log(key);
                        $('.'+key+'-help').removeClass('d-none');
                    }
                    $('span.upload-btn').html('업로드');
                    $('button.submit-btn').html('저장 실패!');
                    alert("저장 실패했습니다.\n재시도 해주세요.");
                }
            });
        }

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
