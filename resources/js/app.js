import './bootstrap';

import Alpine from 'alpinejs';
// Import the React SPA so the single Vite entry includes both Alpine and React
import './app.jsx';

window.Alpine = Alpine;

Alpine.start();
