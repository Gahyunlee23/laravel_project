@extends('layouts.app')

@section('top-style')

@endsection

@section('content')
    <div class="max-w-1200 mx-auto px-2">
        <div class="flex justify-center">
            <div class="block w-full">
                <div class="flex justify-center items-center">
                    <div class="w-full max-w-1200 bg-white rounded-sm">
                        <div>
                            {{-- 기본 테이블 구성 --}}
                            @livewire('admin.information.master-table')
                        </div>
                        <div class="button_container p-2">
                            <div class="flex">
                                <a href="{{route('information.reservation.form',['order_id'=>mt_rand(1000,9999)])}}"
                                   class="bg-blue-500 text-white px-4 py-2 border rounded-md hover:bg-blue-700 hover:border-blue-500">
                                    정보 생성
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('bottom-script')
    <script type="text/javascript">

    </script>
@endsection
