const CACHE_NAME = 'kiswahili-unit-converter-v1';
const urlsToCache = [
  '/',
  '/converter',
  '/formulas',
  '/angles',
  '/constants',
  '/scientific_calculator',
  '/manifest.json',
  '/icons/icon-192.png',
  '/icons/icon-512.png',
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      console.log('Opened cache');
      return Promise.all(
        urlsToCache.map(url =>
          cache.add(url).catch(err => {
            console.warn(`⚠️ Failed to cache ${url}`, err);
          })
        )
      );
    })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request).then(response =>
      response || fetch(event.request).catch(() =>
        new Response('<h1>Offline</h1><p>You are offline. Please reconnect.</p>', {
          headers: { 'Content-Type': 'text/html' },
        })
      )
    )
  );
});
