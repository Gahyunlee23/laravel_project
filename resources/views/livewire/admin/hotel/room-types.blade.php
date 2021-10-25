<div>
    @if(isset($room_types))
        <div class="py-2">
            <div class="py-2 flex text-lg bg-gray-300" x-data="{ type : '{{$visible_type ?? ''}}' }">
                <div class="flex-1 text-center cursor-pointer"
                     :class="{
                        'text-black font-bold' : type === 'all'
                    }">
                    <div wire:click="visibleType('all')">전체 룸 타입 {{$all_count ?? 0}}개</div>
                </div>
                <div class="flex-1 text-center cursor-pointer"
                     :class="{
                        'text-black font-bold' : type === '1'
                    }">
                    <div wire:click="visibleType('1')">판매 중 룸 타입만 {{$visible_count ?? 0}}개</div>
                </div>
            </div>
        </div>
        <div class="overflow-x-scroll py-2">
            <table class="table-auto w-full">
                <thead class="bg-gray-300">
                <tr>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">정렬</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">ID</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">룸 타입 명</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">메인 설명</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">설명</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">업그레이드 YN</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">매진 여부</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">판매가능수</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">주문진행수</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">이미지</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">상태</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">수정</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($room_types as $room_type)
                    <tr class="bg-gray-200 hover:bg-gray-400">
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room_type->order}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room_type->id}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room_type->name}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room_type->main_explanation}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room_type->sub_explanation}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room_type->upgrade}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{($room_type->sold_out === '0') ? 'X' : 'O'}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room_type->sale_possibility_count}}개</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room_type->reservations->count()}}개</td>
                        <td class="px-2 py-1 text-center">
                            @if($room_type->image!==null || $room_type->image!=='')
                                <img src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$room_type->image)}}" alt="">
                            @endif
                        </td>
                        @if($room_type->visible === '1')
                            <td class="px-2 py-1 text-center whitespace-pre"
                                onclick="confirm('비활성화 처리 하시겠습니까?') || event.stopImmediatePropagation()"
                                wire:click="roomTypeVisibleById({{$room_type->id}},'0')"
                            ><div class="px-2 py-1 bg-green-500 hover:bg-green-600 cursor-pointer rounded-md text-white">활성화 중</div></td>
                        @else
                            <td class="px-2 py-1 text-center whitespace-pre"
                                onclick="confirm('활성화 처리 하시겠습니까?') || event.stopImmediatePropagation()"
                                wire:click="roomTypeVisibleById({{$room_type->id}},'1')"
                            ><div class="px-2 py-1 bg-red-500 hover:bg-red-600 cursor-pointer rounded-md text-white">비활성화 중</div></td>
                        @endif
                        <td class="px-2 py-1 text-center whitespace-pre"
                            onclick="confirm('수정 하시겠습니까?') || event.stopImmediatePropagation()"
                            wire:click="roomTypeUpdate({{$room_type->id}})"
                        ><div class="px-2 py-1 bg-yellow-500 hover:bg-yellow-600 cursor-pointer rounded-md text-white">수정</div></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    {{-- 상품 옵션 = 룸 --}}
    <div class="mt-3" x-data="{ show : '{{$form_show}}' }">
        <div class="font-bold text-2xl text-center"
             @click="show = !show"
        >
            <div class="px-2 py-2 text-white bg-red-500 hover:bg-red-600 cursor-pointer rounded-sm"
                 x-show="show" x-cloak wire:click="formReset">
                @if($roomType !== null)
                    룸 타입 수정 닫기
                @else
                    룸 타입 닫기
                @endif
            </div>
            <div class="px-2 py-2 text-white bg-green-500 hover:bg-green-600 cursor-pointer rounded-sm"
                 x-show="!show" x-cloak>
                룸 타입 추가 하기
            </div>
        </div>
        <div x-show="show" x-cloak>
            <table class="table-auto w-full bg-gray-200 rounded-lg">
                <tbody class="@error('order') bg-red-400 @enderror">
                <tr class="">
                    <td class="text-center text-black font-bold whitespace-pre">출력순</td>
                    <td class="py-3 px-2">
                        <input type="text" name="order" id="order" wire:model="order" class="form-input w-full">
                    </td>
                </tr>
                @error('order')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{ $message ?? '오류 에러' }}
                    </td>
                </tr>
                @enderror
                </tbody>
                <tbody class="@error('name') bg-red-400 @enderror">
                <tr class="">
                    <td class="text-center text-black font-bold whitespace-pre">룸 타입 명</td>
                    <td class="py-3 px-2">
                        <input type="text" name="name" id="name" wire:model="name" class="form-input w-full">
                    </td>
                </tr>
                @error('name')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{ $message ?? '오류 에러' }}
                    </td>
                </tr>
                @enderror
                </tbody>

                <tbody class="@error('main_explanation') bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold whitespace-pre">메인 설명</td>
                    <td class="py-3 px-2">
                        <textarea class="form-textarea w-full"
                                  name="main_explanation" id="main_explanation" wire:model="main_explanation"
                        ></textarea>
                    </td>
                </tr>
                @error('main_explanation')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{ $message ?? '오류 에러' }}
                    </td>
                </tr>
                @enderror
                </tbody>
                <tbody class="@error('sub_explanation') bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold whitespace-pre">서브 설명</td>
                    <td class="py-3 px-2">
                        <textarea class="form-textarea w-full"
                            name="sub_explanation" id="sub_explanation" wire:model="sub_explanation"
                        ></textarea>
                    </td>
                </tr>
                @error('sub_explanation')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{ $message ?? '오류 에러' }}
                    </td>
                </tr>
                @enderror
                </tbody>

                <tbody class="@error('sold_out') bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold whitespace-pre">매진 여부</td>
                    <td class="py-3 px-2 flex items-center space-x-2">
                        <div class="flex-1 flex space-x-1">
                            <input type="radio" name="sold_out" id="sold_out.1" wire:model="sold_out" value="0" class="form-check"><label
                                for="sold_out.1">판매가능</label>
                        </div>
                        <div class="flex-1 flex space-x-1">
                            <input type="radio" name="sold_out" id="sold_out.2" wire:model="sold_out" value="1" class="form-check"><label
                                for="sold_out.2">매진</label>
                        </div>
                    </td>
                </tr>
                @error('sold_out')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{ $message ?? '오류 에러' }}
                    </td>
                </tr>
                @enderror
                </tbody>
                <tbody class="@error('upgrade') bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold whitespace-pre">업그레이드 여부</td>
                    <td class="py-3 px-2 flex items-center space-x-2">
                        <div class="flex-1 flex space-x-1">
                            <input type="radio" name="upgrade" id="upgrade.1" wire:model="upgrade" value="N" class="form-check"><label
                                for="upgrade.1">X</label>
                        </div>
                        <div class="flex-1 flex space-x-1">
                            <input type="radio" name="upgrade" id="upgrade.2" wire:model="upgrade" value="Y" class="form-check"><label
                                for="upgrade.2">O</label>
                        </div>
                    </td>
                </tr>
                @error('upgrade')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{ $message ?? '오류 에러' }}
                    </td>
                </tr>
                @enderror
                </tbody>

                <tbody class="@error('sale_possibility_count') bg-red-400 @enderror">
                <tr class="">
                    <td class="text-center text-black font-bold whitespace-pre">판매가능 객실 수</td>
                    <td class="py-3 px-2">
                        <input type="number" name="sale_possibility_count" id="sale_possibility_count" wire:model="sale_possibility_count" class="form-input w-full">
                    </td>
                </tr>
                @error('sale_possibility_count')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{ $message ?? '오류 에러' }}
                    </td>
                </tr>
                @enderror
                </tbody>

                <tbody class="@error('image') bg-red-400 @enderror">
                <tr class="">
                    <td class="text-center text-black font-bold whitespace-pre">객실 이미지</td>
                    <td class="py-3 px-2">
                        <div
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <input type="file" name="image" id="image" wire:model="image" class="form-input w-full">
                            @if($image && $preview_image  && !$errors->has('image'))
                                <img src="{{ $image->temporaryUrl() }}" class="max-w-sm">
                            @endif
                            @if($image && !$preview_image)
                                <img src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$image)}}"
                                     class="max-w-sm">
                            @endif
                            <div wire:loading wire:target="image">Uploading...</div>
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </td>
                </tr>
                @error('image')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{ $message ?? '오류 에러' }}
                    </td>
                </tr>
                @enderror
                </tbody>
                @foreach ([0,1,2,3,4,5,6,7,8,9] as $index=>$count)
                    <tbody class="@error('images.'.$index) bg-red-400 @enderror">
                    <tr class="">
                        <td class="text-center text-black font-bold whitespace-pre">객실 이미지 {{$index+1}}</td>
                        <td class="py-3 px-2">
                            <div
                                x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                                <input type="text" name="images.{{$index}}" id="images.{{$index}}" wire:model="images.{{$index}}" class="hidden">
                                <input type="file" name="images.{{$index}}" id="images.{{$index}}" wire:model="images.{{$index}}" class="form-input w-full">
                                @isset($images[$index])
                                <img
                                    @if( !is_string($images[$index]) && $images[$index]->temporaryUrl()!==null)
                                    src="{{ $images[$index]->temporaryUrl() }}"
                                    @else
                                    src="https://d2pyzcqibfhr70.cloudfront.net/{{ $images[$index] }}"
                                    @endif
                                    class="max-w-sm @if($images[$index] ==='') hidden @endif">
                                <div wire:loading wire:target="images.{{$index}}">Uploading...</div>
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                @endisset
                            </div>
                        </td>
                    </tr>
                    @error('images.'.$index)
                        <tr>
                            <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                                {{ $message ?? '오류 에러' }}
                            </td>
                        </tr>
                    @enderror
                    </tbody>
                @endforeach
            </table>
            <div class="py-1">

                @if($roomType === null)
                    <div wire:click="RoomTypeSubmit"
                         class="py-2 bg-blue-400 hover:bg-blue-500 rounded-sm text-white text-center text-xl font-bold cursor-pointer">
                        추가
                    </div>
                @else
                    <div wire:click="RoomTypeUpdateSubmit"
                         class="py-2 bg-blue-400 hover:bg-blue-500 rounded-sm text-white text-center text-xl font-bold cursor-pointer">
                        수정
                    </div>
                @endif
            </div>
        </div>
        @if ( session()->has('message'))
            <div class="py-1">
                <div class="px-2 py-2 bg-green-600 text-white rounded-md text-right">
                    {{ session()->pull('message') }}
                </div>
            </div>
        @endif
    </div>

</div>
