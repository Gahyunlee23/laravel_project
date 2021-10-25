<?php

namespace App\Http\Livewire\Enter;

use App\EnterOption;
use App\EnterRoom;
use App\Formatter;
use App\Rules\PhoneNumber;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Enter extends Component
{
    protected $listeners = [
        'room_append'=>'add',
        'store',
        'roomArrayCheckEvent'
    ];

    /* hotel 정보 */
    public $hotel_name;
    public $hotel_address;
    public $hotel_web_address;

    /* room option 정보 */
    public $index;
    public $inputs = [0];

    public $i = 0;
    public $current_i = 0;

    public $type;
    public $supply_price_month;
    public $supply_price_3_weeks;
    public $supply_price_2_weeks;
    public $supply_price_1_weeks;
    public $supply_price_short_day;

    public $room_check;

    /* 호텔 option 정보 */
    public $amenities,$facilities,$benefit;

    /* 호텔 담당자 정보 */
    public $manager_name,$manager_rank,$manager_email,$manager_hp,$validated;


    public $admins = [
        [
            'email'=>'hotelmanager@travelmakers.kr',
            'name'=>'트래블메이커스'
        ],
        [
            'email'=>'travelmakerkorea_k@naver.com',
            'name'=>'김병주'
        ]
    ];

    public function rules(): array
    {
        $check = [
            'hotel_name'=>['required','min:2','max:50'],
            'hotel_address'=>['required','string'],
            'hotel_web_address'=>['required','active_url'],

            'amenities'=>['required'],
            'facilities'=>['required'],
            'benefit'=>['required'],

            'manager_name'=>['required'],
            'manager_rank'=>['required'],
            'manager_email'=>['required','email'],
            'manager_hp'=>['required',new PhoneNumber()],
        ];
        foreach ($this->inputs as $item) {
            $check = array_merge($check, [
                'type.' . $item => ['required'],
                'supply_price_month.' . $item => ['required','integer'],
                'supply_price_3_weeks.' . $item => ['required','integer'],
                'supply_price_2_weeks.' . $item => ['required','integer'],
                'supply_price_1_weeks.' . $item => ['required','integer'],
                'supply_price_short_day.' . $item => ['required','integer'],
            ]);
        }
        return $check;
    }

    public function messages(): array
    {
        $check_message = [
            'hotel_name.required'=>'호텔명을 입력해주세요',
            'hotel_name.min'=>'호텔명은 2글자 이상 입력해주세요',
            'hotel_name.max'=>'호텔명은 50글자 이하 입력해주세요',
            'hotel_address.required'=>'호텔 주소를 입력해주세요',
            'hotel_web_address.required'=>'호텔 웹사이트 주소를 입력해주세요',
            'hotel_web_address.active_url'=>'웹사이트 형식(ex. http://yoursitepage.com)을 입력해주세요',

            'amenities.required'=>'어메니티를 입력해주세요',
            'facilities.required'=>'부대시설를 입력해주세요',
            'benefit.required'=>'호텔에삶 Only 혜택을 입력해주세요',

            'manager_name.required'=>'담당자 성명을 입력해주세요',
            'manager_rank.required'=>'담당자 직급을 입력해주세요',
            'manager_email.required'=>'담당자 이메일을 입력해주세요',
            'manager_email.email'=>'담당자 이메일 형식을 확인해주세요',
            'manager_hp.required'=>'담당자 연락처를 입력해주세요',
        ];
        foreach ($this->inputs as $item) {
            $check_message=array_merge($check_message, [
                'type.'.$item.'.required' => '객실 타입을 입력해주세요',
                'supply_price_month.'.$item.'.required' => '한 달 살기 공급가를 입력해주세요',
                'supply_price_3_weeks.'.$item.'.required' => '3주 살기 공급가를 입력해주세요',
                'supply_price_2_weeks.'.$item.'.required' => '2주 살기 공급가를 입력해주세요',
                'supply_price_1_weeks.'.$item.'.required' => '1주 살기 공급가를 입력해주세요',
                'supply_price_short_day.'.$item.'.required' => '단기 거주 공급가를 입력해주세요',
                'supply_price_month.'.$item.'.integer' => '숫자만 입력해주세요',
                'supply_price_3_weeks.'.$item.'.integer' => '숫자만 입력해주세요',
                'supply_price_2_weeks.'.$item.'.integer' => '숫자만 입력해주세요',
                'supply_price_1_weeks.'.$item.'.integer' => '숫자만 입력해주세요',
                'supply_price_short_day.'.$item.'.integer' => '숫자만 입력해주세요',
            ]);
        }
        return $check_message;
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    /* 호텔 룸 리스트 추가*/
    public function add()
    {
        if( (!isset($this->type[$this->i], $this->supply_price_month[$this->i], $this->supply_price_3_weeks[$this->i], $this->supply_price_2_weeks[$this->i], $this->supply_price_1_weeks[$this->i], $this->supply_price_short_day[$this->i]))){
            $this->dispatchBrowserEvent('alert', ['type' => 'room_page','message'=>($this->i+1).'번 객실 정보 모두 작성후 추가 가능합니다.']);
        }else {
            if ($this->i === 9) {
                $this->dispatchBrowserEvent('alert', ['type' => 'room_page', 'message' => '객실 타입은 10개 까지 추가 가능합니다.']);
            } else {
                $this->i++;
                $this->inputs = array_merge($this->inputs, [$this->i]);
                $this->current_i = $this->i;
            }
        }
    }

    public function roomArrayCheckEvent($text){
        $this->room_check=$text;
    }

    /* 룸 리스트 이동*/
    public function room_page($i)
    {
        if($i !== 0
            && ( $this->type[$this->i-1] || $this->supply_price_month[$this->i-1] || $this->supply_price_3_weeks[$this->i-1] || $this->supply_price_2_weeks[$this->i-1] || $this->supply_price_1_weeks[$this->i-1] || $this->supply_price_short_day[$this->i-1] )
            && ($this->type[$i-1] === null || $this->supply_price_month[$i-1] === null || $this->supply_price_3_weeks[$i-1] === null || $this->supply_price_2_weeks[$i-1] === null || $this->supply_price_1_weeks[$i-1] === null || $this->supply_price_short_day[$i-1] === null)){

            $this->dispatchBrowserEvent('alert', ['type' => 'room_page','message'=>'이전 룸 정보 모두 작성후 가능합니다.']);
        }else{
            $this->current_i=$i;
        }
    }

    public function store()
    {
        $request = request();
        $validator = Validator::make($request->all()['serverMemo']['data'], $this->rules());

        if ($validator->fails()) {
            $this->dispatchBrowserEvent('notice', ['type' => 'error','text' => '모든 항목 입력 후 신청을 완료해주세요.']);
        }

        sleep(.5);
        $validatedData = $this->validate();

        $enter = \App\Enter::create([
            'hotel_name' => $validatedData['hotel_name'],
            'hotel_address' => $validatedData['hotel_address'],
            'hotel_web_address' => $validatedData['hotel_web_address'],

            'manager_name' => $validatedData['manager_name'],
            'manager_rank' => $validatedData['manager_rank'],
            'manager_email' => $validatedData['manager_email'],
            'manager_hp' => $validatedData['manager_hp']
        ]);
        if($enter){
            foreach ($validatedData['type'] as $key => $value) {
                EnterRoom::create([
                    'enter_id'=>$enter->id,
                    'type' => $validatedData['type'][$key],
                    'supply_price_month' => $validatedData['supply_price_month'][$key],
                    'supply_price_3_weeks' => $validatedData['supply_price_3_weeks'][$key],
                    'supply_price_2_weeks' => $validatedData['supply_price_2_weeks'][$key],
                    'supply_price_1_weeks' => $validatedData['supply_price_1_weeks'][$key],
                    'supply_price_short_day' => $validatedData['supply_price_short_day'][$key]
                ]);
            }
            $validatedData=array_merge($validatedData,[
                'enter_id'=>$enter->id
            ]);
            EnterOption::create($validatedData);
            $this->dispatchBrowserEvent('notice', ['type' => 'success','text' => '입점 신청 완료했습니다']);

            $data = [
                'subject' => '[호텔에삶/호텔입점신청]'.$this->hotel_name.' 신청 내역입니다.',
                'enter' => $enter,
                'formatter'=> new Formatter()
            ];

            foreach ($this->admins as $index => $user) {
                Mail::send('emails.admin.enter_completed', $data, function ($message) use ($user, $data) {
                    $message->to($user['email'], $user['name'])->subject($data['subject']);
                    $message->from(env('MAIL_USERNAME'), env('MAIL_NICKNAME'));
                });
            }
        }else{
            $this->dispatchBrowserEvent('notice', ['type' => 'error', 'text' => '모든 항목 입력 후 신청을 완료해주세요.']);
        }

    }


    public function render()
    {
        return view('livewire.enter.enter');
    }
}
