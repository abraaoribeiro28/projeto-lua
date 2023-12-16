import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/custom.css",
                "resources/css/home.css",
                "resources/css/tailwind.css",



                "resources/js/app.js",
                "resources/js/bootstrap.js",
                "resources/js/custom-dropdown.js",

                // Home
                "resources/js/portal/subscriber.js",
            ],
            refresh: true,
        }),
    ],

    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap/dist"),
            "~bootstrap-icons": path.resolve(__dirname, "node_modules/bootstrap-icons/font"),
        },
    },

    server: {
        hmr: {
            host: "localhost",
        },
    },
});
