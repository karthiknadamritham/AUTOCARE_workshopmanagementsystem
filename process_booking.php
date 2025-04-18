<?php
// Prevent any output before intended response
error_reporting(0);
session_start();
include_once 'includes/db_connect.php';

header('Content-Type: application/json');

try {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        throw new Exception("You must be logged in to make a booking");
    }

    // Get user ID from session
    $user_id = $_SESSION['user_id'];

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        throw new Exception("Invalid request method");
    }

    // Validate required fields
    $required_fields = ['customer_name', 'email', 'phone', 'vehicle_make', 'vehicle_model', 
                       'vehicle_year', 'service_type', 'preferred_date', 'preferred_time'];
    
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            throw new Exception("Missing required field: " . $field);
        }
    }

    // Collect and sanitize form data
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $vehicle_make = mysqli_real_escape_string($conn, $_POST['vehicle_make']);
    $vehicle_model = mysqli_real_escape_string($conn, $_POST['vehicle_model']);
    $vehicle_year = mysqli_real_escape_string($conn, $_POST['vehicle_year']);
    $service_type = mysqli_real_escape_string($conn, $_POST['service_type']);
    $preferred_date = mysqli_real_escape_string($conn, $_POST['preferred_date']);
    $preferred_time = mysqli_real_escape_string($conn, $_POST['preferred_time']);
    $additional_notes = mysqli_real_escape_string($conn, $_POST['additional_notes'] ?? '');
    $status = 'pending';

    // Insert data into database including user_id
    $sql = "INSERT INTO bookings (user_id, customer_name, email, phone, vehicle_make, vehicle_model, vehicle_year, 
            service_type, preferred_date, preferred_time, additional_notes, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("isssssssssss", 
        $user_id,
        $customer_name, 
        $email, 
        $phone, 
        $vehicle_make, 
        $vehicle_model, 
        $vehicle_year, 
        $service_type, 
        $preferred_date, 
        $preferred_time, 
        $additional_notes, 
        $status
    );

    if (!$stmt->execute()) {
        throw new Exception("Error saving booking: " . $stmt->error);
    }

    $stmt->close();

    echo json_encode([
        'success' => true,
        'message' => 'Booking submitted successfully!'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?> 