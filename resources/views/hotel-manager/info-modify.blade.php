@extends('layouts.app')
@section('content')
    <div class="max-w-1200 mx-auto select-none">
        <div class="px-4 py-6 sm:py-8 flex items-center">
            <div class="JeJuMyeongJo text-xl 2xs:text-2xl xs:text-3xl lg:text-4xl text-white">
                매니저 정보 수정
            </div>
        </div>


        <div class="mt-4 sm:mt-12 md:mt-16 mx-auto flex flex-wrap px-8 max-w-4xl">
            <div class="w-full">
                <div>
                    <livewire:hotels.managers.info-modify></livewire:hotels.managers.info-modify>
                </div>
            </div>
        </div>

    </div>
@endsection
