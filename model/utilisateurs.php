<?php
require_once "db_connect.php";

abstract class User {
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($nom, $prenom, $email, $password) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $this->getRole();
    }

    abstract public function getRole();

    public function register() {
        $db = Database::getInstance()->getConnection();
        
     
        $db->beginTransaction();
        
        try {
    
            $sql = "INSERT INTO utilisateurs (nom, prenom, email, password) VALUES (?, ?, ?, ?)";
            
            $stmt = $db->prepare($sql);
            $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
            
            $stmt->bindParam(1, $this->nom, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->prenom, PDO::PARAM_STR);
            $stmt->bindParam(3, $this->email, PDO::PARAM_STR);
            $stmt->bindParam(4, $hashedPassword, PDO::PARAM_STR);
            
            $success = $stmt->execute();
            
            if ($success) {
                $userId = $db->lastInsertId();
                
              
                $roleSql = "INSERT INTO roles (id_client, role) VALUES (?, ?)";
                $roleStmt = $db->prepare($roleSql);
                $roleValue = ($this->role == 'admin') ? 'admin' : 'user';
                
                $roleStmt->bindParam(1, $userId, PDO::PARAM_INT);
                $roleStmt->bindParam(2, $roleValue, PDO::PARAM_STR);
                
                if ($roleStmt->execute()) {
                    $db->commit();
                    $this->id = $userId;
                    return true;
                }
            }
            
            $db->rollBack();
            return false;
            
        } catch (PDOException $e) {
            $db->rollBack();
            error_log("Registration error: " . $e->getMessage());
            return false;
        }
    }

    public function login() {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $this->email, PDO::PARAM_STR);
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
        
        try {
            switch ($action) {
                case 'ban':
                    // You might want to add a 'status' column to utilisateurs table
                    // or handle banning differently
                    return false;
                    
                case 'update':
                    $sql = "UPDATE utilisateurs SET nom = ?, prenom = ?, email = ? WHERE id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(1, $userData['nom'], PDO::PARAM_STR);
                    $stmt->bindParam(2, $userData['prenom'], PDO::PARAM_STR);
                    $stmt->bindParam(3, $userData['email'], PDO::PARAM_STR);
                    $stmt->bindParam(4, $userId, PDO::PARAM_INT);
                    return $stmt->execute();
                
                default:
                    return false;
            }
        } catch (PDOException $e) {
            error_log("Manage users error: " . $e->getMessage());
            return false;
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
                    $activityData['date_debut'],
                    $activityData['date_fin']
                );
                return $stmt->execute();
            }
        try {
            switch ($action) {
                case 'add':
                    $sql = "INSERT INTO activite (titre, vols, hotels, circuits_touristiques, prix, date_debut, date_fin) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(1, $activityData['titre'], PDO::PARAM_STR);
                    $stmt->bindParam(2, $activityData['vols'], PDO::PARAM_STR);
                    $stmt->bindParam(3, $activityData['hotels'], PDO::PARAM_STR);
                    $stmt->bindParam(4, $activityData['circuits_touristiques'], PDO::PARAM_STR);
                    $stmt->bindParam(5, $activityData['prix'], PDO::PARAM_STR);
                    $stmt->bindParam(6, $activityData['date_debut'], PDO::PARAM_STR);
                    $stmt->bindParam(7, $activityData['date_fin'], PDO::PARAM_STR);
                    return $stmt->execute();
                    
                case 'delete':
                    $sql = "DELETE FROM activite WHERE id_activite = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(1, $activityId, PDO::PARAM_INT);
                    return $stmt->execute();

                
                default:
                    return false;
            }
        } catch (PDOException $e) {
            error_log("Manage activities error: " . $e->getMessage());
            return false;
        }
    }
}

class Client extends User {
    public function getRole() {
        return 'user';  
    }
    
    public function makeReservation($activityId, $date) {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO reservation (id_client, id_activite, status) VALUES (?, ?, 'en attente')";
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
            $stmt->bindParam(2, $activityId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Make reservation error: " . $e->getMessage());
            return false;
        }
    }
    
    public function viewActivities() {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM activite WHERE date_debut >= CURRENT_DATE";
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            error_log("View activities error: " . $e->getMessage());
            return false;
        }
    }

}

    


?>



