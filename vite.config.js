import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
            'resources/css/app.css', 
            'resources/css/announcement.css',
            'resources/css/appointment.css', 
            'resources/css/hero.css', 
            'resources/css/inquiry-form.css', 
            'resources/css/navbar.css', 
            'resources/css/star-rating.css', 
            'resources/css/testimonial.css', 
            'resources/css/training.css', 
            'resources/css/who-are-we.css', 
            'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
