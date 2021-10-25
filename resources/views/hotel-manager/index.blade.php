@extends('layouts.app')
@section('content')
    <div class="max-w-1200 mx-auto select-none pb-12">
        <div class="px-4 py-6 sm:py-8 flex items-center">
            <div class="JeJuMyeongJo text-xl 2xs:text-2xl xs:text-3xl lg:text-4xl text-white">
                호텔 매니저
            </div>
            <div class="ml-auto flex">
                <div class="flex space-x-2">
                    <div class="space-y-3">
                        <div class="flex justify-center items-center cursor-pointer" onclick="location.href='{{route('hotel-manager.info-modify')}}'">
                            <div class="w-8 h-8 rounded-full bg-white flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 18 18">
                                    <g id="ic/setting" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <path d="M10.6571429,1 L11.3203023,2.39372207 C12.1487129,2.68467096 12.9058556,3.12703214 13.5585251,3.68760032 L15.0996318,3.56487219 L16.7567747,6.43512781 L15.8810132,7.70801376 C15.9591461,8.12675055 16,8.5586043 16,9 C16,9.44174741 15.9590809,9.87393766 15.8808264,10.2929872 L16.7567747,11.5648722 L15.0996318,14.4351278 L13.5585251,14.3123997 C12.9058556,14.8729679 12.1487129,15.315329 11.3203023,15.6062779 L10.6571429,17 L7.34285714,17 L6.67959926,15.6062433 C5.85148689,15.3153852 5.09459336,14.873223 4.44208881,14.3129269 L2.9003682,14.4351278 L1.24322534,11.5648722 L2.11917365,10.2929872 C2.04091907,9.87393766 2,9.44174741 2,9 C2,8.5586043 2.04085394,8.12675055 2.1189868,7.70801376 L1.24322534,6.43512781 L2.9003682,3.56487219 L4.44208881,3.68707307 C5.09459336,3.12677697 5.85148689,2.68461479 6.67959926,2.39375665 L7.34285714,1 L10.6571429,1 Z" id="Combined-Shape" stroke="#30373F" stroke-linejoin="round"></path>
                                        <circle id="Oval" stroke="#30373F" cx="9" cy="9" r="4"></circle>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="AppSdGothicNeoR text-sm text-white">
                            정보 변경
                        </div>
                    </div>
                    <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <div class="space-y-3">
                            <div class="flex justify-center items-center">
                                <div class="w-8 h-8 rounded-full bg-white flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4" viewBox="0 0 15 17">
                                        <g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g stroke="#30373F">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path d="M0 2.697L0 0 10.606 0 10.606 15.556 0 15.556 0 12.925" transform="translate(-1524 -136) translate(1505 129.5) translate(11) translate(9 7) matrix(-1 0 0 1 10.606 0)"/>
                                                            <g>
                                                                <path d="M0 2.609L5.885 2.609M3.706 0L6.315 2.609 3.706 5.217" transform="translate(-1524 -136) translate(1505 129.5) translate(11) translate(9 7) translate(6.843 4.95)"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="AppSdGothicNeoR text-sm text-white">
                                {{ __('로그아웃') }}
                            </div>
                        </div>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <div>
            <div class="mt-4 sm:mt-12 md:mt-16 flex flex-wrap px-4 sm:px-16 md:px-12 lg:px-32">
                <div class="relative w-full md:w-1/2 p-4">
                    <div class="flex flex-wrap items-end w-full h-full border border-solid border-white rounded-md shadow-2xl py-10 sm:py-16 cursor-pointer hover:bg-tm-c-292f36 focus:bg-tm-c-292f36"
                         onclick="location.href='{{route('hotel-manager.hotel-management')}}'">
                        <div class="w-full py-6 flex justify-center">
                            <img src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/logos/logo_graphic_white.png')}}"
                                 class="w-10 h-22 sm:w-12 sm:h-26 object-center object-cover"
                                 alt="key logo">
                        </div>
                        <div class="w-full">
                            <div class="w-full flex justify-center AppSdGothicNeoR font-bold text-xl sm:text-2xl text-white">호텔 관리</div>
                            <div class="w-full pt-3 px-2 flex justify-center text-center AppSdGothicNeoR text-sm xs:text-base sm:text-lg text-tm-c-979b9f">파트너사 입점 신청과 입점 신청 내역 관리</div>
                        </div>
                    </div>
                </div>

                <div class="relative w-full md:w-1/2 p-4">
                    <div class="flex flex-wrap items-end w-full h-full border border-solid border-white rounded-md shadow-2xl py-10 sm:py-16 cursor-pointer hover:bg-tm-c-292f36 focus:bg-tm-c-292f36"
                         @if(auth()->check() && auth()->user()->hotelManagers->count())
                         onclick="location.href='{{route('hotel-manager.dash-board')}}';"
                        @endif
                    >
                        <div class="w-full py-6 flex justify-center">
                            <svg class="w-24" viewBox="0 0 106 66" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="호텔-매니저-페이지" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Hoteladmin_02_PC" transform="translate(-1173.000000, -464.000000)" fill="#FFFFFF">
                                        <g id="custumer" transform="translate(976.000000, 312.000000)">
                                            <g id="pic_card" transform="translate(197.000000, 152.000000)">
                                                <path d="M6,0 L100,0 C103.313708,8.22077476e-15 106,2.6862915 106,6 L106,12.6666667 L106,12.6666667 L0,12.6666667 L0,6 C-4.05812251e-16,2.6862915 2.6862915,6.08718376e-16 6,0 Z" id="Rectangle"></path>
                                                <path d="M106,23.3333333 L106,60 C106,63.3137085 103.313708,66 100,66 L6,66 C2.6862915,66 -4.82366169e-16,63.3137085 0,60 L0,23.3333333 L106,23.3333333 Z M97.8980892,50.6666667 L62.7898089,50.6666667 L62.7898089,58 L97.8980892,58 L97.8980892,50.6666667 Z M69.5414013,44.6666667 L62.7898089,44.6666667 L62.7898089,47.3333333 L69.5414013,47.3333333 L69.5414013,44.6666667 Z M78.9936306,44.6666667 L72.2420382,44.6666667 L72.2420382,47.3333333 L78.9936306,47.3333333 L78.9936306,44.6666667 Z M88.4458599,44.6666667 L81.6942675,44.6666667 L81.6942675,47.3333333 L88.4458599,47.3333333 L88.4458599,44.6666667 Z M97.8980892,44.6666667 L91.1464968,44.6666667 L91.1464968,47.3333333 L97.8980892,47.3333333 L97.8980892,44.6666667 Z" id="Combined-Shape"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="w-full">
                            <div class="w-full flex justify-center AppSdGothicNeoR font-bold text-xl sm:text-2xl text-white">고객 관리</div>
                            <div class="w-full pt-3 px-2 flex justify-center text-center AppSdGothicNeoR text-sm xs:text-base sm:text-lg text-tm-c-979b9f">입점이 완료된 호텔 고객의 주문/정산 리스트 관리</div>
                        </div>
                    </div>
                    @if(auth()->check() && auth()->user()->hotelManagers->count()===0)
                        <div class="top-0 left-0 absolute w-full h-full p-4 cursor-default">
                            <div class="flex justify-center items-center w-full h-full bg-tm-c-30373F bg-opacity-75 rounded-md">
                                <div class="AppSdGothicNeoR text-lg xs:text-xl text-center text-white leading-normal">
                                    <p>파트너사 입점 승인 이후에</p>
                                    <p>열람 가능합니다.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4 flex px-4 sm:px-16 md:px-12 lg:px-32">
                <div class="w-full px-4">
                    <livewire:hotels.entry.downloads></livewire:hotels.entry.downloads>
                </div>
            </div>
        </div>

    </div>
@endsection
