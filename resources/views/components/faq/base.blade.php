<div class="px-2 py-1 bg-tm-c-ED rounded-sm">
    <div class="faq_question cursor-pointer">
        <div class="flex items-center text-sm px-2 py-4" style="max-height: 56px;">
            <div class="float-left flex">
                <div class="text-tm-c-0D5E49 PtSerif italic font-bold text-lg pr-1" style="margin-top: 2px;">
                    {{$questionTitle}}&nbsp;
                </div>
                <div class="AppSdGothicNeoR font-bold text-lg leading-snug">{!! $question !!}</div>
            </div>
            <div class="float-left ml-auto cursor-pointer">
                <img class="faq_ic {{$now}} w-8 h-8" style="min-width: 28px;" src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png" alt="">
            </div>
        </div>
    </div>

    @if($now==='true')
        <div class="faq_answer {{$now}}">
            <div class="flex justify-center">
                <div class="bg-tm-c-C1A485 h-px" style="width: calc( 100% - 14px );"></div>
            </div>
            <div>
                <div class="text-sm py-5 px-2">
                <span class="faq_answer_text AppSdGothicNeoR text-lg leading-relaxed">{!! $answer !!}</span>
                </div>
            </div>
        </div>
        @else

        <div class="faq_answer {{$now}}" style="display: none;">
            <div class="flex justify-center">
                <div class="bg-tm-c-C1A485 h-px" style="width: calc( 100% - 14px );"></div>
            </div>
            <div>
                <div class="text-sm py-6 px-2 pl-6" style="text-indent: -1rem;">
                <span class="faq_answer_text AppSdGothicNeoR text-lg leading-relaxed">{!! $answer !!}</span>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    var $faq_question = $('.faq_question').off().on('click', function () {
        const index = $faq_question.index(this);
        const answer = $('.faq_answer:eq(' + index + ')');
        const ic = $('.faq_ic:eq(' + index + ')');
        GA_event('FAQ_click',[$('.faq_answer:eq(' + index + ') .faq_answer_text').text(),index,'{{$hotelId}}']);

        if(answer.hasClass('true')){
            answer.removeClass('true').addClass('false').stop().slideUp();
            ic.attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png');
        }else{
            answer.removeClass('false').addClass('true').stop().slideDown();
            ic.attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png');
        }
    });
    $(document).ready(function(){
       $('.faq_answer.true').stop().slideDown();
        $('.faq_ic.true').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png');
       $('.faq_answer.false').stop().slideUp();
        $('.faq_ic.false').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png');
    });
</script>
