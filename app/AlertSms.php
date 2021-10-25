<?php

namespace App;

class AlertSms
{

    private $curl_url;
    private $usercode;
    private $deptcode;
    private $from;
    private $headers;
    private $subject;
    private $exsubject;
    private $text;
    private $extext;
    private $country_code;
    private $tel;
    private $type;
    private $result;
    private $fields;

    /* 필수 전달값 / country_code = 82, text=내용 , subject=제목, tel=01091031608*/
    public function __construct($data)
    {
        // 요소 초기화
        $this->curl_url = '';
        $this->type='KO';
        $this->country_code='';

        $this->usercode ='travelmaker';
        $this->deptcode='KH-YJO-U7';
        $this->from='15994330';//'01048916154';
        $this->headers = array(
            'Content-Type:application/json'
        );

        $this->text = $data['text'];
        $this->subject = $data['subject'];

        $this->exsubject = '';
        $this->extext = '';
        $this->mb_tel='';
        $this->tel=$data['mb_tel'];
        $this->setting();

        $this->result = '';
    }


    public function setting(){
        //$mb_tel[0] = $this->country_code - +82 +66 등등
        //$mb_tel[1] = $this->mb_tel - 01012345678 , 821670458
        //$mb_tel[2] = $this->type - FC = 외국 / KO = 국내
        if ($this->tel->getPhoneNumberInstance()->getCountryCode() === 82) {
            $this->type = $this->tel->getCountry();
            $this->extext=$this->text;
            $this->exsubject=$this->subject;
        } else if ($this->tel->getPhoneNumberInstance()->getCountryCode() !== 86) { /* 중국이 아닌 국제*/
            $this->type = 'FC';
//            for ($idx = 0, $idxMax = strlen($this->text); $idx < $idxMax; $idx++) {
//                $this->extext .= ord($this->text[$idx]);
//            }
            $this->extext=$this->text;
            $this->exsubject=$this->subject;
        }else if ($this->tel->getPhoneNumberInstance()->getCountryCode() === 86) { /* 중국*/
            $this->type = 'CN';
            //$this->extext=utf8_encode($this->text);
            $this->extext=$this->text;
            $this->exsubject=$this->subject;
        }


        $this->curl_url = 'https://rest.surem.com/intl/text';
//        switch ($this->type) {
//            case 'KR' :
//                $this->curl_url = 'https://rest.surem.com/intl/text';
//                break;
//            case 'FC' :
//                $this->curl_url = 'https://rest.surem.com/intl/text';
//                break;
//            case 'CN' :
//                $this->curl_url = 'https://rest.surem.com/intl/text';
//                break;
//        }
    }

    /* send function check*/
    public function sendStart()
    {
        // 데이터 체크 & 전송 실행
        $this->send();
    }
    protected function setResult($result){
        $this->result=$result;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    protected function send()
    {
        try {
            $send_to[] = [
                'message_id' => date('md') . random_int(1000, 9999),
                'to' => $this->tel->getPhoneNumberInstance()->getCountryCode() . '-' . $this->tel->getPhoneNumberInstance()->getNationalNumber()
            ];
        } catch (\Exception $e) {

        }
        if ($this->type === 'KR') {
            $this->fields = array(
                "usercode" => $this->usercode,
                "deptcode" => $this->deptcode,
                "from" => $this->from,
                "text" => $this->extext,
                "messages" => $send_to,
                "reserved_time" => date('Ymdhi')
            );
        } elseif ($this->type === 'FC') { /*중국외 국제 - 영어-160자 한글-70자*/
            $this->fields = array(
                "usercode" => $this->usercode,
                "deptcode" => $this->deptcode,
                "from" => $this->from,
                "text" => $this->extext,
                "messages" => $send_to,
                "reserved_time" => date('Ymdhi')
            );
        } elseif ($this->type === 'CN') {/* 중국 */
            $this->fields = array(
                "usercode" => $this->usercode,
                "deptcode" => $this->deptcode,
                "from" => $this->from,
                "text" => $this->extext,
                "messages" => $send_to,
                "subject" => $this->exsubject,
                "reserved_time" => date('Ymdhi')
            );
        }
        $this->setResult($this->fields);
        $this->sms_send($this->curl_url, $this->headers, json_encode($this->fields));
    }

    protected function sms_send($curl_url,$headers,$data){
        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $curl_url);
        curl_setopt($curl_session, CURLOPT_POST, true);
        curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $data);

        curl_exec($curl_session);
        curl_close($curl_session);
    }

}
