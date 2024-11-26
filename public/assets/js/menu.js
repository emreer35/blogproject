var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
var themeToggleBtn = document.getElementById("theme-toggle");

// Load the theme on page load
function loadTheme() {
    if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        document.documentElement.classList.add("dark");
        themeToggleLightIcon.classList.remove("hidden");
    } else {
        themeToggleDarkIcon.classList.remove("hidden");
    }
}

// Call the loadTheme function on page load
loadTheme();

themeToggleBtn.addEventListener("click", function () {
    themeToggleDarkIcon.classList.toggle("hidden");
    themeToggleLightIcon.classList.toggle("hidden");

    if (localStorage.getItem("color-theme")) {
        if (localStorage.getItem("color-theme") === "light") {
            document.documentElement.classList.add("dark");
            localStorage.setItem("color-theme", "dark");
        } else {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("color-theme", "light");
        }
    } else {
        if (document.documentElement.classList.contains("dark")) {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("color-theme", "light");
        } else {
            document.documentElement.classList.add("dark");
            localStorage.setItem("color-theme", "dark");
        }
    }
});

// end dark mode

document.addEventListener("DOMContentLoaded", function () {
    // begin dropdown menu
    const dropDownBtns = document.querySelectorAll("[data-collapse-toggle]");

    dropDownBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            const targetItemId = btn.getAttribute("data-collapse-toggle");
            const targetItem = document.getElementById(targetItemId);

            // Diger acik olan menüleri kapatma
            document
                .querySelectorAll("ul[id^='dropdown-menu']")
                .forEach((menu) => {
                    if (menu !== targetItem) {
                        menu.classList.add("hidden");
                    }
                });
            targetItem.classList.toggle("hidden");
        });
    });
    // end dropdown menu

    // begin Sidebar açma kapatma

    const dropDownBtn = document.querySelector("[data-drawer-toggle]");
    const dropDownModal = document.getElementById("logo-sidebar");

    dropDownBtn.addEventListener("click", function () {
        dropDownModal.classList.toggle("-translate-x-full");
    });
    // end Sidebar açma kapatma

    //  profile ac kaap

    const userDropdown = document.querySelector(
        '[data-dropdown-toggle="dropdown-user"]'
    );
    const userModal = document.getElementById("dropdown-user");

    // Menü tıklama ile ac kapa
    userDropdown.addEventListener("click", (e) => {
        e.stopPropagation(); // Tıklama olayını durdur
        userModal.classList.toggle("hidden");
    });

    // herhangi bir yerine tıklandığında dropdown menüsünü gizle
    window.addEventListener("click", () => {
        if (!userModal.classList.contains("hidden")) {
            userModal.classList.add("hidden");
        }
    });

    // Dropdown a tıklandığında kapanmaması için
    userModal.addEventListener("click", (e) => {
        e.stopPropagation();
    });

    

});
