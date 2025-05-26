<template>
    <div>
        <v-app-bar
            id="header"
            app
            :class="flat && route().current('inicio') ? 'bgTranparente' : ''"
            dark
            class="align-center"
            :flat="flat"
            dense
        >
            <v-app-bar-nav-icon
                class="hidden-md-and-up"
                @click="ocultarMostrarDrawer = !ocultarMostrarDrawer"
            ></v-app-bar-nav-icon>

            <div
                v-if="route().current('inicio') && $vuetify.breakpoint.mdAndUp"
            >
                <v-toolbar-title v-if="flat == false">
                    <inertia-link class="white--text" href="/">
                        Jenis Sagbini
                    </inertia-link>
                </v-toolbar-title>
            </div>

            <div v-else>
                <v-toolbar-title>
                    <inertia-link class="white--text" href="/">
                        Jenis Sagbini
                    </inertia-link>
                </v-toolbar-title>
            </div>

            <v-spacer></v-spacer>

            <v-toolbar-items v-if="$vuetify.breakpoint.mdAndUp">
                <nav class="d-flex justify-end text-end align-center">
                    <inertia-link
                        v-for="item in links"
                        :key="item.name"
                        :href="route(item.route)"
                    >
                        <a
                            class="white--text subtitle-2 text-uppercase link mx-1"
                            :class="{ active: route().current(item.route) }"
                        >
                            {{ item.title }}
                        </a>
                    </inertia-link>
                </nav>
            </v-toolbar-items>

            <template v-else>
                {{ route().current() }}
            </template>
            <v-menu
                v-if="$page.user == null"
                bottom
                transition="scale-transition"
                :offset-y="true"
                :close-on-content-click="false"
            >
                <template v-slot:activator="{ on }">
                    <v-btn dark icon v-on="on">
                        <v-icon>mdi-dots-horizontal-circle-outline</v-icon>
                    </v-btn>
                </template>
                <div v-if="$page.user !== null" class="text-center"></div>

                <v-list>
                    <v-subheader>Opciones</v-subheader>

                    <v-list-item-group
                        v-if="authenticated && user"
                        color="primary"
                    >
                        <v-list-item to="/dashboard">
                            <v-list-item-icon>
                                <v-icon>mdi-account-circle</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title
                                    >Hola, {{ user.name }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <inertia-link href="/dashboard">
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-monitor-dashboard</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title
                                        >ver sitio</v-list-item-title
                                    >
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>
                        <v-divider></v-divider>
                        <v-list-item @click="logout">
                            <v-list-item-icon>
                                <v-icon>mdi-logout</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title
                                    >Cerrar sesión
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>

                    <v-list-item-group v-else color="primary">
                        <inertia-link href="/login">
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-account-key</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        Login</v-list-item-title
                                    >
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>
                        <v-divider></v-divider>
                        <inertia-link href="/register">
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-account-plus</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title
                                        >Registrar</v-list-item-title
                                    >
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>
                    </v-list-item-group>
                </v-list>
            </v-menu>
            <settings-dropdown class="ml-2"></settings-dropdown>
        </v-app-bar>

        <v-btn
            v-scroll="onScroll"
            v-show="fab"
            fab
            dark
            fixed
            bottom
            right
            @click="toTop"
        >
            <v-icon>mdi-chevron-up</v-icon>
        </v-btn>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";
import { route } from "ziggy-js";
import { mapState } from "vuex";
import SettingsDropdown from "@/components/SettingsDropdown.vue";

export default {
    components: {
        SettingsDropdown,
        InertiaLink: Link,
    },
    data() {
        return {
            fab: false,
            flat: false,
            localApp: false,
            item: 1,
            authenticated: null,
            user: null,
        };
    },
    computed: {
        ...mapState(["links", "linksWithAuth"]),
        desplazamiento() {
            return document.documentElement.clientHeight - 100;
        },
        getRoute() {
            return this.route.path;
        },
        ocultarMostrarDrawer: {
            get() {
                return this.$store.state.drawer;
            },
            set(val) {
                this.$store.commit("setDrawer", val);
            },
        },
    },
    methods: {
        route,
        logout() {},
        chainFlat() {
            //console.log('ejecuto chainFlat');
            if (this.route().current("inicio")) {
                this.flat = true;
            }
        },
        toTop() {
            this.$vuetify.goTo(0);
        },

        onScroll(e) {
            //console.log('ejecuto onScroll');

            if (typeof window === "undefined") return;

            const top = window.pageYOffset || e.target.scrollTop || 0;
            if (top > 50) {
                this.fab = true;
            } else {
                this.fab = false;
            }

            if (this.route().current("inicio")) {
                if (top > this.desplazamiento) {
                    this.flat = false;
                } else {
                    this.flat = true;
                }
            }
        },
    },
    mounted() {
        this.chainFlat();
    },
};
</script>

<style>
.bgTranparente {
    background-color: transparent !important;
}

nav a.link {
    transition: 0.7s ease !important;
    border-radius: 5px 5px 0 0 !important;
    color: #ffffff !important;
    /* text-decoration: none; */
    border-top: 2px solid rgba(0, 0, 0, 0) !important;
    border-bottom: 2px solid rgba(0, 0, 0, 0) !important;
    padding: 25px 5px !important;
    margin: 0 !important;
}

nav a.active {
    /* border-top: 2px solid #bdbdbd !important; */
    border-bottom: 2px solid #ffffff !important;
    border-radius: 5px 5px 0 0 !important;
    padding: 6px 5px !important;
}

nav a.link:hover {
    /* border-top: 2px solid #bdbdbd !important; */
    border-bottom: 2px solid #ffffff !important;
    padding: 6px 5px !important;
}
</style>
