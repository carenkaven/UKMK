// =======================================================
//  ANIMASI MASUK HALAMAN
// =======================================================
window.addEventListener("load", () => {
    document.body.style.opacity = "1";
    document.body.style.transition = "opacity 0.6s ease";
});

// =======================================================
//  NAVIGASI: DARI LANDING KE FORM PENDAFTARAN
// =======================================================
function goToForm() {
    window.location.href = "/form";
}

// =======================================================
//  LANDING PAGE: INTERAKSI DAFTAR UKM
// =======================================================
document.querySelectorAll(".ukm-card button").forEach((button) => {
    button.addEventListener("click", () => {
        const namaUKM = button.textContent.trim();
        const deskripsi = button.getAttribute("data-desc") || "-";
        const jadwal = button.getAttribute("data-jadwal") || "-";
        const prestasi = button.getAttribute("data-prestasi") || "-";
        const ketua = button.getAttribute("data-ketua") || "-";
        const kontak = button.getAttribute("data-kontak") || "-";

        Swal.fire({
            title: `<strong>${namaUKM}</strong>`,
            html: `
                <div style="text-align: left; font-size: 14px; line-height: 1.6;">
                    <p style="margin-bottom: 10px;">${deskripsi}</p>
                    <hr style="border: 0; border-top: 1px solid #eee; margin: 10px 0;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="width: 100px; font-weight: 600; color: #555;">📅 Jadwal</td>
                            <td>: ${jadwal}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #555;">🏆 Prestasi</td>
                            <td>: ${prestasi}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #555;">👤 Ketua</td>
                            <td>: ${ketua}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #555;">📞 Kontak</td>
                            <td>: ${kontak}</td>
                        </tr>
                    </table>
                </div>
            `,
            width: 600,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Tutup',
            confirmButtonColor: '#0d6efd',
            customClass: {
                title: 'swal-title-class',
                popup: 'swal-wide-popup'
            }
        });
    });
});

// =======================================================
//  FORM PENDAFTARAN: MULTI STEP FORM
// =======================================================
// Menggunakan IIFE atau block scope untuk menghindari konflik variabel global jika script di-include berulang
(function() {
    const page1 = document.getElementById("page1");
    const page2 = document.getElementById("page2");
    const nextBtn = document.getElementById("nextBtn");
    const backBtn = document.getElementById("backBtn");
    const steps = document.querySelectorAll(".step");

    // Helper: Validasi input required
    function validateInputs(container) {
        const inputs = container.querySelectorAll("input[required], select[required]");
        let valid = true;
        inputs.forEach((input) => {
            if (!input.value.trim()) {
                input.style.borderColor = "red";
                // Tambahkan event listener agar warna kembali normal saat diketik
                input.addEventListener('input', () => input.style.borderColor = "#ddd", {once: true});
                valid = false;
            } else {
                input.style.borderColor = "#ddd";
            }
        });
        return valid;
    }

    // Tombol NEXT — pindah dari Data Personal ke Form Confirmation
    if (nextBtn && page1 && page2) {
        nextBtn.addEventListener("click", () => {
            if (validateInputs(page1)) {
                page1.classList.remove("active");
                page2.classList.add("active");
                if(steps[0]) steps[0].classList.remove("active");
                if(steps[1]) steps[1].classList.add("active");
            } else {
                Swal.fire({
                    title: 'Data Belum Lengkap!',
                    text: 'Harap isi semua data di bagian Data Personal yang bertanda *.',
                    icon: 'warning',
                    confirmButtonColor: '#004aad'
                });
            }
        });
    }

    // Tombol BACK — kembali ke Data Personal
    if (backBtn && page1 && page2) {
        backBtn.addEventListener("click", () => {
            page2.classList.remove("active");
            page1.classList.add("active");
            if(steps[1]) steps[1].classList.remove("active");
            if(steps[0]) steps[0].classList.add("active");
        });
    }

    // =======================================================
    //  UPLOAD FOTO (Drag & Drop + Preview)
    // =======================================================
    const fileInput = document.getElementById("photoInput");
    const dropZone = document.getElementById("dropZone");
    const preview = document.getElementById("preview");

    if (fileInput && dropZone) {
        // Prevent default browser behavior for drag events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Highlight drop zone
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.style.background = "#eaf2ff";
                dropZone.style.borderColor = "#0a58ca";
            }, false);
        });

        // Unhighlight drop zone
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.style.background = "#f8fbff";
                dropZone.style.borderColor = "#0d6efd";
            }, false);
        });

        // Handle Drop
        dropZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if(files.length > 0) {
                fileInput.files = files;
                handleFiles(files);
            }
        });

        // Handle Click - Trigger Input
        dropZone.addEventListener('click', (e) => {
            // Cek jika yang diklik bukan input file itu sendiri (untuk menghindari recursion jika input ada di dalam label)
            if (e.target !== fileInput) {
                fileInput.click();
            }
        });

        // Handle Input Change
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        function handleFiles(files) {
            if (files[0]) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onloadend = function() {
                        const img = document.createElement('img');
                        img.src = reader.result;
                        preview.innerHTML = ''; // Clear previous
                        preview.appendChild(img);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format Salah',
                        text: 'Harap upload file gambar (JPG/PNG).',
                    });
                    fileInput.value = ''; // Reset input
                    preview.innerHTML = '';
                }
            }
        }
    }

    // =======================================================
    //  SUBMIT FORM PENDAFTARAN
    // =======================================================
    const form = document.getElementById("ukmForm");
    if (form) {
        form.addEventListener("submit", (e) => {
            if (page2 && page2.classList.contains("active")) {
                if (!validateInputs(page2)) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Data Belum Lengkap!',
                        text: 'Mohon lengkapi semua data pada Form Confirmation!',
                        icon: 'warning',
                        confirmButtonColor: '#004aad'
                    });
                }
                // Jika valid, biarkan submit berjalan (backend akan handle)
            } else {
                // Jika user mencoba submit tapi belum di step terakhir (misal enter key)
                e.preventDefault();
                Swal.fire({
                     icon: 'info',
                     text: 'Silakan selesaikan langkah pendaftaran.'
                });
            }
        });
    }

})();
