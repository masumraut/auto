document.addEventListener("DOMContentLoaded", () => {
    
    const loginForm = document.getElementById("login-form");
    const signupForm = document.getElementById("signup-form");

    if (loginForm) {
        loginForm.addEventListener("submit", (e) => {
            e.preventDefault();
            // Simulate backend check
            alert("Login successful! Redirecting to Dashboard...");
            window.location.href = "dashboard.html";
        });
    }

    if (signupForm) {
        signupForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const name = document.getElementById("signup-name").value;
            // Simulate account creation
            alert(`Account created for ${name}! Please login.`);
            window.location.href = "login.html";
        });
    }
});