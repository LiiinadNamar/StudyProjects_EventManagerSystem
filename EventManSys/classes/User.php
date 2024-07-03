<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function usernameExists($username) {
        $stmt = $this->db->query('SELECT id FROM users WHERE username = :username', ['username' => $username]);
        return $stmt->fetchColumn() !== false;
    }

    public function isPasswordValid($password) {
        return strlen($password) >= 6 &&
               preg_match('/[a-z]/', $password) &&
               preg_match('/[A-Z]/', $password) &&
               preg_match('/[0-9]/', $password);
    }

    public function register($username, $password, $email) {
        if ($this->usernameExists($username)) {
            return ['success' => false, 'message' => 'Nickname already used'];
        }

        if (!$this->isPasswordValid($password)) {
            return ['success' => false, 'message' => 'Password must be at least 6 characters long and contain both uppercase and lowercase letters, and numbers.'];
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $this->db->query($sql, ['username' => $username, 'password' => $hashedPassword, 'email' => $email]);
        return ['success' => true];
    }

    public function login($username, $password) {
        $stmt = $this->db->query("SELECT * FROM users WHERE username = :username", ['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            Session::start($user['id']);
            return true;
        }
        return false;
    }

    public function isLoggedIn() {
        return Session::get('user_id') !== null;
    }
}
?>
