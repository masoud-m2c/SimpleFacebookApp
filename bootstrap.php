<?php
require_once "vendor/autoload.php";

// set the default timezone 
date_default_timezone_set('Asia/Kuala_Lumpur');

// start session to keep facebook_access_token
if (!session_id()) {
    session_start();
}
