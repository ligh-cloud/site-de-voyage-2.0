<?php

require_once "../model/utilisateurs.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}




if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../view/login.php");
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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        switch ($action) {
            case 'add_activity':

                $activityData = [
                    'titre' => $_POST['titre'] ?? '',
                    'vols' => $_POST['vols'] ?? '',
                    'hotels' => $_POST['hotels'] ?? '',
                    'circuits_touristiques' => $_POST['circuits_touristiques'] ?? '',
                    'prix' => $_POST['prix'] ?? '',
                    'date_debut' => $_POST['date_debut'] ?? '',
                    'date_fin' => $_POST['date_fin'] ?? '',
                ];

                foreach ($activityData as $key => $value) {
                    if (empty($value)) {
                        $_SESSION['error'] = "All fields are required. Missing: $key";

                        exit;
                    }
                }

                $result = $admin->manageActivities('add', $activityData);
                if ($result) {
                    $_SESSION['success'] = "Activity added successfully!";
                    echo "Activity added successfully";
                } else {
                    $_SESSION['error'] = "Failed to add activity. Please try again.";
                    echo "Failed to add activity. Please try again";
                }

                exit;


                break;

            case 'update_activity':
                $activityId = $_POST['activity_id'] ?? null;
                if (!$activityId) {
                    $_SESSION['error'] = "Activity ID is required";
                    header("Location: admin_dashboard.php");
                    exit;
                }

                $activityData = [
                    'titre' => $_POST['titre'] ?? '',
                    'vols' => $_POST['vols'] ?? '',
                    'hotels' => $_POST['hotels'] ?? '',
                    'circuits_touristiques' => $_POST['circuits_touristiques'] ?? '',
                    'prix' => $_POST['prix'] ?? '',
                    'date_debut' => $_POST['date_debut'] ?? '',
                    'date_fin' => $_POST['date_fin'] ?? '',
                ];

                foreach ($activityData as $key => $value) {
                    if (empty($value)) {
                        $_SESSION['error'] = "All fields are required. Missing: $key";
                        header("Location: admin_dashboard.php");
                        exit;
                    }
                }

                $result = $admin->manageActivities('update', $activityData, $activityId);
                if ($result) {
                    $_SESSION['success'] = "Activity updated successfully!";
                } else {
                    $_SESSION['error'] = "Failed to update activity. Please try again.";
                }
                header("Location: admin_dashboard.php");
                exit;

            case 'delete_activity':
                $activityId = $_POST['activity_id'] ?? null;
                if (!$activityId) {
                    $_SESSION['error'] = "Activity ID is required";
                    header("Location: admin_dashboard.php");
                    exit;
                }

                $result = $admin->manageActivities('delete', null, $activityId);
                if ($result) {
                    $_SESSION['success'] = "Activity deleted successfully!";
                } else {
                    $_SESSION['error'] = "Failed to delete activity. Please try again.";
                }
                header("Location: admin_dashboard.php");
                exit;
                case 'delete_user':
                    $userId = $_POST['user_id'] ?? null;
                    if (!$userId) {
                        $_SESSION['error'] = "User ID is required";
                        header("Location: ../view/admin_dashboard.php");
                        exit;
                    }
                    $result = $admin->manageUsers('delete', $userId);
                    if ($result) {
                        $_SESSION['success'] = "User deleted successfully!";
                    } else {
                        $_SESSION['error'] = "Failed to delete user. Please try again.";
                    }
                    header("Location: ../view/admin_dashboard.php");
                    exit;
                    case 'add_admin':
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
                            $errors[] = "First name and last name are required";
                        }
            
                       
                        if (empty($email)) {
                            $errors[] = "Email is required";
                        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $errors[] = "Invalid email format";
                        }
            
                       
                        if (empty($errors)) {
                            try {
                               
                                $newAdmin = new Admin($nom, $prenom, $email, $password);
                                
                                if ($newAdmin->register()) {
                                    $_SESSION['success'] = "New admin added successfully!";
                                } else {
                                    $_SESSION['error'] = "Failed to add new admin. Please try again.";
                                }
                            } catch (Exception $e) {
                                error_log("Registration error: " . $e->getMessage());
                                $_SESSION['error'] = "An error occurred during registration. Please try again later.";
                            }
                        } else {
                          
                            $_SESSION['error'] = implode("<br>", $errors);
                        }
            
                        header("Location: ../view/admin_dashboard.php");
                        exit;
            case 'approve_reservation':
            case 'reject_reservation':
                $reservationId = $_POST['reservation_id'] ?? null;
                if (!$reservationId) {
                    $_SESSION['error'] = "Reservation ID is required";
                    header("Location: admin_dashboard.php");
                    exit;
                }
                $status = ($action === 'approve_reservation') ? 'confirmer' : 'annuler';
                $result = $admin->updateReservationStatus($reservationId, $status);
                if ($result) {
                    $_SESSION['success'] = "Reservation $status successfully!";
                } else {
                    $_SESSION['error'] = "Failed to update reservation";
                }
                header("Location: admin_dashboard.php");
                exit;
        }
    }
}

