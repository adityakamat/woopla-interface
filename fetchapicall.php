<?php

$dataJson = $_POST['data'];
$dataArray = json_decode($dataJson,true);

$clientid = $dataArray["clientid"]; // Access Array data
$passphrase = $dataArray["passphrase"]; // Access Array data
$inputNumberofRecords = $dataArray["inputNumberofRecords"]; // Access Array data
$inputAdditionalParameters = $dataArray["inputAdditionalParameters"]; // Access Array data

$url = "https://woop.la/mywoopla/call-control/api/getParam.aspx";

// Initializes a new cURL session
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        
$i = 1;
$finalres = [];
$param = "clientid=".$clientid."&passphrase=".$passphrase;
while($i <= $inputNumberofRecords){   
        $route = "ROUTING".substr("0000{$i}", -3);
        $str = $param."&pname=".$route; //Make the string 3 characters
        curl_setopt($curl, CURLOPT_POSTFIELDS, $str); 
        $response[$i] = curl_exec($curl);
        if($errno = curl_errno($curl)) {
                $error_message = curl_strerror($errno);
                $response[$i] = $error_message;
        }
        $finalres[$i] = $route." ".substr($response[$i],7);
        $i++;
}
foreach ($inputAdditionalParameters as $p){ 
        if(!empty($p)) {
                $str = $param."&pname=".$p; //Make the string 3 characters
                curl_setopt($curl, CURLOPT_POSTFIELDS, $str); 
                $response[$i] = curl_exec($curl);
                if($errno = curl_errno($curl)) {
                        $error_message = curl_strerror($errno);
                        $response[$i] = $error_message;
                }
                $finalres[$i] = $p." ".substr($response[$i],7);
        }
        $i++;
}


print_r(json_encode($finalres));
curl_close($curl);
?>
