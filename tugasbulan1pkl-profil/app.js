(function () {
  // Pastikan script ini tidak jalan dua kali
  if (window._pwaScriptLoaded) return;
  window._pwaScriptLoaded = true;

  // Pastikan deferredPrompt hanya didefinisikan sekali
  if (typeof window.deferredPrompt === 'undefined') {
    window.deferredPrompt = null;
  }

  // Daftarkan Service Worker
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('sw.js')
      .then(() => console.log('Service Worker terdaftar!'))
      .catch(err => console.log('SW gagal:', err));
  }

  // Ambil elemen popup dan tombol
  const installPopup = document.getElementById('installPopup');
  const installBtn = document.getElementById('installBtn');

  // Event sebelum install (ditrigger saat browser siap install PWA)
  window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    window.deferredPrompt = e;
    if (installPopup) {
      installPopup.style.display = 'block';
    }
  });

  // Event klik tombol install
  if (installBtn) {
    installBtn.addEventListener('click', async () => {
      if (installPopup) installPopup.style.display = 'none';
      if (window.deferredPrompt) {
        window.deferredPrompt.prompt();
        const { outcome } = await window.deferredPrompt.userChoice;
        console.log(`User memilih: ${outcome}`);
        window.deferredPrompt = null; // reset setelah digunakan
      }
    });
  }
})();
(function () {
  // Pastikan script ini tidak jalan dua kali
  if (window._pwaScriptLoaded) return;
  window._pwaScriptLoaded = true;

  // Pastikan deferredPrompt hanya didefinisikan sekali
  if (typeof window.deferredPrompt === 'undefined') {
    window.deferredPrompt = null;
  }

  // Daftarkan Service Worker
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('sw.js')
      .then(() => console.log('Service Worker terdaftar!'))
      .catch(err => console.log('SW gagal:', err));
  }

  // Ambil elemen popup dan tombol
  const installPopup = document.getElementById('installPopup');
  const installBtn = document.getElementById('installBtn');

  // Event sebelum install (ditrigger saat browser siap install PWA)
  window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    window.deferredPrompt = e;
    if (installPopup) {
      installPopup.style.display = 'block';
    }
  });

  // Event klik tombol install
  if (installBtn) {
    installBtn.addEventListener('click', async () => {
      if (installPopup) installPopup.style.display = 'none';
      if (window.deferredPrompt) {
        window.deferredPrompt.prompt();
        const { outcome } = await window.deferredPrompt.userChoice;
        console.log(`User memilih: ${outcome}`);
        window.deferredPrompt = null; // reset setelah digunakan
      }
    });
  }
})();
