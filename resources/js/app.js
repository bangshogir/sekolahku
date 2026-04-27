import './bootstrap';

// Alpine.js — sudah di-include via Livewire 3 (livewire/livewire)
// Livewire otomatis men-inject Alpine.js saat menggunakan @livewireScripts

// Global window helpers (jika dibutuhkan)
window.copyToClipboard = function (text) {
    navigator.clipboard.writeText(text).then(() => {
        console.log('Copied:', text);
    });
};
