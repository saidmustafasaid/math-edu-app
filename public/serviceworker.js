const CACHE_NAME = 'kiswahili-unit-converter-v2';
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

const AUTH_PATHS = ['/login', '/register', '/logout', '/password', '/email', '/dashboard', '/home'];

function isAuthRequest(url) {
  const path = new URL(url).pathname;
  return AUTH_PATHS.some(p => path === p || path.startsWith(p + '/'));
}

self.addEventListener('fetch', function(event) {
  const url = event.request.url;

  // Never cache auth or dynamic app pages — always go to network
  if (event.request.method !== 'GET' || isAuthRequest(url)) {
    event.respondWith(fetch(event.request));
    return;
  }

  // For static/public pages: cache-first, fallback to network
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


