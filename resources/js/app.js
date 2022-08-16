import '@css/app.css';

import Alpine from 'alpinejs'

// Accept HMR as per: https://vitejs.dev/guide/api-hmr.html
if (import.meta.hot) {
    import.meta.hot.accept(() => {
        console.log("HMR")
    });
}

window.Alpine = Alpine
Alpine.start()
