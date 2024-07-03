<?php
class Event {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($userId, $eventName, $description, $eventDate, $location) {
        $sql = "INSERT INTO events (user_id, event_name, description, event_date, location) VALUES (:user_id, :event_name, :description, :event_date, :location)";
        $this->db->query($sql, ['user_id' => $userId, 'event_name' => $eventName, 'description' => $description, 'event_date' => $eventDate, 'location' => $location]);
    }

    public function getAllEvents($userId) {
        $sql = "SELECT * FROM events WHERE user_id = :user_id";
        $stmt = $this->db->query($sql, ['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEvent($eventId) {
        $sql = "SELECT * FROM events WHERE id = :id";
        $stmt = $this->db->query($sql, ['id' => $eventId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($eventId, $eventName, $description, $eventDate, $location) {
    if (empty($eventDate)) {
        throw new Exception('Event date cannot be empty.');
    }

    $sql = "UPDATE events SET event_name = :event_name, description = :description, event_date = :event_date, location = :location WHERE id = :id";
    $this->db->query($sql, ['id' => $eventId, 'event_name' => $eventName, 'description' => $description, 'event_date' => $eventDate, 'location' => $location]);
}


    public function delete($eventId) {
        $sql = "DELETE FROM events WHERE id = :id";
        $this->db->query($sql, ['id' => $eventId]);
    }
}
?>
