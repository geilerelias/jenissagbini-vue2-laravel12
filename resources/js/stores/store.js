import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        drawer: false,
        search: "",
        links: [
            {
                route: "inicio",
                icon: "mdi-home",
                title: "Inicio",
                array: null
            },
            {
                route: "quienSoy",
                icon: "mdi-account-question",
                title: "¿Quien soy?",
                array: null
            },
            {
                route: "proyectos",
                icon: "mdi-file-tree",
                title: "Proyectos",
                array: null
            },
            {
                route: "articulo",
                icon: "mdi-card-text",
                title: "Artículos",
                array: null
            },
            {
                route: "servicios",
                icon: "mdi-face-agent",
                title: "Servicios",
                array: null
            },
            {
                route: "contacto",
                icon: "mdi-card-account-mail",
                title: "Contacto",
                array: null
            },
        ],
        linksWithAuth: [
            {
                route: "dashboard",
                icon: 'mdi-view-dashboard',
                title: "Dashboard",
                can: 'view dashboard',
                array: null
            },
            {
                route: "notices.index",
                icon: 'mdi-bulletin-board',
                title: "Noticias",
                can: 'view notices',
                array: null
            },
            {
                route: "about.index",
                title: "Quien soy",
                icon: "mdi-account-question",
                can: 'view about',
                array: null
            },
            {
                route: "articles",
                title: "Artículos",
                icon: "mdi-file-tree",
                can: 'view articles',
                array: [
                    {
                        route: "/articles/published/index",
                        title: "Publicados",
                        icon: "mdi-newspaper-variant-outline",
                        can: 'view articles',
                        array: null
                    },
                    {
                        route: "/articles/others",
                        title: "Otros",
                        icon: "mdi-pdf-box",
                        can: 'view articles',
                        array: null
                    }
                ]
            },
            {
                route: "project",
                title: "Proyectos",
                icon: "mdi-card-text",
                can: 'view project',
                array: null
            },
            {
                route: "services",
                icon: 'mdi-face-agent',
                title: "Servicios",
                can: 'view services',
                array: null
            },

            // {route: "posts.index", icon: 'mdi-note-text-outline', title: "Post"},
            {
                route: "user.index",
                icon: 'mdi-account-tie',
                title: "User",
                can: 'view user',
                array: null
            },
            {
                route: "role.index",
                icon: 'mdi-shield-account',
                title: "Roles",
                can: 'view rol',
                array: null
            },
            {
                route: "permission.index",
                icon: 'mdi-badge-account-outline',
                title: "Permisos",
                can: 'view permission',
                array: null
            },

        ],
        expand: false,
    },
    getters: {
        getDrawer(state) {
            return state.drawer;
        },
        getSearch(state) {
            return state.search;
        },
        getExpand(state) {
            return state.expand;
        },
    },
    mutations: {
        setDrawer(state, v) {
            state.drawer = v;
        },
        setSearch(state, v) {
            state.search = v;
        },
        setExpand(state, v) {
            state.expand = v;
        },
    },
    actions: {}
});

export default store;
