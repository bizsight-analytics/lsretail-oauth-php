<?php

$config = require 'config.php';
$client_id = $config['clientID'];
$scope = $_POST['scope'];
$authURL = "https://cloud.lightspeedapp.com/oauth/authorize.php?response_type=code&client_id={$client_id}&scope={$scope}";

$SquareClient_id = $config['SquareClientID'];
$SquareAuthURL = "https://cloud.lightspeedapp.com/oauth/authorize.php?response_type=code&client_id={$SquareClient_id}&scope={$scope}";

$SumUpClient_id = $config['SumUpClientID'];
$SumUpAuthURL = "https://cloud.lightspeedapp.com/oauth/authorize.php?response_type=code&client_id={$SumUpClient_id}&scope={$scope}";

$ePOSNowClient_id = $config['ePOSNowClientID'];
$ePOSNowAuthURL = "https://cloud.lightspeedapp.com/oauth/authorize.php?response_type=code&client_id={$ePOSNowClient_id}&scope={$scope}";

if ($_POST['button'] == 'generate'):

?>

<!DOCTYPE html>
<html>
<head>
	<title>Lightspeed Retail OAuth Connector</title>
</head>
<body>
	<h1>Authorization Endpoint URL Generated</h1>
	<p><a href="<?= $authURL; ?>"><?= $authURL; ?></a></p>
</body>
</html>

<?php

elseif ($_POST['button'] == 'Lightspeed'):
	header("location: {$authURL}");
elseif ($_POST['button'] == 'Square'):
	header("location: {$SquareAuthURL}");
elseif ($_POST['button'] == 'SumUp'):
	header("location: {$SumUpAuthURL}");
elseif ($_POST['button'] == 'ePOS Now'):
	header("location: {$ePOSNowAuthURL}");
endif;

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