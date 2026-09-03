// Glide.js slider home integration
import Glide from '@glidejs/glide';
import '@glidejs/glide/dist/css/glide.core.min.css';
import '@glidejs/glide/dist/css/glide.theme.min.css';

document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.glide')) {
        new Glide('.glide', {
            type: 'carousel',
            autoplay: 8000,
            hoverpause: true,
            perView: 1,
            gap: 0,
            animationDuration: 600,
        }).mount();
    }
});
import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

// Register PWA Service Worker
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch(() => {});
    });
}
