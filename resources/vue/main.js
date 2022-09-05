import { createApp } from "vue";
import Router from "./router";
// import store from "~/Stores";
import App from "./app.vue";
import vSelect from 'vue-select';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import VueTablerIcons from "vue-tabler-icons";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import axios from 'axios';
import {
    ContentLoader,
    FacebookLoader,
    CodeLoader,
    BulletListLoader,
    InstagramLoader,
    ListLoader,
} from 'vue-content-loader'

// axios.defaults.baseURL = '/api/';
// axios.defaults.headers.common['Authorization'] = `Bearer ${store.state.token}`;

createApp({
    extends: App,
    created() {
        // if (store.getters.hasSession) {
        //     console.log("You're Logged In");
        // } else {
        //     console.log("You're Logged Out, Please Login First");
        // }

    }
})
    // .use(store)
    .use(Router)
    .use(VueTablerIcons)
    .use(VueSweetalert2)
    .component('QuillEditor', QuillEditor)
    .component("v-select", vSelect)
    .component('ContentLoader', ContentLoader)
    .component('FacebookLoader', FacebookLoader)
    .component('CodeLoader', CodeLoader)
    .component('BulletListLoader', BulletListLoader)
    .component('InstagramLoader', InstagramLoader)
    .component('ListLoader', ListLoader)
    .mount("#app");
