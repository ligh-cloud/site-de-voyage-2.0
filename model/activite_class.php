<?php 
class Activity {
    private $id;
    private $title;
    private $description;
    private $price;
    private $endDate;
    private $startDate;
    
    public function __construct($title, $description, $price,$startDate,$endDate, $id = null) {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->id = $id;
    }
    
    public function save() {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO activities (title, description, price, start_date, end_date) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam("ssd", $this->title, $this->description, $this->price);
        return $stmt->execute();
    }

public function update() {
    $db = Database::getInstance()->getConnection();
    $sql = "UPDATE activities SET title = ?, description = ?, price = ?, start_date = ?, end_date = ? WHERE id = ?";

    $stmt = $db->prepare($sql);
    $stmt->bindParam("ssdssi", $this->title, $this->description, $this->price, $this->startDate, $this->endDate, $this->id);
    return $stmt->execute();
}
public function delete() {
    $db = Database::getInstance()->getConnection();
    $sql = "DELETE FROM activities WHERE id = ?";
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam("i", $this->id);
    return $stmt->execute();
}
}



?>
