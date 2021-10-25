<div class="space-y-2">
    @if(isset($reviews) && $reviews->count()>=1)
        @foreach($reviews as $review)
            <div class="border border-solid border-tm-c-30373F">
                <x-admins.review :review="$review"></x-admins.review>
                <x-form.buttons.button-01
                    name="삭제" width_class="w-full" height_class="h-8" text_color="text-white" bg_class="bg-red-500 hover:bg-red-600"
                    onclick="event.preventDefault();if(confirm('삭제 처리 하시겠습니까 ?')){
                        Livewire.emit('adminReviewEventReviewDelete', {{$review->id}});
                        location.reload();
                     }"
                ></x-form.buttons.button-01>
            </div>
        @endforeach
    @endif

    <div x-data="{ show : false }">
        <div x-show="!show">
            <div class="px-2 py-2">
                <div @click="show=!show"
                     class="cursor-pointer bg-green-500 hover:bg-green-600 py-2 text-center text-white rounded-sm font-bold text-lg">
                    리뷰 추가
                </div>
            </div>
        </div>
        <div class="pt-4 relative border border-solid border-tm-c-30373F"
            x-show="show" x-cloak>
            <div class="absolute -mt-6 text-tm-c-30373F font-bold bg-gray-100 rounded-md ml-1 px-2">
                리뷰
            </div>
            <div class="w-full flex-wrap justify-center items-center gap-2 px-2">
                <div class="w-full NaNumSquare px-1 py-2 font-bold">
                    리뷰 작성자
                </div>
                <div class="w-full flex flex-wrap gap-1">
                    <input type="text" name="review_name" wire:model="review_name"
                           class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                @error('review_name')
                <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full flex-wrap justify-center items-center gap-2 px-2">
                <div class="w-full NaNumSquare px-1 py-2 font-bold">
                    별점
                    <div class="flex pt-1">
                        <x-hotel.star star="{{$review_star}}">
                            <x-slot name="star_slot">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#D2B99E">
                                            <g>
                                                <g>
                                                    <path d="M61 14.702L56.886 16.663 57.479 12.144 54.343 8.837 58.824 8.005 61 4 63.176 8.005 67.657 8.837 64.521 12.144 65.114 16.663z" transform="translate(-447 -725) translate(361 522) translate(32 199)"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </x-slot>
                        </x-hotel.star>
                    </div>
                </div>
                <div class="w-full flex flex-wrap gap-1">
                    <input type="number" min="1" max="5" name="review_star" wire:model="review_star"
                           class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                @error('review_star')
                <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="w-full flex-wrap justify-center items-center gap-2 px-2">
                <div class="w-full NaNumSquare px-1 py-2 font-bold">
                    순서
                </div>
                <div class="w-full flex flex-wrap gap-1">
                    <input type="number" min="0" max="1000" name="review_order" wire:model="review_order"
                           class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                @error('review_order')
                <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full flex-wrap justify-center items-center gap-2 px-2">
                <div class="w-full NaNumSquare px-1 py-2 font-bold">
                    룸타입 명칭
                </div>
                <div class="w-full flex flex-wrap gap-1">
                    <input type="text" name="review_option" wire:model="review_option"
                           class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                @error('review_option')
                <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full flex-wrap justify-center items-center gap-2 px-2">
                <div class="w-full NaNumSquare px-1 py-2 font-bold">
                    링크
                </div>
                <div class="w-full flex flex-wrap gap-1">
                    <input type="text" name="review_link" wire:model="review_link"
                           class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                @error('review_link')
                <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full flex-wrap justify-center items-center gap-2 px-2">
                <div class="w-full NaNumSquare px-1 py-2 font-bold">
                    내용
                </div>
                <div class="w-full flex flex-wrap gap-1">
                <textarea name="review_content" wire:model="review_content"
                          class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                ></textarea>
                </div>
                @error('review_content')
                <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full flex-wrap justify-center items-center gap-2 px-2">
                <div class="w-full NaNumSquare px-1 py-2 font-bold">
                    작성일
                </div>
                <div class="w-full flex flex-wrap gap-1">
                    <input type="date" name="review_input_completed_at" wire:model="review_input_completed_at"
                           class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                @error('review_input_completed_at')
                <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full flex-wrap justify-center items-center gap-2 px-2"
                 x-data="{ isUploading: false, progress: 0 }"
                 x-on:livewire-upload-start="isUploading = true"
                 x-on:livewire-upload-finish="isUploading = false"
                 x-on:livewire-upload-error="isUploading = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="w-full NaNumSquare px-1 py-2 font-bold">
                    리뷰 이미지
                </div>
                @if($review_image)
                    <div class="px-2 py-2">
                        <img src="{{ $review_image->temporaryUrl() }}">
                    </div>
                @endif
                <div class="w-full flex flex-wrap gap-1">
                    <input type="file" name="review_image" wire:model="review_image"
                           class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                <div wire:loading wire:target="review_image">Uploading...</div>
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
                @error('review_image')
                <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="px-2 py-2">
                <div wire:click="submit"
                     class="cursor-pointer bg-blue-400 hover:bg-blue-500 py-2 text-center text-white rounded-sm font-bold text-lg">
                    리뷰 등록
                </div>
            </div>
            @if ( session()->has('message'))
                <div class="px-2 pb-1">
                    <div class="px-2 py-2 bg-green-600 text-white rounded-md text-right">
                        {{ session()->pull('message') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
