const CACHE_NAME = 'kiswahili-unit-converter-v1';
const urlsToCache = [
  '/',
  '/home?lang=en',
  '/home?lang=sw',
  '/converter',
  '/convert',              // ✅ Add this
  '/formulas',
  '/angles',
  '/scientific_calculator',
  '/manifest.json',
  '/icons/icon-192.png',
  '/icons/icon-512.png',
];


// ✅ Install: Cache available pages only
self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(CACHE_NAME).then(function(cache) {
      console.log('Opened cache');
      return Promise.all(
        urlsToCache.map(url =>
          fetch(url)
            .then(response => {
              if (!response.ok) throw new Error('Request failed: ' + url);
              return cache.put(url, response.clone());
            })
            .catch(err => {
              console.warn(`⚠️ Skipped caching ${url}:`, err.message);
            })
        )
      );
    })
  );
});

// ✅ Fetch: Use cache if offline
self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request).then(response => {
      return response || fetch(event.request).catch(() => {
        // ✅ Fallback for HTML page when offline
        if (event.request.headers.get('accept')?.includes('text/html')) {
          return caches.match('/');
        }
      });
    })
  );
});
