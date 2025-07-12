const CACHE_NAME = 'kiswahili-unit-converter-v2';
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
];

self.addEventListener('install', function (event) {
  event.waitUntil(
    caches.open(CACHE_NAME).then(async function (cache) {
      console.log('Opened cache');
      for (const url of urlsToCache) {
        try {
          const response = await fetch(url);
          if (response.ok) {
            await cache.put(url, response.clone());
          } else {
            console.warn(`❌ Skipped caching ${url}: response not OK`);
          }
        } catch (err) {
          console.warn(`⚠️ Skipped caching ${url}:`, err.message);
        }
      }
    })
  );
});

self.addEventListener('fetch', function (event) {
  event.respondWith(
    caches.match(event.request).then(function (response) {
      return response || fetch(event.request);
    })
  );
});
