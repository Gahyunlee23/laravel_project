@extends('layouts.app')

@section('content')
<div class="container mx-auto pt-4 px-2" x-data="{ type : '{{$type}}' }">
    <div class="row justify-content-center max-w-1200 mx-auto">
        <div x-show="type === 'password'" x-cloak>
            <livewire:auth.modify-password></livewire:auth.modify-password>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush
