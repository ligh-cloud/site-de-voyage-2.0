<?php 
class Reservation {
    private $id;
    private $userId;
    private $activityId;
    private $date;
    private $status;
    
    public function __construct($userId, $activityId, $date) {
        $this->userId = $userId;
        $this->activityId = $activityId;
        $this->date = $date;
        $this->status = 'pending';
    }
    
    public function save() {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO reservations (user_id, activity_id, date, status) VALUES (?, ?, ?, ?)";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam("iiss", $this->userId, $this->activityId, $this->date, $this->status);
        return $stmt->execute();
    }
    
    public function updateStatus($newStatus) {
        $db = Database::getInstance()->getConnection();
        $sql = "UPDATE reservations SET status = ? WHERE id = ?";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam("si", $newStatus, $this->id);
        return $stmt->execute();
    }
}
?>