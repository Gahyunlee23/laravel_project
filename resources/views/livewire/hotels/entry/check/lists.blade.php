<div>
    <form name="check-form" wire:submit.prevent="submit(Object.fromEntries(new FormData($event.target)))">

        <div>
            @forelse($groups as $group)
                <div class="pt-10 md:pt-14 flex items-center">
                    <div class="pr-3 sm:pr-4">
                        <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485">
                            {{$group->title ?? ''}}
                        </div>
                    </div>
                    <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
                </div>

                @if($group->explanation !== null)
                    <div class="pt-6">
                        {!! $group->explanation ?? '' !!}
                    </div>
                @endif
                @if($group->id === 1)
                    <div class="pt-8">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                            @foreach ($images as $i=>$image)
                                @continue($i===0)
                                <div>
                                    <div class="relative pb-3/4">
                                        <div class="absolute w-full h-full box-border
                                            @error('images.'.$i) border border-solid border-white rounded-sm bg-white @enderror
                                        @if (empty($images[$i])) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                                            <div class="w-full h-full select-none">
                                                <div
                                                    class="w-full h-full flex flex-wrap items-center justify-center"
                                                    x-data="{ isUploading: false, progress: 0 , deleteBox: false }"
                                                    x-on:livewire-upload-start="isUploading = true"
                                                    x-on:livewire-upload-finish="isUploading = false"
                                                    x-on:livewire-upload-error="isUploading = false"
                                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                                    x-on:click.away="deleteBox=false"
                                                >
                                                    <input type="text" wire:model="images.{{$i}}" class="hidden" @if($isAdmin) disabled @endif>
                                                    <input type="file" id="images.{{$i}}" wire:model="images.{{$i}}" class="hidden" @if($isAdmin) disabled @endif>
                                                    @if (isset( $images[$i]) && $images[$i]!==null && $images[$i] !=='' && !$errors->has('images.'.$i))
                                                        <div class="w-full h-full relative">
                                                            <div class="absolute top-0 left-0 w-full h-full bg-tm-c-30373F bg-opacity-75"
                                                                 :class="{
                                                            'visible cursor-pointer' : deleteBox,
                                                            'invisible' : !deleteBox
                                                         }"
                                                                 x-cloak
                                                                 @if(!$isAdmin) onclick="imageRemover('images','{{$i}}');" @endif
                                                            >
                                                                <div class="h-full flex justify-center items-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 sm:w-12" viewBox="0 0 86 86" >
                                                                        <g fill="none" fill-rule="evenodd">
                                                                            <g stroke="#EDEDED">
                                                                                <g>
                                                                                    <g>
                                                                                        <g transform="translate(-507 -434) translate(360 228) translate(0 99) rotate(45 -34.853 283.137)">
                                                                                            <circle cx="30" cy="30" r="29.5"/>
                                                                                            <path d="M16.075 29.475L42.874 29.475M29.475 42.874L29.475 16.075"/>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <img
                                                                @if( $images[$i]!==null && $images[$i]!=='')
                                                                @if(!is_string($images[$i]))
                                                                @if($images[$i]->temporaryUrl()!==null)
                                                                src="{{ $images[$i]->temporaryUrl() }}"
                                                                @else
                                                                src="https://d2pyzcqibfhr70.cloudfront.net/{{ $images[$i] }}"
                                                                @endif
                                                                @elseif(is_string($images[$i]))
                                                                src="https://d2pyzcqibfhr70.cloudfront.net/{{ $images[$i] }}"
                                                                @endif
                                                                @endif
                                                                class="w-full h-full"
                                                                :class="{
                                                                    'cursor-pointer' : deleteBox
                                                                 }"
                                                                @if(!$isAdmin) x-on:click="deleteBox=true" @endif
                                                                >
                                                        </div>
                                                    @else
                                                        <div class="w-full py-2" x-show="isUploading" x-cloak>
                                                            <div class="w-full flex flex-wrap items-center justify-center px-4 space-y-2">
                                                                <div class="w-full overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                                    <div :style="`width: ${progress}%`" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                                                </div>
                                                                <div class="text-white text-sm">
                                                                    이미지 업로드 중
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label for="images.{{$i}}" class="w-full h-full flex flex-wrap items-center justify-center cursor-pointer" x-show="!isUploading">
                                                            <div class="w-full text-center">
                                                                <div class="w-full flex justify-center pb-4">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                                        <g fill="none" fill-rule="evenodd">
                                                                            <g stroke="#EDEDED">
                                                                                <g>
                                                                                    <g>
                                                                                        <g transform="translate(-945 -446) translate(360 228) translate(410 99) translate(175 119)">
                                                                                            <circle cx="15" cy="15" r="14.5"/>
                                                                                            <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                                <div class="w-full AppSdGothicNeoR font-medium text-sm xs:text-base md:text-lg text-white">
                                                                    {{$i}}번 이미지 등록 @if($i <= 10) &lbbrk;필수&rbbrk; @else &lbbrk;선택&rbbrk; @endif
                                                                </div>
                                                            </div>
                                                        </label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('images.'.$i)
                                    <div class="mt-2">
                                        <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                            @endforeach
                            @for ($i=1;$i<=$image_count;$i++)

                            @endfor
                        </div>
                        @if($image_count < 20)
                            <div class="mt-6 py-3 bg-transparent border border-white border-solid cursor-pointer"
                                 @if(!$isAdmin) wire:click="imageCountAdd" @endif
                                >
                                <div class="flex items-center justify-center space-x-2">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 30 30">
                                            <g fill="none" fill-rule="evenodd">
                                                <g stroke="#EDEDED">
                                                    <g>
                                                        <g>
                                                            <g transform="translate(-891 -373) translate(359 228) translate(1 130) translate(531 15)">
                                                                <circle cx="15" cy="15" r="14.5"/>
                                                                <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text-white">
                                        이미지 추가하기
                                    </div>
                                </div>
                            </div>
                            @if($errors->has('imageCountAdd'))
                                <div class="mt-2">
                                    <div class="text-tm-c-ff7777">
                                        {{$errors->get('imageCountAdd')[0] ?? ''}}
                                    </div>
                                </div>
                            @endif
                        @endif

                    </div>
                @endif

                <div class="pt-6 space-y-3">
                    {{--->skip(($this->page-1)*$this->limit)->limit($this->limit)--}}
                    @forelse (\App\CheckList::whereGroupId($group->id)->get() as $checkList)
                        <div @if(isset($checkList->jsonRequest['input'][0]) && $checkList->jsonRequest['input'][0]['type'] === 'text' && $checkList->jsonRequest['input'][0]['placeholder'] === 'Y/N') x-data="{ 'bool' : '{{\App\AddHotelCheckList::whereAddHotelId($addHotel->id)->whereHotelManagerId(auth()->user()->id)->whereCheckGroupId($group->id)->whereCheckListId($checkList->id)->whereInput(0)->latest()->first()->answer ?? ''}}' }" @endif>
                            <div class="py-3">
                                <div class="AppSdGothicNeoR text-white text-base sm:text-lg text-tm-c-d7d3cf leading-normal">
                                    {{$checkList->question}}
                                </div>
                            </div>
                            @if(isset($checkList->jsonRequest['input']) && $checkList->jsonRequest['input']!==null)
                            <div class="space-y-3">
                                @foreach($checkList->jsonRequest['input'] as $index=>$input)
                                    <div id="{{$group->id}}-{{$checkList->id}}-{{$index}}" >
                                        @if(isset($input['type']) && $input['type'] === 'textarea')
                                            <div class="border border-solid border-white rounded-sm">
                                            <textarea name="{{$group->id}}-{{$checkList->id}}-{{$index}}" rows="5"
                                                      autocomplete="off"
                                                      @if(isset($input['max']) && $input['max']!==null ) maxlength="{{$input['max'] ?? 50}}" @endif
                                                      @if($isAdmin) disabled @endif
                                                      class="px-4 py-3 w-full appearance-none AppSdGothicNeoR text-lg text-white bg-transparent tracking-wide leading-normal focus:outline-none"
                                            >{{\App\AddHotelCheckList::whereAddHotelId($addHotel->id)->whereHotelManagerId(auth()->user()->id)->whereCheckGroupId($group->id)->whereCheckListId($checkList->id)->whereInput($index)->latest()->first()->answer ?? ''}}</textarea>
                                            </div>
                                        @elseif(isset($input['type']) && $input['type'] === 'text' && $input['placeholder'] === 'Y/N')
                                            <div class="relative" id="{{$group->id}}-{{$checkList->id}}-{{$index}}">
                                                <div class="flex space-x-2 AppSdGothicNeoR">
                                                    <label @if(!$isAdmin) x-on:click="bool='Y'" @endif>
                                                        <input type="radio" class="hidden" name="{{$group->id}}-{{$checkList->id}}-{{$index}}"
                                                               x-bind:checked="bool === 'Y'"
                                                               @if($isAdmin) disabled @endif
                                                               value="Y">
                                                        <div class="w-30 border border-solid border-white rounded-full py-2 select-none"
                                                             x-bind:class="{
                                                            'bg-white text-tm-c-30373F' : bool === 'Y',
                                                            'bg-transparent text-white' : bool !== 'Y'
                                                        }">
                                                            <div class="text-center px-8 leading-normal text-lg font-bold">{{$input['button1'] ?? 'Y'}}</div>
                                                        </div>
                                                    </label>
                                                    <label @if(!$isAdmin) x-on:click="bool='N'" @endif>
                                                        <input type="radio" class="hidden" name="{{$group->id}}-{{$checkList->id}}-{{$index}}"
                                                               x-bind:checked="bool === 'N'"
                                                               @if($isAdmin) disabled @endif
                                                               value="N">
                                                        <div class="w-30 border border-solid border-white rounded-full py-2 select-none"
                                                             x-bind:class="{
                                                            'bg-white text-tm-c-30373F' : bool === 'N',
                                                            'bg-transparent text-white' : bool !== 'N'
                                                        }">
                                                            <div class="text-center px-8 leading-normal text-lg font-bold">{{$input['button2'] ?? 'N'}}</div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        @else
                                            <div class="border border-solid border-white rounded-sm"
                                                @if(isset($input['bool']) && $input['bool'] !== null)
                                                    x-bind:class="{
                                                        'hidden' : bool !== '{{$input['bool']}}'
                                                    }"
                                                @endif>
                                                <div class="relative">
                                                    <input type="{{$input['type']}}" name="{{$group->id}}-{{$checkList->id}}-{{$index}}" placeholder="{{$input['placeholder'] ?? ''}}" autocomplete="off"
                                                           @if(isset($input['max']) && $input['max']!==null ) maxlength="{{$input['max'] ?? 50}}" @endif
                                                            @if($isAdmin) disabled @endif
                                                           value="{{\App\AddHotelCheckList::whereAddHotelId($addHotel->id)->whereHotelManagerId(auth()->user()->id)->whereCheckGroupId($group->id)->whereCheckListId($checkList->id)->whereInput($index)->latest()->first()->answer ?? ''}}"
                                                           class="px-4 py-4 @if(isset($input['unit']) && $input['unit']!==null ) pr-8 sm:pr-12 @endif w-full appearance-none AppSdGothicNeoR text-lg text-white bg-transparent tracking-wide leading-normal focus:outline-none placeholder-tm-c-979b9f">
                                                    @if(isset($input['unit']) && $input['unit']!==null )
                                                        <div class="absolute top-0 right-0 h-full mr-2 sm:mr-4">
                                                            <div class="flex h-full items-center">
                                                                <div class="text-tm-c-d7d3cf text-sm 2xs:text-base sm:text-lg leading-normal">
                                                                    {{$input['unit'] ?? ''}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @if($errors->has($group->id.'-'.$checkList->id.'-'.$index))
                                            <div class="mt-4">
                                                <div class="text-tm-c-ff7777">
                                                    {{$errors->get($group->id.'-'.$checkList->id.'-'.$index)[0] ?? ''}}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-white text-lg">
                            질문 없음
                        </div>
                    @endforelse
                </div>
            @empty
                <div class="text-white text-lg">
                    그룹 없음
                </div>
            @endforelse
        </div>
        @if(session()->has('errors'))
            <div class="mt-2 text-tm-c-ff7777">
                @foreach(session()->get('errors') as $error)
                    <div>{{$error ?? ''}}</div>
                @endforeach
            </div>
        @endif
        @if(session()->has('error'))
            <div class="mt-2 text-tm-c-ff7777">
                <div>{{session()->pull('error') ?? ''}}</div>
            </div>
        @endif
        @if(session()->has('message'))
            <div class="mt-2 text-white">
                <div>{{session()->pull('message') ?? ''}}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="hidden hidden_error" x-data="{error : '{{$errors->keys()[0]}}'}"
                 x-init="fieldError = document.getElementById(error);if(fieldError){$('html, body').stop().animate( { scrollTop : fieldError.offsetTop - 120 } );fieldError.focus();$('.hidden_error').remove();}"></div>
        @endif
        @if(!$isAdmin)
        <div class="pt-10 pb-16 flex items-center justify-center">
            <button class="py-4 w-full max-w-sm disabled:bg-tm-c-979b9f bg-tm-c-C1A485 rounded-sm text-white AppSdGothicNeoR font-bold" type="submit">
                체크리스트 저장하기
            </button>
        </div>
        @endif
    </form>
</div>

<script>
    function imageRemover($target, $index = 0){
        Livewire.emit('checkListImageRemoverEvent', $target, $index)
    }
    // $('#images').change(function(e){
    //     var files = e.target.files;
    //     for (let i=0; i<files.length; i++){
    //         let file = files[i];
    //         var filesize = ((file.size/1024)/1024).toFixed(4); // MB
    //         if(files.length > 20){
    //             alert('이미지는 20장까지 등록 가능합니다.');
    //             $('#images').val('');
    //             document.getElementById('preview_images_div').innerHTML = '';
    //             return;
    //         }
    //         if(files.length < 10){
    //             alert('이미지를 최소 10장 이상 등록해주세요.');
    //             $('#images').val('');
    //             document.getElementById('preview_images_div').innerHTML = '';
    //             return;
    //         }
    //         if(filesize>2){
    //             alert('파일 이미지 2MB 이하만 선택해주세요.')
    //             $('#images').val('');
    //             document.getElementById('preview_images_div').innerHTML = '';
    //             return;
    //         }
    //     }
    //     document.getElementById('preview_images_div').innerHTML = '';
    //     for (let i=0; i<files.length; i++){
    //         let file = files[i];
    //         let reader = new FileReader();
    //         reader.onload = function(e) {
    //             // Render thumbnail.
    //             var span = document.createElement('span');
    //             span.className = 'relative pb-3/4';
    //             span.innerHTML = ['<div class="absolute w-full h-full"><img src="', e.target.result,
    //                 '" class="h-full" title="', escape(file.name), '"></div>'
    //             ].join('');
    //             document.getElementById('preview_images_div').insertBefore(span, null);
    //         };
    //         // Read in the image file as a data URL.
    //         reader.readAsDataURL(file);
    //     }
    //
    //     //$("#preview_images_div").append(imgTag);
    //
    // });
    //
</script>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }
    input[type=number] {
        -moz-appearance:textfield; /* Firefox */
    }
    input[type="time"]::-webkit-calendar-picker-indicator {
        background: none;
        display:none;
    }
</style>
