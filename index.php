<?php
require 'bootstrap.php';
use App\Library\FacebookAuth;

$auth = new FacebookAuth;
$helper = $auth->getRedirectLoginHelper();
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl($auth->getCustomLoginUrl(), $permissions); // get url for facebook login callback
echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
