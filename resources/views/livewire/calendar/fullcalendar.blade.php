<div>
    @if($events !== null)
    <div class="py-4 grid grid-cols-2 gap-3">
        <div class="calendar-unselect flex justify-center items-center px-4 h-12 bg-tm-c-292f36 rounded-sm shadow-lg cursor-pointer"
            wire:click="$emitUp('calendarUnSelect')">
            <div class="text-sm text-white font-bold">
                선택 전체 취소
            </div>
        </div>
        <div class="flex justify-center items-center px-4 h-12 bg-tm-c-C1A485 rounded-sm shadow-lg cursor-pointer" wire:click="$emitUp('schedulerModalOpen')">
            <div class="text-sm text-white font-bold">
                선택 일정 스케줄러 추가
            </div>
        </div>
    </div>
    @endif

    <div class="flex flex-wrap sm:flex-nowrap space-y-3 sm:space-y-0">
        <div id='calendar-container'
             class="w-full relative z-10 mx-4 space-x-2"
             wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>

    <div id='external-events' class="mt-10 w-full px-4 bg-gray-200">

        <select wire:model="name" id="selectName">
            <option value="">선택 - 개발중</option>
            @foreach ($this->names as $name)
                <option value="{{ $name }}">{{ $name }}</option>
            @endforeach
        </select>

        @foreach ($this->tasks as $task)
            <div data-event='@json(['id' => uniqid(), 'title' => $task])'
                 class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event cursor-move my-2'>
                <div class='fc-event-main'>{{$task}}</div>
            </div>
        @endforeach

{{--        <p>--}}
{{--            <input type='checkbox' id='drop-remove' />--}}
{{--            <label for='drop-remove'>삭제 처리</label>--}}
{{--        </p>--}}

        <ul class="overflow-y-scroll">
            @foreach (array_reverse($logs) as $Item)
                <li>{{ $Item }}</li>
            @endforeach
        </ul>
    </div>
