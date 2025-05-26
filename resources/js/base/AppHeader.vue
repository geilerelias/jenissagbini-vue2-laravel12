<template>
    <!--        <v-system-bar absolute v-if="$vuetify.breakpoint.smAndUp" :class="$vuetify.breakpoint.mdAndUp?'px-200':'px-6'"
                          height="30">
                <div class="d-flex social-icons">
                    <v-btn icon text rounded>
                        <v-icon size="20">
                            mdi-facebook
                        </v-icon>
                    </v-btn>
                    <v-btn icon text rounded>
                        <v-icon size="20">
                            mdi-twitter
                        </v-icon>
                    </v-btn>
                    <v-btn icon text rounded>
                        <v-icon size="20">
                            mdi-instagram
                        </v-icon>
                    </v-btn>
                    <v-btn icon text rounded>
                        <v-icon size="20">
                            mdi-whatsapp
                        </v-icon>
                    </v-btn>
                </div>

                <v-spacer></v-spacer>

                <div>
                    <v-icon notranslate>mdi-phone</v-icon>
                    <span>Call us: <span class="font-weight-bold">0800 - 1923</span></span>
                </div>

            </v-system-bar>-->
    <div style="z-index: 10">
        <v-app-bar app
                   :class="$vuetify.breakpoint.mdAndUp?'px-20':''"
                   color="primary">
            <v-btn v-if="!route().current('home')" @click="back" text light fab class="mr-1 ">
                <v-icon dark color="white">mdi-arrow-left</v-icon>
            </v-btn>

            <logo></logo>

            <v-toolbar-title>
                <inertia-link v-if="$vuetify.breakpoint.smAndDown" class="white--text" href="/">
                    Jenis Sagbini
                </inertia-link>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <div class="text-center" v-if="$page.user==null">
                <v-menu
                    :close-on-content-click="false"
                    :nudge-width="200"
                    offset-y
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn icon
                               v-bind="attrs"
                               v-on="on"
                               class="ml-2 hidden-sm-and-down white--text"

                        >
                            <v-icon>
                                mdi-dots-vertical
                            </v-icon>
                        </v-btn>
                    </template>

                    <v-card>
                        <v-list>
                            <template v-if="$page.user==null">
                                <v-subheader>Authentication</v-subheader>
                                <v-divider></v-divider>
                                <v-list-item
                                    v-for="item in items"
                                    :key="item.title"
                                    :href="item.route"
                                >
                                    <v-list-item-icon>
                                        <v-icon>{{ item.icon }}</v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>

                            </template>
                        </v-list>
                    </v-card>
                </v-menu>
            </div>

            <v-app-bar-nav-icon dark
                                class="hidden-md-and-up"
                                @click="drawer?setDrawer(false):setDrawer(true)"
            ></v-app-bar-nav-icon>

            <settings-dropdown></settings-dropdown>

            <!--            <v-btn icon v-if="$vuetify.breakpoint.mdAndUp" dark-->
            <!--                   @click="expand?setExpand(false):setExpand(true)">-->
            <!--                <v-icon v-text="expand?'mdi-view-list-outline':'mdi-dots-vertical'"></v-icon>-->
            <!--            </v-btn>-->

        </v-app-bar>

        <v-btn

            v-show="fab"
            v-scroll="onScroll"
            bottom
            color="primary"
            dark
            fab
            fixed
            right
            @click="toTop"
        >
            <v-icon>mdi-chevron-up</v-icon>
        </v-btn>
    </div>
</template>

<script>

import {mapMutations, mapState} from "vuex";


import logo from '@/Components/Logo.vue'
import SettingsDropdown from "@/components/SettingsDropdown.vue";


export default {

    name: "AppHeader",
    components: {
        SettingsDropdown,
        logo
    },
    props: {
        seeker: {
            type: Boolean,
            default: true
        },
        app: {
            type: Boolean,
            default: false
        },
    },
    data: () => ({
        fav: true,
        menu: false,
        dialog: false,
        message: false,
        hints: true,
        fab: false,
        logo: logo,
        department: [],
        businesses: [],
        items: [
            {title: 'Login', icon: 'mdi-account-lock', route: "/login"},
            {title: 'Sign Up', icon: 'mdi-account-plus', route: "/register"},
        ],
        opciones: [
            {title: "Notificaciones", icon: 'mdi-bell', route: ""},
            {title: "Seguidos", icon: 'mdi-account-group', route: ""},
            {title: "Favoritos", icon: 'mdi-heart', route: ""},
            {title: "Ubicación", icon: 'mdi-map-marker', route: ""},
            {title: "Ajustes", icon: 'mdi-cog', route: ""},
        ],
    }),
    computed: {
        ...mapState(["drawer", "links", 'expand']),
    },
    methods: {
        ...mapMutations([
            "setDrawer", "setExpand"
        ]),
        toTop() {
            this.$vuetify.goTo(0);
        }
        ,
        onScroll(e) {
            if (typeof window === "undefined") return;
            const top = window.pageYOffset || e.target.scrollTop || 0;
            if (top > 50) {
                this.fab = true;
            } else {
                this.fab = false;
            }
        }
        ,
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },
        logout() {
            axios.post(route('logout').url()).then(response => {
                window.location = '/';
            })
        },
        back() {
            window.history.back();
            //return document.referrer;
        },
        searching() {
            if (!this.route().current('marketplace')) {
                this.$inertia.get('/marketplace');
            }
        }
    }
}
</script>

<style>
.px-20 {
    padding-left: 20px !important;
    padding-right: 20px !important;
}
</style>

