// cache name with version for updates upon modification
var cacheName = 'howfar-0.0.1';

/*list of files required for app shell to be cached: images, js, css etc.
 its important to always include '/' & '/index.html' or '/index.php' cos 
 most users will  almost never  include index.html after the primary url 
 for our webapps */

var filesToCache = [
  '/',
  '/index.php',
  '/templates/header.php',
  '/templates/footer.php',
  '/chat.php',
  '/terms.php',
  '/about.php',
  '/login_register.php',
  '/js/bootstrap.min.js',
  '/js/jquery-1.11.3.min.js',
  '/js/ajax.js',
  '/js/functions_script.js',
  '/js/login_register.js',
  '/js/user-profile.js',
  '/css/carousel.css',
  '/css/chat_log_div.css',
  '/css/dashboard.css',
  '/css/login_register.css',
  '/css/user-profile.css',
  '/css/holder.css',
  '/controller/functions.php'
];

//service worker installation & adding of app shell files & images to cache
self.addEventListener('install', function(e) {
  console.log('[ServiceWorker] Install');
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      console.log('[ServiceWorker] Caching app shell');
      return cache.addAll(filesToCache);
    })
  );
});

// deleting unused cache contents
self.addEventListener('activate', function(e) {
  console.log('[ServiceWorker] Activate');
  e.waitUntil(
    caches.keys().then(function(keyList) {
      return Promise.all(keyList.map(function(key) {
        if (key !== cacheName) {
          console.log('[ServiceWorker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
    })
  );
});

/*serving app shell from cache, caches.match reviews the web request that triggered 
the event 'fetch', checks the cache for matching, if a version exists in the cache,  
it issues it, else it gets/uses 'fetch' to copy it from the network, cache it & 
then render it. Note: the response is sent back to the web page using 'e.respondWith()'
where 'e' is the currently active 'fetch instance' */

self.addEventListener('fetch', function(e) {
  console.log('[ServiceWorker] Fetch', e.request.url);
  e.respondWith(
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});
