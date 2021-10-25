@extends('layouts.app')

@section('top-style')

@endsection

@section('content')
    <div class="max-w-1200 mx-auto">
        <div class="pt-6 sm:pt-10 px-4">
            <div class="AppSdGothicNeoR text-xl sm:text-3xl lg:text-4xl text-white">
                배너 매니저 {{$type ?? ''}}
            </div>
            <div class="py-8">
                <livewire:admin.banner.core :type="$type ?? 'list'" :banner="$banner->id ?? null"></livewire:admin.banner.core>
            </div>
        </div>
    </div>
@endsection
