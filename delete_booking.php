<?php
session_start();
include_once 'includes/db_connect.php';

header('Content-Type: application/json');

try {
    // Check if user is logged in
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
        throw new Exception('You must be logged in to delete a booking');
    }

    $user_email = $_SESSION['user_email'];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    if (!isset($_POST['booking_id']) || empty($_POST['booking_id'])) {
        throw new Exception('Booking ID is required');
    }

    $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);

    // First check if this booking belongs to the current user
    $check_sql = "SELECT * FROM bookings WHERE id = ? AND (user_id = ? OR email = ?)";
    $check_stmt = $conn->prepare($check_sql);
    
    if (!$check_stmt) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }
    
    $check_stmt->bind_param("iis", $booking_id, $_SESSION['user_id'], $user_email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception("You do not have permission to delete this booking");
    }
    
    $check_stmt->close();

    // Delete the booking
    $sql = "DELETE FROM bookings WHERE id = ? AND (user_id = ? OR email = ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("iis", $booking_id, $_SESSION['user_id'], $user_email);

    if (!$stmt->execute()) {
        throw new Exception("Error deleting booking: " . $stmt->error);
    }

    if ($stmt->affected_rows === 0) {
        throw new Exception("No booking found with ID: " . $booking_id);
    }

    $stmt->close();

    echo json_encode([
        'success' => true,
        'message' => 'Booking deleted successfully'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?> 