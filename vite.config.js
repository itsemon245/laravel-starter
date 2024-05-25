import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";
import Components from "unplugin-vue-components/vite";
import { PrimeVueResolver } from "unplugin-vue-components/resolvers";

export default defineConfig({
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        Components({
            dts: true,
            dirs: ["resources/js/vue/components"],
            resolvers: [
                PrimeVueResolver(),
            ],
        }),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        cors: true, // Enable CORS
        hmr: {
            host: 'localhost',
        },
    },
    resolve: {
        alias: {
            'vue$': "vue/dist/vue.esm-bundler.js",
        },
    },
});
