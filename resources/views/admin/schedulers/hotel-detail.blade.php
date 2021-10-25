@extends('layouts.app')
@section('content')
<div class="max-w-1200 mx-auto px-2 pb-10">
    <div>
        <div class="text-2xl py-4 text-white">
            {{$hotel->option->title}}
        </div>
        <livewire:admin.hotels.scheduler.core :hotel="$hotel"></livewire:admin.hotels.scheduler.core>
    </div>
</div>
@endsection
