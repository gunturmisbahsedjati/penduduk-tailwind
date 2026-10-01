// =====================================
// SIDEBAR MOBILE TOGGLE LOGIC
// =====================================
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');
const openSidebarBtn = document.getElementById('openSidebar');
const closeSidebarBtn = document.getElementById('closeSidebar');

function toggleSidebar() {
    sidebar.classList.toggle('-translate-x-full');
    sidebarOverlay.classList.toggle('hidden');
}

openSidebarBtn?.addEventListener('click', toggleSidebar);
closeSidebarBtn?.addEventListener('click', toggleSidebar);
sidebarOverlay?.addEventListener('click', toggleSidebar);

// Tutup sidebar saat item diklik di tampilan mobile
document.querySelectorAll('.sidebar-item').forEach(item => {
    item.addEventListener('click', function () {
        if (window.innerWidth < 768) {
            toggleSidebar();
        }
    });
});


// =====================================
// DATATABLES INIT (RESPONSIVE)
// =====================================
$(document).ready(function () {
    $('#pendudukTable').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        responsive: true,
        language: {
            sEmptyTable: "Belum ada data penduduk.",
            sProcessing: "Sedang memproses...",
            sLengthMenu: "_MENU_ data",
            sZeroRecords: "Tidak ditemukan data",
            sInfo: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            sInfoEmpty: "Menampilkan 0 - 0 dari 0 data",
            sInfoFiltered: "(disaring dari _MAX_ total data)",
            sSearch: "Cari:",
            oPaginate: {
                sFirst: "Awal",
                sPrevious: "«",
                sNext: "»",
                sLast: "Akhir"
            }
        }
    });
});

// =====================================
// LOGIKA DARK / LIGHT MODE & LOCALSTORAGE
// =====================================
const html = document.documentElement;
const themeToggleBtn = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');
const themeText = document.getElementById('themeText');

function applyTheme(theme) {
    if (theme === 'dark') {
        html.classList.add('dark');
        themeIcon.className = 'fa-solid fa-moon text-indigo-400';
        if (themeText) themeText.innerText = 'Dark';
    } else {
        html.classList.remove('dark');
        themeIcon.className = 'fa-solid fa-sun text-amber-500';
        if (themeText) themeText.innerText = 'Light';
    }
}

const savedTheme = localStorage.getItem('theme') || 'light';
applyTheme(savedTheme);

themeToggleBtn?.addEventListener('click', () => {
    const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

    localStorage.setItem('theme', newTheme);
    applyTheme(newTheme);
});

// =====================================
// MODAL FORM & DELETE LOGIC
// =====================================
const formModal = document.getElementById('formModal');
const deleteModal = document.getElementById('deleteModal');

function openFormModal() {
    document.getElementById('modalTitle').innerHTML = '<i class="fa-solid fa-user-plus me-2"></i>Tambah Data Penduduk';
    document.getElementById('formAction').value = 'create';
    document.getElementById('pendudukId').value = '';

    document.getElementById('nik').value = '';
    document.getElementById('nama').value = '';
    document.getElementById('jenis_kelamin').value = 'Laki-laki';
    document.getElementById('tanggal_lahir').value = '';
    document.getElementById('pekerjaan').value = '';
    document.getElementById('alamat').value = '';

    formModal.classList.remove('hidden');
    formModal.classList.add('flex');
}

function closeFormModal() {
    formModal.classList.add('hidden');
    formModal.classList.remove('flex');
}

function editData(data) {
    document.getElementById('modalTitle').innerHTML = '<i class="fa-solid fa-pen-to-square me-2"></i>Edit Data Penduduk';
    document.getElementById('formAction').value = 'edit';
    document.getElementById('pendudukId').value = data.id;

    document.getElementById('nik').value = data.nik;
    document.getElementById('nama').value = data.nama;
    document.getElementById('jenis_kelamin').value = data.jenis_kelamin;
    document.getElementById('tanggal_lahir').value = data.tanggal_lahir;
    document.getElementById('pekerjaan').value = data.pekerjaan;
    document.getElementById('alamat').value = data.alamat;

    formModal.classList.remove('hidden');
    formModal.classList.add('flex');
}

function confirmDelete(id, nama) {
    document.getElementById('deleteId').value = id;
    document.getElementById('deleteNama').innerText = nama;

    deleteModal.classList.remove('hidden');
    deleteModal.classList.add('flex');
}

function closeDeleteModal() {
    deleteModal.classList.add('hidden');
    deleteModal.classList.remove('flex');
}


$(document).ready(function () {

    // Helper Fungsi Buka Modal Tailwind
    function openModal(modalSelector) {
        $(modalSelector).removeClass('hidden').addClass('flex');
    }

    // Helper Fungsi Tutup Modal Tailwind
    window.closeCustomModal = function (modalSelector) {
        if (modalSelector) {
            $(modalSelector).addClass('hidden').removeClass('flex');
        } else {
            $('.custom-modal').addClass('hidden').removeClass('flex');
        }
    };

    // Event Delegasi Buka Modal saat Tombol Ditekan
    $(document).on('click', '.open-modal-btn', function () {
        var targetModal = $(this).data('target');
        var id = $(this).data('id');

        openModal(targetModal);

        // 1. Modal Tambah Penduduk
        if (targetModal === '#addPendudukModal') {
            document.getElementById("load-add-penduduk").style.display = "block";
            document.getElementById("add-penduduk").style.display = "none";

            $.ajax({
                url: 'dashboard/data-penduduk/tambah_penduduk.php',
                type: 'GET',
                success: function (data) {
                    document.getElementById("load-add-penduduk").style.display = "none";
                    document.getElementById("add-penduduk").style.display = "block";
                    $('.add-penduduk-content').html(data);
                }
            });
        }

        // 2. Modal Edit Penduduk
        if (targetModal === '#editPendudukModal') {
            document.getElementById("load-edit-penduduk").style.display = "block";
            document.getElementById("edit-penduduk").style.display = "none";

            $.ajax({
                url: 'dashboard/data-penduduk/edit_penduduk.php',
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    document.getElementById("load-edit-penduduk").style.display = "none";
                    document.getElementById("edit-penduduk").style.display = "block";
                    $('.edit-penduduk-content').html(data);
                }
            });
        }

        // 3. Modal Hapus Penduduk
        if (targetModal === '#deletePendudukModal') {
            document.getElementById("load-delete-penduduk").style.display = "block";
            document.getElementById("delete-penduduk").style.display = "none";

            $.ajax({
                url: 'dashboard/data-penduduk/hapus_penduduk.php',
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    document.getElementById("load-delete-penduduk").style.display = "none";
                    document.getElementById("delete-penduduk").style.display = "block";
                    $('.delete-penduduk-content').html(data);
                }
            });
        }
    });

    $('.custom-modal').on('click', function (e) {
        // Cek jika elemen yang diklik adalah area luar (backdrop)
        if ($(e.target).hasClass('custom-modal')) {
            var $modalDialog = $(this).find('.glass-modal');

            // Tambahkan class animasi getar
            $modalDialog.addClass('animate-shake');

            // Hapus class animasi setelah durasi animasi selesai (350ms)
            setTimeout(function () {
                $modalDialog.removeClass('animate-shake');
            }, 350);
        }
    });
});