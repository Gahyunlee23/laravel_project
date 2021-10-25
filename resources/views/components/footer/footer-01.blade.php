<div class="space-y-12 text-tm-c-30373F">
    <div class="mx-auto sm:mx-0 w-max-content grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-6">

        <div class="AppSdGothicNeoR text-tm-c-30373F">
            <div class="AppSdGothicNeoR text-tm-c-30373F font-bold text-base text-center sm:text-left">고객센터</div>
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-auto mt-1 sm:mt-3">
                    <div class="py-3 w-48 mx-auto sm:w-60 bg-tm-c-30373F rounded-sm cursor-pointer"
                         onclick="GA_event('카카오톡 문의하기',['카카오톡 1:1']);/*kakaoOnetoOne()*/">
                        <a class="flex justify-center" href="https://livinginhotel.channel.io/" target="_blank">
                            <div class="AppSdGothicNeoR text-white text-sm font-medium">고객센터 연결</div>
                            <div class="pl-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#FFF">
                                            <g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path d="M11 0c.552 0 1 .448 1 1v6.5c0 .552-.448 1-1 1l-3.018-.001-3.75 2.957V8.5H1c-.552 0-1-.447-1-1V1c0-.552.448-1 1-1h10zM3 3.317c-.414 0-.75.33-.75.737s.336.737.75.737.75-.33.75-.737-.336-.737-.75-.737zm3 0c-.414 0-.75.33-.75.737s.336.737.75.737.75-.33.75-.737-.336-.737-.75-.737zm3 0c-.414 0-.75.33-.75.737s.336.737.75.737.75-.33.75-.737-.336-.737-.75-.737z" transform="translate(-466.000000, -7804.000000) translate(1.000000, 7717.000000) translate(358.000000, 50.000000) translate(0.000000, 27.000000) translate(107.000000, 10.000000)"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="flex flex-wrap sm:flex-nowrap items-center md:mt-4">
            <div class="w-full sm:w-auto">
                <div class="font-normal text-sm mt-1 space-y-1 ml-2 text-center sm:text-left">
                    <div class="AppSdGothicNeoR sm:block text-tm-c-30373F font-bold text-base text-center sm:text-left" style="margin-top: -15px;">1599-4330</div>
                    <div class="mt-0 sm:pt-2">10:00 - 18:30 (점심시간 12:00 ~ 13:30)</div>
                    <div>주말/공휴일 휴무</div>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-auto">
            <div class="mt-6 3xs:mt-0">
                <div class="AppSdGothicNeoR text-tm-c-30373F font-bold text-base text-center sm:text-left">SNS</div>
                <div class="mt-1 sm:mt-3">
                    <div class="flex justify-center sm:justify-start items-end">
                        <div class="float-left flex space-x-4">
                            <a href="{{secure_url('https://www.facebook.com/livinginhotel')}}"
                               onclick="GA_event('페이지 전환',['페이스북','0']);" class="flex justify-center items-center w-8" target="_blank">
                                <img data-src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-facebook.svg')}}"
                                     class="lozad cursor-pointer" alt="">
                            </a>
                            <a href="{{secure_url('https://www.youtube.com/channel/UCjJpa9RJDl0RBfKzw2uMK_w')}}"
                               onclick="GA_event('페이지 전환',['유튜브','1']);" class="flex justify-center items-center w-8" target="_blank">
                                <img data-src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-youtube.svg')}}"
                                     class="lozad cursor-pointer" alt="">
                            </a>
                            <a href="{{secure_url('https://www.instagram.com/livinginhotel/')}}"
                               onclick="GA_event('페이지 전환',['인스타그램','0']);" class="flex justify-center items-center w-8" target="_blank">
                                <img data-src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-instagram.svg')}}"
                                     class="lozad cursor-pointer" alt="">
                            </a>
                            <a href="{{secure_url('https://blog.naver.com/travelmakerkorea')}}"
                               onclick="GA_event('페이지 전환',['네이버','0']);" class="flex justify-center items-center w-8" target="_blank">
                                <img data-src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-naver.svg')}}"
                                     class="lozad cursor-pointer" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-auto">
            <div class="mt-6 sm:mt-0 w-auto xs:w-full sm:w-auto">
                <div class="AppSdGothicNeoR text-tm-c-30373F font-bold text-base text-center sm:text-left">
                    호텔에삶 입점 문의
                </div>
                <div class="flex mt-2">
                    <a class="w-full" href="{{route('enter.hotel')}}" onclick="GA_event('입점_문의_접근', ['버튼 클릭 이동'])">
                        <div class="flex justify-center mx-auto w-48 sm:w-60 py-3 bg-tm-c-C1A485 rounded-sm cursor-pointer">
                            <span class="AppSdGothicNeoR text-sm font-medium text-white tracking-wide">
                                입점 문의하기
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-1 text-tm-c-30373F text-center sm:text-left">
        <div class="AppSdGothicNeoR font-bold tracking-tight text-base">
            트래블메이커스 호텔에삶
        </div>
        <div class="space-y-3 text-sm">
            <div class="AppSdGothicNeoR leading-5 tracking-tight">
                회사명 | (주){{env('COMPANY_NAME')}}<p class="inline sm:hidden"><br></p><p class="hidden sm:inline">&nbsp;|&nbsp;</p>
                대표 | 김병주 | 개인정보보호책임자 | 정승재<p class="inline sm:hidden"><br></p><p class="hidden sm:inline">&nbsp;|&nbsp;</p>
                사업자등록번호 | 484-86-01405<p class="inline sm:hidden"><br></p><p class="hidden sm:inline">&nbsp;|&nbsp;</p>
                주소 | {{env('COMPANY_ADDRESS')}}<p class="inline sm:hidden"><br></p><p class="hidden sm:inline">&nbsp;|&nbsp;</p>
                통신판매업신고번호 | 2020-서울중구-0431<p class="inline sm:hidden"><br></p><p class="hidden sm:inline">&nbsp;|&nbsp;</p>
                이메일문의 | {{env('INFO_MAIL_USERNAME')}} <p class="inline sm:hidden"><br></p><p class="hidden sm:inline">&nbsp;|&nbsp;</p>
                제휴 이메일문의 | {{env('PARTNER_MAIL_USERNAME')}}<p class="inline sm:hidden"><br></p><p class="hidden sm:inline">&nbsp;|&nbsp;</p>
            </div>
            <div class="AppSdGothicNeoR leading-5 tracking-tight">
                {{env('COMPANY_NAME')}}는 통신판매중개자이며 통신판매의 당사자가 아닙니다.<p class="inline sm:hidden"><br></p>
                따라서 상품·거래정보 및 거래에 대하여 책임을 지지 않습니다.<p class="inline sm:hidden"><br></p>
                &copy; TravelMakers ㆍ 2020
            </div>
        </div>
    </div>

</div>
