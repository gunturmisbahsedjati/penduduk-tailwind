<?php
// Ambil route dari query string/URL (default: 'home')
$current_page = $_GET['do'] ?? 'home';
?>

<nav class="space-y-2">
    <!-- Menu Dashboard -->
    <a href="/" class="sidebar-item <?= ($current_page === '/' || $current_page === '') ? 'active' : '' ?> flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-sm transition duration-300">
        <i class="fa-solid fa-chart-pie text-base"></i>
        <span>Dashboard</span>
    </a>

    <!-- Menu Data Penduduk -->
    <a href="listPenduduk" class="sidebar-item <?= ($current_page === 'listPenduduk') ? 'active' : '' ?> flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-sm transition duration-300">
        <i class="fa-solid fa-address-card text-base"></i>
        <span>Data Penduduk</span>
    </a>
    <a href="listPengguna" class="sidebar-item <?= ($current_page === 'listPengguna') ? 'active' : '' ?> flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-sm transition duration-300">
        <i class="fa-solid fa-users text-base"></i>
        <span>Data Pengguna</span>
    </a>
</nav>