
document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const showPasswordIcon = document.getElementById("showPassword");
    const hidePasswordIcon = document.getElementById("hidePassword");

    // Toggle password visibility
    showPasswordIcon.addEventListener("click", function () {
        passwordInput.type = "text"; // Change input type to text (show password)
        showPasswordIcon.classList.add("hidden"); // Hide the show icon
        hidePasswordIcon.classList.remove("hidden"); // Show the hide icon
    });

    hidePasswordIcon.addEventListener("click", function () {
        passwordInput.type = "password"; // Change input type to password (hide password)
        hidePasswordIcon.classList.add("hidden"); // Hide the hide icon
        showPasswordIcon.classList.remove("hidden"); // Show the show icon
    });
});
