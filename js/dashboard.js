document.addEventListener("DOMContentLoaded", () => {
    
    // Set today's date as default in the booking form
    const dateInput = document.getElementById("date");
    if(dateInput) {
        dateInput.valueAsDate = new Date();
    }

    const bookingForm = document.getElementById("book-auto-form");
    const resultDiv = document.getElementById("booking-result");

    if (bookingForm) {
        bookingForm.addEventListener("submit", (e) => {
            e.preventDefault();

            // Get user input
            const pickup = document.getElementById("pickup").value;
            const dropoff = document.getElementById("dropoff").value;

            // Generate a random mock fare between ₹40 and ₹150
            const randomFare = Math.floor(Math.random() * (150 - 40 + 1)) + 40;

            // Update the UI with results
            document.getElementById("res-pickup").innerText = pickup;
            document.getElementById("res-dropoff").innerText = dropoff;
            document.getElementById("res-fare").innerText = "₹" + randomFare;

            // Show the result div
            resultDiv.classList.remove("hidden");
            
            // Optionally clear the form
            bookingForm.reset();
            if(dateInput) dateInput.valueAsDate = new Date(); // reset date
        });
    }
});