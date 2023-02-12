<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$config = require 'config.php';
$tempToken = $_GET['code'];
$domainPrefix = $_GET['domain_prefix'];
$tokenURL = "https://{$domainPrefix}.vendhq.com/api/1.0/token";
$postFields = [
    'code' => $tempToken,
    'client_id' => $config['lsxClientID'],
    'client_secret' => $config['lsxClientSecret'],
    'grant_type' => 'authorization_code',
    'redirect_uri' => 'https://bizsight-oauth-test.azurewebsites.net/lsxtemp-token.php'
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

$refresh_token = $responseObj->refresh_token;
$tokenURL2 = "https://{$domainPrefix}.vendhq.com/api/1.0/token";
$postFields2 = [
    'refresh_token' => $refresh_token,
    'client_id' => $config['lsxClientID'],
    'client_secret' => $config['lsxClientSecret'],
    'grant_type' => 'refresh_token'
];

$curl2 = curl_init();
curl_setopt_array($curl2, array(
    CURLOPT_URL => $tokenURL2,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $postFields2
));

$response2 = curl_exec($curl2);
$responseObj2 = json_decode($response2);
$jsonString2 = json_encode($responseObj2, JSON_PRETTY_PRINT);
$err2 = curl_error($curl2);
print($response2);

curl_close($curl2);
?>