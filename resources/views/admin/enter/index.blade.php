@extends('layouts.app')

@section('top-style')

@endsection

@section('content')
<div class="max-w-1200 mx-auto">
    <div class="pt-6 sm:pt-10 px-4">
        <div class="AppSdGothicNeoR text-xl sm:text-3xl lg:text-4xl text-white">
            호텔 입점 신청 리스트
        </div>
        <div class="py-8">
            <livewire:admin.enter.lists></livewire:admin.enter.lists>
        </div>
    </div>
</div>
@endsection
