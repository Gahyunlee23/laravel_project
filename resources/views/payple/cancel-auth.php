<?php
/*
* TEST : https://testcpay.payple.kr/php/auth.php
* REAL : https://cpay.payple.kr/php/auth.php
*/

use App\AlertTalk;
use App\AlertTalkList;
use App\Confirmation;
use App\Formatter;
use App\HotelReservation;
use App\Payment;
use App\Schedule;
use App\Template;
use Carbon\Carbon;
use Illuminate\Support\Str;

header("Expires: Mon 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d, M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0; pre-check=0", false);
header("Pragma: no-cache");
header("Content-type: application/json; charset=utf-8");

try {

    //AWS 이용 가맹점인 경우 REFERER 에 도메인을 넣어주세요.
    $CURLOPT_HTTPHEADER = array(
        "cache-control: no-cache",
        "content-type: application/json; charset=UTF-8",
        "referer: http://".$_SERVER['HTTP_HOST']
    );

    // 발급받은 비밀키. 유출에 주의하시기 바랍니다.
    $post_data = array (
        "cst_id" => "tmaker",
        "custKey" => "3e47b1ea5bbbde2eb3f2e3cd95396b3d49197de139a003b52e418a29fb766f52",
        "PCD_PAYCANCEL_FLAG" => "Y"
    );

    $ch = curl_init('https://cpay.payple.kr/php/auth.php');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $CURLOPT_HTTPHEADER);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

    ob_start();
    $response = curl_exec ($ch);
    $AuthBuffer = ob_get_contents();
    ob_end_clean();
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close ($ch);

    $AuthResult = json_decode($AuthBuffer, true);

    if (!isset($AuthResult['result'])) throw new Exception($AuthResult['result'].$AuthResult['cst_id'] . "인증요청 실패!48");

    if ($AuthResult['result'] !== 'success') throw new Exception($AuthResult['result_msg'].'!50');
