import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
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
            input: ["resources/css/app.css", "resources/js/app.js"],
        },
    },
});
