<?php
abstract class User {
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($username, $email, $password, $id = null) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
    }

    abstract public function getRole();

    public function register() {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        
        try {
            $stmt = $db->prepare($sql);
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bindParam("ssss", $this->username, $this->email, $hashedPassword, $this->getRole());
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login() {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam("s", $this->email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result && password_verify($this->password, $result['password'])) {
                return $result;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
}
class Admin extends User {
    public function getRole() {
        return 'admin';
    }
    
    public function manageUsers($action, $userId = null, $userData = null) {
        $db = Database::getInstance()->getConnection();
        
        switch ($action) {
            case 'ban':
                $sql = "UPDATE users SET status = 'banned' WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("i", $userId);
                return $stmt->execute();
                
            case 'update':
                $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("ssi", $userData['username'], $userData['email'], $userId);
                return $stmt->execute();
        }
    }
    
    public function manageActivities($action, $activityData = null, $activityId = null) {
        $db = Database::getInstance()->getConnection();
        
        switch ($action) {
            case 'add':
                $sql = "INSERT INTO activities (title, description, price, date_start, date_end) VALUES (?, ?, ?, ?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("ssdss", 
                    $activityData['title'],
                    $activityData['description'],
                    $activityData['price'],
                    $activityData['date_start'],
                    $activityData['date_end']
                );
                return $stmt->execute();
                
            case 'delete':
                $sql = "DELETE FROM activities WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("i", $activityId);
                return $stmt->execute();
        }
    }
}
class Client extends User {
    public function getRole() {
        return 'client';
    }
    
    public function makeReservation($activityId, $date) {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO reservations (user_id, activity_id, date, status) VALUES (?, ?, ?, 'pending')";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam("iis", $this->id, $activityId, $date);
        return $stmt->execute();
    }
    
    public function viewActivities() {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM activities WHERE date_start >= CURRENT_DATE";
        
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}



?>