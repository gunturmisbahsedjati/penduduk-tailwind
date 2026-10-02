<!-- CONTAINER FLOATING TOAST NOTIFICATION -->
<div id="toastContainer" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 max-w-sm w-full pointer-events-none">
    <!-- Toast akan dimunculkan secara dinamis melalui JavaScript -->
</div>

<style>
    /* CSS Glassmorphism & Shadow Toast */
    .toast-glass {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.15);
    }

    .dark .toast-glass {
        background: rgba(30, 41, 59, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.5);
    }

    /* Animasi Masuk dan Keluar */
    @keyframes toastIn {
        from {
            opacity: 0;
            transform: translateX(100%) scale(0.9);
        }

        to {
            opacity: 1;
            transform: translateX(0) scale(1);
        }
    }

    @keyframes toastOut {
        from {
            opacity: 1;
            transform: translateX(0) scale(1);
        }

        to {
            opacity: 0;
            transform: translateX(100%) scale(0.9);
        }
    }

    .toast-enter {
        animation: toastIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .toast-exit {
        animation: toastOut 0.3s cubic-bezier(0.7, 0, 0.84, 0) forwards;
    }
</style>