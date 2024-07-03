<?php
class Session {
    public static function start($userId) {
        session_start();
        $_SESSION['user_id'] = $userId;
    }

    public static function destroy() {
        session_start();
        session_destroy();
    }

    public static function get($key) {
        session_start();
        return $_SESSION[$key] ?? null;
    }

    public static function set($key, $value) {
        session_start();
        $_SESSION[$key] = $value;
    }
}
?>
