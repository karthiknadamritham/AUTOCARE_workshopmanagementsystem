<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - AutoCare Workshop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ff4b6e',    // Pink
                        secondary: '#4169e1',   // Royal Blue
                        accent: '#ff1744',      // Red
                        dark: '#1a1a2e',
                        light: '#f8f9fa'
                    }
                }
            }
        }
    </script>
    <style>
        .nav-link {
            @apply text-gray-700 hover:text-primary transition-colors;
        }
        .nav-link.active {
            @apply text-primary font-semibold;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #ff4b6e 0%, #4169e1 100%);
        }
        .card-hover {
            @apply hover:shadow-[0_0_15px_rgba(255,75,110,0.3)] transition-all duration-300;
        }
        .badge {
            @apply px-3 py-1 bg-primary/10 text-primary rounded-full text-sm;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="font-[Poppins] bg-gray-50">
    <?php include 'includes/navbar.php'; ?>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 gradient-bg text-white">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">About AutoCare</h1>
                <p class="text-xl opacity-90">Your trusted partner in automotive care since 1995</p>
            </div>
        </div>
    </section>

    <!-- Company Story Section -->
    <section class="py-20 bg-light">
        <div class="container mx-auto px-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Our Story</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">Founded in 1995, AutoCare has been providing exceptional car maintenance and repair services for over 25 years. What started as a small family-owned workshop has grown into a state-of-the-art facility with cutting-edge equipment and a team of certified professionals.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                    <div class="bg-white rounded-2xl p-8 shadow-lg text-center" data-aos="fade-up" data-aos-delay="100">
                        <i class="fas fa-car text-5xl text-primary mb-4"></i>
                        <h3 class="text-4xl font-bold text-dark mb-2">50,000+</h3>
                        <p class="text-gray-600">Cars Serviced</p>
                    </div>
                    <div class="bg-white rounded-2xl p-8 shadow-lg text-center" data-aos="fade-up" data-aos-delay="200">
                        <i class="fas fa-users text-5xl text-primary mb-4"></i>
                        <h3 class="text-4xl font-bold text-dark mb-2">30+</h3>
                        <p class="text-gray-600">Expert Technicians</p>
                    </div>
                    <div class="bg-white rounded-2xl p-8 shadow-lg text-center" data-aos="fade-up" data-aos-delay="300">
                        <i class="fas fa-award text-5xl text-primary mb-4"></i>
                        <h3 class="text-4xl font-bold text-dark mb-2">25+</h3>
                        <p class="text-gray-600">Years Experience</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values Section -->
    <section class="py-20 gradient-bg text-white">
        <div class="container mx-auto px-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Mission & Values</h2>
                    <p class="text-lg opacity-90 max-w-3xl mx-auto">We are committed to providing exceptional automotive care with integrity and innovation</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 shadow-lg text-center group hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                        <div class="bg-gradient-to-br from-primary to-secondary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-heart text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Customer First</h3>
                        <p class="opacity-90">We prioritize customer satisfaction in everything we do</p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 shadow-lg text-center group hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
                        <div class="bg-gradient-to-br from-primary to-secondary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-certificate text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Quality Service</h3>
                        <p class="opacity-90">We maintain the highest standards in automotive care</p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 shadow-lg text-center group hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="300">
                        <div class="bg-gradient-to-br from-primary to-secondary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-handshake text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Integrity</h3>
                        <p class="opacity-90">We believe in honest and transparent service</p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 shadow-lg text-center group hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="400">
                        <div class="bg-gradient-to-br from-primary to-secondary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-tools text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Innovation</h3>
                        <p class="opacity-90">We stay updated with the latest automotive technology</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
