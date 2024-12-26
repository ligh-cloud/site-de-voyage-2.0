<?php
require_once "../model/utilisateurs.php";  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    $errors = [];
    
   
    if (empty($password) || empty($confirmPassword)) {
        $errors[] = "Both password fields are required";
    } elseif ($password !== $confirmPassword) {
        $errors[] = "The passwords don't match";
    }
    
  
    if (empty($nom) || empty($prenom)) {
        $errors[] = "Username is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
  
    if (empty($errors)) {
        try {
            
            $user = new Client($nom , $prenom, $email, $password);
            var_dump($user);
            if ($user->register()) {
                
            
                header("Location: ../view/login.php");
                exit;
            } else {
                echo "Registration failed. Please try again.";
            }
        } catch (Exception $e) {
            error_log("Registration error: " . $e->getMessage());
            echo "An error occurred during registration. Please try again later.";
        }
    } else {
        
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>