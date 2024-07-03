<?php

//require 'config.php';
//require 'classes/User.php';
require 'classes/Session.php';
//require 'classes/Database.php';

Session::destroy();
header('Location: login.php');
exit;
?>

