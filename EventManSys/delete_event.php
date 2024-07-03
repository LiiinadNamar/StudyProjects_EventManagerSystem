<?php

require 'config.php';
require 'classes/Database.php';
require 'classes/Event.php';

$event = new Event();
$eventId = $_GET['id'];

$event->delete($eventId);
header('Location: index.php');
exit;
?>
