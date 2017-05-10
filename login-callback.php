<?php
require 'bootstrap.php';
use App\Library\FacebookAuth;

$auth = new FacebookAuth;
$helper = $auth->getRedirectLoginHelper();
$accessToken = $auth->getAccessToken();

if (isset($accessToken)) {
	// Logged in
	header('location:dashboard.php');
} else {
	if ($helper->getError()) {
		// The user denied the request
		header('HTTP/1.0 401 Unauthorized');
		echo "Error: " . $helper->getError() . "<br/>";
		echo "Error Code: " . $helper->getErrorCode() . "<br/>";
		echo "Error Reason: " . $helper->getErrorReason() . "<br/>";
		echo "Error Description: " . $helper->getErrorDescription() . "<br/>";
	} else {
		// Bad Request
		header('HTTP/1.0 400 Bad Request');
		echo 'Error: Bad request';
	}
	exit;
}
