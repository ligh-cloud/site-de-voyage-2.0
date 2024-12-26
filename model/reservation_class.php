<?php 
class Activity {
    private $id;
    private $title;
    private $description;
    private $price;
    
    public function __construct($title, $description, $price, $id = null) {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->id = $id;
    }
    
    public function save() {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO activities (title, description, price) VALUES (?, ?, ?)";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam("ssd", $this->title, $this->description, $this->price);
        return $stmt->execute();
    }
}


?>