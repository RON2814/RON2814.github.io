import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    assetsInclude: ["**/*.png", "**/*.jpg", "**/*.jpeg", "**/*.svg"],
    build: {
        outDir: "public/build",
        emptyOutDir: true,
        rollupOptions: {
            input: [
                "resources/assets/back-arrow.svg",
                "resources/assets/cvsulogo.png",
                "resources/assets/cvsu-bg.jpg",
                "resources/assets/stingrays.png",
                "resources/assets/under_review.png",
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/bootstrap.js",
                "resources/js/modal.js",
            ],
        },
    },
});
