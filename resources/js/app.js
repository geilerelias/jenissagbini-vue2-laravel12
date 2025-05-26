import('./bootstrap');

import('moment');

// Importa la función route usando desestructuración
import { route } from 'ziggy-js';

// Opcional: para que esté disponible globalmente
window.route = route;

import Vue from 'vue';

import vuetify from './plugins/vuetify.js'

import { createInertiaApp } from '@inertiajs/inertia-vue'

import { InertiaProgress } from '@inertiajs/progress'
import store from "./stores/store.js";

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);

import PerfectScrollbar from 'vue2-perfect-scrollbar'
import 'vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css'

Vue.use(PerfectScrollbar)

import VueGates from 'vue-gates';

Vue.use(VueGates);

//Plugins Permissions
import Permissions from './plugins/Permissions';

Vue.use(Permissions);

//vue2 editor
import Vue2Editor from "vue2-editor";

Vue.use(Vue2Editor);

//Vue Animate CSS
import VAnimateCss from 'v-animate-css';
import 'animate.css';

Vue.use(VAnimateCss);


import 'viewerjs/dist/viewer.css'
import Viewer from 'v-viewer'

Vue.use(Viewer)



const app = document.getElementById('app');

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue')
        return pages[`./Pages/${ name }.vue`]().then(m => m.default)
    },
    setup({ el, App, props, plugin }) {
        Vue.use(plugin)

        new Vue({
            vuetify,
            store,
            render: h => h(App, props),
        }).$mount(el)
    },
})



InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,
    // The color of the progress bar.
    color: '#29d',
    // Whether to include the default NProgress styles.
    includeCSS: true,
    // Whether the NProgress spinner will be shown.
    showSpinner: true,
});
