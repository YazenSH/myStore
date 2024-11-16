<?php
session_start();
include '../db/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    // Validate email
    $email = strtolower(trim($_POST['email']));
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate password
    $password = $_POST['password'];
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($errors)) {
        $hashed_password = md5($password);
        
        try {
            $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $hashed_password);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                $_SESSION['user_id'] = $user['user_ID'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['is_admin'] = $user['isAdmin'];
                
                if ($user['isAdmin']) {
                    header("Location: ../pages/admin.php");
                } else {
                    header("Location: ../index.php");
                }
                exit();
            } else {
                echo "<script>
                        alert('Invalid email or password');
                        window.history.back();
                      </script>";
            }
        } catch (Exception $e) {
            echo "<script>
                    alert('Error occurred. Please try again.');
                    window.history.back();
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('" . implode("\\n", $errors) . "'); window.history.back();</script>";
    }
}
$conn->close();
?>