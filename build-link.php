<?php

if (empty($_SESSION['auth_state'])) {
  $_SESSION['auth_state'] = bin2hex(random_bytes(32));
}

$config = require 'config.php';
$client_id = $config['clientID'];
$authURL = "https://cloud.lightspeedapp.com/oauth/authorize.php?response_type=code&client_id={$client_id}&scope=employee:all";

$SquareClient_id = $config['SquareClientID'];
$SquareState= $_SESSION['auth_state'];
$SquareAuthURL = "https://connect.squareup.com/oauth2/authorize?client_id={$SquareClient_id}&scope=ORDERS_READ&session=false&state={$SquareState}";

$SumUpClient_id = $config['SumUpClientID'];
$SumUpAuthURL = "https://api.sumup.com/authorize?response_type=code&client_id={$SumUpClient_id}&redirect_uri=https://bizsight-oauth-test.azurewebsites.net &scope=transactions.history";

$ePOSNowClient_id = $config['ePOSNowClientID'];
$ePOSNowAuthURL = "https://cloud.lightspeedapp.com/oauth/authorize.php?response_type=code&client_id={$ePOSNowClient_id}&scope={$scope}";

$lsxClientID = $config['lsxClientID'];
$lsxAuthURL = "https://secure.vendhq.com/connect?response_type=code&client_id={$lsxClientID}&redirect_uri=https://bizsight-oauth-test.azurewebsites.net/lsxtemp-token.php&state=state";

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
elseif ($_POST['button'] == 'Lightspeed X'):
	header("location: {$lsxAuthURL}");
endif;
?>