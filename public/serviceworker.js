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

// ✅ Install: Add files to cache, but skip any that fail
self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(CACHE_NAME).then(async function(cache) {
      console.log('Opened cache');

      // Add each file safely
      await Promise.all(
        urlsToCache.map(url =>
          fetch(url)
            .then(response => {
              if (!response.ok) throw new Error(`${url} failed with status ${response.status}`);
              return cache.put(url, response.clone());
            })
            .catch(err => console.warn(`Skipped caching ${url}:`, err.message))
          )
      );
    })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});

