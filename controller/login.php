<?php
require_once "../model/utilisateurs.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $errors = [];

    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }


    if (empty($password)) {
        $errors[] = "Password is required";
    }

   
    if (empty($errors)) {
        $user = new Client("", "", $email, $password);

        
        if ($user->login()) {
           
            if ($user->getRole() === 'admin') {
                header("location: ../view/admin_dashboard.php");
                exit();
            } else {
                header("location: ../view/user_dashboard.php");
                exit();
            }
        } else {
            echo "Invalid email or password";
        }
    } else {
        
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>