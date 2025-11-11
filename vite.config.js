import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

const inputFiles = [
    "resources/css/app.css",
    "resources/js/app.js",
    "resources/js/admin/supplements/home.js",
    "resources/js/admin/supplements/create.js",
    "resources/js/admin/supplements/edit.js",
    "resources/js/admin/categories/index.js",
    "resources/js/admin/categories/form.js",
    "resources/js/admin/shared/autoHideAlerts.js",
    "resources/js/shared/autoHideAlerts.js",
    "resources/js/supplements/show.js",
    "resources/js/tests/recommendations/create.js",
    "resources/js/users/edit.js",
];

export default defineConfig({
    plugins: [
        laravel({
            input: inputFiles,
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: "0.0.0.0",
        port: 5173,
        hmr: {
            host: "localhost",
            port: 5173,
        },
    },
    build: {
        outDir: "public/build",
        emptyOutDir: true,
        manifest: true,
        manifestDir: ".",
        rollupOptions: {
            input: inputFiles,
        },
    },
});
