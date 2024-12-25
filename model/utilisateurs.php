<?php
abstract class utilisateurs {
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $id;
    
    public function __construct($nom, $prenom, $email, $password, $id = null) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
    }
    
    public function connect_db() {
        $host = 'localhost';
        $dbname = 'travel';
        $username = 'root';
        $password = '';
        $charset = 'utf8mb4';
        
        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
            exit;
        }
    }
    
    abstract public function getRole();
}

class Admin extends utilisateurs {
    public function getRole() {
        return 'admin';
    }
    
    public function addActivity($titre, $vols, $hotels, $circuits_touristiques, $prix, $date_debut, $date_fin) {
        try {
            $pdo = $this->connect_db();
            $sql = "INSERT INTO activite (titre, vols, hotels, circuits_touristiques, prix, date_debut, date_fin)
                    VALUES (:titre, :vols, :hotels, :circuits_touristiques, :prix, :date_debut, :date_fin)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titre' => $titre,
                ':vols' => $vols,
                ':hotels' => $hotels,
                ':circuits_touristiques' => $circuits_touristiques,
                ':prix' => $prix,
                ':date_debut' => $date_debut,
                ':date_fin' => $date_fin,
            ]);
            echo "Activity added successfully!";
        } catch (PDOException $e) {
            echo "Failed to add activity: " . $e->getMessage();
        }
    }
    
 
    public function modifyUser($userId, $nom, $prenom, $email, $password = null) {
        try {
            $pdo = $this->connect_db();
            
           
            if ($password) {
                $sql = "UPDATE utilisateurs SET 
                        nom = :nom,
                        prenom = :prenom,
                        email = :email,
                        password = :password
                        WHERE id = :id";
                $params = [
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':email' => $email,
                    ':password' => password_hash($password, PASSWORD_DEFAULT),
                    ':id' => $userId
                ];
            } else {
            
                $sql = "UPDATE utilisateurs SET 
                        nom = :nom,
                        prenom = :prenom,
                        email = :email
                        WHERE id = :id";
                $params = [
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':email' => $email,
                    ':id' => $userId
                ];
            }
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            if ($stmt->rowCount() > 0) {
                return "User updated successfully!";
            } else {
                return "No user found with ID: $userId";
            }
        } catch (PDOException $e) {
            return "Failed to update user: " . $e->getMessage();
        }
    }
    

    public function deleteUser($userId) {
        try {
            $pdo = $this->connect_db();
            

            $checkSql = "SELECT role FROM utilisateurs WHERE id = :id";
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute([':id' => $userId]);
            $user = $checkStmt->fetch();
            
            if (!$user) {
                return "No user found with ID: $userId";
            }
            
            if ($user['role'] === 'admin') {
                return "Cannot delete admin users";
            }
            
       
            $sql = "DELETE FROM utilisateurs WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $userId]);
            
            if ($stmt->rowCount() > 0) {
                return "User deleted successfully!";
            } else {
                return "Failed to delete user";
            }
        } catch (PDOException $e) {
            return "Failed to delete user: " . $e->getMessage();
        }
    }
    
  
    public function viewAllUsers() {
        try {
            $pdo = $this->connect_db();
            $sql = "SELECT id, nom, prenom, email, role FROM utilisateurs";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return "Failed to fetch users: " . $e->getMessage();
        }
    }
}

class User extends utilisateurs {
    public function getRole() {
        return 'user';
    }

    public function addUser($username, $password, $email) {
        try {
            $pdo = $this->connect_db();
            $sql = "INSERT INTO utilisateurs (username, password, email, role) VALUES (:username, :password, :email, 'user')";
            $stmt = $pdo->prepare($sql);
            
         
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            
        
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':email', $email);
            
            $stmt->execute();
            
            echo "User added successfully!";
        } catch (PDOException $e) {
            echo "Failed to add user: " . $e->getMessage();
        }
    }
}

?>