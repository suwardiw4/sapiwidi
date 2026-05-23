document.addEventListener("DOMContentLoaded", function() {
    const navToggle = document.getElementById("navToggle");
    const navMenu = document.getElementById("navMenu");

    // Deteksi klik pada tombol hamburger
    navToggle.addEventListener("click", function() {
        // Memunculkan / menyembunyikan menu
        navMenu.classList.toggle("show-menu");
        
        // Mengubah animasi hamburger menjadi huruf X
        navToggle.classList.toggle("toggle-active");
    });

    // Menutup menu secara otomatis jika user mengklik salah satu link (berguna untuk single page application)
    const navLinks = document.querySelectorAll(".nav-link");
    navLinks.forEach(link => {
        link.addEventListener("click", () => {
            navMenu.classList.remove("show-menu");
            navToggle.classList.remove("toggle-active");
        });
    });
});
