<?php

$config = require 'config.php';
$tokenURL = "https://cloud.lightspeedapp.com/oauth/access_token.php";
$tempToken = $_GET['code'];
$postFields = [
    'client_id' => $config['clientID'],
    'client_secret' => $config['clientSecret'],
    'code' => $tempToken,
    'grant_type' => 'authorization_code'
];

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $tokenURL,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $postFields
));

$response = curl_exec($curl);
$responseObj = json_decode($response);
$jsonString = json_encode($responseObj, JSON_PRETTY_PRINT);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    if (array_key_exists('access_token', $responseObj)) {
        echo "<h2>Access Token Returned</h2>";
    } else {
        echo "<h2>It looks like there was an error.</h2>";
    };
    echo "<pre>$jsonString</pre>";
}
?>

<?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    echo $url;  
  ?>   