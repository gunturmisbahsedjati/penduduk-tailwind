<?php
session_start();
include 'config.php';

$error = '';

// Jika sudah login, redirect ke halaman utama
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $query = $conn->query("SELECT * FROM users WHERE username = '$username' LIMIT 1");

        if ($query && $query->num_rows > 0) {
            $user = $query->fetch_assoc();

            // Verifikasi Password (Password Hash)
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama'] = $user['nama'] ?? $user['username'];

                header('Location: index.php');
                exit();
            } else {
                $error = 'Username atau password salah!';
            }
        } else {
            $error = 'Username atau password salah!';
        }
    } else {
        $error = 'Harap isi semua kolom!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Data Penduduk</title>

    <!-- Script Cek Theme Sebelum Render -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <link rel="shortcut icon" href="assets/image/logo.png" type="image/x-icon">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ANIMASI GRADASI BACKGROUND UNGU KE BIRU */
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animated-gradient-bg {
            /* Perpaduan warna gradasi ungu & biru (Light Mode) */
            background: linear-gradient(-45deg, #4f46e5, #7c3aed, #2563eb, #3b82f6, #9333ea);
            background-size: 400% 400%;
            animation: gradientAnimation 12s ease infinite;
        }

        .dark .animated-gradient-bg {
            /* Perpaduan warna gradasi ungu & biru yang lebih gelap (Dark Mode) */
            background: linear-gradient(-45deg, #0f172a, #311042, #1e1b4b, #09203f, #1e1035);
            background-size: 400% 400%;
            animation: gradientAnimation 12s ease infinite;
        }

        /* CSS Glassmorphism Style */
        .glass-panel {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.35);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .dark .glass-panel {
            background: rgba(15, 23, 42, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.85);
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
            outline: none;
        }

        .dark .glass-input {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f8fafc;
        }

        .dark .glass-input:focus {
            background: rgba(30, 41, 59, 0.9);
            border-color: #818cf8;
            box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.25);
        }

        .glass-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #9333ea 100%);
            color: #ffffff;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4);
        }

        .glass-btn:hover {
            opacity: 0.95;
            transform: translateY(-1px);
        }

        /* Floating Theme Button Style */
        .glass-float-btn {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15);
        }

        .dark .glass-float-btn {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        /* Animasi Bergetar (Shake) Jika Error */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-8px);
            }

            40%,
            80% {
                transform: translateX(8px);
            }
        }

        .animate-shake {
            animation: shake 0.35s ease-in-out;
        }
    </style>
</head>

<body class="animated-gradient-bg text-slate-800 dark:text-slate-100 min-h-screen flex items-center justify-center p-4 transition-colors duration-500 relative">

    <!-- FLOATING BUTTON DARK/LIGHT MODE -->
    <div class="fixed top-5 right-5 z-50">
        <button id="themeToggleBtn" type="button" class="glass-float-btn p-3 rounded-full text-white dark:text-slate-200 hover:scale-110 active:scale-95 transition-all duration-300 flex items-center justify-center w-12 h-12">
            <!-- Ikon Bulan (Light Mode) -->
            <i class="fa-solid fa-moon text-lg dark:hidden"></i>
            <!-- Ikon Matahari (Dark Mode) -->
            <i class="fa-solid fa-sun text-lg hidden dark:block text-amber-400"></i>
        </button>
    </div>

    <!-- Container Utama -->
    <div class="w-full max-w-md">

        <!-- Kartu Login -->
        <div class="glass-panel p-6 sm:p-8 rounded-3xl relative overflow-hidden <?= !empty($error) ? 'animate-shake' : '' ?>">

            <!-- Header Kartu -->
            <div class="text-center mb-6 sm:mb-8">
                <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto mb-3 rounded-2xl bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white text-2xl sm:text-3xl shadow-lg shadow-indigo-500/40">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                    Selamat Datang
                </h1>
                <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 mt-1">
                    Silakan masuk ke Sistem Pendataan Penduduk
                </p>
            </div>

            <!-- Pesan Error -->
            <?php if (!empty($error)): ?>
                <div class="mb-5 p-3.5 rounded-xl bg-red-500/20 backdrop-blur-md border border-red-500/40 text-red-900 dark:text-red-300 text-xs sm:text-sm flex items-center gap-2.5 font-medium">
                    <i class="fa-solid fa-circle-exclamation text-base flex-shrink-0"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <!-- Form Login -->
            <form action="login.php" method="POST" class="space-y-4">

                <!-- Input Username -->
                <div>
                    <label for="username" class="block text-xs font-semibold mb-1.5 text-slate-800 dark:text-slate-200">
                        Username
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500 dark:text-slate-400">
                            <i class="fa-solid fa-user text-sm"></i>
                        </span>
                        <input type="text" id="username" name="username" required placeholder="Masukkan username Anda" class="w-full pl-10 pr-4 py-2.5 sm:py-3 rounded-xl glass-input text-xs sm:text-sm font-medium">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <label for="password" class="block text-xs font-semibold mb-1.5 text-slate-800 dark:text-slate-200">
                        Password
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500 dark:text-slate-400">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                        <input type="password" id="password" name="password" required placeholder="••••••••" class="w-full pl-10 pr-10 py-2.5 sm:py-3 rounded-xl glass-input text-xs sm:text-sm font-medium">

                        <!-- Toggle Tampil/Sembunyikan Password -->
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition">
                            <i class="fa-solid fa-eye text-sm" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-2">
                    <button type="submit" class="glass-btn w-full py-3 rounded-xl font-semibold text-xs sm:text-sm transition duration-300 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span>Masuk Akun</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer Hak Cipta -->
        <p class="text-center text-xs text-white/80 dark:text-slate-400 mt-6 drop-shadow">
            &copy; <?= date('Y') ?> Sistem Informasi Penduduk. All rights reserved.
        </p>
    </div>

    <!-- Script JavaScript -->
    <script>
        // 1. Toggle Password
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });

        // 2. Floating Toggle Dark / Light Mode
        const themeToggleBtn = document.getElementById('themeToggleBtn');

        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    </script>
</body>

</html>