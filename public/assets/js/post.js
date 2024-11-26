// DOmContent Loaded

document.addEventListener("DOMContentLoaded", function () {
    copyLink();
    sliderMenu();
    commentModal();
});

function copyLink() {
    const shareDropdown = document.querySelector(
        '[data-dropdown-toggle="dropdown-share"]'
    );
    const shareModal = document.getElementById("dropdown-share");

    shareDropdown.addEventListener("click", function (e) {
        e.stopPropagation();
        shareModal.classList.toggle("hidden");
    });
    window.addEventListener("click", () => {
        if (!shareModal.classList.contains("hidden")) {
            shareModal.classList.add("hidden");
        }
    });
    shareModal.addEventListener("click", (e) => {
        e.stopPropagation();
    });

    const copyBtn = document.getElementById("copyBtn");
    const linkUrlInput = document.getElementById("linkUrl");

    copyBtn.addEventListener("click", () => {
        linkUrlInput.select();
        linkUrlInput.setSelectionRange(0, 999999);
        document.execCommand("copy");

        const message = document.getElementById("copyMessage");
        message.classList.remove("opacity-0", "translate-y-[-100%]");
        message.classList.add("opacity-100", "translate-y-0");

        // Mesajı 3 saniye sonra gizle
        setTimeout(function () {
            message.classList.remove("opacity-100", "translate-y-0");
            message.classList.add("opacity-0", "translate-y-[-100%]");
        }, 3000);
        shareModal.classList.add("hidden");
    });
}

function sliderMenu() {
    const carousel = document.getElementById("carousel");
    const prevButton = document.getElementById("prev");
    const nextButton = document.getElementById("next");
    let currentIndex = 0;
    const items = document.querySelectorAll(".carousel-item");
    const totalItems = items.length;

    // Carousel ileri kaydırma
    function goToNext() {
        if (currentIndex < totalItems - 1) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        updateCarouselPosition();
    }

    // Carousel geri kaydırma
    function goToPrev() {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = totalItems - 1;
        }
        updateCarouselPosition();
    }

    // Carousel'ın mevcut konumunu güncelleme
    function updateCarouselPosition() {
        const offset = -currentIndex * (items[0].clientWidth + 24); // 24px margin
        carousel.style.transform = `translateX(${offset}px)`;
    }

    // Ok butonlarına tıklama olayları
    nextButton.addEventListener("click", goToNext);
    prevButton.addEventListener("click", goToPrev);
}

function commentModal() {
    const commentBtn = document.querySelectorAll(
        '[data-modal-toggle="comment-modal"]'
    );
    const commentModal = document.getElementById("comment-modal");
    const hidecommentModal = document.querySelector(
        '[data-modal-hide="comment-modal"]'
    );

    commentBtn.forEach((btn) => {
        btn.addEventListener("click", () => {
            commentModal.classList.remove("hidden");
        });
    });

    hidecommentModal.addEventListener("click", () => {
        commentModal.classList.add("hidden");
    });
    window.addEventListener("click", (e) => {
        if (e.target === commentModal) {
            commentModal.classList.add("hidden");
        }
    });
}
