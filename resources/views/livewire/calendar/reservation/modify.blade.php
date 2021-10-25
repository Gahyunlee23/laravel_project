<div x-data="app()"
     x-init="[initDate('{{$type}}','{{$startYear}}','{{$startMonth}}','{{$startDate}}','{{$endYear}}','{{$endMonth}}','{{$endDate}}'), getNoOfDays()]"
     x-cloak>
    <div class="mx-auto">
        <div class="overflow-hidden">
            <div class="flex items-center justify-center py-2 px-6">
                @if($type==='start')
                    <div class="px-1 py-1">
                        <button
                            type="button"
                            class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex p-1 items-center text-gray-500"
                            {{--                            :class="{'cursor-not-allowed opacity-25': month === 0 }"--}}
                            {{--                            :disabled="month === 0"--}}
                            @if($disable === '1')
                            :disabled="true"
                            :class="{'cursor-default':true}"
                            @else
                            :class="{'cursor-pointer hover:text-gray-700':true}"
                            @endif
                            style="outline: 0;"
                            @click="monthChange('sub'); getNoOfDays()">

                            <svg class="h-4 w-4 inline-flex leading-none" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                    </div>
                @endif

                <div class="space-x-px">
                    <span x-text="year+'.'" class="AppSdGothicNeoR font-bold text-lg text-tm-c-30373F"></span>
                    <span x-text="MONTH_NAMES[month]" class="AppSdGothicNeoR font-bold text-lg text-tm-c-30373F"></span>
                </div>

                @if($type==='start')
                    <div class="px-1 py-1">
                        <button
                            type="button"
                            class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center p-1 text-gray-500"
                            @if($disable === '1')
                            :disabled="true"
                            :class="{'cursor-default':true}"
                            @else
                            :class="{'cursor-pointer hover:text-gray-700':true}"
                            @endif
                            style="outline: 0;"
                            @click="monthChange('add'); getNoOfDays()">
                            <svg class="h-4 w-4 inline-flex leading-none" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            <div class="-mx-1 -mb-1 px-2 py-4">
                <div class="flex flex-wrap" style="">
                    <template x-for="(day, index) in DAYS" :key="index">
                        <div style="width: 14.26%" class="px-1 xs:px-2 py-2">
                            <div
                                x-text="day"
                                class="AppSdGothicNeoR text-tm-c-30373F text-xs xs:text-sm uppercase tracking-wide font-bold text-center"></div>
                        </div>
                    </template>
                </div>

                <div class="flex flex-wrap">
                    <template
                        x-for="[id, value] in Object.entries(blankdays)" :key="id">

                        <div style="width: 14.28%;" class="items py-1 flex items-center justify-center">
                            <div class="w-full relative">
                                <div class="flex justify-center">
                                    <button
                                        x-text="value"
                                        @click="monthChange('sub'); getNoOfDays()"
                                        class="text-tm-c-d7d3cf z-10 inline-flex w-8 h-8 items-center justify-center text-center text-sm xs:text-base leading-none rounded-full transition ease-in-out duration-100"
                                        style="outline: 0;"
                                        @if($disable === '1')
                                        :disabled="true"
                                        :class="{
                                        'border-2 border-solid border-tm-c-ED bg-tm-c-C1A485' : isBlankToday(value ?? null),
                                        'cursor-default': true
                                        }"
                                        @else
                                        :class="{
                                        'border-2 border-solid border-tm-c-ED bg-tm-c-C1A485' : isBlankToday(value ?? null),
                                        'cursor-pointer': !isBlankToday(date ?? null)}"
                                        @endif
                                    >
                                    </button>
                                </div>
                                <div class="absolute top-0 h-full bg-tm-c-ED"
                                     :class="{
                                     'w-1/2 right-0' : isBlankFromToday(value ?? null) === 'true-to-start',
                                     'w-1/2 left-0' : isBlankFromToday(value ?? null) === 'true-to-end',
                                     'w-full' : isBlankFromToday(value ?? null) === 'true'
                                     }"></div>
                            </div>
                        </div>
                    </template>

                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                        <div style="width: 14.28%;" class="items py-1 flex items-center justify-center">
                            <div class="w-full relative">
                                <div class="flex justify-center">
                                    <button x-text="date"
                                            @click="selectDateEvent(date)"
                                            class="z-10 inline-flex w-8 h-8 items-center justify-center text-center text-sm xs:text-base leading-none rounded-full transition ease-in-out duration-100"
                                            style="outline: 0;"
                                            @if($disable === '1')
                                            :disabled="true"
                                            :class="{
                                                'border-2 border-solid border-tm-c-ED bg-tm-c-C1A485' : isToday(date ?? null),
                                                'text-white' : isToday(date ?? null) && !isDisableDay(date ?? null),
                                                'text-gray-700': !isToday(date ?? null) && !isDisableDay(date ?? null),
                                                'text-tm-c-d7d3cf' : isDisableDay(date ?? null),
                                                'cursor-default': true
                                            }"
                                            @else
                                            :class="{
                                                'border-2 border-solid border-tm-c-ED bg-tm-c-C1A485' : isToday(date ?? null),
                                                'text-white' : isToday(date ?? null) && !isDisableDay(date ?? null),
                                                'text-gray-700': !isToday(date ?? null) && !isDisableDay(date ?? null),
                                                'cursor-pointer hover:bg-blue-200': !isToday(date ?? null) && !isDisableDay(date ?? null),
                                                'text-tm-c-d7d3cf' : isDisableDay(date ?? null)
                                            }"
                                            @endif
                                    >
                                    </button>
                                </div>
                                <div class="absolute top-0 h-full bg-tm-c-ED"
                                     :class="{
                                     'w-1/2 right-0' : isFromToday(date ?? null) === 'true-to-start',
                                     'w-1/2 left-0' : isFromToday(date ?? null) === 'true-to-end',
                                     'w-full' : isFromToday(date ?? null) === 'true'
                                     }"></div>
                            </div>
                        </div>
                    </template>

                    <template
                        x-for="[id, value] in Object.entries(blankEndDays)" :key="id">

                        <div style="width: 14.28%;" class="items py-1 flex items-center justify-center">
                            <div class="w-full relative">
                                <div class="flex justify-center">
                                    <button
                                        x-text="value"
                                        @click="monthChange('add'); getNoOfDays()"
                                        class="text-tm-c-d7d3cf z-10 inline-flex w-8 h-8 items-center justify-center text-center text-sm xs:text-base leading-none rounded-full transition ease-in-out duration-100"
                                        style="outline: 0;"
                                        @if($disable === '1')
                                        :disabled="true"
                                        :class="{
                                        'border-2 border-solid border-tm-c-ED bg-tm-c-C1A485' : isEndBlankToday(value ?? null),
                                        'cursor-default': true
                                        }"
                                        @else
                                        :class="{
                                        'border-2 border-solid border-tm-c-ED bg-tm-c-C1A485' : isEndBlankToday(value ?? null),
                                        'cursor-pointer': !isEndBlankToday(date ?? null)}"
                                        @endif
                                    >
                                    </button>
                                </div>
                                <div class="absolute top-0 h-full bg-tm-c-ED"
                                     :class="{
                                     'w-1/2 right-0' : isEndBlankFromToday(value ?? null) === 'true-to-start',
                                     'w-1/2 left-0' : isEndBlankFromToday(value ?? null) === 'true-to-end',
                                     'w-full' : isEndBlankFromToday(value ?? null) === 'true'
                                     }"></div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">

    var MONTH_NAMES = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
    var DAYS = ['일', '월', '화', '수', '목', '금', '토'];
    var date = null;

    function app() {
        return {
            month: '',
            year: '',
            no_of_days: [],
            blankdays: [],
            blankEndDays: [],
            days: DAYS,
            type: '',

            startYear: '',
            startMonth: '',
            startDate: '',
            endYear: '',
            endMonth: '',
            endDate: '',
            openEventModal: false,

            initDate(type, startYear, startMonth, startDate, endYear, endMonth, endDate) {
                let today = new Date();
                this.type = type;

                if (this.type === 'start') {
                    this.year = startYear;
                    this.month = startMonth - 1;
                } else if (this.type === 'end') {
                    this.year = endYear;
                    this.month = endMonth - 1;
                }

                this.startYear = startYear;
                this.startMonth = startMonth;
                this.startDate = startDate;
                this.endYear = endYear;
                this.endMonth = endMonth;
                this.endDate = endDate;

                this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
            },
            isToday(date) {
                if (date !== null) {
                    const d = new Date(this.year, this.month, date);
                    var startTo = new Date(this.startYear, this.startMonth - 1, this.startDate);
                    var endTo = new Date(this.endYear, this.endMonth - 1, this.endDate);

                    if (startTo.getTime() === d.getTime() || endTo.getTime() === d.getTime()) {
                        return true;
                    }
                    return false;
                }
            },
            isBlankToday(date) {
                if (date !== null) {
                    var d = new Date(this.year, this.month - 1, date);
                    var startTo = new Date(this.startYear, this.startMonth - 1, this.startDate);
                    var endTo = new Date(this.endYear, this.endMonth - 1, this.endDate);

                    return startTo.getTime() === d.getTime() || endTo.getTime() === d.getTime();

                }
            },
            isEndBlankToday(date) {
                if (date !== null) {
                    const d = new Date(this.year, (this.month + 1), date);
                    var startTo = new Date(this.startYear, this.startMonth-1, this.startDate);
                    var endTo = new Date(this.endYear, this.endMonth-1, this.endDate);

                    return startTo.getTime() === d.getTime()
                        || endTo.getTime() === d.getTime();
                }
            },

            isFromToday(date) {
                if (date !== null) {
                    const d = new Date(this.year, this.month, date);
                    const startDay = new Date(this.startYear, this.startMonth - 1, this.startDate);
                    const endDay = new Date(this.endYear, this.endMonth - 1, this.endDate);

                    if ((startDay.getTime() <= d.getTime())
                        && (endDay.getTime() >= d.getTime())) {

                        if (this.isToday(date)) {
                            if (startDay.getTime() === d.getTime()) {
                                return 'true-to-start';
                            } else if (endDay.getTime() === d.getTime()) {
                                return 'true-to-end';
                            }
                        }
                        return 'true';
                    }

                    return false;
                }
            },
            isBlankFromToday(date) {
                if (date !== null) {
                    const d = new Date(this.year, this.month-1, date);
                    const startDay = new Date(this.startYear, this.startMonth-1, this.startDate);
                    const endDay = new Date(this.endYear, this.endMonth-1, this.endDate);

                    if (startDay.getTime() <= d.getTime() &&
                        endDay.getTime() >= d.getTime()) {
                        if (this.isBlankToday(date)) {
                            if (startDay.getTime() === d.getTime()) {
                                return 'true-to-start';
                            } else if (endDay.getTime() === d.getTime()) {
                                return 'true-to-end';
                            }
                        }
                        return 'true';
                    }
                    return false;
                }
            },
            isEndBlankFromToday(date) {
                if (date !== null) {
                    const d = new Date(this.year, (this.month + 1), date);
                    const startDay = new Date(this.startYear, this.startMonth-1, this.startDate);
                    const endDay = new Date(this.endYear, this.endMonth-1, this.endDate);

                    if (startDay.getTime() <= d.getTime()
                        && endDay.getTime() >= d.getTime()) {

                        if (this.isEndBlankToday(date)) {
                            if (startDay.getTime() === d.getTime()) {
                                return 'true-to-start';
                            } else if (endDay.getTime() === d.getTime()) {
                                return 'true-to-end';
                            }
                        }
                        return 'true';
                    }
                    return false;
                }
            },
            isDisableDay(date) {
                if (date !== null) {
                    var now = new Date();
                    /* 선택 가능 시작 : 오늘 +3 ~ */
                    var nowDate = new Date(now.getFullYear(),now.getMonth(),now.getDate()+3);
                    /* 선택 가능 끝 : 시작+1달 */
                    var endDate = new Date(nowDate.getFullYear(),nowDate.getMonth()+1,nowDate.getDate());
                    var selectDate = new Date(this.year, this.month, date);/* 실 선택 */
                    if((nowDate.getTime() <= selectDate.getTime() && endDate.getTime() > selectDate.getTime())){
                        return false;
                    }
                    return true;
                }
            },
            selectDateEvent(date) {
                var selectDate = new Date(this.year, this.month, date);/* 실 선택 */
                const startDay = new Date(this.startYear, this.startMonth-1, this.startDate);
                const endDay = new Date(this.endYear, this.endMonth-1, this.endDate);
                /* 희망 시작일 + 1달*/
                var startDate = new Date(startDay.getFullYear(),startDay.getMonth()+1,startDay.getDate());
                var now = new Date();
                /* 선택 가능 시작 : 오늘 +3 ~ */
                var nowDate = new Date(now.getFullYear(),now.getMonth(),now.getDate()+3);
                /* 선택 가능 끝 : 시작+1달 */
                var endDate = new Date(nowDate.getFullYear(),nowDate.getMonth()+1,nowDate.getDate());

                /* 오늘+3일 부터 ~~~ 희망 시작일로 부터 1달 이내 선택 가능
                * (nowDate.getTime() <= selectDate.getTime() && startDate.getTime() > selectDate.getTime())
                    || */
                /* OR 오늘+3일 부터 ~~~ 오늘+1달 이내 선택 가능*/
                if((nowDate.getTime() <= selectDate.getTime() && endDate.getTime() > selectDate.getTime())){
                    var diffDay = Math.ceil((selectDate.getTime() - startDay.getTime()) / (1000 * 3600 * 24));
                    var SelectStartDate = [
                        selectDate.getFullYear(),
                        ((selectDate.getMonth()+1) >= 10 ? (selectDate.getMonth()+1) : '0'+(selectDate.getMonth()+1)),
                        ((selectDate.getDate()) >= 10 ? (selectDate.getDate()) : '0'+(selectDate.getDate()))
                    ];

                    const endDayTemp =  new Date(this.endYear, this.endMonth-1, this.endDate);
                    endDayTemp.setDate(endDayTemp.getDate()+diffDay);
                    var SelectEndDate = [
                        endDayTemp.getFullYear(),
                        ((endDayTemp.getMonth()+1) >= 10 ? (endDayTemp.getMonth()+1) : '0'+(endDayTemp.getMonth()+1)),
                        ((endDayTemp.getDate()) >= 10 ? (endDayTemp.getDate()) : '0'+(endDayTemp.getDate()))
                    ];
                    var StartDate = [
                        startDay.getFullYear(),
                        ((startDay.getMonth()+1) >= 10 ? (startDay.getMonth()+1) : '0'+(startDay.getMonth()+1)),
                        ((startDay.getDate()) >= 10 ? (startDay.getDate()) : '0'+(startDay.getDate()))
                    ];
                    var EndDate = [
                        endDay.getFullYear(),
                        ((endDay.getMonth()+1) >= 10 ? (endDay.getMonth()+1) : '0'+(endDay.getMonth()+1)),
                        ((endDay.getDate()) >= 10 ? (endDay.getDate()) : '0'+(endDay.getDate()))
                    ];
                    @if($reservation->isMonth())
                        if(confirm( '입주 일자 ㆍ '+StartDate[0]+'. '+StartDate[1]+'. '+StartDate[2]+' > '+SelectStartDate[0]+'. '+SelectStartDate[1]+'. '+SelectStartDate[2]+'\n' +
                            '퇴실 일자 ㆍ '+EndDate[0]+'. '+EndDate[1]+'. '+EndDate[2]+' > '+SelectEndDate[0]+'. '+SelectEndDate[1]+'. '+SelectEndDate[2]+'\n' +
                            '변동 일자 ㆍ '+diffDay+'일\n' +
                            '\n입주, 퇴실 기간 변경 신청하시겠습니까?\n' +
                            '신청 후 확정 시 알림톡 전달해드리겠습니다.\n' +
                            '※ 미확정 시 호텔에삶 매니저가 별도로 연락드립니다.\n' +
                            '※ 신청 기간, 입주 일자에 따라 변동 불가 할 수 있습니다.')){
                            Livewire.emit('reservationModifyApplicationEvent',StartDate,EndDate,SelectStartDate,SelectEndDate,diffDay);
                        }
                    @endif
                    @if($reservation->isTour())
                        if(confirm( '입주 일자 ㆍ '+StartDate[0]+'. '+StartDate[1]+'. '+StartDate[2]+' > '+SelectStartDate[0]+'. '+SelectStartDate[1]+'. '+SelectStartDate[2]+'\n' +
                            '변동 일자 ㆍ '+diffDay+'일\n' +
                            '\n투어 기간 변경 신청하시겠습니까?\n' +
                            '신청 후 확정 시 알림톡 전달해드리겠습니다.\n' +
                            '※ 미확정 시 호텔에삶 매니저가 별도로 연락드립니다.\n' +
                            '※ 신청 기간, 투어 일자에 따라 변동 불가 할 수 있습니다.')){
                            Livewire.emit('reservationModifyApplicationEvent',StartDate,EndDate,SelectStartDate,SelectEndDate,diffDay);
                        }
                    @endif
                    return true;
                }else{
                    alert('선택하신 날짜는 변경 가능한 기간이 아닙니다.');
                    return false;
                }
            },
            getNoOfDays() {
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                let dayOfWeek = new Date(this.year, this.month).getDay();
                let nextDayOfWeek = new Date(this.year, this.month + 1).getDay();
                let previousMonth = new Date(this.year, this.month, 0);

                let daysArray = [];
                let blankdaysArray = [];
                let blankEndDaysArray = [];
                var blankEndDaysArrayI = 0;

                for (var i = 1; i <= daysInMonth; i++) {
                    daysArray.push(i);
                }

                for (var i = 0; i < dayOfWeek; i++) {
                    blankdaysArray.push(previousMonth.getDate() - i);
                }

                if (daysArray.length + blankdaysArray.length < 35) {
                    blankEndDaysArrayI = 7;
                }
                for (var i = 0; i < (7 - nextDayOfWeek + blankEndDaysArrayI); i++) {
                    blankEndDaysArray.push(i + 1);
                }

                this.no_of_days = daysArray;
                this.blankdays = blankdaysArray.reverse();
                this.blankEndDays = blankEndDaysArray;
            },
            monthChange($type) {
                const now = new Date();
                const d = new Date(this.year, (this.month), 1);
                const nowDay = new Date(now.getFullYear(), now.getMonth(), 1);
                const startDay = new Date(this.startYear, this.startMonth-1, 1);
                const endDay = new Date(this.endYear, this.endMonth-1, 1);
                const oneMonthDay = new Date(endDay.getFullYear(), endDay.getMonth()+1, 1);

                if ($type === 'add') {
                    if ( d.getTime() > oneMonthDay.getTime() && d.getTime() === endDay.getTime()
                        || ( endDay.getTime() <= oneMonthDay.getTime() && d.getTime() === oneMonthDay.getTime() )) {
                        return false;
                    }
                    if (this.month >= 11) {
                        this.year++;
                        this.month = 0;
                    } else {
                        this.month++;
                    }
                }
                if ($type === 'sub') {
                    if ( d.getTime() < nowDay.getTime() && d.getTime() === startDay.getTime()
                        || (startDay.getTime() >= nowDay.getTime() && d.getTime() === nowDay.getTime() )) {
                        return false;
                    }
                    if (this.month === 0) {
                        this.year--;
                        this.month = 11;
                    } else {
                        this.month--;
                    }
                }

                Livewire.emit('calendarChangeStatEvent','0');
            }
        };
    }
</script>
