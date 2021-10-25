<div class="mt-10">

    <div x-data="{
            disable : true
        }">
        <div class="flex justify-between mb-3">
            <div class="text-white">이름</div>
            <div class="border-b border-solid border-tm-c-C1A485 tm-c-d7d3cf text-tm-c-C1A485 cursor-pointer">
                <a x-bind:class="{ 'hidden' : !disable }" x-on:click="disable=false;">변경하기</a>
                <a x-bind:class="{ 'hidden' : disable }" wire:click="nameModify" x-on:click="disable=true;">변경완료</a>
            </div>
        </div>
        <input name="name" id="name" type="text" wire:model="modify.name" x-bind:disabled="disable"
               class="AppSdGothicNeoR appearance-none w-full h-14 px-1 pl-4 text-white border border-solid border-white outline-none bg-tm-c-30373F"
               autofocus required autocomplete="off">
        <div class="mt-3 text-white">실명으로 입력해 주셔야 호텔 입주 시 빠른 안내가 가능합니다.</div>
        @error('modify.name')
        <div class="mt-1" role="alert">
            <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
        </div>
        @enderror
    </div>


    <div class="mt-8">

        <div x-data="{
            disable: true
        }">
            <div class="flex justify-between mb-3">
                <div class="text-white">비밀번호</div>
                <div class="border-b border-solid border-tm-c-C1A485 tm-c-d7d3cf text-tm-c-C1A485 cursor-pointer">
                    <a x-bind:class="{ 'hidden': !disable }" x-on:click="disable = false;">변경하기</a>
                    <a wire:click="passwordModify" x-bind:class="{ 'hidden' : disable }" x-on:click="disable = true;">변경완료</a>
                </div>

            </div>


        <div class="flex space-x-2">

            <div class="w-full space-y-2">
                <div class="form-group row">
                    <div class="">
                        <input name="password" id="password" type="password" wire:model="modify.password" x-bind:disabled="disable"
                               class="AppSdGothicNeoR appearance-none pl-4 w-full h-14 px-1 text-white border border-solid border-white outline-none bg-tm-c-30373F"
                               autofocus required autocomplete="off" placeholder="비밀번호 입력">
                        @error('modify.password')
                        <div class="mt-1" role="alert">
                            <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="">
                        <input name="password_confirmation" id="password_confirmation" type="password" wire:model="modify.password_confirmation" x-bind:disabled="disable"
                               class="AppSdGothicNeoR appearance-none w-full pl-4 h-14 px-1 text-white border border-solid border-white outline-none bg-tm-c-30373F"
                               required autocomplete="off" placeholder="비밀번호 재입력 입력">
                        @error('modify.password_confirmation')
                        <div class="mt-1" role="alert">
                            <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
</div>
