<?php
session_start();
include_once 'includes/db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: signUpLogin/login.html");
    exit();
}

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : '';
$userEmail = $isLoggedIn ? $_SESSION['user_email'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Service - AutoCare Workshop</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style type="text/tailwind">
        @layer components {
            .nav-link {
                @apply text-gray-700 hover:text-primary-600 transition-colors relative group;
            }
            .nav-link::after {
                @apply content-[''] absolute bottom-0 left-0 w-full h-0.5 bg-primary-500 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left;
            }
            .nav-link.active {
                @apply text-primary-600 font-semibold;
            }
            .nav-link.active::after {
                @apply scale-x-100;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <!-- Main Content with Padding for Fixed Navbar -->
    <main class="pt-20">
        <!-- Appointment Details Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12" data-aos="fade-up">Book Your Service</h2>
                    
                    <!-- Service Selection -->
                    <div class="mb-10 bg-white rounded-2xl p-8 shadow-lg" data-aos="fade-up">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Select Your Service</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="service-option group">
                                <input type="radio" name="service" id="general-service" class="hidden">
                                <label for="general-service" class="block p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-300 group-hover:border-primary-500">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                                            <i class="fas fa-tools text-primary-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">General Service</h4>
                                            <p class="text-sm text-gray-600">Complete car checkup and maintenance</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="service-option group">
                                <input type="radio" name="service" id="oil-change" class="hidden">
                                <label for="oil-change" class="block p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-300 group-hover:border-primary-500">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                                            <i class="fas fa-oil-can text-primary-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">Oil Change</h4>
                                            <p class="text-sm text-gray-600">Oil and filter replacement</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="service-option group">
                                <input type="radio" name="service" id="brake-service" class="hidden">
                                <label for="brake-service" class="block p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-300 group-hover:border-primary-500">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                                            <img src="https://cdn-icons-png.flaticon.com/512/2061/2061956.png" alt="Brake Service Icon" class="w-6 h-6">
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">Brake Service</h4>
                                            <p class="text-sm text-gray-600">Brake inspection and repair</p>
                                        </div>
                                        <div class="ml-auto">
                                            <!-- <img src="https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=120&h=120&q=80" alt="Brake Service" class="w-16 h-16 rounded-lg object-cover"> -->
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="service-option group">
                                <input type="radio" name="service" id="diagnostic" class="hidden">
                                <label for="diagnostic" class="block p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-300 group-hover:border-primary-500">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                                            <i class="fas fa-car-battery text-primary-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">Diagnostic Test</h4>
                                            <p class="text-sm text-gray-600">Complete car diagnosis</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Form -->
                    <form id="bookingForm" action="process_booking.php" method="POST" class="bg-white rounded-2xl p-8 shadow-lg space-y-6" data-aos="fade-up">
                        <!-- Personal Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="customer_name">Full Name</label>
                                <input type="text" id="customer_name" name="customer_name" value="<?php echo htmlspecialchars($userName); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="email">Email Address</label>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userEmail); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required <?php echo $isLoggedIn ? 'readonly' : ''; ?>>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="service_type">Service Type</label>
                                <select id="service_type" name="service_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                                    <option value="">Select a service</option>
                                    <option value="General Service">General Service</option>
                                    <option value="Oil Change">Oil Change</option>
                                    <option value="Brake Service">Brake Service</option>
                                    <option value="Diagnostic Test">Diagnostic Test</option>
                                    <option value="Wheel Alignment">Wheel Alignment</option>
                                    <option value="Engine Repair">Engine Repair</option>
                                </select>
                            </div>
                        </div>

                        <!-- Vehicle Details -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="vehicle_make">Vehicle Make</label>
                                <input type="text" id="vehicle_make" name="vehicle_make" placeholder="e.g., Toyota" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="vehicle_model">Vehicle Model</label>
                                <input type="text" id="vehicle_model" name="vehicle_model" placeholder="e.g., Camry" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="vehicle_year">Vehicle Year</label>
                                <input type="number" id="vehicle_year" name="vehicle_year" placeholder="e.g., 2020" min="1900" max="2030" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                        </div>

                        <!-- Date and Time Selection -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="preferred_date">Preferred Date</label>
                                <input type="date" id="preferred_date" name="preferred_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="preferred_time">Preferred Time</label>
                                <select id="preferred_time" name="preferred_time" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                                    <option value="">Select a time slot</option>
                                    <option value="09:00:00">09:00 AM</option>
                                    <option value="10:00:00">10:00 AM</option>
                                    <option value="11:00:00">11:00 AM</option>
                                    <option value="12:00:00">12:00 PM</option>
                                    <option value="14:00:00">02:00 PM</option>
                                    <option value="15:00:00">03:00 PM</option>
                                    <option value="16:00:00">04:00 PM</option>
                                </select>
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="additional_notes">Additional Notes</label>
                            <textarea id="additional_notes" name="additional_notes" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Please describe any specific issues or requirements..."></textarea>
                        </div>

                        <!-- Terms and Submit -->
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <input type="checkbox" id="terms" name="terms" class="mt-1 h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" required>
                                <label for="terms" class="ml-2 text-sm text-gray-600">
                                    I agree to the <a href="#" class="text-primary-600 hover:underline">terms and conditions</a>
                                </label>
                            </div>
                            <button type="submit" class="w-full bg-primary-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-primary-700 transition-colors duration-300">
                                Confirm Appointment
                            </button>
                        </div>
                    </form>

                    <!-- Appointment Information -->
                    <div class="mt-10 bg-white rounded-2xl p-8 shadow-lg" data-aos="fade-up">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Important Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-clock text-primary-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Service Hours</h4>
                                    <p class="text-gray-600">Monday - Friday: 8:00 AM - 6:00 PM</p>
                                    <p class="text-gray-600">Saturday: 9:00 AM - 4:00 PM</p>
                                    <p class="text-gray-600">Sunday: Closed</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-info-circle text-primary-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">What to Bring</h4>
                                    <ul class="text-gray-600 space-y-1">
                                        <li>• Vehicle Registration</li>
                                        <li>• Driver's License</li>
                                        <li>• Insurance Information</li>
                                        <li>• Service History (if available)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Booking Modal -->
        <div id="bookingModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Booking Confirmation</h2>
                <p>Your appointment has been scheduled successfully!</p>
                <p>Booking ID: <span id="bookingId"></span></p>
                <div class="confirmation-details">
                    <p>We'll send you a confirmation email with all the details.</p>
                    <p>You can track your service status using your booking ID.</p>
                </div>
            </div>
        </div>
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
        
        // Set min date to today for the date picker
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('preferred_date').min = today;
            
            // Handle form submission
            const form = document.getElementById('bookingForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Basic validation
                const requiredFields = ['customer_name', 'email', 'phone', 'vehicle_make', 'vehicle_model', 
                                      'vehicle_year', 'service_type', 'preferred_date', 'preferred_time'];
                
                let isValid = true;
                requiredFields.forEach(field => {
                    if (!document.getElementById(field).value.trim()) {
                        isValid = false;
                    }
                });
                
                if (!isValid) {
                    alert('Please fill all required fields.');
                    return false;
                }
                
                // Submit form
                const formData = new FormData(form);
                
                fetch('process_booking.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = 'booking.php';
                    } else {
                        alert(data.message || 'An error occurred. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again later.');
                });
            });
        });
    </script>

    <!-- Add this style to your CSS -->
    <style>
        .service-option input[type="radio"]:checked + label {
            border-color: var(--primary);
            background-color: var(--primary-light);
        }
    </style>
</body>
</html> 
