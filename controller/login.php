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

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if(empty($errors)){
        $hash_pass = password_hash($password ,PASSWORD_BCRYPT );
    $user = new Client("" , "" , $email , $hash_pass);
    if($user->login()){
        echo "connexion good";
    }
}
}
?>