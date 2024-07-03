<?php

require 'config.php';
require 'classes/Session.php';
require 'classes/User.php';
require 'classes/Event.php';
require 'classes/Database.php';

$user = new User();
if (!$user->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$event = new Event();
$events = $event->getAllEvents(Session::get('user_id'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manager</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Manage your events</h1>
        <div class="text-right mb-3">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

         <h2>Create Event</h2>
        <form action="create_event.php" method="post">
            <div class="form-group">
                <input type="text" name="event_name" class="form-control" placeholder="Event Name" required>
            </div>
            <div class="form-group">
                <textarea name="description" class="form-control" placeholder="Description"></textarea>
            </div>
            <div class="form-group">
                <input type="datetime-local" name="event_date" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" name="location" class="form-control" placeholder="Location">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Create Event</button>
        </form>
        
        <h2>Your Events</h2>
        <ul class="list-group mb-4">
            <?php foreach ($events as $evt) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo htmlspecialchars($evt['event_name']); ?>
                    <span>
                        <a href="edit_event.php?id=<?php echo $evt['id']; ?>" class="btn btn-info btn-sm">View/Edit</a>
                        <a href="delete_event.php?id=<?php echo $evt['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
