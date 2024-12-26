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
            echo "Login successful";
        } else {
            echo "Invalid email or password";
            var_dump($user) ;
        }
    } else {
      
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>
