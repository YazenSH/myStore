<?php
include '../db/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();
    
    // Validate name (not empty)
    if (empty(trim($_POST['name'])) || strlen(trim($_POST['name'])) < 3) {
        $errors[] = "Name is required.";
    }

    // Validate email
    if (empty(trim($_POST['email']))) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    } else {
        // Check if email already exists in feedback table
        $email = $_POST['email'];
        $check_email = "SELECT email FROM feedback WHERE email = ?";
        $stmt = $conn->prepare($check_email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errors[] = "You have already submitted feedback with this email.";
        }
        $stmt->close();
    }

    // Validate phone (10 digits)
    if (empty(trim($_POST['phone']))) {
        $errors[] = "Phone number is required.";
    } elseif (!preg_match("/^\d{10}$/", $_POST['phone'])) {
        $errors[] = "Phone number must be 10 digits.";
    }

    // Validate age if provided
    if (!empty($_POST['age'])) {
        if (!is_numeric($_POST['age']) || $_POST['age'] < 13 || $_POST['age'] > 120) {
            $errors[] = "Age must be between 13 and 120.";
        }
    }

    // Validate products (checkboxes)
    if (!isset($_POST['products']) || empty($_POST['products'])) {
        $errors[] = "Please select at least one product.";
    }

    // Validate satisfaction
    if (!isset($_POST['satisfaction'])) {
        $errors[] = "Please select your satisfaction level.";
    }

    // Validate feedback type
    if (empty($_POST['feedbackType'])) {
        $errors[] = "Please select a feedback type.";
    }

    // Validate comments
    if (empty(trim($_POST['feedback'])) || strlen(trim($_POST['feedback'])) < 10) {
        $errors[] = "Feedback must be at least 10 characters.";
    }

    // If there are validation errors
    if (!empty($errors)) {
        echo "<script>alert('" . implode("\\n", $errors) . "'); window.history.back();</script>";
        exit();
    }

    // If validation passes, process the data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = !empty($_POST['age']) ? $_POST['age'] : NULL;
    $satisfaction = $_POST['satisfaction'];
    $feedbackType = $_POST['feedbackType'];
    $comments = $_POST['feedback'];
    $products = implode(", ", $_POST['products']);

    // Prepare SQL statement
    $sql = "INSERT INTO feedback (email, name, phone, age, satisfaction, feedback_type, products, comments) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssissss", $email, $name, $phone, $age, $satisfaction, $feedbackType, $products, $comments);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Thank you for your feedback!');
                window.location.href='../pages/feedback.php';
              </script>";
    } else {
        echo "<script>
                alert('Error submitting feedback. Please try again.');
                window.history.back();
              </script>";
    }

    $stmt->close();
}
$conn->close();
?>