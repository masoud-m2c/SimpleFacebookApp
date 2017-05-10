<?php
require 'bootstrap.php';

// Remove access token from session
unset($_SESSION['facebook_access_token']);

// Redirect to the index
header("Location:index.php");
