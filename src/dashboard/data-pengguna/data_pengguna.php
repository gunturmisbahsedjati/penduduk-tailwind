<?php
include 'config.php';

// Data Pengguna
$result = $conn->query("SELECT * FROM users ORDER BY id DESC");

// Query Statistik Pengguna
$total_users = $result ? $result->num_rows : 0;

$q_admin = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='Admin'");
$total_admin = $q_admin ? $q_admin->fetch_assoc()['total'] : 0;

$q_petugas = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='Petugas'");
$total_petugas = $q_petugas ? $q_petugas->fetch_assoc()['total'] : 0;
?>

<section id="data-pengguna" class="glass-panel rounded-2xl p-4 sm:p-6 overflow-hidden">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-sm sm:text-base bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-purple-400 dark:to-blue-400">
            <i class="fa-solid fa-users-gear me-2"></i>Daftar Data Pengguna
        </h3>
        <!-- Tombol Tambah Data Pengguna -->
        <button type="button" class="glass-btn open-modal-btn px-3 py-2.5 sm:px-5 sm:py-2.5 rounded-xl text-xs font-semibold flex items-center gap-2 transition duration-300" data-target="#addUserModal">
            <i class="fa-solid fa-user-plus"></i>
            <span class="hidden sm:inline">Tambah Pengguna</span>
        </button>
    </div>

    <div class="overflow-x-auto">
        <table id="userTable" class="w-full text-left border-collapse text-xs sm:text-sm">
            <thead>
                <tr class="table-header">
                    <th class="p-3 sm:p-4 whitespace-nowrap">No.</th>
                    <th class="p-3 sm:p-4 whitespace-nowrap">Nama Lengkap</th>
                    <th class="p-3 sm:p-4 whitespace-nowrap">Username</th>
                    <th class="p-3 sm:p-4 whitespace-nowrap">Email</th>
                    <th class="p-3 sm:p-4 whitespace-nowrap">Peran (Role)</th>
                    <th class="p-3 sm:p-4 whitespace-nowrap">Status</th>
                    <th class="p-3 sm:p-4 text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-indigo-100/50 dark:divide-white/5">
                <?php $no = 1;
                if ($result && $result->num_rows > 0):
                    while ($row = $result->fetch_assoc()): ?>
                        <tr class="table-row transition duration-200">
                            <td class="p-3 sm:p-4 text-slate-600 dark:text-slate-300 whitespace-nowrap"><?= $no++ ?></td>
                            <td class="p-3 sm:p-4 font-medium whitespace-nowrap"><?= htmlspecialchars($row['nama']) ?></td>
                            <td class="p-3 sm:p-4 font-semibold text-indigo-600 dark:text-purple-300 whitespace-nowrap"><?= htmlspecialchars($row['username']) ?></td>
                            <td class="p-3 sm:p-4 text-slate-600 dark:text-slate-300 whitespace-nowrap"><?= htmlspecialchars($row['email']) ?></td>
                            <td class="p-3 sm:p-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[10px] sm:text-xs font-semibold <?= $row['role'] == 'Admin' ? 'bg-purple-500/15 text-purple-600 dark:text-purple-300 border border-purple-500/30' : 'bg-blue-500/15 text-blue-600 dark:text-blue-300 border border-blue-500/30' ?>">
                                    <?= htmlspecialchars($row['role']) ?>
                                </span>
                            </td>
                            <td class="p-3 sm:p-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[10px] sm:text-xs font-semibold <?= isset($row['status']) && $row['status'] == 'Aktif' ? 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-300 border border-emerald-500/30' : 'bg-slate-500/15 text-slate-600 dark:text-slate-400 border border-slate-500/30' ?>">
                                    <?= isset($row['status']) ? htmlspecialchars($row['status']) : 'Aktif' ?>
                                </span>
                            </td>
                            <td class="p-3 sm:p-4 whitespace-nowrap">
                                <div class="flex justify-center gap-1.5 sm:gap-2">
                                    <!-- Tombol Edit -->
                                    <button type="button" class="open-modal-btn p-2 rounded-lg bg-amber-500/15 text-amber-600 dark:text-amber-300 border border-amber-500/30 hover:bg-amber-500/30 transition" data-target="#editUserModal" data-id="<?= $row['id'] ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <!-- Tombol Hapus -->
                                    <button type="button" class="open-modal-btn p-2 rounded-lg bg-red-500/15 text-red-600 dark:text-red-300 border border-red-500/30 hover:bg-red-500/30 transition" data-target="#deleteUserModal" data-id="<?= $row['id'] ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="p-4 text-center text-slate-500 dark:text-slate-400">Belum ada data pengguna.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- ==================== TAILWIND MODAL CONTAINERS ==================== -->

<!-- Modal Tambah Pengguna -->
<div id="addUserModal" class="custom-modal fixed inset-0 bg-slate-900/40 dark:bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4 z-50 overflow-y-auto">
    <div class="glass-modal p-5 sm:p-8 rounded-2xl w-full max-w-lg md:max-w-2xl my-8">
        <div id="load-add-user" class="p-6 text-center text-slate-500 dark:text-slate-400">
            <i class="fa-solid fa-spinner fa-spin me-2"></i> Memuat form tambah...
        </div>
        <div id="add-user" style="display: none;" class="add-user-content"></div>
    </div>
</div>

<!-- Modal Edit Pengguna -->
<div id="editUserModal" class="custom-modal fixed inset-0 bg-slate-900/40 dark:bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4 z-50 overflow-y-auto">
    <div class="glass-modal p-5 sm:p-8 rounded-2xl w-full max-w-lg md:max-w-2xl my-8">
        <div id="load-edit-user" class="p-6 text-center text-slate-500 dark:text-slate-400">
            <i class="fa-solid fa-spinner fa-spin me-2"></i> Memuat data edit...
        </div>
        <div id="edit-user" style="display: none;" class="edit-user-content"></div>
    </div>
</div>

<!-- Modal Hapus Pengguna -->
<div id="deleteUserModal" class="custom-modal fixed inset-0 bg-slate-900/40 dark:bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4 z-50">
    <div class="glass-modal p-6 rounded-2xl w-full max-w-sm sm:max-w-md text-center">
        <div id="load-delete-user" class="p-6 text-center text-slate-500 dark:text-slate-400">
            <i class="fa-solid fa-spinner fa-spin me-2"></i> Memuat konfirmasi hapus...
        </div>
        <div id="delete-user" style="display: none;" class="delete-user-content"></div>
    </div>
</div>