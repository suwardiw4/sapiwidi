 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const btnBuka = document.getElementById("btnBukaFormSapi");
         const modalOverlay = document.getElementById("frmSapiModalKustom");
         const modalClose = document.querySelector(".modal-close-kustom");
         const modalBody = document.getElementById("modalBody");
         const titlemodal = document.getElementById("titlemodal");

         // Fungsi membuka modal dan mengambil data form
         if (btnBuka) {
             btnBuka.addEventListener("click", function() {
                 const url = this.getAttribute("data-url");

                 //  const modalTitleText = modalTitleElement.textContent;


                 // Tampilkan modal dengan animasi
                 modalOverlay.classList.add("aktif");
                 // Mengunci halaman belakang agar tidak berubah tinggi/scroll
                 document.body.style.overflow = "hidden";

                 // Set tampilan loading awal
                 modalBody.innerHTML = `
                <div class="modal-loading-kustom">
                    <div class="spinner-kustom"></div>
                    <p style="font-family: sans-serif; font-size: 14px; color: #666;">Memuat form Sapi...</p>
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
                         const modalTitleElement = modalBody.querySelector('.modal-title');
                         titlemodal.textContent = modalTitleElement.textContent;

                         // 3. Eksekusi semua tag <script> yang ada di dalam HTML baru
                         const scripts = modalBody.querySelectorAll('script');
                         scripts.forEach(oldScript => {
                             const newScript = document.createElement('script');

                             // Salin teks/kode JavaScript di dalamnya
                             newScript.textContent = oldScript.textContent;

                             // Salin atribut lain jika ada (misal: src, data-*, dll)
                             Array.from(oldScript.attributes).forEach(attr => {
                                 newScript.setAttribute(attr.name, attr.value);
                             });

                             // Jalankan script dengan memasukkannya ke dokumen, lalu langsung hapus tag-nya
                             oldScript.parentNode.replaceChild(newScript, oldScript);
                         });
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

         // Menangkap semua tombol dengan class 'btn-edit-sapi'
         document.querySelectorAll('.btn-edit-sapi').forEach(button => {
             button.addEventListener('click', function(e) {
                 e.preventDefault(); // Mencegah lompatan halaman

                 const url = this.getAttribute("data-url");

                 // Tampilkan modal dengan animasi
                 modalOverlay.classList.add("aktif");
                 // Mengunci halaman belakang agar tidak berubah tinggi/scroll
                 document.body.style.overflow = "hidden";

                 // Set tampilan loading awal
                 modalBody.innerHTML = `
                <div class="modal-loading-kustom">
                    <div class="spinner-kustom"></div>
                    <p style="font-family: sans-serif; font-size: 14px; color: #666;">Memuat form Edit sapi...</p>
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
                         const modalTitleElement = modalBody.querySelector('.modal-title');
                         titlemodal.textContent = modalTitleElement.textContent;

                         // 3. Eksekusi semua tag <script> yang ada di dalam HTML baru
                         const scripts = modalBody.querySelectorAll('script');
                         scripts.forEach(oldScript => {
                             const newScript = document.createElement('script');

                             // Salin teks/kode JavaScript di dalamnya
                             newScript.textContent = oldScript.textContent;

                             // Salin atribut lain jika ada (misal: src, data-*, dll)
                             Array.from(oldScript.attributes).forEach(attr => {
                                 newScript.setAttribute(attr.name, attr
                                     .value);
                             });

                             // Jalankan script dengan memasukkannya ke dokumen, lalu langsung hapus tag-nya
                             oldScript.parentNode.replaceChild(newScript, oldScript);
                         });
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
         });

         // Fungsi menutup modal saat klik tombol silang
         modalClose.addEventListener("click", fungsiTutupModal);

         // Fungsi menutup modal saat klik area gelap di luar kotak putih / ini diremark supaya jika click di luar area modal tidak close
         //  window.addEventListener("click", function(event) {
         //      if (event.target === modalOverlay) {
         //          fungsiTutupModal();
         //      }
         //  });

         function fungsiTutupModal() {
             modalOverlay.classList.remove("aktif");
             document.body.style.overflow = ""; // Mengembalikan halaman belakang ke kondisi awal
         }


     });
 </script>
