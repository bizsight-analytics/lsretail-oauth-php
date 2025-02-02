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

$convertToArrayObject = json_decode($response,true);
$key="access_token";
$access_token = $convertToArrayObject[$key];

curl_close($curl);

?>
<html>
<head>
	<title>Bizsight OAuth</title>
</head>
    <body>
<h1>BIZSIGHT</h1>
	<div class="box">
	<p id="desc">The access token currently in your Azure data factory needs to be updated with the following: Bearer
        
    <?php echo "$access_token" ?>
        
    . All API calls need to be triggered within 30 minutes before the token expires. <?php echo "$access_token" ?> </p>
    </div>
<style>
    h1 {color:White; text-align: center; background-color:black; height:80px; font-size: 60px;}
	.box {border:2px solid rgb(83, 154, 83); width:500px; margin:auto; border-radius: 10px; text-align: center; padding-top:10px; padding-bottom: 10px; padding-left: 30px; padding-right: 30px;}
	.box p {color:white; font-size:18px; text-align:center}
	body {background-color: rgb(27, 27, 27);}
</style>
</body>
</html>