<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 rounded-lg" style="padding: 0;">

            <div class="event-top">
                <img src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/top_01.png"
                     width="100%" style="max-width: 760px" alt="">
            </div>

            <div class="event-explanation">
                <img
                    src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/explanation_01.png"
                    width="100%" style="max-width: 760px" alt="">
            </div>
            <div class="event-eventProducts">
                <img
                    src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/eventProducts_01.png"
                    width="100%" style="max-width: 760px" alt="">
            </div>

            {{-- Form Start --}}
            <div class="card-body p-3" style="background-color: #ffffff;">
                <div class="event-imagesUploadFormTitle p-2 mt-1 mb-2">
                    <img
                        src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/imagesUploadFormTitle_01.png"
                        width="100%" style="max-width: 760px" alt="">
                </div>

                <form name="imageUploadForm" id="imageUploadForm" action="{{ route('uploadFile') }}"
                      enctype="multipart/form-data" method="post" autocomplete="off">
                    @csrf

                    {{--@if (session('filepath'))
                        <div class="h-56">
                            <picture>
                                <source srcset="{{Storage::disk('s3')->url(session('filepath'))}}" type="image/webp"
                                        style="width:100%;max-width: 760px;min-height: 200px"/>
                                <img src="{{Storage::disk('s3')->url(session('filepath'))}}"
                                     style="width:100%;max-width: 760px;min-height: 200px" alt=""/>
                            </picture>
                        </div>
                    @endif--}}

                    <div class="form-group">
                        <div class="event-imagesUploadFormImgUploadBox">
                            <div
                                class="event-imagesUploadFormImgUploadBackground w-auto relative p-2 px-3 m-sm-2 bg-gray-200"
                                onclick="$('#file').trigger('click');">
                                    <span
                                        class="upload-btn d-block break-all rounded-full text-white shadow text-center h-10 leading-9 py-1 px-3 text-lg sm:text-xl sm:px-10 md:text-2xl font-black absolute inline-block transform -translate-x-1/2 -translate-y-1/2"
                                        style="background-color: #fa775d;top:50%;left: 50%;">
                                        업로드
                                    </span>
                                @if (session('filepath'))
                                    <img
                                        src="{{session('filepath')}}"
                                        class="" width="100%" style="max-width: 760px" alt="">
                                @else
                                    <img
                                        src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/imagesUploadFormImgUploadBtn_01.png"
                                        class="thumbnail-img-C" width="100%" style="max-width: 760px" alt="" onerror="this.src='https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/imagesUploadFormImgUploadBtn_01.png';">
                                @endif
                            </div>
                        </div>
                        <input
                            class="d-none shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="file" name="file" id="file" required value="{{old('file')}}">
                        @if($errors->first('file'))<span
                            class="help-block text-danger">* 여행 사진 1개는 필수입니다.</span>@endif
                    </div>

                    <div class="form-group border-b border-b-2 border-gray-500 hover:border-orange-400 mt-6">
                        <label for="name">성명 @if($errors->first('name'))<span
                                class="help-block text-danger">* {{$errors->first('name')}}</span>@endif</label>
                        <input
                            class="input-group appearance-none border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                            placeholder="성명을 입력해주세요." onfocus="checkFocus()"
                            type="text" name="name" id="name" required
                            value="{{Faker\Factory::create()->text(5)}}" {{--value="{{old('name')}}"--}}>
                    </div>

                    <div class="form-group border-b border-b-2 border-gray-500 hover:border-orange-400 mt-6" >
                        <label for="tel">연락처 @if($errors->first('tel'))<span
                                class="help-block text-danger">* {{$errors->first('tel')}}</span>@endif</label>
                        <input
                            class="input-group appearance-none border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                            placeholder="연락처를 입력해주세요." onfocus="checkFocus()"
                            type="tel" name="tel" id="tel" required
                            value="{{Faker\Factory::create()->numberBetween(10000000,99999999)}}"{{--value="{{old('tel')}}"--}}>
                    </div>

                    <div class="form-group border-b border-b-2 border-gray-500 hover:border-orange-400 mt-6">
                        <label for="email">이메일 @if($errors->first('email'))<span
                                class="help-block text-danger">* {{$errors->first('email')}}</span>@endif</label>
                        <input
                            class="input-group appearance-none border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                            placeholder="Email을 입력해주세요." onfocus="checkFocus()"
                            type="email" name="email" id="email" required
                            value="{{Faker\Factory::create()->email}}"{{--value="{{old('email')}}"--}}>
                    </div>

                    <div class="pretty p-svg p-curve mt-4">
                        <input type="checkbox" name="check1" id="check1" required/>
                        <div class="state p-success">
                            <svg class="svg svg-icon" viewBox="0 0 20 20"
                                 style="background-color: rgb(250, 119, 93) !important;">
                                <path
                                    d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z"
                                    style="stroke: white;fill:white;"></path>
                            </svg>
                            <label>개인정보 동의 @if($errors->first('check1'))<span
                                    class="help-block text-danger">* {{$errors->first('check1')}}</span>@endif
                            </label>
                        </div>
                    </div>

                </form>

                <div class="mt-6">
                    <div class="w-full inline-flex">
                        <button
                            class="submit-btn w-64 text-center text-lg text-white font-bold m-auto py-2 px-3 rounded"
                            style="background-color: #fa775d;" onclick="fileSizeCheck()">이벤트 응모하기
                        </button>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{session('success')}}
                    </div>
                @endif
            </div>
            {{-- Form End --}}

            <div class="event-QnATitle pt-8">
                <img class="w-40 mx-auto"
                     src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/QnATitle_01.png"
                     width="100%" style="max-width: 760px" alt="">
                <div class="event-QnABackGround mt-2 pb-10"
                     style="">
                    <ul class="py-3 px-2 w-11/12 mx-auto">
                        <li class="my-2 px-2 py-1 rounded-full font-weight-bold bg-gray-100 bg-opacity-75">
                            Q. 이벤트는 왜 하는 건가요 ?
                        </li>
                        <li class="my-2 px-2 py-1 rounded-full font-weight-bold bg-gray-600 bg-opacity-25">
                            A. 이벤트는 ~
                        </li>
                        <li class="m-4"></li>
                        <li class="my-2 px-2 py-1 rounded-full font-weight-bold bg-gray-100 bg-opacity-75">
                            Q. 트래블메이커는 뭐하는 곳인가요 ?
                        </li>
                        <li class="my-2 px-2 py-1 rounded-full font-weight-bold bg-gray-600 bg-opacity-25">
                            A. 가나다라마바사 ~
                        </li>
                        <li class="m-4"></li>
                        <li class="my-2 px-2 py-1 rounded-full font-weight-bold bg-gray-100 bg-opacity-75">
                            Q. 혜택 지급은 언제 되나요 ?
                        </li>
                        <li class="my-2 px-2 py-1 rounded-full font-weight-bold bg-gray-600 bg-opacity-25">
                            A. 가나다라마바사 ~
                        </li>
                    </ul>
                </div>
            </div>

            <div class="event-eventShareTitle py-8" style="background-color: #f5f5f5;">
                <div>
                    <img class="w-56 mx-auto"
                         src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/eventShareTitle_01.png"
                         width="100%" style="max-width: 760px" alt="">
                </div>
                <div class="pt-4 px-10 h-full" style="background-color: #f5f5f5;">
                    <img class="kakao-link w-1/3 mx-auto float-left sm:px-3 md:px-5 lg:px-10 xl:px-16" id="kakao-link"
                         src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/eventShare_kakao_01.png"
                         width="100%" style="background-color: #f5f5f5;cursor: pointer;" alt="" onclick="shareKakaoLink()">
                    <img class="w-1/3 mx-auto float-left sm:px-3 md:px-5 lg:px-10 xl:px-16"
                         src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/eventShare_facebook_01.png"
                         width="100%" style="background-color: #f5f5f5;cursor: pointer;" alt="" onclick="shareFaceBook()">
                    <img class="w-1/3 mx-auto float-left sm:px-3 md:px-5 lg:px-10 xl:px-16"
                         src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/eventShare_twitter_01.png"
                         width="100%" style="background-color: #f5f5f5;cursor: pointer;" alt="" onclick="shareTwitter()">
                    <div class="clear-both"></div>
                </div>
            </div>

            <div class="event-appDownloadTitle py-8" style="background-color: #e7e7e7;">
                <div>
                    <img class="w-48 mx-auto"
                         src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/appDownloadTitle_01.png"
                         width="100%" style="max-width: 760px" alt="">
                </div>
                <div class="pt-4 px-10 h-full" style="background-color: #e7e7e7;">
                    <img class="w-1/2 mx-auto float-left sm:px-3 md:px-5 lg:px-10 xl:px-16"
                         src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/appDownload_travelmakers_01.png"
                         width="100%" style="max-width: 760px;cursor: pointer;" alt="" onclick="AppDownload('travelmakers')">
                    <img class="w-1/2 mx-auto float-left sm:px-3 md:px-5 lg:px-10 xl:px-16"
                         src="https://event-sds-travelmakers-01.s3.ap-northeast-2.amazonaws.com/images/appDownload_SDS_01.png"
                         width="100%" style="max-width: 760px;cursor: pointer;" alt="" onclick="AppDownload('samsungSDS')">
                    <div class="clear-both"></div>
                </div>
            </div>

            <div class="px-3 py-16" style="background-color: #444444;">
                    <span class="text-white text-xs sm:text-sm md:text-base lg:text-lg">
                        개인정보 동의 ::::<br>
                        개인정보 동의 ::::<br>
                        개인정보 동의 ::::<br>
                        개인정보 동의 ::::<br>
                        test 1234
                    </span>
            </div>
        </div>

    </div>

</div>
