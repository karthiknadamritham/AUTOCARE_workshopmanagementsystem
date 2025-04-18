// Initialize AOS (Animate on Scroll)
AOS.init({
    duration: 800,
    once: true
});

// DOM Elements
const navToggle = document.getElementById('navToggle');
const navLinks = document.querySelector('.nav-links');
const darkModeToggle = document.getElementById('darkModeToggle');
const bookingForm = document.getElementById('bookingForm');
const trackingForm = document.querySelector('.track-form');
const statusDisplay = document.getElementById('statusDisplay');
const modal = document.getElementById('bookingModal');
const closeModal = document.querySelector('.close');
const bookingButtons = document.querySelectorAll('.book-btn');

// Navigation Toggle
navToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

// Close navigation when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.navbar')) {
        navLinks.classList.remove('active');
    }
});

// Dark Mode Toggle
darkModeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    const icon = darkModeToggle.querySelector('i');
    if (document.body.classList.contains('dark-mode')) {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    }
});

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        target.scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Remove the sticky navbar background change effect

// Booking Form Submission
if (bookingForm) {
    bookingForm.addEventListener('submit', (e) => {
        e.preventDefault();
        modal.style.display = 'block';
    });
}

// Modal Close
if (closeModal) {
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });
}

// Service Tracking
if (trackingForm) {
    const trackBtn = document.getElementById('trackBtn');
    trackBtn.addEventListener('click', () => {
        const trackingId = document.getElementById('trackingId').value;
        if (trackingId.trim() !== '') {
            statusDisplay.classList.remove('hidden');
            // In a real application, this would fetch the actual status
            // For demo, we'll simulate the status with a random progress
            const progress = Math.floor(Math.random() * 4) + 1;
            const progressBar = document.querySelector('.progress');
            const steps = document.querySelectorAll('.step');
            
            progressBar.style.width = `${(progress / 4) * 100}%`;
            
            steps.forEach((step, index) => {
                if (index < progress) {
                    step.classList.add('active');
                } else {
                    step.classList.remove('active');
                }
            });
        }
    });
}

// Booking Buttons
bookingButtons.forEach(button => {
    button.addEventListener('click', () => {
        window.location.href = 'booking.html';
    });
});

// Add any other functionality needed for the website 