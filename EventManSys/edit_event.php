<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php';
require 'classes/Session.php';
require 'classes/Database.php';
require 'classes/Event.php';

$event = new Event();
$eventId = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventData = $event->getEvent($eventId);
    if (!$eventData) {
        die("Event not found.");
    }

    $eventDate = $_POST['event_date'] ?? $eventData['event_date'];

    try {
        $event->update($eventId, $_POST['event_name'], $_POST['description'], $eventDate, $_POST['location']);
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$eventData = $event->getEvent($eventId);
if (!$eventData) {
    die("Event not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">YOUR Event</h1>
        <form action="edit_event.php?id=<?php echo $eventId; ?>" method="post" class="mt-4">
            <div class="form-group">
                <label for="event_date">Event</label>
                <input type="text" name="event_name" class="form-control" placeholder="Event Name" value="<?php echo htmlspecialchars($eventData['event_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="event_date">Description</label>
                <textarea name="description" class="form-control" placeholder="Description"><?php echo htmlspecialchars($eventData['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="datetime-local" name="event_date" class="form-control" value="<?php echo !empty($eventData['event_date']) ? date('Y-m-d\TH:i', strtotime($eventData['event_date'])) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="event_date">Location</label>
                <input type="text" name="location" class="form-control" placeholder="Location" value="<?php echo htmlspecialchars($eventData['location']); ?>">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Event</button>
        </form>
        <div class="text-center mt-3">
            <a href="index.php">Back</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
