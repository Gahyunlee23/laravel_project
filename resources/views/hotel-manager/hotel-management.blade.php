@extends('layouts.app')
@section('content')
    <div class="max-w-1200 mx-auto space-y-4 sm:space-y-8 select-none pb-12">
        <div class="px-4 pt-6 sm:pt-8 flex items-end">
            <div class="flex flex-wrap space-y-4">
                <div class="w-full">
                    <a href="{{route('hotel-manager.index')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-8" viewBox="0 0 32 33">
                            <g fill="none" fill-rule="evenodd">
                                <g>
                                    <path fill="#30373F" d="M0 0H1920V1024H0z" transform="translate(-360 -114)"/>
                                    <g>
                                        <g>
                                            <path stroke="#FFF" stroke-width="2" d="M3 16L16 30 29 16" transform="translate(-360 -114) translate(360 114) rotate(90 15.75 16.25)"/>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="w-full">
                    <div class="JeJuMyeongJo text-xl 2xs:text-2xl xs:text-3xl lg:text-4xl text-white">
                        호텔 관리
                    </div>
                </div>
            </div>
            <div class="w-full text-w-4xs 2xs:max-w-3xs sm:max-w-2xs md:max-w-xs ml-auto">
                <button class="py-2 sm:py-3 flex items-center justify-center w-full bg-tm-c-C1A485 rounded-sm"
                    onclick="location.href='{{route('hotel-entry.hotel')}}'">
                    <div class="AppSdGothicNeoR text-base 2xs:text-lg sm:text-xl text-white">
                        @if(\App\AddHotel::whereHotelManagerId(auth()->user()->id)->count())
                            추가&nbsp;@endif입점 신청하기
                    </div>
                </button>
            </div>
        </div>

        @if (session()->has('error'))
        <div class="px-4">
            <div class="px-4 py-3 bg-tm-c-da5542 text-white rounded-sm">
                {{ session('error') }}
            </div>
        </div>
        @endif
        @if (session()->has('message'))
        <div class="px-4">
            <div class="px-4 py-3 bg-tm-c-0D5E49 text-white rounded-sm leading-normal">
                {!! session('message') !!}
            </div>
        </div>
        @endif

        <div>
            <div class="flex flex-wrap px-4">
                <livewire:hotels.managers.hotel-management title="입점 신청 내역"></livewire:hotels.managers.hotel-management>
            </div>
        </div>

        <div>
            <div class="flex flex-wrap px-4">
                <livewire:hotels.managers.hotel-management title="승인 완료 내역" type="입점 승인" ></livewire:hotels.managers.hotel-management>
            </div>
        </div>

        <div class="flex flex-wrap px-4">
            <livewire:hotels.managers.hotel-management title="미승인 내역" type="입점 미승인"></livewire:hotels.managers.hotel-management>
        </div>

    </div>
@endsection

@push('scripts')
@endpush
