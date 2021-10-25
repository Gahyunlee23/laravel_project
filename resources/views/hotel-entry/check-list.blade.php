@extends('layouts.app')
@section('content')
<div class="max-w-1200 mx-auto">
    <div class="px-4">
        <livewire:hotels.entry.check.lists :add-hotel="$addHotel" limit="10"></livewire:hotels.entry.check.lists>
    </div>
</div>
@endsection
