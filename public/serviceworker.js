const CACHE_NAME = 'kiswahili-unit-converter-v1';
const urlsToCache = [
  '/',
  '/home?lang=en',
  '/home?lang=sw',
  '/converter?lang=en',
  '/converter?lang=sw',
  '/constants?lang=en',
  '/constants?lang=sw',
  '/formulas?lang=en',
  '/formulas?lang=sw',
  '/angles?lang=en',
  '/angles?lang=sw',
  '/calculator?lang=en',   // ✅ Fixed path
  '/calculator?lang=sw',   // ✅ Fixed path
  '/manifest.json',
  '/icons/icon-192.png',
  '/icons/icon-512.png',
];

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(CACHE_NAME).then(function(cache) {
      console.log('✅ Opened cache');
      return Promise.all(
        urlsToCache.map(url =>
          fetch(url, { redirect: "follow" })
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

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request).then(response => {
      return response || fetch(event.request).catch(() => {
        if (event.request.headers.get('accept')?.includes('text/html')) {
          return caches.match('/');
        }
      });
    })
  );
});


