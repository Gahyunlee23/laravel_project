<div x-data="{
    start_date : @entangle('start_date'),
    end_date : @entangle('end_date')
}">
    <div class="mt-8 flex flex-wrap sm:flex-nowrap space-y-3 sm:space-y-0 bg-white shadow-lg rounded-sm">
        <div id='calendar-container'
             class="w-full relative z-10 space-x-2 p-4 sm:p-8"
             wire:ignore>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div id='calendar_0'></div>
                <div id='calendar_1'></div>
            </div>
        </div>
    </div>
    @if(isset($impossibleDates) && collect($impossibleDates)->count()>=1)
    <div class="AppSdGothicNeoR mt-8 p-4 bg-white text-tm-c-30373F">
        <div class="pb-2">
            예약 불가 날짜가 포함되있습니다.
        </div>
        <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-12 text-left gap-2">
            @foreach ($impossibleDates as $index=>$item)
                @break($index>=4)
                <div>
                    {{$item}}
                </div>
            @endforeach
            @if(collect($impossibleDates)->count()>4)
            <div class="text-sm flex items-center">
                이외 {{collect($impossibleDates)->count()-4}}일
            </div>
            @endif
        </div>
    </div>
    @endif
@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;

            var calendarEl_0 = document.getElementById('calendar_0');
            var calendarEl_1 = document.getElementById('calendar_1');

            let weekList = ["일", "월", "화", "수", "목", "금", "토"];

            var calendar_0 = new Calendar(calendarEl_0, {
                /*firstDay:1, //시작 요일 */
                unselectAuto : false,
                selectable: false,
                selectOverlap:true, // 중복 선택 불가
                dayMaxEvents: false,/*이벤트 다수 일경우 그룹 화*/
                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                },
                customButtons: {
                    prev : {
                        click : function(){
                            var now = new Date();
                            if(now.getTime()<=calendar_0.getDate().getTime()){
                                calendar_0.prev();
                                calendar_1.prev();
                                Livewire.emit('dateCheckDate');
                                checkPossibleDate();
                            }
                        }
                    },
                    next : {
                        click : function(){
                            calendar_0.next();
                            calendar_1.next();
                            Livewire.emit('dateCheckDate');
                            checkPossibleDate();
                        }
                    }
                },
                titleFormat: function(date) {
                    if(date.date.month<9){
                        return `${date.date.year}. 0${date.date.month + 1}`;
                    }
                    return `${date.date.year}. ${date.date.month + 1}`;
                },
                dayHeaderContent: function (date) {
                    return weekList[date.dow];
                },
                editable: false,
                eventStartEditable:false, /* 위치 변경 가능 */
                eventDurationEditable:false, /* 기간 드래그 증가 불가*/
                droppable: true,
                eventTimeFormat : {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                },
                dateClick: function(info) {
                    /* 선택 표기 On 삭제*/
                    if(@this.type === 'month'){
                        if(info.dateStr > '{{today()->addDays(3)->format('Y-m-d')}}'){
                            if(document.querySelectorAll('.fc-daygrid-day:not(.fc-day-other) .fc-daygrid-day-number.on').length >=2){
                                document.querySelectorAll('.fc-daygrid-day-number.on').forEach(function (item, index){
                                    item.setAttribute('class', 'fc-daygrid-day-number');
                                });
                                /* 배경 이벤트 삭제 */
                                calendar_0.removeAllEvents();
                                calendar_1.removeAllEvents();
                            }
                            /* 선택한 날짜 상위 wire 전달*/
                            Livewire.emit('calendarDateClick', 'order.input-form', info.dateStr);
                            //var clickDate = info.dayEl.querySelector('.fc-daygrid-day-frame > .fc-daygrid-day-top > .fc-daygrid-day-number');
                            var clickDate = document.querySelectorAll('.fc-daygrid-day[data-date="'+info.dateStr+'"] > .fc-daygrid-day-frame > .fc-daygrid-day-top > .fc-daygrid-day-number');
                            clickDate.forEach(function (item, index){
                                item.setAttribute('class', 'fc-daygrid-day-number on');
                            });
                            /*setTimeout(function(){
                                console.log(@this.start_date,@this.end_date);
                            },300);*/
                        }else{
                            document.querySelectorAll('.fc-daygrid-day-number.on').forEach(function (item, index){
                                item.setAttribute('class', 'fc-daygrid-day-number');
                            });
                            /* 배경 이벤트 삭제 */
                            calendar_0.removeAllEvents();
                            calendar_1.removeAllEvents();
                            Livewire.emit('calendarDateUpperClear');
                        }
                    }else{
                        if(info.dateStr > '{{today()->addDay()->format('Y-m-d')}}'){
                            if(document.querySelectorAll('.fc-daygrid-day:not(.fc-day-other) .fc-daygrid-day-number.on').length >=1){
                                document.querySelectorAll('.fc-daygrid-day-number.on').forEach(function (item, index){
                                    item.setAttribute('class', 'fc-daygrid-day-number');
                                });
                                /* 배경 이벤트 삭제 */
                                calendar_0.removeAllEvents();
                                calendar_1.removeAllEvents();
                            }
                            /* 선택한 날짜 상위 wire 전달*/
                            Livewire.emit('calendarDateClick', 'order.input-form', info.dateStr);
                            //var clickDate = info.dayEl.querySelector('.fc-daygrid-day-frame > .fc-daygrid-day-top > .fc-daygrid-day-number');
                            var clickDate = document.querySelectorAll('.fc-daygrid-day[data-date="'+info.dateStr+'"] > .fc-daygrid-day-frame > .fc-daygrid-day-top > .fc-daygrid-day-number');
                            clickDate.forEach(function (item, index){
                                item.setAttribute('class', 'fc-daygrid-day-number on');
                            });
                        }else{
                            document.querySelectorAll('.fc-daygrid-day-number.on').forEach(function (item, index){
                                item.setAttribute('class', 'fc-daygrid-day-number');
                            });
                            /* 배경 이벤트 삭제 */
                            calendar_0.removeAllEvents();
                            calendar_1.removeAllEvents();
                            Livewire.emit('calendarDateUpperClear');
                        }
                    }
                }
            });

            var calendar_0_month = calendar_0.getDate().getMonth()+2;
            if(calendar_0_month<10){
                calendar_0_month = '0'+calendar_0_month;
            }
            var calendar_1 = new Calendar(calendarEl_1, {
                initialDate:calendar_0.getDate().getFullYear()+'-'+calendar_0_month+'-01',
                unselectAuto : false,
                selectable: false,
                selectOverlap:true, // 중복 선택 불가
                dayMaxEvents: false,/*이벤트 다수 일경우 그룹 화*/
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: 'next'
                },
                customButtons: {
                    next : {
                        click : function(){
                            calendar_0.next();
                            calendar_1.next();
                            Livewire.emit('dateCheckDate');
                            checkPossibleDate();
                        }
                    }
                },
                titleFormat: function(date) {
                    if(date.date.month<9){
                        return `${date.date.year}. 0${date.date.month + 1}`;
                    }
                    return `${date.date.year}. ${date.date.month + 1}`;
                },
                dayHeaderContent: function (date) {
                    return weekList[date.dow];
                },
                editable: false,
                eventStartEditable:false,
                eventDurationEditable:false,
                droppable: true,
                eventTimeFormat : {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                },
                dateClick: function(info) {
                    /* 선택 표기 On 삭제*/
                    if(@this.type === 'month'){
                        if(info.dateStr > '{{today()->addDays(3)->format('Y-m-d')}}'){
                            if(document.querySelectorAll('.fc-daygrid-day:not(.fc-day-other) .fc-daygrid-day-number.on').length >=2){
                                document.querySelectorAll('.fc-daygrid-day-number.on').forEach(function (item, index){
                                    item.setAttribute('class', 'fc-daygrid-day-number');
                                });
                                /* 배경 이벤트 삭제 */
                                calendar_0.removeAllEvents();
                                calendar_1.removeAllEvents();
                            }
                            /* 선택한 날짜 상위 wire 전달*/
                            Livewire.emit('calendarDateClick', 'order.input-form', info.dateStr);
                            //var clickDate = info.dayEl.querySelector('.fc-daygrid-day-frame > .fc-daygrid-day-top > .fc-daygrid-day-number');
                            var clickDate = document.querySelectorAll('.fc-daygrid-day[data-date="'+info.dateStr+'"] > .fc-daygrid-day-frame > .fc-daygrid-day-top > .fc-daygrid-day-number');
                            clickDate.forEach(function (item, index){
                                item.setAttribute('class', 'fc-daygrid-day-number on');
                            });
                            /*setTimeout(function(){
                                console.log(@this.start_date,@this.end_date);
                            },300);*/
                        }else{
                            document.querySelectorAll('.fc-daygrid-day-number.on').forEach(function (item, index){
                                item.setAttribute('class', 'fc-daygrid-day-number');
                            });
                            /* 배경 이벤트 삭제 */
                            calendar_0.removeAllEvents();
                            calendar_1.removeAllEvents();
                            Livewire.emit('calendarDateUpperClear');
                        }
                    }else{
                        if(info.dateStr > '{{today()->addDay()->format('Y-m-d')}}'){
                            if(document.querySelectorAll('.fc-daygrid-day:not(.fc-day-other) .fc-daygrid-day-number.on').length >=1){
                                document.querySelectorAll('.fc-daygrid-day-number.on').forEach(function (item, index){
                                    item.setAttribute('class', 'fc-daygrid-day-number');
                                });
                                /* 배경 이벤트 삭제 */
                                calendar_0.removeAllEvents();
                                calendar_1.removeAllEvents();
                            }
                            /* 선택한 날짜 상위 wire 전달*/
                            Livewire.emit('calendarDateClick', 'order.input-form', info.dateStr);
                            //var clickDate = info.dayEl.querySelector('.fc-daygrid-day-frame > .fc-daygrid-day-top > .fc-daygrid-day-number');
                            var clickDate = document.querySelectorAll('.fc-daygrid-day[data-date="'+info.dateStr+'"] > .fc-daygrid-day-frame > .fc-daygrid-day-top > .fc-daygrid-day-number');
                            clickDate.forEach(function (item, index){
                                item.setAttribute('class', 'fc-daygrid-day-number on');
                            });
                        }else{
                            document.querySelectorAll('.fc-daygrid-day-number.on').forEach(function (item, index){
                                item.setAttribute('class', 'fc-daygrid-day-number');
                            });
                            /* 배경 이벤트 삭제 */
                            calendar_0.removeAllEvents();
                            calendar_1.removeAllEvents();
                            Livewire.emit('calendarDateUpperClear');
                        }
                    }
                }
            });

            calendar_0.render();
            calendar_1.render();

            Livewire.on('dateCheckDate', () => {
                if(@this.type === 'month'){
                    var start = new Date(@this.start_date);
                    var end = new Date(@this.end_date);
                    var start_date = start.getFullYear()+'-'+((start.getMonth()+1).toString().padStart(2,'0'))+'-'+((start.getDate()).toString().padStart(2,'0'));
                    var end_date = end.getFullYear()+'-'+((end.getMonth()+1).toString().padStart(2,'0'))+'-'+((end.getDate()).toString().padStart(2,'0'));

                    if(start_date!==null){
                        document.querySelectorAll('.fc-daygrid-day[data-date="'+start_date+'"] > .fc-daygrid-day-frame > .fc-daygrid-day-top > .fc-daygrid-day-number').forEach(function (item, index){
                            item.setAttribute('class', 'fc-daygrid-day-number on');
                        });
                    }
                    if(end_date!==null){
                        document.querySelectorAll('.fc-daygrid-day[data-date="'+end_date+'"] > .fc-daygrid-day-frame > .fc-daygrid-day-top > .fc-daygrid-day-number').forEach(function (item, index){
                            item.setAttribute('class', 'fc-daygrid-day-number on');
                        });
                    }
                }else{
                    var start = new Date(@this.start_date);
                    var start_date = start.getFullYear()+'-'+((start.getMonth()+1).toString().padStart(2,'0'))+'-'+((start.getDate()).toString().padStart(2,'0'));

                    if(start_date!==null){
                        document.querySelectorAll('.fc-daygrid-day[data-date="'+start_date+'"] > .fc-daygrid-day-frame > .fc-daygrid-day-top > .fc-daygrid-day-number').forEach(function (item, index){
                            item.setAttribute('class', 'fc-daygrid-day-number on');
                        });
                    }
                }
            });

            Livewire.on('dateCheckBackground', () => {
                var ranges = @this.period_ranges;
                var end = new Date(ranges[ranges.length-1]);
                calendar_0.addEvent({
                    start: ranges[0],
                    end: end.getFullYear()+'-'+((end.getMonth()+1).toString().padStart(2,'0'))+'-'+((end.getDate()+1).toString().padStart(2,'0')),
                    display: 'background',
                    color:'#EDEDED',
                    overlap: false,
                });
                calendar_1.addEvent({
                    start: ranges[0],
                    end: end.getFullYear()+'-'+((end.getMonth()+1).toString().padStart(2,'0'))+'-'+((end.getDate()+1).toString().padStart(2,'0')),
                    display: 'background',
                    color:'#EDEDED',
                    overlap: false,
                });
            });

            /* 선택 지우는 function */
            Livewire.on('dateCheckClear', () => {
                document.querySelectorAll('.fc-daygrid-day-number.on').forEach(function (item, index){
                    item.setAttribute('class', 'fc-daygrid-day-number');
                });
                calendar_0.removeAllEvents();
                calendar_1.removeAllEvents();
            });

            /* 선택 가능 일자 처리 */
            function checkPossibleDate(){
                var prices = @this.periodPrices;
                document.querySelectorAll('.fc-daygrid-day').forEach(function (item, index){
                    if(@this.type === 'month'){
                        if(item.getAttribute('data-date') <= '{{today()->addDays(3)->format('Y-m-d')}}'){
                            item.style.textDecoration= 'line-through';
                            item.style.textDecorationColor= '#979b9f';
                            item.style.color= '#979b9f';
                        }
                    }else{
                        if(item.getAttribute('data-date') <= '{{today()->addDay()->format('Y-m-d')}}'){
                            item.style.textDecoration= 'line-through';
                            item.style.textDecorationColor= '#979b9f';
                            item.style.color= '#979b9f';
                        }
                    }
                    if (!prices.includes(item.getAttribute('data-date'))) {
                        item.style.textDecoration= 'line-through';
                        item.style.textDecorationColor= '#979b9f';
                        item.style.color= '#979b9f';
                    }
                });
            }
            checkPossibleDate();
        });

    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
    <style>
        :root {
            --fc-today-bg-color: #ffffff;
        }
        /* 메인 중간 표기 BOX */
        .fc-toolbar-chunk > div{
            display: flex;
            align-items: center;
        }
        /* 메인 기간 표기 BOX*/
        .fc-toolbar-title{
            padding: 0 10px;
            color:white;
            user-select: none;
        }
        /* 이전,다음 달 예상 날짜 */
        .fc-day-other{
            background-color: #ffffff;
        }
        /* 현재 달의 날자들 */
        .fc-daygrid-day:not(.fc-day-other):not(.fc-day-sun):not(.fc-day-sat){
            background-color: #ffffff;
            color:#30373f;
        }
        /* 각 일자 표기 중앙 정렬 */
        .fc-daygrid-day-top{
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 23px;
            line-height: 23px;
            user-select: none;
            /* background-color: #c1a485;*/
        }
        .fc-daygrid-day-number{
            font-family: AppleSDGothicNeoR, serif;
            font-size: 14px;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            padding:0 !important;
            width:25px;
            text-align: center;
            height: 25px;
            line-height: 21px;
            border-radius: 100%;
            cursor: pointer;
        }
        /* 이외 일자 */
        .fc-daygrid-day.fc-day.fc-day-other{
            color: #d7d3cf !important;
        }
        /* 요일 표기 박스*/
        .fc-col-header-cell{
            background-color: #ffffff;
            user-select: none;
        }
        /* 요일 표기 주말 */
        .fc-col-header-cell.fc-day-sun, .fc-col-header-cell.fc-day-sat{
            color: #e3342f;
        }
        /* 토 일 라인 */
        .fc-day-sun, .fc-day-sat{
            background-color: transparent;
        }
        /* 년.월 표기 */
        .fc-toolbar-title{
            color : #30373f;
            font-size: 19px;
            font-family: AppleSDGothicNeoR, serif;
            font-weight: bold;
        }
        /* 모든 줄*/
        .fc-theme-standard td, .fc-theme-standard th,.fc-scrollgrid.fc-scrollgrid-liquid{
            border:none;
        }
        /* 주말 요일 표기 */
        .fc-col-header-cell.fc-day.fc-day-mon,
        .fc-col-header-cell.fc-day.fc-day-tue,
        .fc-col-header-cell.fc-day.fc-day-wed,
        .fc-col-header-cell.fc-day.fc-day-thu,
        .fc-col-header-cell.fc-day.fc-day-fri,
        .fc-col-header-cell.fc-day-sun, .fc-col-header-cell.fc-day-sat{
            font-family: AppleSDGothicNeoR, serif;
            color : #30373f;
            font-size: 13px;
        }
        .fc-daygrid-day-frame.fc-scrollgrid-sync-inner{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* 버튼 부분 */
        .fc-next-button.fc-button.fc-button-primary,
        .fc-prev-button.fc-button.fc-button-primary{
            padding: 0 0 5px 0;
            display: flex;
            align-items: center;
            background-color: transparent !important;
            color: #30373f !important;
            border: none;
            box-shadow: none !important;
            outline: none !important;
        }
        .fc-toolbar-chunk{
            outline: none !important;
        }

        #calendar_0 > .fc-header-toolbar > .fc-toolbar-chunk > .fc-next-button {
            display: none;
        }
        #calendar_1 > .fc-header-toolbar > .fc-toolbar-chunk > .fc-next-button {
            display: block;
        }
        @media (max-width: 767px) {
            #calendar_0 > .fc-header-toolbar > .fc-toolbar-chunk > .fc-next-button {
                display: block;
            }
            #calendar_1 > .fc-header-toolbar > .fc-toolbar-chunk > .fc-next-button {
                display: none;
            }
        }
        .fc-daygrid-day-number.on{
            z-index: 100;
            background-color: #c1a485; color:white; border: 2px solid #EDEDED;
        }
        .fc-bg-event.fc-event{
            height: 50%;
            transform: translate(0px, 50%);
            opacity: 1 !important;
        }
        .fc-bg-event.fc-event.fc-event-start{
            #transform: translate(15px, 50%) !important;;
            border-top-left-radius: 10%;
            border-bottom-left-radius: 10%;
        }
        .fc-bg-event.fc-event.fc-event-end{
            #transform: translate(-15px, 50%) !important;
            border-top-right-radius: 10%;
            border-bottom-right-radius: 10%;
        }
        .fc .fc-day-other .fc-daygrid-day-top{
            opacity: .7 !important;
            z-index: 10;
        }
    </style>
@endpush

</div>
