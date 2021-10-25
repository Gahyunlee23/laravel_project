@extends('layouts.app')
@section('meta-tag')
    @php
        $keywords ='';
        $meta_title=env('APP_NAME');
        $ogDescription='';
        $ogUrl=secure_url('/');
        $ogTitle=env('APP_NAME');
        $ogImage='';
    @endphp
    <meta name="copyright" property="copyright" content="&copy;트래블메이커::개인 맞춤형 여행 플랫폼">
    <meta name="content-language" content="kr">
    <meta name="build" content="">
    <meta name="keywords" property="keywords" content="{{$keywords}}">
    <meta name="title" property="title" content="{{$meta_title}}">
    <meta name="description" property="description" content="{{$ogDescription}}">

    <meta name="og:url" property="og:url" content="{{$ogUrl}}">
    <meta name="og:title" property="og:title" content="{{$ogTitle}}">
    <meta name="og:description" property="og:description" content="{{$ogDescription}}">
    <meta name="og:image" property="og:image" content="{{$ogImage}}">

    <meta name="twitter:url" property="twitter:url" content="{{$ogUrl}}">
    <meta name="twitter:title" property="twitter:title" content="{{$ogTitle}}">
    <meta name="twitter:description" property="twitter:description" content="{{$ogDescription}}">
    <meta name="twitter:image" property="twitter:image" content="{{$ogImage}}">
@endsection
@section('content')
    <div class="max-w-1200 mx-auto">
        <div class="pt-6 pb-4 px-4">
            <div class="JeJuMyeongJo text-2xl sm:text-3xl lg:text-4xl text-white">
                호텔 모아보기
            </div>
        </div>

        <div>
            <livewire:hotels.collect :tabSearch="$tabSearch" :depthSearch="$depthSearch" :curator="$curator"></livewire:hotels.collect>
        </div>
    </div>
@endsection
