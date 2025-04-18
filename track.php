<?php
session_start();
include_once 'includes/db_connect.php';

$trackingResult = '';
$serviceStatus = '';
$statusPercentage = 0;
$bookingDetails = null;

if (isset($_POST['trackingId']) && !empty($_POST['trackingId'])) {
    $trackingId = $_POST['trackingId'];
    
    // Query to get booking details
    $sql = "SELECT b.*, s.status_name, s.status_order 
            FROM bookings b 
            JOIN service_status s ON b.status_id = s.status_id 
            WHERE b.booking_id = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $trackingId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $bookingDetails = $result->fetch_assoc();
        $serviceStatus = $bookingDetails['status_name'];
        
        // Calculate progress percentage based on status_order
        // Assuming status_order ranges from 1 to 4
        $statusPercentage = ($bookingDetails['status_order'] / 4) * 100;
        
        $trackingResult = 'found';
    } else {
        $trackingResult = 'not_found';
    }
    
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Service - AutoCare Workshop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            200: '#fecdd3',
                            300: '#fda4af',
                            400: '#fb7185',
                            500: '#f43f5e',
                            600: '#e11d48',
                            700: '#be123c',
                            800: '#9f1239',
                            900: '#881337',
                            950: '#4c0519',
                        },
                        secondary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'bounce-slow': 'bounce 2s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                        'spin-slow': 'spin 3s linear infinite',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans bg-gray-50 overflow-x-hidden">
    <?php include 'includes/navbar.php'; ?>

    <!-- Track Service Section -->
    <section class="pt-32 pb-20 relative bg-gradient-to-br from-primary-600 via-primary-500 to-secondary-600">
        <div class="absolute inset-0">
            <div class="absolute -top-20 -right-20 w-72 h-72 bg-gradient-to-br from-white/20 to-white/5 rounded-full animate-float blur-xl"></div>
            <div class="absolute -bottom-20 -left-20 w-48 h-48 bg-gradient-to-tr from-white/20 to-white/5 rounded-full animate-float delay-1000 blur-xl"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <div class="max-w-2xl mx-auto text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Track Your Service</h1>
                <p class="text-lg text-white/80">Enter your booking ID to check the status of your service</p>
            </div>
        </div>
    </section>

    <!-- Track Form Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="mb-8">
                        <form method="POST" action="" class="flex flex-col md:flex-row gap-4">
                            <input type="text" id="trackingId" name="trackingId" placeholder="Enter Booking ID" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                            <button type="submit" class="bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition-colors">Track Status</button>
                        </form>
                    </div>
                    
                    <?php if ($trackingResult == 'found'): ?>
                    <div id="statusDisplay" class="mb-8">
                        <div class="bg-green-50 p-4 rounded-lg mb-6">
                            <p class="text-green-800 font-medium">Booking #<?php echo htmlspecialchars($bookingDetails['booking_id']); ?> found</p>
                            <p class="text-gray-700 mt-2">Current Status: <span class="font-semibold"><?php echo htmlspecialchars($serviceStatus); ?></span></p>
                        </div>
                        
                        <div class="relative pt-10 pb-8">
                            <div class="w-full h-2 bg-gray-200 rounded-full">
                                <div class="bg-primary-500 h-2 rounded-full" style="width: <?php echo $statusPercentage; ?>%"></div>
                            </div>
                            <div class="flex justify-between mt-2">
                                <div class="text-center">
                                    <div class="w-6 h-6 <?php echo $bookingDetails['status_order'] >= 1 ? 'bg-primary-500' : 'bg-gray-300'; ?> rounded-full mx-auto -mt-5 flex items-center justify-center">
                                        <?php if ($bookingDetails['status_order'] >= 1): ?>
                                        <i class="fas fa-check text-white text-xs"></i>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-sm font-medium block mt-2">Received</span>
                                </div>
                                <div class="text-center">
                                    <div class="w-6 h-6 <?php echo $bookingDetails['status_order'] >= 2 ? 'bg-primary-500' : 'bg-gray-300'; ?> rounded-full mx-auto -mt-5 flex items-center justify-center">
                                        <?php if ($bookingDetails['status_order'] >= 2): ?>
                                        <i class="fas fa-check text-white text-xs"></i>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-sm font-medium block mt-2">Inspection</span>
                                </div>
                                <div class="text-center">
                                    <div class="w-6 h-6 <?php echo $bookingDetails['status_order'] >= 3 ? 'bg-primary-500' : 'bg-gray-300'; ?> rounded-full mx-auto -mt-5 flex items-center justify-center">
                                        <?php if ($bookingDetails['status_order'] >= 3): ?>
                                        <i class="fas fa-check text-white text-xs"></i>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-sm font-medium block mt-2">In Service</span>
                                </div>
                                <div class="text-center">
                                    <div class="w-6 h-6 <?php echo $bookingDetails['status_order'] >= 4 ? 'bg-primary-500' : 'bg-gray-300'; ?> rounded-full mx-auto -mt-5 flex items-center justify-center">
                                        <?php if ($bookingDetails['status_order'] >= 4): ?>
                                        <i class="fas fa-check text-white text-xs"></i>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-sm font-medium block mt-2">Ready</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2">Booking Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-600">Service: <span class="text-gray-900"><?php echo htmlspecialchars($bookingDetails['service_type']); ?></span></p>
                                    <p class="text-gray-600">Vehicle: <span class="text-gray-900"><?php echo htmlspecialchars($bookingDetails['vehicle_make'] . ' ' . $bookingDetails['vehicle_model']); ?></span></p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Appointment: <span class="text-gray-900"><?php echo date('F j, Y', strtotime($bookingDetails['appointment_date'])); ?></span></p>
                                    <p class="text-gray-600">Time: <span class="text-gray-900"><?php echo date('g:i A', strtotime($bookingDetails['appointment_time'])); ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php elseif ($trackingResult == 'not_found'): ?>
                    <div class="bg-red-50 p-4 rounded-lg mb-6">
                        <p class="text-red-800 font-medium">No booking found with this ID.</p>
                        <p class="text-gray-700 mt-2">Please check the booking ID and try again.</p>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
                    <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-lg transition-shadow" data-aos="fade-up">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-info-circle text-2xl text-primary-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">How to Track</h3>
                        <p class="text-gray-600">Enter the booking ID you received when scheduling your service to check its current status.</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-clock text-2xl text-primary-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Real-Time Updates</h3>
                        <p class="text-gray-600">Our system provides real-time status updates of your vehicle's service progress.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- About Section -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold">AutoCare</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Your trusted partner in automotive care. We provide professional car repair and maintenance services with a commitment to excellence.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold">Quick Links</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="index.php" class="text-gray-400 hover:text-primary-500 transition-colors flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php#services" class="text-gray-400 hover:text-primary-500 transition-colors flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                <span>Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="about.php" class="text-gray-400 hover:text-primary-500 transition-colors flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                <span>About Us</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Services Links -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold">Services</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="booking.php" class="text-gray-400 hover:text-primary-500 transition-colors flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                <span>Oil Change</span>
                            </a>
                        </li>
                        <li>
                            <a href="booking.php" class="text-gray-400 hover:text-primary-500 transition-colors flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                <span>Brake Service</span>
                            </a>
                        </li>
                        <li>
                            <a href="booking.php" class="text-gray-400 hover:text-primary-500 transition-colors flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                <span>Engine Repair</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold">Contact Info</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt mt-1 text-primary-500"></i>
                            <span class="text-gray-400">123 Workshop Street<br>City, Country</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone text-primary-500"></i>
                            <span class="text-gray-400">+1 234 567 890</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-primary-500"></i>
                            <span class="text-gray-400">info@autocare.com</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-clock mt-1 text-primary-500"></i>
                            <span class="text-gray-400">
                                Mon - Fri: 8:00 AM - 6:00 PM<br>
                                Sat: 9:00 AM - 4:00 PM
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">&copy; 2024 AutoCare Workshop. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors text-sm">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors text-sm">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors text-sm">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>
</body>
</html> 