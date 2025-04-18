<?php
session_start();
$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/db_connect.php';
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $service_type = mysqli_real_escape_string($conn, $_POST['service_type']);
    
    $sql = "INSERT INTO feedback (name, email, rating, message, service_type, created_at) 
            VALUES ('$name', '$email', '$rating', '$message', '$service_type', NOW())";
    
    if (mysqli_query($conn, $sql)) {
        $success_message = "Thank you for your feedback!";
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - AutoCare Workshop</title>
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
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <?php include 'includes/navbar.php'; ?>

    <main class="pt-20">
        <section class="py-16">
            <div class="container mx-auto px-6">
                <div class="max-w-2xl mx-auto">
                    <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center" data-aos="fade-up">Share Your Feedback</h1>
                    
                    <?php if ($success_message): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline"><?php echo $success_message; ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($error_message): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline"><?php echo $error_message; ?></span>
                        </div>
                    <?php endif; ?>

                    <form action="feedback.php" method="POST" class="bg-white shadow-lg rounded-2xl p-8 space-y-6" data-aos="fade-up">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>

                        <div>
                            <label for="service_type" class="block text-sm font-medium text-gray-700 mb-2">Service Type</label>
                            <select id="service_type" name="service_type" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Select a service</option>
                                <option value="General Service">General Service</option>
                                <option value="Oil Change">Oil Change</option>
                                <option value="Brake Service">Brake Service</option>
                                <option value="Diagnostic Test">Diagnostic Test</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <div class="flex space-x-4">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                <div class="flex items-center">
                                    <input type="radio" id="rating<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" required
                                        class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500">
                                    <label for="rating<?php echo $i; ?>" class="ml-2 text-sm text-gray-700"><?php echo $i; ?> Star</label>
                                </div>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Your Feedback</label>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Please share your experience with our service..."></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-red-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-red-700 transition-colors duration-300 flex items-center justify-center space-x-2">
                            <span>Submit Feedback</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

   

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