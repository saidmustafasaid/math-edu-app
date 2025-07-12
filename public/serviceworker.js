const CACHE_NAME = 'math-edu-app-v1';
const urlsToCache = [
  '/',
  '/converter',
  '/constants',
  '/formulas',
  '/angles',
  '/scientific_calculator',
  '/manifest.json',
  '/icons/icon-192.png',
  '/icons/icon-512.png',
  // Optional: Add CSS/JS if needed
];

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(CACHE_NAME).then(function(cache) {
      console.log('[ServiceWorker] Caching app shell');
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener('activate', function(event) {
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(key) {
          if (key !== CACHE_NAME) {
            console.log('[ServiceWorker] Removing old cache', key);
            return caches.delete(key);
          }
        })
      );
    })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request).then(function(response) {
      return response || fetch(event.request).catch(() => {
        return new Response('You are offline and the content is not cached.', {
          headers: { 'Content-Type': 'text/plain' }
        });
      });
    })
  );
});
