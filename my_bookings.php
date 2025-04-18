<?php
session_start();
include_once 'includes/db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: signUpLogin/login.html");
    exit();
}

// Get the current user's ID
$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'];

// Fetch only bookings for the logged-in user using both user_id and email for reliable results
$sql = "SELECT * FROM bookings WHERE user_id = ? OR email = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - AutoCare Workshop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Add SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">
    <?php include 'includes/navbar.php'; ?>

    <main class="pt-20 pb-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">My Bookings</h1>
                    <a href="booking.php" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>New Booking
                    </a>
                </div>

                <?php if ($result && $result->num_rows > 0): ?>
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <?php while($booking = $result->fetch_assoc()): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden booking-card" data-aos="fade-up" id="booking-<?php echo $booking['id']; ?>">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-sm font-semibold px-3 py-1 rounded-full 
                                            <?php 
                                            echo match($booking['status']) {
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'confirmed' => 'bg-green-100 text-green-800',
                                                'completed' => 'bg-blue-100 text-blue-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                            ?>">
                                            <?php echo ucfirst($booking['status']); ?>
                                        </span>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm text-gray-500">
                                                <?php echo date('M d, Y', strtotime($booking['created_at'])); ?>
                                            </span>
                                            <button onclick="deleteBooking(<?php echo $booking['id']; ?>)" 
                                                    class="text-red-500 hover:text-red-700 transition-colors">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900"><?php echo htmlspecialchars($booking['service_type']); ?></h3>
                                            <p class="text-gray-600"><?php echo htmlspecialchars($booking['customer_name']); ?></p>
                                        </div>

                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-car mr-2"></i>
                                            <span><?php echo htmlspecialchars($booking['vehicle_year'] . ' ' . $booking['vehicle_make'] . ' ' . $booking['vehicle_model']); ?></span>
                                        </div>

                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-calendar mr-2"></i>
                                            <span><?php echo date('F d, Y', strtotime($booking['preferred_date'])); ?></span>
                                        </div>

                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span><?php echo date('h:i A', strtotime($booking['preferred_time'])); ?></span>
                                        </div>

                                        <?php if($booking['additional_notes']): ?>
                                            <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                                <p class="text-sm text-gray-600"><?php echo htmlspecialchars($booking['additional_notes']); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mt-6 flex justify-between items-center">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-phone text-gray-400"></i>
                                            <span class="text-sm text-gray-600"><?php echo htmlspecialchars($booking['phone']); ?></span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                            <span class="text-sm text-gray-600"><?php echo htmlspecialchars($booking['email']); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12">
                        <div class="mb-4">
                            <i class="fas fa-calendar-times text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Bookings Found</h3>
                        <p class="text-gray-600 mb-6">You haven't made any bookings yet.</p>
                        <a href="booking.php" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700">
                            <i class="fas fa-plus mr-2"></i>
                            Make Your First Booking
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        function deleteBooking(bookingId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This booking will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('booking_id', bookingId);

                    fetch('delete_booking.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the booking card with animation
                            const bookingCard = document.getElementById(`booking-${bookingId}`);
                            bookingCard.style.transition = 'all 0.5s ease';
                            bookingCard.style.opacity = '0';
                            bookingCard.style.transform = 'scale(0.95)';
                            
                            setTimeout(() => {
                                bookingCard.remove();
                                
                                // Check if there are any remaining bookings
                                const remainingBookings = document.querySelectorAll('.booking-card');
                                if (remainingBookings.length === 0) {
                                    location.reload(); // Reload to show the "No Bookings" message
                                }
                            }, 500);

                            Swal.fire(
                                'Deleted!',
                                'Your booking has been deleted.',
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Error!',
                                data.message || 'Failed to delete booking.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the booking.',
                            'error'
                        );
                    });
                }
            });
        }
    </script>
</body>
</html> 