import { defineConfig } from 'vite';
import Laravel from 'laravel-vite-plugin';
import Vue from '@vitejs/plugin-vue';
import Pages from 'vite-plugin-pages';
import Layouts from 'vite-plugin-vue-layouts';
import Components from 'unplugin-vue-components/vite';
import AutoImport from 'unplugin-auto-import/vite';
const path = require('path');

export default defineConfig({
    plugins: [
        // https://github.com/antfu/unplugin-auto-import
        AutoImport({
            imports: [
                'vue',
                'vue-router',
                'vue-i18n',
                'vue/macros',
                '@vueuse/head',
                '@vueuse/core',
            ],
            dirs: [
                'resources/vue/composables',
                'resources/vue/store',
            ],
            vueTemplate: true,
        }),
        // https://github.com/antfu/unplugin-vue-components
        Components({
            dirs: ['resources/vue/components'],
            extensions: ['vue', 'md'],
            include: [/\.vue$/, /\.vue\?vue/, /\.md$/],
            deep: true,
            directives: true,
            exclude: [/[\\/]node_modules[\\/]/, /[\\/]\.git[\\/]/, /[\\/]\.nuxt[\\/]/],
        }),
        Laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        // https://github.com/JohnCampionJr/vite-plugin-vue-layouts
        Layouts(),
        // https://github.com/hannoeru/vite-plugin-pages
        Pages({
            dirs: 'resources/vue/pages',
            extensions: ['vue', 'md'],
        }),
        Vue({
            include: [/\.vue$/, /\.md$/],
            reactivityTransform: true,
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        })
    ],
    build: {
        chunkSizeWarningLimit: 500,
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return id.toString().split('node_modules/')[1].split('/')[0].toString();
                    }
                }
            }
        }
    },
    resolve: {
        alias: {
            //'~': path.resolve(__dirname, './resources/vue')
        },
    },
});
