<!-- DASHBOARD STATS GRID (Adaptif: 1-col HP, 2-col Tablet, 3-col Desktop) -->
<section id="dashboard" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
    <!-- Total Penduduk -->
    <div class="glass-panel p-4 sm:p-5 rounded-2xl flex items-center gap-4 hover:scale-[1.02] transition duration-300">
        <div class="p-3.5 sm:p-4 rounded-xl bg-indigo-500/10 dark:bg-purple-500/20 text-indigo-600 dark:text-purple-400">
            <i class="fa-solid fa-users text-xl sm:text-2xl"></i>
        </div>
        <div>
            <span class="text-xs text-slate-500 dark:text-slate-400 block font-medium">Total Penduduk</span>
            <span class="text-xl sm:text-2xl font-bold"><?= 23 ?> <span class="text-xs font-normal text-slate-500">Jiwa</span></span>
        </div>
    </div>

    <!-- Total Penduduk Laki-Laki -->
    <div class="glass-panel p-4 sm:p-5 rounded-2xl flex items-center gap-4 hover:scale-[1.02] transition duration-300">
        <div class="p-3.5 sm:p-4 rounded-xl bg-blue-500/10 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400">
            <i class="fa-solid fa-mars text-xl sm:text-2xl"></i>
        </div>
        <div>
            <span class="text-xs text-slate-500 dark:text-slate-400 block font-medium">Laki-Laki</span>
            <span class="text-xl sm:text-2xl font-bold text-blue-600 dark:text-blue-400"><?= 23 ?> <span class="text-xs font-normal text-slate-500 dark:text-slate-400">Jiwa</span></span>
        </div>
    </div>

    <!-- Total Penduduk Perempuan -->
    <div class="glass-panel p-4 sm:p-5 rounded-2xl flex items-center gap-4 hover:scale-[1.02] transition duration-300 sm:col-span-2 lg:col-span-1">
        <div class="p-3.5 sm:p-4 rounded-xl bg-pink-500/10 dark:bg-pink-500/20 text-pink-600 dark:text-pink-400">
            <i class="fa-solid fa-venus text-xl sm:text-2xl"></i>
        </div>
        <div>
            <span class="text-xs text-slate-500 dark:text-slate-400 block font-medium">Perempuan</span>
            <span class="text-xl sm:text-2xl font-bold text-pink-600 dark:text-pink-400"><?= 23 ?> <span class="text-xs font-normal text-slate-500 dark:text-slate-400">Jiwa</span></span>
        </div>
    </div>
</section>