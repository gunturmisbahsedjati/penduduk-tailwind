<div class="flex items-center justify-between mb-4 sm:mb-6">
    <h2 class="text-lg sm:text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-purple-400 dark:to-blue-400">
        <i class="fa-solid fa-user-plus me-2"></i>Tambah Data Penduduk
    </h2>
    <button type="button" onclick="closeCustomModal('#addPendudukModal')" class="text-slate-400 hover:text-slate-600 dark:hover:text-white transition p-1">
        <i class="fa-solid fa-xmark text-xl"></i>
    </button>
</div>

<form action="data_penduduk.php" method="POST" class="space-y-3 sm:space-y-4">
    <input type="hidden" name="action" value="create">

    <div>
        <label class="block text-xs font-semibold mb-1 text-slate-600 dark:text-slate-300">NIK</label>
        <input type="text" name="nik" required maxlength="16" class="w-full p-2.5 sm:p-3 rounded-xl glass-input text-xs sm:text-sm">
    </div>
    <div>
        <label class="block text-xs font-semibold mb-1 text-slate-600 dark:text-slate-300">Nama Lengkap</label>
        <input type="text" name="nama" required class="w-full p-2.5 sm:p-3 rounded-xl glass-input text-xs sm:text-sm">
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
        <div>
            <label class="block text-xs font-semibold mb-1 text-slate-600 dark:text-slate-300">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full p-2.5 sm:p-3 rounded-xl glass-input text-xs sm:text-sm">
                <option value="Laki-laki" class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white">Laki-laki</option>
                <option value="Perempuan" class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white">Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1 text-slate-600 dark:text-slate-300">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" required class="w-full p-2.5 sm:p-3 rounded-xl glass-input text-xs sm:text-sm">
        </div>
    </div>
    <div>
        <label class="block text-xs font-semibold mb-1 text-slate-600 dark:text-slate-300">Pekerjaan</label>
        <input type="text" name="pekerjaan" required class="w-full p-2.5 sm:p-3 rounded-xl glass-input text-xs sm:text-sm">
    </div>
    <div>
        <label class="block text-xs font-semibold mb-1 text-slate-600 dark:text-slate-300">Alamat</label>
        <textarea name="alamat" required rows="3" class="w-full p-2.5 sm:p-3 rounded-xl glass-input text-xs sm:text-sm"></textarea>
    </div>
    <div class="flex justify-end gap-3 pt-3">
        <button type="button" onclick="closeCustomModal('#addPendudukModal')" class="px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl border border-slate-300 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-xs sm:text-sm transition">Batal</button>
        <button type="submit" class="glass-btn px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl font-semibold text-xs sm:text-sm transition">Simpan Data</button>
    </div>
</form>