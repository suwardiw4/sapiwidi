 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const btnBuka = document.getElementById("btnBukaPembayaran");
         const modalOverlay = document.getElementById("pembayaranModalKustom");
         const modalClose = document.querySelector(".modal-close-kustom");
         const modalBody = document.getElementById("modalBodyPembayaran");

         // Fungsi membuka modal dan mengambil data form
         if (btnBuka) {
             btnBuka.addEventListener("click", function() {
                 const url = this.getAttribute("data-url");

                 // Tampilkan modal dengan animasi
                 modalOverlay.classList.add("aktif");
                 // Mengunci halaman belakang agar tidak berubah tinggi/scroll
                 document.body.style.overflow = "hidden";

                 // Set tampilan loading awal
                 modalBody.innerHTML = `
                <div class="modal-loading-kustom">
                    <div class="spinner-kustom"></div>
                    <p style="font-family: sans-serif; font-size: 14px; color: #666;">Memuat form pembayaran...</p>
                </div>
            `;

                 // Ambil konten HTML form pembayaran dari Laravel
                 fetch(url)
                     .then(response => {
                         if (!response.ok) throw new Error("Gagal memuat halaman");
                         return response.text();
                     })
                     .then(html => {
                         // Masukkan isi form kustom Anda ke dalam modal
                         modalBody.innerHTML = html;
                     })
                     .catch(error => {
                         modalBody.innerHTML = `
                        <div style="color: #721c24; background-color: #f8d7da; padding: 15px; border-radius: 8px; text-align:center; font-family: sans-serif;">
                            Gagal memuat data pembayaran. Silakan coba lagi.
                        </div>
                    `;
                         console.error("Error Fetch:", error);
                     });
             });
         }

         // Fungsi menutup modal saat klik tombol silang
         modalClose.addEventListener("click", fungsiTutupModal);

         // Fungsi menutup modal saat klik area gelap di luar kotak putih
         window.addEventListener("click", function(event) {
             if (event.target === modalOverlay) {
                 fungsiTutupModal();
             }
         });

         function fungsiTutupModal() {
             modalOverlay.classList.remove("aktif");
             document.body.style.overflow = ""; // Mengembalikan halaman belakang ke kondisi awal
         }
     });
 </script>
