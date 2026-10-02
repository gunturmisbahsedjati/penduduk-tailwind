<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pendataan Penduduk</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <!-- Font Fira Code -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <link rel="shortcut icon" href="assets/image/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/custom.css?<?= time(); ?>">
</head>

<body class="min-h-screen text-slate-800 dark:text-slate-100 flex flex-col md:flex-row antialiased relative">

    <!-- Glowing Dynamic Orbs -->
    <div class="fixed top-10 left-10 w-48 h-48 sm:w-72 sm:h-72 bg-purple-400/30 dark:bg-purple-600/30 rounded-full blur-3xl -z-10 pointer-events-none transition-colors duration-500"></div>
    <div class="fixed bottom-10 right-10 w-64 h-64 sm:w-96 sm:h-96 bg-blue-400/20 dark:bg-blue-600/20 rounded-full blur-3xl -z-10 pointer-events-none transition-colors duration-500"></div>

    <!-- OVERLAY SIDEBAR MOBILE -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden md:hidden"></div>

    <!-- SIDEBAR -->
    <aside id="sidebar" class="fixed md:sticky top-0 left-0 z-50 w-72 md:w-64 h-screen glass-panel p-5 flex flex-col justify-between shrink-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
        <div>
            <!-- Brand Logo / Header & Close Button Mobile -->
            <?php include_once 'layout/header.php' ?>

            <!-- Navigation Menu -->
            <?php include_once 'layout/sidebar.php' ?>
        </div>

        <!-- Sidebar Footer -->
        <div class="pt-4 border-t border-indigo-100/50 dark:border-white/10 text-xs text-slate-500 dark:text-slate-400">
            <p class="font-semibold text-slate-700 dark:text-slate-200">Admin Panel v1.0</p>
            <p class="text-[10px]">© 2026 All rights reserved</p>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 min-w-0 p-4 sm:p-6 md:p-8 flex flex-col gap-6">

        <!-- NAVBAR / TOP HEADER -->
        <header class="glass-panel rounded-2xl p-4 sm:p-5 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <!-- Hamburger Button (Mobile Only) -->
                <button id="openSidebar" class="md:hidden p-2.5 rounded-xl glass-panel text-slate-700 dark:text-slate-200 hover:scale-105 transition">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <div>
                    <h1 class="text-base sm:text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-purple-400 dark:to-blue-400 leading-tight">
                        Dashboard Utama
                    </h1>
                    <p class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 hidden sm:block">Kelola data kependudukan secara terpusat dan efisien</p>
                </div>
            </div>

            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Theme Toggle Button -->
                <button id="themeToggle" class="p-2.5 sm:px-4 sm:py-2.5 rounded-xl glass-panel text-slate-700 dark:text-slate-200 hover:scale-105 transition flex items-center gap-2">
                    <i id="themeIcon" class="fa-solid fa-sun text-amber-500"></i>
                    <!-- <span id="themeText" class="text-xs font-semibold hidden lg:inline">Light</span> -->
                </button>
            </div>
        </header>
        <main class="relative min-h-[400px] w-full flex-1">

            <!-- PROGRESS LOADER KHUSUS KONTEN -->
            <div id="contentLoader" class="absolute inset-0 z-30 flex flex-col items-center justify-center animated-loader-bg rounded-2xl transition-opacity duration-300">
                <div class="loader-glass-card p-6 sm:p-8 rounded-3xl flex flex-col items-center max-w-xs w-full shadow-xl relative overflow-hidden">
                    <div class="relative mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xl shadow-lg shadow-indigo-500/40 animate-bounce">
                            <i class="fa-solid fa-spinner animate-spin"></i>
                        </div>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800 dark:text-white mb-1">Memuat Konten...</h3>

                    <!-- Progress Bar Track -->
                    <div class="w-full bg-slate-200/60 dark:bg-slate-700/60 h-2 rounded-full overflow-hidden relative my-3">
                        <div id="contentProgressBar" class="h-full rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 transition-all duration-150 ease-out w-0 overflow-hidden relative">
                            <div class="shimmer-effect absolute inset-0"></div>
                        </div>
                    </div>

                    <span id="contentProgressText" class="text-xs font-semibold text-slate-600 dark:text-slate-300">0%</span>
                </div>
            </div>

            <!-- HASIL LOAD ROUTES.PHP -->
            <div id="routesContent">
                <?php include_once 'dashboard/routes.php'; ?>
            </div>

        </main>


        <!-- TABLE DATA SECTION -->
    </div>

    <!-- jQuery & DataTables JS CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <?php include_once 'layout/toast.php'; ?>
    <!-- Custom JavaScript -->
    <script src="assets/js/custom.js?<?= time(); ?>"></script>
    <?php if (isset($_SESSION['toast'])): ?>
        <script>
            $(document).ready(function() {
                showToast(
                    '<?= $_SESSION['toast']['type']; ?>',
                    '<?= $_SESSION['toast']['title']; ?>',
                    '<?= $_SESSION['toast']['message']; ?>'
                );
            });
        </script>
        <?php unset($_SESSION['toast']); ?>
    <?php endif; ?>

</body>

</html>