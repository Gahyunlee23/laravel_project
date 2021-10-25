@extends('layouts.app')
@section('content')
<div class="max-w-1200 mx-auto">
    <div class="px-4">
        <livewire:hotels.entry.edit-core :add-hotel="$addHotel"></livewire:hotels.entry.edit-core>
    </div>
</div>
@endsection
