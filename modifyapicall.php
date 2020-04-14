<?php
$dataJson = $_POST['data'];
$dataArray = json_decode($dataJson,true);

$clientid = $dataArray["clientid"]; // Access Array data
$passphrase = $dataArray["passphrase"]; // Access Array data
$text = $dataArray["text"];

$url = "https://woop.la/mywoopla/call-control/api/modParam.aspx";
//https://woop.la/mywoopla/call-control/api/modParam.aspx?clientid=DEL003&passphrase=fg2.epw74n89kp&pname=ROUTING002&pvalue=3;12;9;13;2;9198333313437-919820871233

// Initializes a new cURL session
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        
$i = 1;
$finalres = [];
$param = "clientid=".$clientid."&passphrase=".$passphrase;
foreach ($text as $t){ 
        if(!empty($t)) {
                $array = explode(" ",$t);
                $route = $array[0];
                $str = $param."&pname=".$route."&pvalue="; //Make the string 3 characters
                $str = $str.$array[1];
                curl_setopt($curl, CURLOPT_POSTFIELDS, $str); 
                $response[$i] = curl_exec($curl);
                if($errno = curl_errno($curl)) {
                        $error_message = curl_strerror($errno);
                        $response[$i] = $error_message;
                }
                $finalres[$i] = $route." ".$response[$i];
        }
        $i++;
}
print_r(json_encode($finalres));
curl_close($curl);
?>
