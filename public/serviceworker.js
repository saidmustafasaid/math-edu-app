const CACHE_NAME = 'kiswahili-unit-converter-v1';
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
  // Add more routes or static assets if needed (CSS/JS)
];

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        return response || fetch(event.request);
      })
  );
});

