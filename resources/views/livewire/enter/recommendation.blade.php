<div>
    <div class="flex justify-center pt-10 mx-auto sm:pt-16 px-2" style="max-width: 1000px;">
        <div class="space-y-8 w-full sm:space-y-12">
            <div class="space-y-6 sm:space-y-8">
                <div class="flex flex-wrap justify-center">
                    <div
                        class="relative w-max-content">
                        <div class="z-10 text-lg JeJuMyeongJo 2xs:text-xl sm:text-2xl md:text-3xl text-tm-c-d7d3cf">
                            살아보고 싶은 호텔을 추천해 주세요.
                        </div>
                        <div class="absolute -mt-4 h-5 sm:h-full md:-mt-5 bg-tm-c-0D5E49 -ml-3"
                             style="z-index:-1;width: calc( 100% + 30px );"></div>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center">
                    <div class="relative w-max-content">
                        <div
                            class="text-sm leading-7 text-center sm:text-base AppSdGothicNeoR text-tm-c-d7d3cf sm:leading-8">
                            살아보고 싶은 호텔이 있으시다면 추천해 주세요.
                            <div class="sm:hidden"></div>
                            그곳에서의 호텔에삶을 열어 드리겠습니다.<br>
                            해당 호텔이 오픈될 시, 가장 먼저 알려 드립니다.
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full">
                <div class=" sm:flex space-y-2 sm:space-y-0">
                    <div class="flex-1 px-2 relative block">
                        <input type="text" name="val" wire:model.defer="val"
                               data-target="val-delete-incorrect"
                               onKeypress="if(event.keyCode==13) {tag_creating()}" required autocomplete="off"
                               class="val input_delete_incorrect text-xs sm:text-base py-4 px-5 w-full text-white rounded-sm border-2 border-solid border-tm-c-d7d3cf bg-tm-c-30373F placeholder-white-50"
                               placeholder="지역명을 입력해주세요 (예시 : 잠실)">

                        <div
                            class="val-delete-incorrect delete_incorrect z-50 hidden absolute right-0 top-0 mr-3 sm:mr-5 mt-2 sm:mt-3"
                            data-target="val">
                            <img
                                data-src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg"
                                class="lozad cursor-pointer" alt="">
                        </div>
                        @error('val')<div class="w-full text-sm text-tm-c-d7d3cf mt-2">{{ $message }}</div>@enderror
                    </div>
                    <div class="flex-1 px-2 relative block">
                        <input type="text" name="val2" wire:model.defer="val2"
                               data-target="val2-delete-incorrect"
                               onKeypress="if(event.keyCode==13) {tag_creating()}" autocomplete="off"
                               class="val2 input_delete_incorrect text-xs sm:text-base py-4 px-5 w-full text-white rounded-sm border-2 border-solid border-tm-c-d7d3cf bg-tm-c-30373F placeholder-white-50"
                               placeholder="호텔명을 입력해주세요 (예시 : 시그니엘 서울)">

                        <div
                            class="val2-delete-incorrect delete_incorrect z-50 hidden absolute right-0 top-0 mr-3 sm:mr-5 mt-2 sm:mt-3"
                            data-target="val2">
                            <img
                                data-src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg"
                                class="lozad cursor-pointer" alt="">
                        </div>
                        @error('val2')<div class="w-full text-sm text-tm-c-d7d3cf mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                @if($recommendation->count() >= 1)
                    <div class="flex flex-wrap py-2">
                        @foreach ($recommendation as $key=>$tag)
                            <div class="py-2 px-2 my-1 mr-2 rounded-full border border-solid border-tm-c-d7d3cf"
                                 data-index="{{$key}}">
                                <div class="flex justify-center items-center">
                                    <div
                                        class="px-1 pt-px text-base tracking-wide AppSdGothicNeoR text-tm-c-d7d3cf sm:text-lg">
                                        {{ $tag }}
                                    </div>
                                    <div class="cursor-pointer"
                                         wire:click="recommendationTagRemoveEvent({{$key}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5" viewBox="0 0 20 20">
                                            <g fill="none" fill-rule="evenodd">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path stroke="#D7D3CF"
                                                                  d="M4 15.843L15.843 4M4 4L15.843 15.843"
                                                                  transform="translate(-310 -217) translate(202 212) translate(108 5)"/>
                                                            <path d="M0 0H20V20H0z"
                                                                  transform="translate(-310 -217) translate(202 212) translate(108 5)"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div x-data="{ data : {{$dataCount}} }" x-show="data >= 1" x-cloak class="mt-2 space-y-3">
                        <div>
                            <div class="relative block">
                                <input type="tel" name="tel" wire:model="tel" required autocomplete="off"
                                       data-target="tel-delete-incorrect"
                                       class="tel input_delete_incorrect tel-check text-xs sm:text-base py-4 px-5 w-full text-white rounded-sm border-2 border-solid border-tm-c-d7d3cf bg-tm-c-30373F placeholder-white-50"
                                       placeholder="휴대전화 번호를 입력해주세요.">
                                <div
                                    class="tel-delete-incorrect delete_incorrect z-50 hidden absolute right-0 top-0 mr-3 sm:mr-5 mt-2 sm:mt-3"
                                    data-target="tel">
                                    <img
                                        data-src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg"
                                        class="lozad cursor-pointer" alt="">
                                </div>
                            </div>

                            @error('tel')<div class="w-full text-sm text-tm-c-d7d3cf mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="mt-4 sm:mt-8 border-2 border-tm-c-d7d3cf divide-y-2 divide-tm-c-d7d3cf">
                            <div>
                                <div class="px-2" style="z-index: -1;">
                                    <div class="w-full inline-flex items-center text-sm">
                                        <div class="flex-1 flex items-center AppSdGothicNeoR text-lg text-white">
                                            <label for="allChecker" class="flex items-center">
                                                <div class="z-30">
                                                    <img
                                                        @if($allChecker) src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg"
                                                        @else src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg" @endif
                                                        class="mx-1 mr-2 3xs:mx-2 xs:mx-3 w-8 sm:w-9 cursor-pointer"
                                                        alt="">
                                                </div>
                                                <div class="flex-1 py-4 cursor-pointer text-sm 2xs:text-base sm:text-lg text-tm-c-C1A485 font-medium">
                                                    전체 동의
                                                </div>
                                                <input type="checkbox" class="hidden" id="allChecker" wire:model="allChecker" required>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="px-2" style="z-index: -1;">
                                    <div class="w-full inline-flex items-center text-sm">
                                        <div class="flex-1 flex items-center AppSdGothicNeoR text-lg text-white">
                                            <label for="privacy">
                                                <div class="z-30">
                                                    <img
                                                        @if($privacy) src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg"
                                                        @else src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg" @endif
                                                        class="mx-1 mr-2 3xs:mx-2 xs:mx-3 w-8 sm:w-9 cursor-pointer"
                                                        alt="">
                                                </div>
                                                <input type="checkbox" class="hidden" id="privacy" wire:model="privacy" required>
                                            </label>
                                            <label for="open1">
                                                <div class="flex-1 py-4 cursor-pointer text-sm 2xs:text-base sm:text-lg">
                                                    개인정보 수집 및 활용 동의 (필수)
                                                </div>
                                            </label>
                                        </div>
                                        <label for="open1">
                                            <div class="float-left ml-auto mr-1 sm:mr-2 cursor-pointer">
                                                <img class="w-8 h-8"
                                                     @if($open1) src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png"
                                                     @else src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png" @endif
                                                     alt="">
                                            </div>
                                        </label>
                                        <input type="checkbox" class="hidden" id="open1" wire:model="open1">
                                    </div>
                                </div>
                                <div @if(!$open1) :class="'hidden'" @endif
                                class="h-42 overflow-y-scroll border-t-2 border-solid border-tm-c-d7d3cf">
                                    <div class="">
                                        <div class="py-6 px-2">
                                        <span class="AppSdGothicNeoR text-white text-xs 3xs:text-sm xs:text-base leading-6 xs:leading-7">
                                            @livewire('privacy')
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- 마케팅 수신 동의 시작 --}}
                            <div class="">
                                <div class="px-2" style="z-index: -1;">
                                    <div class="w-full inline-flex items-center text-sm">
                                        <div class="flex-1 flex items-center AppSdGothicNeoR text-lg text-white">
                                            <label for="privacy">
                                                <div class="z-30">
                                                    <img
                                                        @if($marketing) src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg"
                                                        @else src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg" @endif
                                                        class="mx-1 mr-2 3xs:mx-2 xs:mx-3 w-8 sm:w-9 cursor-pointer"
                                                        alt="">
                                                </div>
                                                <input type="checkbox" class="hidden" id="marketing" wire:model="marketing" required>
                                            </label>
                                            <label for="open2">
                                                <div class="flex-1 py-4 cursor-pointer text-sm 2xs:text-base sm:text-lg">
                                                    마케팅 수신 동의 (선택)
                                                </div>
                                            </label>
                                        </div>
                                        <label for="open2">
                                            <div class="float-left ml-auto mr-1 sm:mr-2 cursor-pointer">
                                                <img class="w-8 h-8"
                                                     @if($open2) src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png"
                                                     @else src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png" @endif
                                                     alt="">
                                            </div>
                                        </label>
                                        <input type="checkbox" class="hidden" id="open2" wire:model="open2">
                                    </div>
                                </div>
                                <div @if(!$open2) :class="'hidden'" @endif
                                class="h-42 overflow-y-scroll border-t-2 border-solid border-tm-c-d7d3cf">
                                    <div class="">
                                        <div class="py-6 px-2">
                                        <span class="AppSdGothicNeoR text-white text-xs 3xs:text-sm xs:text-base leading-6 xs:leading-7">
                                            @livewire('marketing-agreement')
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- 마케팅 수신 동의 끌 --}}
                        </div>
                        @error('privacy')<div class="w-full text-sm text-tm-c-d7d3cf mt-1">{{ $message }}</div>@enderror

                        <div class="flex justify-center">
                            <button class="recommendationButton w-full max-w-sm py-6 mt-5 rounded-sm @if(!$errors->has('tel') && $tel!==null && $privacy) bg-tm-c-C1A485 cursor-pointer @else bg-tm-c-d7d3cf cursor-not-allowed @endif"
                                    onclick="recommendationButton()" wire:click="recommendationStore">
                                <div class="text-white text-center AppSdGothicNeoR text-xl sm:text-2xl">호텔 추천하기</div>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div
        x-data="noticesHandler()"
        class="fixed inset-0 flex flex-col-reverse items-center justify-start h-full w-full pb-20"
        @notice.window="add($event.detail)"
        style="pointer-events:none">
        <template x-for="notice of notices" :key="notice.id">
            <div
                x-show="visible.includes(notice)"
                x-transition:enter="transition ease-in duration-200"
                x-transition:enter-start="transform opacity-0 translate-y-2"
                x-transition:enter-end="transform opacity-100"
                x-transition:leave="transition ease-out duration-500"
                x-transition:leave-start="transform translate-x-0 opacity-100"
                x-transition:leave-end="transform translate-x-full opacity-0"
                @click="remove(notice.id)"
                class="rounded mb-4 mr-6 px-6 py-4 flex items-center justify-center text-white bg-black bg-opacity-75 shadow-lg text-base 2xs:text-lg sm:text-xl rounded-sm cursor-pointer"
                style="pointer-events:all"
                x-text="notice.text">
            </div>
        </template>
    </div>
