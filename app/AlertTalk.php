<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertTalk extends Model
{
    private $user_code;
    private $dept_code;
    private $yellowid_key;
    private $from;
    private $curl_url;
    private $headers;
    private $fields;
    private $to;
    private $identificationNumber;/*핸드폰 맨앞 식별번호*/
    private $backNumber;/*핸드폰 뒤 번호*/
    private $template;
    private $template_code;
    private $re_send; // Y,N,R 실패시 재전송
    private $buttons=null;
    private $reserved_time;


    public function __construct($data, $buttons=null)
    {
        parent::__construct();
        $this->user_code ='travelmaker';
        $this->dept_code='KH-YJO-U7';
        $this->yellowid_key='3a0d1a1ea66bb9e5d5a6463d5c15a6b54498a023';
        $this->from='15994330';
        $this->curl_url= "https://rest.surem.com/alimtalk/v2/json";
        $this->headers = array(
            'Content-Type:application/json'
        );
        $this->to=$data['tel'];//'01091031608';//$data->tel;
        $this->template=$data['template'];
        $this->template_code=$data['template_code'];
        $this->re_send=$data['re_send'];
        $this->buttons=$buttons;
        $this->reserved_time=$data['reserved_time'];
        $this->replacteTel();
    }

    public function send(){
        $message_data = [
            'reserved_time'=>$this->reserved_time,
            'message_id'=>date('md').rand(1000, 9999),
            'to' => '82'.$this->identificationNumber.$this->backNumber,
            'text' => $this->template,
            'from' => $this->from,
            'template_code' => $this->template_code,
            're_send' => $this->re_send,
            'buttons'=>null
        ];

        if ($this->buttons !== null){
            $message_data['buttons']=[$this->buttons];
            /*[
                "button_type" => 'WL',
                "button_name" => '결과 확인하기',
                "button_url" => 'https://m.travelmaker.co.kr/skin/m_html/eventsdsresult.php',
                "button_url2" => 'https://www.travelmaker.co.kr/skin/html/eventsdsresult.php'
            ];*/
        }

        $this->fields = [
            "usercode" => $this->user_code,
            "deptcode" => $this->dept_code,
            "yellowid_key" => $this->yellowid_key,
            "messages" => [$message_data]
        ];


        $this->curlInit();

        return true;
    }

    public function setTel($tel): void
    {
        $this->to=$tel;
        $this->replacteTel();
    }

    private function replacteTel(){
        $this->identificationNumber=substr($this->to,1,2);
        $this->backNumber=substr($this->to,3);
    }

    public function curlInit(): void
    {
        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $this->curl_url);
        curl_setopt($curl_session, CURLOPT_POST, true);
        curl_setopt($curl_session, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, json_encode($this->fields));

        curl_exec($curl_session);
        curl_close($curl_session);
    }

}
