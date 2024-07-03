<?php

require 'config.php';
require 'classes/Session.php';
require 'classes/Database.php';
require 'classes/Event.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event = new Event();
    $event->create(Session::get('user_id'), $_POST['event_name'], $_POST['description'], $_POST['event_date'], $_POST['location']);
    header('Location: index.php');
    exit;
}
?>

