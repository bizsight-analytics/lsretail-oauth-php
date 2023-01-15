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
print($refresh_token);
?>