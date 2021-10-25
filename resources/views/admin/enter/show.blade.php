@extends('layouts.app')

@section('top-style')

@endsection

@section('content')
<div class="max-w-1200 mx-auto">
    <div class="pt-6 sm:pt-10 px-4">
        <div class="AppSdGothicNeoR text-xl sm:text-3xl lg:text-4xl text-white">
            호텔 입점 상세 정보
        </div>
        <div class="pt-8">
            <livewire:admin.enter.core :add-hotel="$addHotel"></livewire:admin.enter.core>
        </div>

        <div class="pt-8 pb-20">
            <div class="flex items-center space-x-4">
                <div class="flex-1 h-px border-b border-solid border-dotted border-white"></div>
                <div class="AppSdGothicNeoR text-4xl lg:text-5xl font-bold text-white">
                    Hotel Check List
                </div>
                <div class="flex-1 h-px border-b border-solid border-dotted border-white"></div>
            </div>
            <livewire:hotels.entry.check.lists :add-hotel="$addHotel" limit="10" is-admin="true"></livewire:hotels.entry.check.lists>
        </div>
    </div>
</div>
@endsection