//    ddd($AuthResult->cst_id.'-'.$AuthResult->custKey.'-'.$AuthResult->AuthKey.'-'.$AuthResult->return_url);

    $cst_id = $AuthResult['cst_id'];                  // 가맹점 ID
    $custKey = $AuthResult['custKey'];                // 가맹점 키
    $AuthKey = $AuthResult['AuthKey'];                // 인증 키
    $PayReqURL = $AuthResult['return_url'];           // 정기결제요청 URL
    ##################################################### PAY REQ #####################################################

    // 정기결제 요청 데이터
    $PCD_PAYER_EMAIL = $_POST['PCD_PAYER_EMAIL'] ?? "";                                // 결제자 Email
    $PCD_PAY_OID = $_POST['PCD_PAY_OID'] ?? "";                                        // 주문번호
    $PCD_PAY_DATE = (isset($_POST['PCD_PAY_DATE'])) ? preg_replace("/([^0-9]+)/", "", $_POST['PCD_PAY_DATE']) : "";        // 원거래 결제일자
    $PCD_REGULER_FLAG ="N";                            // 정기결제 Y|N
    $PCD_PAY_YEAR = (isset($_POST['PCD_PAY_YEAR'])) ? preg_replace("/([^0-9]+)/", "", $_POST['PCD_PAY_YEAR']) : "";    // 정기결제 구분 년도
    $PCD_PAY_MONTH = (isset($_POST['PCD_PAY_MONTH'])) ? preg_replace("/([^0-9]+)/", "", $_POST['PCD_PAY_MONTH']) : "";    // 정기결제 구분 월
    $PCD_REFUND_TOTAL = $_POST['PCD_REFUND_TOTAL'] ?? "";                        // 환불요청금액
    $PCD_REFUND_TAXTOTAL = $_POST['PCD_REFUND_TAXTOTAL'] ?? "";                        // 환불요청금액
    $PCD_REFUND_KEY = '7f8b618b2cfcb87228c37bec763e20c358a5bfd30d2d31b66dd4487d52fa5039';                                                                                        // 환불서비스 key

    ///////////////////////////////////////////////// 환불(승인취소)요청 전송 /////////////////////////////////////////////////

    $pay_data = array(
        "PCD_CST_ID" => (string)$cst_id,
        "PCD_CUST_KEY" => (string)$custKey,
        "PCD_AUTH_KEY" => (string)$AuthKey,
        "PCD_REFUND_KEY" => $PCD_REFUND_KEY,
        "PCD_PAYCANCEL_FLAG" => "Y",
        "PCD_PAY_OID" => $PCD_PAY_OID,
        "PCD_PAY_DATE" => $PCD_PAY_DATE,
        "PCD_REFUND_TOTAL" => $PCD_REFUND_TOTAL,
        "PCD_PAYER_EMAIL" => $PCD_PAYER_EMAIL,
        "PCD_REGULER_FLAG" => $PCD_REGULER_FLAG,
        "PCD_PAY_YEAR" => $PCD_PAY_YEAR,
        "PCD_PAY_MONTH" => $PCD_PAY_MONTH,
        "PCD_REFUND_TAXTOTAL" => $PCD_REFUND_TAXTOTAL,
    );

    $post_data = json_encode($pay_data);

    //////////////////// cURL Data Send ////////////////////
    $ch2 = curl_init($PayReqURL);
    curl_setopt($ch2, CURLOPT_POST, true);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, $CURLOPT_HTTPHEADER);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

    ob_start();
    $PayRes = curl_exec($ch2);
    $PayBuffer = ob_get_contents();
    ob_end_clean();
    ///////////////////////////////////////////////////////
    // 	print_r($PayBuffer);

    ///////////////////////////////////////////////// 환불(승인취소) 요청 전송 /////////////////////////////////////////////////
    // Converting To Object
    $PayResult = json_decode($PayRes, true);

    if (isset($PayResult['PCD_PAY_RST']) && $PayResult['PCD_PAY_RST'] != '') {
        $memo='';
        $pay_rst = $PayResult['PCD_PAY_RST'];                // success | error
        $pay_msg = $PayResult['PCD_PAY_MSG'];                // 환불성공 | 환불실패 | 가맹점 건당 한도 초과.., 가맹점 월 한도 초과.., 등록된 계좌정보를 찾을 수 없습니다..., 최초 결제자 입니다. 본인인증 후 이용하세요...
        $pay_oid = $PayResult['PCD_PAY_OID'];                    // 주문번호
        $pay_type = $PayResult['PCD_PAY_TYPE'];            // 결제방법 (transfer)
        $payer_id = $PayResult['PCD_PAYER_ID'];                // 결제자 PAYPLE USER ID
        $payer_no = $PayResult['PCD_PAYER_NO'];            // 결제자 고유번호 (가맹점 회원 회원번호)
        $reguler_flag = $PayResult['PCD_REGULER_FLAG'];        // 정기결제 Y|N
        $pay_year = $PayResult['PCD_PAY_YEAR'];                // [정기결제] 년도
        $pay_month = $PayResult['PCD_PAY_MONTH'];                // [정기결제] 월
        $pay_goods = $PayResult['PCD_PAY_GOODS'];                // 상품명
        $refund_total = $PayResult['PCD_REFUND_TOTAL'];        // 환불(승인취소)금액
        $refund_taxtotal = $PayResult['PCD_REFUND_TAXTOTAL']; // 환불(승인취소)부가세

        if($pay_oid !=='' && $pay_oid !==null ){
$memo .= '----------- 페이플 결과 -----------
결제결과:'.$pay_rst.'
결제메세지:'.$pay_msg.'
주문번호:'.$pay_oid.'
결제방법:'.$pay_type.'
결제자ID:'.$payer_id.'
결제자고유번호:'.$payer_no.'
정기결제:'.$reguler_flag.'
상품명:'.$pay_goods.'
환불(승인취소)금액:'.$refund_total.'
환불(승인취소)부가세:'.$refund_taxtotal.'
----------- TM 관리자 메모 -----------
결제정보,주문정보 자동 결제취소 처리
'. $_POST['memo'];

            $payment= Payment::whereOrderId($pay_oid)->first();
            if($payment){
                $reservation= HotelReservation::find($payment->reservation_id);
                if($reservation){

                    $confirmation = Confirmation::whereReservationId($reservation->id)
                        ->whereType('LivingInHotel')->whereStatus('1')
                        ->first();

                    if($pay_rst ==='success' && $pay_msg ==='환불성공') {
                        $formatter = new Formatter();

                        $reservation->order_status='0';
                        $reservation->save();

                        $payment->memo=$memo;
                        if($refund_total === $payment->total_price){
                            $payment->status='0';
                        }elseif($refund_total < $payment->total_price){
                            $payment->status='10';/*부분 취소*/
                        }
                        $payment->cancel_price = $refund_total;
                        $payment->save();

                        if($confirmation){
                            $confirmation->status = '0';
                            $confirmation->save();
                        }

                        $hotel_option = $reservation->hotel->options->where('disable', '=', 'N')->first();
                        $hotel_room = $reservation->room;

                        $template = Template::whereCatalog('주문 취소, 변경')->whereUse('1')->first();
                        $start_dt = Carbon::parse(($confirmation->start_dt ?? ($reservation->order_desired_dt)))->format('Y-m-d H:i:s');
                        $end_dt = Carbon::parse(($confirmation->start_dt ?? ($reservation->order_desired_dt)))->addDays($hotel_room->nights)->format('Y-m-d H:i:s');

                        $template_content = $formatter->templateFormat($template->template, [
                            '#{회원명}' => $payment->name ?? $reservation->order_name,
                            '#{호텔명}' => $hotel_option->title,
                            '#{룸타입}' => $confirmation->room_type ?? ($hotel_room->main_explanation ?? ($hotel_room->name ?? '사용객실')),
                            '#{입주확정일자}' => $formatter->carbonFormat($start_dt, 'Y년 m월 d일(요일)'),
                            '#{퇴실일자}' => $formatter->carbonFormat($end_dt, 'Y년 m월 d일(요일)'),
                            '#{취소/변경}' => '취소'
                        ]);

                        $data = [
                            'reserved_time' => '',/*예약시간*/
                            're_send' => 'Y',
                            'tel' => $formatter->hpFormat($reservation->order_hp),
                            'template_code' => $template->code,
                            'template' => $template_content
                        ];

                        $at = new AlertTalk($data);
                        $at->send();

                        AlertTalkList::create([
                            'template_id' => $template->id,
                            'reservation_id' => $reservation->id,
                            'payment_id' => $payment->id,
                            'confirmation_id' => $confirmation->id ?? 0,
                            'hotel_id' => $reservation->hotel->id,
                            'room_id' => $hotel_room->id,
                            'catalog' => $template->catalog,
                            'hp' => $formatter->hpFormat($reservation->order_hp),
                            'result' => 'success',
                            'template' => $template_content,
                            'send_at' => Carbon::now(),
                        ]);
                    }
                }
            }
        }

    } else {

        $pay_rst = "error";                                // success | error
        $pay_msg = "환불요청실패";                           // 환불요청실패 ..
        $pay_oid = $PCD_PAY_OID;                           // 주문번호
        $pay_type = "";                                    // 결제방법 (transfer|card)
        $payer_id = "";                                    // 결제자 PAYPLE USER ID
        $payer_no = "";                                    // 결제자 고유번호 (가맹점 회원 회원번호)
        $reguler_flag = "";                                // 정기결제 Y|N
        $pay_year = "";                                    // [정기결제] 년도
        $pay_month = "";                                   // [정기결제] 월
        $pay_goods = "";                                   // 상품명
        $refund_total = $PCD_REFUND_TOTAL;                 // 환불(승인취소)요청금액
        $refund_taxtotal = $PCD_REFUND_TAXTOTAL;           // 환불(승인취소)부가세

    }

//
    $DATA = array(
        "PCD_PAY_RST" => $pay_rst,
        "PCD_PAY_MSG" => $pay_msg,
        "PCD_PAY_OID" => $pay_oid,
        "PCD_PAY_TYPE" => $pay_type,
        "PCD_PAYER_NO" => $payer_no,
        "PCD_PAYER_ID" => $payer_id,
        "PCD_PAY_YEAR" => $pay_year,
        "PCD_PAY_MONTH" => $pay_month,
        "PCD_PAY_GOODS" => $pay_goods,
        "PCD_REGULER_FLAG" => $reguler_flag,
        "PCD_REFUND_TOTAL" => $refund_total,
        "PCD_REFUND_TAXTOTAL" => $refund_taxtotal
    );

    $JSON_DATA = json_encode($DATA, JSON_UNESCAPED_UNICODE);

    echo $JSON_DATA;

    exit;

} catch (Exception $e) {
    $errMsg = $e->getMessage();
    $message = ($errMsg != '') ? $errMsg : "!!!!!!!환불(승인취소)요청 에러!!!!!!!";
    $DATA = "{\"PCD_PAY_RST\":\"error\", \"PCD_PAY_MSG\":\"$message\"}";
    echo $DATA;
}