</div>
<script>

    $(document).on('click', '.delete_incorrect', function () {
        $('.' + $(this).data('target')).val('');
        $(this).addClass('hidden');
    });
    $(document).on('click keyup change', '.input_delete_incorrect', function () {
        deleteIncorrect(this, $(this).data('target'));
    });
    $(document).on('focusout', '.input_delete_incorrect', function () {
        var target = $(this).data('target');
        setTimeout(function () {
            $('.' + target).addClass('hidden');
        }, 100);
    });
    function deleteIncorrect($this, $target) {
        if ($($this).val() !== '' && $($this).val() !== null) {
            $('.' + $target).removeClass('hidden');
        } else {
            $('.' + $target).addClass('hidden');
        }
    }

    function tag_creating() {
        setTimeout(function () {
            Livewire.emit('recommendationTagCreatingEvent');
        }, 200);
    }
    function recommendationButton(){
        setTimeout(function () {
            $('.recommendationButton').attr('wire:click','');
        },100);
        $('.recommendationButton').removeClass('bg-tm-c-C1A485 cursor-pointer');
        $('.recommendationButton').addClass('bg-tm-c-d7d3cf cursor-not-allowed');
        setTimeout(function () {
            $('.recommendationButton').attr('wire:click','recommendationStore');
            $('.recommendationButton').addClass('bg-tm-c-C1A485 cursor-pointer');
            $('.recommendationButton').removeClass('bg-tm-c-d7d3cf cursor-not-allowed');
        },6000);
    }

    function noticesHandler() {
        return {
            notices: [],
            visible: [],
            add(notice) {
                notice.id = Date.now()
                this.notices.push(notice)
                this.fire(notice.id)
            },
            fire(id) {
                this.visible.push(this.notices.find(notice => notice.id === id)) /* 실행한 notice id 체크 visible 활성화 전달*/
                const timeShown = 2000 * this.visible.length /* 현재 보이는 개수 * 2초 */
                setTimeout(() => {
                    this.remove(id);
                    if(this.notices.find(notice => notice.id === id).type === 'success'){
                        location.href = '/';
                    }
                }, timeShown)
            },
            remove(id) {
                const notice = this.visible.find(notice => notice.id === id)
                const index = this.visible.indexOf(notice)
                this.visible.splice(index, 1)
            },

        };
    }

</script>
