<?php
include '../../config.php';
$id = (int)($_GET['id'] ?? 0);
$query = $conn->query("SELECT * FROM penduduk WHERE id = $id");
$row = $query->fetch_assoc();
?>
<div class="w-12 h-12 sm:w-16 sm:h-16 bg-red-500/15 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 border border-red-500/30 text-xl sm:text-2xl">
    <i class="fa-solid fa-triangle-exclamation"></i>
</div>
<h3 class="text-base sm:text-lg font-bold mb-2">Konfirmasi Hapus</h3>
<p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mb-6">
    Apakah Anda yakin ingin menghapus data penduduk <span class="font-semibold text-indigo-600 dark:text-purple-400"><?= htmlspecialchars($row['nama']) ?></span>?
</p>

<form action="data_penduduk.php" method="POST" class="flex justify-center gap-3">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <button type="button" onclick="closeCustomModal('#deletePendudukModal')" class="px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl border border-slate-300 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-xs sm:text-sm transition">Batal</button>
    <button type="submit" class="px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold text-xs sm:text-sm transition shadow-lg shadow-red-600/30">Hapus</button>
</form>