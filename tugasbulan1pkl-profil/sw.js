const CACHE_NAME = 'pwa-cache-v1';
const FILES_TO_CACHE = [
  './',
  './index.php',
  './about.html',
  './ai.html',
  './androidapp.html',
  './app.js',
  './appleapp.html',
  './article.html',
  './chatbot.php',
  './coutact.html',
  './it.html',
  './manifest.json',
  './offline.html',
  './partnership.php',
  './review.php',
  './servis.html',
  './style.css',
  './sw.js',
  './tes.html',
  './web.html'
];

// Install
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(FILES_TO_CACHE))
  );
});

// Fetch
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request).then(response => {
      return response || fetch(event.request);
    })
  );
});
