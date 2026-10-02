<?php
include 'config.php';

// Data Penduduk
$result = $conn->query("SELECT * FROM penduduk ORDER BY id DESC");

// Query Statistik Penduduk
$total_penduduk = $result->num_rows;

$q_laki = $conn->query("SELECT COUNT(*) as total FROM penduduk WHERE jenis_kelamin='Laki-laki'");
$total_laki = $q_laki ? $q_laki->fetch_assoc()['total'] : 0;

$q_perempuan = $conn->query("SELECT COUNT(*) as total FROM penduduk WHERE jenis_kelamin='Perempuan'");
$total_perempuan = $q_perempuan ? $q_perempuan->fetch_assoc()['total'] : 0;
?>

<section id="data-penduduk" class="glass-panel rounded-2xl p-4 sm:p-6 overflow-hidden">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-sm sm:text-base bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-purple-400 dark:to-blue-400">
            <i class="fa-solid fa-table me-2"></i>Daftar Data Penduduk
        </h3>
        <!-- Tombol Tambah Data Penduduk -->
        <button type="button" class="glass-btn open-modal-btn px-3 py-2.5 sm:px-5 sm:py-2.5 rounded-xl text-xs font-semibold flex items-center gap-2 transition duration-300" data-target="#addPendudukModal">
            <i class="fa-solid fa-user-plus"></i>
            <span class="hidden sm:inline">Tambah Penduduk</span>
        </button>
    </div>

    <div class="overflow-x-auto">
        <table id="pendudukTable" class="w-full text-left border-collapse text-xs sm:text-sm">
            <thead>
                <tr class="table-header">
                    <th class="p-3 sm:p-4 whitespace-nowrap">No.</th>
                    <th class="p-3 sm:p-4 whitespace-nowrap">NIK</th>
                    <th class="p-3 sm:p-4 whitespace-nowrap">Nama Lengkap</th>
                    <th class="p-3 sm:p-4 whitespace-nowrap">L/P</th>
                    <th class="p-3 sm:p-4 whitespace-nowrap">Tgl Lahir</th>
                    <th class="p-3 sm:p-4 whitespace-nowrap">Pekerjaan</th>
                    <th class="p-3 sm:p-4 whitespace-nowrap">Alamat</th>
                    <th class="p-3 sm:p-4 text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-indigo-100/50 dark:divide-white/5">
                <?php $no = 1;
                if ($result->num_rows > 0):
                    while ($row = $result->fetch_assoc()): ?>
                        <tr class="table-row transition duration-200">
                            <td class="p-3 sm:p-4 text-slate-600 dark:text-slate-300 whitespace-nowrap"><?= $no++ ?></td>
                            <td class="p-3 sm:p-4 font-semibold text-indigo-600 dark:text-purple-300 whitespace-nowrap"><?= htmlspecialchars($row['nik']) ?></td>
                            <td class="p-3 sm:p-4 font-medium whitespace-nowrap"><?= htmlspecialchars($row['nama']) ?></td>
                            <td class="p-3 sm:p-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[10px] sm:text-xs font-semibold <?= $row['jenis_kelamin'] == 'Laki-laki' ? 'bg-blue-500/15 text-blue-600 dark:text-blue-300 border border-blue-500/30' : 'bg-pink-500/15 text-pink-600 dark:text-pink-300 border border-pink-500/30' ?>">
                                    <?= $row['jenis_kelamin'] ?>
                                </span>
                            </td>
                            <td class="p-3 sm:p-4 text-slate-600 dark:text-slate-300 whitespace-nowrap"><?= $row['tanggal_lahir'] ?></td>
                            <td class="p-3 sm:p-4 text-slate-600 dark:text-slate-300 whitespace-nowrap"><?= htmlspecialchars($row['pekerjaan']) ?></td>
                            <td class="p-3 sm:p-4 text-slate-500 dark:text-slate-400 max-w-xs truncate"><?= htmlspecialchars($row['alamat']) ?></td>
                            <td class="p-3 sm:p-4 whitespace-nowrap">
                                <div class="flex justify-center gap-1.5 sm:gap-2">
                                    <!-- Tombol Edit -->
                                    <button type="button" class="open-modal-btn p-2 rounded-lg bg-amber-500/15 text-amber-600 dark:text-amber-300 border border-amber-500/30 hover:bg-amber-500/30 transition" data-target="#editPendudukModal" data-id="<?= $row['id'] ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <!-- Tombol Hapus -->
                                    <button type="button" class="open-modal-btn p-2 rounded-lg bg-red-500/15 text-red-600 dark:text-red-300 border border-red-500/30 hover:bg-red-500/30 transition" data-target="#deletePendudukModal" data-id="<?= $row['id'] ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- ==================== TAILWIND MODAL CONTAINERS ==================== -->

<!-- Modal Tambah Penduduk -->
<div id="addPendudukModal" class="custom-modal fixed inset-0 bg-slate-900/40 dark:bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4 z-50 overflow-y-auto">
    <div class="glass-modal p-5 sm:p-8 rounded-2xl w-full max-w-lg md:max-w-2xl my-8">
        <div id="load-add-penduduk" class="p-6 text-center text-slate-500 dark:text-slate-400">
            <i class="fa-solid fa-spinner fa-spin me-2"></i> Memuat form tambah...
        </div>
        <div id="add-penduduk" style="display: none;" class="add-penduduk-content"></div>
    </div>
</div>

<!-- Modal Edit Penduduk -->
<div id="editPendudukModal" class="custom-modal fixed inset-0 bg-slate-900/40 dark:bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4 z-50 overflow-y-auto">
    <div class="glass-modal p-5 sm:p-8 rounded-2xl w-full max-w-lg md:max-w-2xl my-8">
        <div id="load-edit-penduduk" class="p-6 text-center text-slate-500 dark:text-slate-400">
            <i class="fa-solid fa-spinner fa-spin me-2"></i> Memuat data edit...
        </div>
        <div id="edit-penduduk" style="display: none;" class="edit-penduduk-content"></div>
    </div>
</div>

<!-- Modal Hapus Penduduk -->
<div id="deletePendudukModal" class="custom-modal fixed inset-0 bg-slate-900/40 dark:bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4 z-50">
    <div class="glass-modal p-6 rounded-2xl w-full max-w-sm sm:max-w-md text-center">
        <div id="load-delete-penduduk" class="p-6 text-center text-slate-500 dark:text-slate-400">
            <i class="fa-solid fa-spinner fa-spin me-2"></i> Memuat konfirmasi hapus...
        </div>
        <div id="delete-penduduk" style="display: none;" class="delete-penduduk-content"></div>
    </div>
</div>