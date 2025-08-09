const CACHE='justy-shell-v1';
const ASSETS=[
  '/',
  '/assets/css/app.css',
  '/assets/js/app.js',
];
self.addEventListener('install',e=>{e.waitUntil(caches.open(CACHE).then(c=>c.addAll(ASSETS)))});
self.addEventListener('fetch',e=>{
  e.respondWith(caches.match(e.request).then(res=>res||fetch(e.request)));
});