</div>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script>
    document.addEventListener('livewire:load', function() {
        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var calendarEl = document.getElementById('calendar');

        new Draggable(containerEl, {
            itemSelector: '.fc-event'
        });

        var calendar = new Calendar(calendarEl, {
            locales: 'kr',
            unselectAuto : false,
            selectable: true,
            /*selectOverlap:false,*/ // 중복 선택 불가
            dayMaxEvents: true,/*이벤트 다수 일경우 그룹 화*/
            headerToolbar: {
                left: 'dayGridMonth',/*listWeek*/
                center: 'prev,title,next',
                right: 'today'/*dayGridMonth,timeGridWeek,timeGridDay   addEventButton*/
            },
            editable: true,
            eventStartEditable:true, /* 위치 변경 가능 */
            eventDurationEditable:false, /* 기간 드래그 증가 불가*/
            droppable: true, // this allows things to be dropped onto the calendar
            eventTimeFormat : {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            },
            /*customButtons: {
                addEventButton: {
                    text: '옵션 추가',
                    click: function() {
                        var dateStr = prompt('YYYY-MM-DD 포맷으로 입력해주세요.');
                        var date = new Date(dateStr + 'T00:00:00');

                        if (!isNaN(date.valueOf())) {
                            var title = prompt('옵션 명칭을 입력해주세요.');
                            if (title.valueOf()) {
                                calendar.addEvent({
                                    title: title,
                                    start: date,
                                    allDay: true
                                });
                                return true;
                            }
                        }
                        alert('추가 취소됬습니다.');
                    }
                }
            },*/
            eventClick: function(info) {
                var eventObj = info.event;

                if (eventObj.url) {
                    alert(
                        'Clicked ' + eventObj.title + '.\n' +
                        'Will open ' + eventObj.url + ' in a new tab'
                    );
                    window.open(eventObj.url);
                    info.jsEvent.preventDefault();
                } else {
                    if(confirm(eventObj.title + ' 삭제 하시겠습니까 ?')){
                        Livewire.emit('schedulerDateRemove',info.event);
                        eventObj.remove();
                    }
                }
            },
            drop: function(info) {
                // if (checkbox.checked) {
                //     info.draggedEl.parentNode.removeChild(info.draggedEl);
                // }
            },
            select: function (info) {
                Livewire.emit('schedulerDateSelect', info);
                //calendar.unselect();
            },
            // selectOverlap: function(event) {
            //     return ! event.block;
            // },
            //select: info => Livewire.emit('schedulerDateSelect', info),
            eventReceive: info => Livewire.emit('schedulerDateReceive',info.event),
            eventDrop: info => Livewire.emit('schedulerDateDrop',info.event, info.oldEvent),
            loading: function(isLoading) {
                if (!isLoading) {
                    this.getEvents().forEach(function(e){
                        if (e.source === null) {
                            e.remove();
                        }
                    });
                }
            },
            eventDidMount: function(info) {
                if(info.event.extendedProps.description!=='' && info.event.extendedProps.description!== null && info.event.extendedProps.description!== undefined){
                    tippy(info.el, {
                        content:  info.event.extendedProps.description,//이벤트 디스크립션을 툴팁으로 가져옵니다.
                        allowHTML: true,
                    });
                }
            },
        });

        calendar.addEventSource({
            url: '{{route('api.hotel.schedules')}}',
            method: 'POST',
            color: 'rgb(132,151,115)',
            textColor: 'rgb(255,255,255)',
            extraParams: {
                hotel : '{{$hotel->id}}',
                activeStart : calendar.view.activeStart,
                activeEnd : calendar.view.activeEnd
            },
            failure: function() {
                alert('스케줄러 데이터 불러오기 실패!!');
            }
        });
        calendar.render();
        Livewire.on('refreshCalendar', () => {
            calendar.refetchEvents()
        });
        Livewire.on('ShowEvent', (event) => {
            eventAddCalendar(event);
        });
        Livewire.on('ShowEvents', (events) => {
            calendar.refetchEvents();
            setTimeout(function(){
                eventsAddCalendar(events);
            },200);
        });
        /* 이벤트 정리 리로드 Event */
        window.addEventListener('reEventSourceGet', event => {
            calendar.refetchEvents();
        });

        function eventAddCalendar(event){
            var start = new Date(event['start']);
            var end = new Date(event['end']);
            calendar.addEvent({
                start: start.getFullYear()+'-'+((start.getMonth()+1).toString().padStart(2,'0'))+'-'+(start.getDate().toString().padStart(2,'0')),//start.getFullYear()+'-'+('00'+start.getMonth()).substr(1,2)+'-'+('00'+start.getDate()).substr(1,2),
                end: end.getFullYear()+'-'+((end.getMonth()+1).toString().padStart(2,'0'))+'-'+(end.getDate().toString().padStart(2,'0')),//end.getFullYear()+'-'+('00'+end.getMonth()).substr(1,2)+'-'+('00'+end.getDate()).substr(1,2),
                display: 'background',
                overlap: false,
            });
        }
        function eventsAddCalendar(events){
            if(events !== null){
                for (var i=0; i<events.length;i++){
                    var start = new Date(events[i]['start']);
                    var end = new Date(events[i]['end']);
                    calendar.addEvent({
                        start: start.getFullYear()+'-'+((start.getMonth()+1).toString().padStart(2,'0'))+'-'+(start.getDate().toString().padStart(2,'0')),//start.getFullYear()+'-'+('00'+start.getMonth()).substr(1,2)+'-'+('00'+start.getDate()).substr(1,2),
                        end: end.getFullYear()+'-'+((end.getMonth()+1).toString().padStart(2,'0'))+'-'+(end.getDate().toString().padStart(2,'0')),//end.getFullYear()+'-'+('00'+end.getMonth()).substr(1,2)+'-'+('00'+end.getDate()).substr(1,2),
                        display: 'background',
                        overlap: false,
                    });
                }
            }
        }

        document.querySelector('.fc-prev-button').addEventListener('click', function(event) {
            Livewire.emit('CalendarReShowEvents');
        });
        document.querySelector('.fc-next-button').addEventListener('click', function(event) {
            Livewire.emit('CalendarReShowEvents');
        });
    });

</script>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
<style>
    :root {
        --fc-today-bg-color: #C1A485;
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
    }
    /* 이전,다음 달 예상 날짜 */
    .fc-day-other{
        background-color: #dddddd;
    }
    /* 현재 달의 날자들 */
    .fc-daygrid-day:not(.fc-day-other):not(.fc-day-sun):not(.fc-day-sat){
        background-color: #ededed;
    }
    /* 요일 표기 박스*/
    .fc-col-header-cell{
        background-color: #ededed;
    }
    /* 요일 표기 주말 */
    .fc-col-header-cell.fc-day-sun, .fc-col-header-cell.fc-day-sat{
        color: #e3342f;
    }
    /* 토 일 라인 */
    .fc-day-sun, .fc-day-sat{
        background-color: #c1c1c1;
    }
</style>
@endpush
