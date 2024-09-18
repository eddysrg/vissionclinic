import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/components/navbarMenu.js",
                "resources/js/components/responsiveMenu.js",
                "resources/js/carousel/mainCarousel.js",
            ],
            refresh: true,
        }),
    ],
});
