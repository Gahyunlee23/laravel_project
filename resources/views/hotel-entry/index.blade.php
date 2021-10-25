@extends('layouts.app')
@section('content')
<div>
    <livewire:hotels.entry.core :tab="$tab" :add-hotel="$hotel"></livewire:hotels.entry.core>
</div>
@endsection
