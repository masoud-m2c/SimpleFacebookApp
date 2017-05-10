<?php
require 'bootstrap.php';
use App\Library\FacebookAuth;

if(!empty($input->post('signed_request'))) {
	$auth = new FacebookAuth;
	$user = $auth->parseSignedRequest( $input->post('signed_request') );

	// update status (is_active) field
	$entityManager->getRepository('User')->deauthUser($user['user_id']);
} else {
	// Bad Request
	header('HTTP/1.0 400 Bad Request');
	echo 'Error: Bad request';
}
exit;
