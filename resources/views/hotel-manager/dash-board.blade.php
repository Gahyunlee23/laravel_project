@extends('layouts.app')
@push('styles')
    <style type="text/css">
        ::-webkit-scrollbar {
            width: 10px;  /* 세로축 스크롤바 길이 */
            height: 7px;  /* 가로축 스크롤바 길이 */
        }
        input:checked ~ .checkbox-bg {
            background-color: #073d2f;
        }
        input:checked ~ .checkbox-bg > div {
            justify-content: start;
            color : #ffffff;
        }
        input:checked ~ .checkbox-dot {
            transform: translateX(200%);
            background-color: #ffffff;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-1200 mx-auto">
        <div>
            @if(auth()->check() && auth()->user()->hotelManagers->count())
                <livewire:hotels.managers.core-board :hotel-tab="$tab" :list="$list"></livewire:hotels.managers.core-board>
            @else
                <div class="flex justify-center items-center">
                    <div class="py-10">
                        <div class="AppSdGothicNeoR">
                            <div class="text-lg font-bold text-white">관리 권한이 없습니다.</div>
                            <div></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
@endpush
