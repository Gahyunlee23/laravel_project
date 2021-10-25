@extends('layouts.app')

@section('content')
<div class="container mx-auto pt-4 px-2">
    <div class="row justify-content-center max-w-1200 mx-auto">
        <div>
            <div class="mb-3 text-white text-xl">
                <a href="{{route('login')}}">
                    <div>
                        <i class="fas fa-chevron-left cursor-pointer hover:text-tm-c-0D5E49"></i>
                    </div>
                </a>
            </div>
            <div>
                <div class="JeJuMyeongJo text-4xl text-white select-none">
                    <span>
                        {{ __('호텔에삶 회원가입') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="w-full sm:max-w-xl md:max-w-2xl mx-auto">
            <div>
                <div class="mt-4 px-8 py-6">
                    <livewire:auth.basic-register></livewire:auth.basic-register>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@push('scripts')
<script>
    function displayMessage(message,catalog) {
        toastr.success(message, catalog);
    }
    // $(document).ready(function(){
    //     $(document).bind('keydown',function(e){
    //         if ( e.keyCode === 123  ||
    //             ((e.ctrlKey && e.shiftKey && e.keyCode === 73) ||
    //                 (e.ctrlKey && e.shiftKey && e.keyCode === 74) ||
    //                 (e.ctrlKey && e.shiftKey && e.keyCode === 67))) {
    //             e.preventDefault();
    //             e.returnValue = false;
    //             alert('개발자 도구(F12) 접근이 불가능합니다');
    //         }
    //     });
    // });
    //
    // !function() {
    //     function detectDevTool(allow) {
    //         if(isNaN(+allow)) allow = 100;
    //         var start = +new Date();
    //         debugger;
    //         var end = +new Date();
    //         if(isNaN(start) || isNaN(end) || end - start > allow) {
    //             alert('개발자 도구 접근으로 모든 작업 종료됩니다.');
    //             location.reload();
    //         }
    //     }
    //
    //     if(window.attachEvent) {
    //         if (document.readyState === "complete" || document.readyState === "interactive") {
    //             detectDevTool();
    //             window.attachEvent('onresize', detectDevTool);
    //             window.attachEvent('onmousemove', detectDevTool);
    //             window.attachEvent('onfocus', detectDevTool);
    //             window.attachEvent('onblur', detectDevTool);
    //         } else {
    //             setTimeout(argument.callee, 0);
    //         }
    //     } else {
    //         window.addEventListener('load', detectDevTool);
    //         window.addEventListener('resize', detectDevTool);
    //         window.addEventListener('mousemove', detectDevTool);
    //         window.addEventListener('focus', detectDevTool);
    //         window.addEventListener('blur', detectDevTool);
    //     }
    // }();
</script>
@endpush
