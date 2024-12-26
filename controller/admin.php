<?php

require_once "../model/utilisateurs.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}


$admin = new Admin(
    $_SESSION['user']['nom'],
    $_SESSION['user']['prenom'],
    $_SESSION['user']['email'],
    ''
);


$activities = $admin->manageActivities('view_all');
$users = $admin->getAllUsers();
$reservations = $admin->getAllReservations();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    echo "";
    switch ($action) {
        case 'add_activity':
            $activityData = [
                'titre' => trim($_POST['titre'] ?? ''),
                'vols' => trim($_POST['vols'] ?? ''),
                'hotels' => trim($_POST['hotels'] ?? ''),
                'circuits_touristiques' => trim($_POST['circuits_touristiques'] ?? ''),
                'prix' => trim($_POST['prix'] ?? ''),
                'date_debut' => trim($_POST['date_debut'] ?? ''),
                'date_fin' => trim($_POST['date_fin'] ?? ''),
            ];
            
          
            foreach ($activityData as $key => $value) {
                if (empty($value)) {
                    $_SESSION['error'] = "All fields are required. Missing: $key";
                    header("Location: admin_dashboard.php");
                    exit;
                }
            }
            
           
            if (!is_numeric($activityData['prix']) || $activityData['prix'] <= 0) {
                $_SESSION['error'] = "Price must be a positive number";
                header("Location: admin_dashboard.php");
                exit;
            }
            
            if (strtotime($activityData['date_fin']) <= strtotime($activityData['date_debut'])) {
                $_SESSION['error'] = "End date must be after start date";
                header("Location: admin_dashboard.php");
                exit;
            }
            
            $result = $admin->manageActivities('add', $activityData);
            $_SESSION[($result ? 'success' : 'error')] = $result ? "Activity added successfully!" : "Failed to add activity";
            break;
            
        case 'update_user':
            if (!isset($_POST['user_id']) || !is_numeric($_POST['user_id'])) {
                $_SESSION['error'] = "Invalid user ID";
                break;
            }
            
            $userData = [
                'nom' => trim($_POST['nom'] ?? ''),
                'prenom' => trim($_POST['prenom'] ?? ''),
                'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL)
            ];
            
            if (!$userData['email']) {
                $_SESSION['error'] = "Invalid email format";
                break;
            }
            
            $result = $admin->manageUsers('update', $_POST['user_id'], $userData);
            $_SESSION[($result ? 'success' : 'error')] = $result ? "User updated successfully!" : "Failed to update user";
            break;
            
        case 'ban_user':
            if (!isset($_POST['user_id']) || !is_numeric($_POST['user_id'])) {
                $_SESSION['error'] = "Invalid user ID";
                break;
            }
            
            $result = $admin->manageUsers('ban', $_POST['user_id']);
            $_SESSION[($result ? 'success' : 'error')] = $result ? "User banned successfully!" : "Failed to ban user";
            break;
            
        // case 'approve_reservation':
        // case 'reject_reservation':
        //     if (!isset($_POST['reservation_id']) || !is_numeric($_POST['reservation_id'])) {
        //         $_SESSION['error'] = "Invalid reservation ID";
        //         break;
        //     }
            
        //     $status = ($action === 'approve_reservation') ? 'approved' : 'rejected';
        //     $result = $admin->updateReservationStatus($_POST['reservation_id'], $status);
        //     $_SESSION[($result ? 'success' : 'error')] = $result ? "Reservation {$status} successfully!" : "Failed to update reservation";
        //     break;
    }
    

    exit;
}