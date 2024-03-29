<?php
/*
* TEST : https://testcpay.payple.kr/php/auth.php
* REAL : https://cpay.payple.kr/php/auth.php
*/
header("Expires: Mon 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d, M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0; pre-check=0", false);
header("Pragma: no-cache");
header("Content-type: application/json; charset=utf-8");

//AWS 이용 가맹점인 경우 REFERER 에 도메인을 넣어주세요.
$CURLOPT_HTTPHEADER = array(
    "referer: http://".$_SERVER['HTTP_HOST']
);

// 발급받은 비밀키. 유출에 주의하시기 바랍니다.
$post_data = array (
    "cst_id" => "tmaker",
    "custKey" => "3e47b1ea5bbbde2eb3f2e3cd95396b3d49197de139a003b52e418a29fb766f52"
);

$ch = curl_init('https://cpay.payple.kr/php/auth.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSLVERSION, 4);
curl_setopt($ch, CURLOPT_HTTPHEADER, $CURLOPT_HTTPHEADER);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

ob_start();
$response = curl_exec ($ch);
$buffer = ob_get_contents();
ob_end_clean();

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close ($ch);
if($status_code == 200) {
    echo $buffer;
}
