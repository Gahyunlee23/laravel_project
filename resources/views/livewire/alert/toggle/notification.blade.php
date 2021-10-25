{{--
    <div class="flex items-center justify-center h-screen">
        <button x-data
                @click="$dispatch('notice', {type: 'success', text: '🔥 Success!'})"
                class="m-4 bg-green-500 text-lg font-bold p-6 py-2 text-white shadow-md rounded">
            Success
        </button>
        <button x-data
                @click="$dispatch('notice', {type: 'info', text: 'ᕦ(ò_óˇ)ᕤ'})"
                class="m-4 bg-blue-500 text-lg font-bold p-6 py-2 text-white shadow-md rounded">
            Info
        </button>
        <button x-data
                @click="$dispatch('notice', {type: 'warning', text: '⚡ Warning'})"
                class="m-4 bg-orange-500 text-lg font-bold p-6 py-2 text-white shadow-md rounded">
            Warning
        </button>
        <button x-data
                x-on:click="$dispatch('notice', {type: 'error', text: '😵 Error!'})"
                class="m-4 bg-red-500 text-lg font-bold p-6 py-2 text-white shadow-md rounded">
            Error
        </button>
    </div>
        <button x-data
                x-on:click="$dispatch('notice', {type: '30373F', text: '😵 테스트 알림 입니다. 호텔 매니저 관리 테스트 진행중에 있습니다 안녕하세요 반가워요'})"
                class="m-4 bg-red-500 text-lg font-bold p-6 py-2 text-white shadow-md rounded">
            Test
        </button>
    --}}


<div wire:poll.10000ms="check"
    x-data="noticesHandler()"
    class="fixed inset-0 flex flex-col-reverse items-center justify-end sm:justify-start h-screen w-screen"
    @notice.window="add($event.detail)"
    @notification.window="toast($event.detail)"
    style="pointer-events:none">
    <template x-for="notice of notices" :key="notice.id">
        <div
            x-show="visible.includes(notice)"
            x-transition:enter="transition ease-in duration-300 delay-150"
            x-transition:enter-start="transform opacity-0"
            x-transition:enter-end="transform opacity-100"
            x-transition:leave="transition ease-out duration-75"
            x-transition:leave-start="transform opacity-50"
            x-transition:leave-end="transform opacity-0"
            @click="remove(notice.id)"
            class="flex items-center justify-center"
            :class="{
                'absolute transition-all ease-in-out duration-500 px-4 w-full sm:max-w-sm md:max-w-md 3xl:max-w-lg' : notice.type === 'wbc-mtc-text-30373F-bg-d7d3cf'
            }" style="pointer-events:all;">
            <div class="w-full cursor-pointer shadow-lg lg:shadow-2xl"
             :class="{
                'mt-12 sm:mt-0 sm:mb-4 flex h-20 items-center justify-center text-base sm:text-lg AppSdGothicNeoR font-semibold rounded-sm leading-normal text-tm-c-30373F bg-tm-c-d7d3cf border border-solid border-white bg-opacity-70' : notice.type === 'wbc-mtc-text-30373F-bg-d7d3cf'
            }">
                <p x-text="notice.text"></p>
            </div>
        </div>
    </template>
</div>
<script>
    function noticesHandler() {
        return {
            notices: [],
            visible: [],
            add(notice) {
                notice.id = Date.now();
                this.notices.push(notice);
                this.fire(notice.id, (notice.time ? notice.time : '2000' ));
            },
            toast(notice) {
                this.notices = [];
                this.visible = [];

                notice.id = Date.now();
                this.notices.push(notice);
                this.fire(notice.id, (notice.time ? notice.time : '2000' ));
            },
            fire(id, time) {
                this.visible.push(this.notices.find(notice => notice.id === id));/* 실행한 notice id 체크 visible 활성화 전달*/
                const timeShown = time * this.visible.length;/* 현재 보이는 개수 * 2초 */
                setTimeout(() => {
                    this.remove(id);
                }, timeShown);
            },
            remove(id) {
                const notice = this.visible.find(notice => notice.id === id);
                if(notice !== undefined){
                    const index = this.visible.indexOf(notice);
                    this.visible.splice(index, 1);
                }
            },
        }
    }
</script>
