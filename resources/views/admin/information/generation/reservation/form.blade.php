@extends('layouts.app')

@section('top-style')
@endsection

@section('content')
<div class="max-w-1200 mx-auto">
    <div class="flex justify-center">
        <div class="block w-full">
            <div class="flex justify-center items-center">
                <div class="w-full max-w-8xl rounded-sm">
                    <div class="p-4">
                        {{-- 기본 테이블 구성 --}}
                        <livewire:admin.information.generation.reservation.form
                            :order_id="$order_id" :reservation_id="$reservation_id"></livewire:admin.information.generation.reservation.form>
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
