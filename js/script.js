document.addEventListener("DOMContentLoaded", () => {
    
    // Mobile Menu Toggle Logic
    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector(".nav-links");

    if (menuToggle) {
        menuToggle.addEventListener("click", () => {
            navLinks.classList.toggle("active");
        });
    }

    // Contact Form Submission Alert
    const contactForm = document.getElementById("contact-form");
    if (contactForm) {
        contactForm.addEventListener("submit", (e) => {
            e.preventDefault();
            alert("Thank you! Your message has been sent. We will contact you shortly.");
            contactForm.reset();
        });
    }
});