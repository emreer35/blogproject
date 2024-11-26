function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById("user_image");
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);

    document.getElementById("save_button").classList.remove("hidden");
    document.getElementById("upload_button").textContent = "Fotoğraf Seçin";
}

const openModalButton = document.querySelector(
    '[data-modal-target="user-delete-modal"]'
);
const closeModalButtons = document.querySelectorAll(
    '[data-modal-hide="user-delete-modal"]'
);
const modal = document.getElementById("user-delete-modal");

openModalButton.addEventListener("click", () => {
    modal.classList.remove("hidden"); 
    modal.classList.add("flex"); 
    document.body.style.overflow = "hidden"; 
});

// Close modal when close button is clicked
closeModalButtons.forEach((button) => {
    button.addEventListener("click", () => {
        modal.classList.add("hidden"); // Hide modal
        modal.classList.remove("flex"); // Reset flex display
        document.body.style.overflow = "auto"; // Re-enable scrolling
    });
});

// Optional: Close modal if clicked outside of the modal content (on the overlay)
modal.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
        document.body.style.overflow = "auto";
    }
});



