<template>
    <v-navigation-drawer
        v-model="localDrawer"
        app
        :permanent="$vuetify.breakpoint.mdAndUp"
        :expand-on-hover="expand"
        style="box-shadow: #00000033 -20px 1px 17px 8px, #00000024 0px 2px 2px 0px, #0000001f 0px 1px 5px 0px;">
        <perfect-scrollbar>
            <v-list>
                <v-list-item class="px-3" two-line>
                    <v-list-item-content>
                        <v-list-item-title class="text-uppercase font-weight-regular subtitle-1 mx-auto">

                            <inertia-link
                                class="font-weight-black font-weight-bold primary--text"
                                href="/">
                                Jenis Sagbini
                            </inertia-link>
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <template v-if="$page.user!==null">

                <v-list-item class="px-2" two-line>
                    <v-list-item-avatar>
                        <img :src="$page.user.profile_photo_url"
                             :alt="$page.user.name">
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title>{{ $page.user.name }}</v-list-item-title>
                        <v-list-item-subtitle>{{ $page.user.email }}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
                <v-divider></v-divider>
            </template>


            <v-list dense shaped>
                <v-list-item-group
                    v-model="group"
                    color="primary"
                >
                    <template v-if="$page.user==null">

                        <v-divider></v-divider>
                        <v-subheader>Authentication</v-subheader>
                        <inertia-link v-for="item in items"
                                      :key="item.title"
                                      :href="item.route">
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>{{ item.icon }}</v-icon>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>
                    </template>

                    <!-- Responsive Settings Options -->
                    <template v-if="$page.user!==null" dense>
                        <inertia-link v-for="item in linksWithAuth" :key="item.id"
                                      :href="route(item.route)"
                                      v-permission="item.can">
                            <v-list-item
                                :dark="route().current(item.route)"
                                class="mb-2"
                                :class="route().current(item.route)?'active primary  white--text':''"
                            >
                                <v-list-item-icon>
                                    <v-icon v-text="item.icon"></v-icon>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title v-text="item.title"></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>

                        <v-divider></v-divider>
                        <v-subheader v-if="!expand">Settings Options</v-subheader>

                        <inertia-link :href="route('profile.show')">
                            <v-list-item
                                :dark="route().current('profile.show')"
                                :class="route().current('profile.show')?'active primary  white--text':''">
                                <v-list-item-icon>
                                    <v-icon>mdi-account-circle</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title> Profile</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>
                        <inertia-link :href="route('api-tokens.index')"
                                      v-if="$page.jetstream.hasApiFeatures">
                            <v-list-item class="px-2"
                                         :dark="route().current('api-tokens.index')"
                                         :class="route().current('api-tokens.index')?'active primary  white--text':''"
                            >
                                <v-list-item-icon>
                                    <v-icon>mdi-lan</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title> API Tokens</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>
                        <v-divider></v-divider>

                        <v-subheader v-if="!expand">Authentication</v-subheader>

                        <v-list-item @click="logout">
                            <v-list-item-icon>
                                <v-icon>mdi-logout</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title> Logout</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                        <v-divider></v-divider>
                        <v-subheader v-if="!expand">Manage Team</v-subheader>
                        <inertia-link :href="route('teams.show', $page.user.current_team)">
                            <v-list-item
                                :dark="route().current('teams.show')"
                                :class="route().current('teams.show')?'active primary  white--text':''"
                            >
                                <v-list-item-icon>
                                    <v-icon>mdi-account-group</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title> Team Settings</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>

                        <inertia-link :href="route('teams.create')">
                            <v-list-item
                                :dark="route().current('teams.create')"
                                :class="route().current('teams.create')?'active primary  white--text':''"
                            >
                                <v-list-item-icon>
                                    <v-icon>mdi-account-multiple-plus</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>Create New Team</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>
                    </template>
                </v-list-item-group>
            </v-list>

            <div v-if="$page.user!==null" class="pt-4 pb-1 border-t border-gray-200">

                <div class="mt-3 space-y-1">

                    <!-- Team Management -->
                    <template v-if="$page.jetstream.hasTeamFeatures">

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Switch Teams
                        </div>

                        <template v-for="team in $page.user.all_teams">
                            <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                <jet-responsive-nav-link as="button">
                                    <div class="flex items-center">
                                        <svg v-if="team.id == $page.user.current_team_id"
                                             class="mr-2 h-5 w-5 text-green-400" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>{{ team.name }}</div>
                                    </div>
                                </jet-responsive-nav-link>
                            </form>
                        </template>
                    </template>
                </div>
            </div>


            <v-list dense shaped>
                <v-list-item-group
                    v-model="group"
                    color="primary"
                    dense shaped
                >
                    <template v-for="item in rutas">

                        <inertia-link v-if="item.array==null" :href="route(item.route)">
                            <v-list-item
                                dense
                                shaped
                                :dark="route().current(item.route)"
                                class="mb-2"
                                :class="route().current(item.route)?'active primary  white--text':''"
                            >
                                <v-list-item-icon>
                                    <v-icon v-text="item.icon"></v-icon>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title v-text="item.title"></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>

                        </inertia-link>

                        <v-list-group v-else
                                      :key="item.title"
                                      :prepend-icon="item.icon"
                                      no-action
                                      class="mb-2"
                                      :dark="route().current(item.route)"
                                      :class="route().current(item.route)?'active primary  white--text':''"
                                      dense shaped
                        >
                            <template v-slot:prependIcon>
                                <inertia-link :href="route(item.route)">
                                    <v-icon>{{ item.icon }}</v-icon>
                                </inertia-link>
                            </template>
                            <template v-slot:activator>
                                <v-list-item-content v-text="item.title">
                                </v-list-item-content>
                            </template>
                            <v-list-item-group
                                v-model="group"
                                color="primary"
                                dense
                                shaped
                            >
                                <inertia-link v-for="child in item.array"
                                              :key="child.title"
                                              :href="route(item.route)">
                                    <v-list-item
                                        @click=""
                                        :dark="route().current(child.route)"
                                        class="mb-2 pl-10"
                                        dense
                                        shaped
                                        :class="route().current(child.route)?'active primary  white--text':''"
                                    >

                                        <v-list-item-icon>
                                            <v-icon v-text="child.icon"></v-icon>
                                        </v-list-item-icon>
                                        <v-list-item-content>
                                            <v-list-item-title v-text="child.title"></v-list-item-title>
                                        </v-list-item-content>

                                    </v-list-item>
                                </inertia-link>
                            </v-list-item-group>
                        </v-list-group>
                    </template>
                </v-list-item-group>
            </v-list>
        </perfect-scrollbar>
    </v-navigation-drawer>
</template>

<script>
import {mapMutations, mapState} from "vuex";
import logo from '@/../img/logo.png';

import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
import JetDropdown from '@/Jetstream/Dropdown.vue'
import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
import JetNavLink from '@/Jetstream/NavLink.vue'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'

export default {
    name: "AppDrawer",
    components: {
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
    },
    data: () => ({
        admins: [
            ['Management', 'mdi-account-multiple-outline'],
            ['Settings', 'mdi-cog-outline'],
        ],
        cruds: [
            ['Create', 'mdi-plus-outline'],
            ['Read', 'mdi-file-outline'],
            ['Update', 'mdi-update'],
            ['Delete', 'mdi-delete'],
        ],
        rutas: [
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
            }
        ],
        dialog: false,
        group: null,
        logo: logo,
        items: [
            {title: 'Login', icon: 'mdi-account-lock', route: "/login"},
            {title: 'Sign Up', icon: 'mdi-account-plus', route: "/register"},
        ],
        businesses: [],
        right: null,
        notifications: false,
        sound: true,
        widgets: false,
        select: [
            {text: 'State 1'},
            {text: 'State 2'},
            {text: 'State 3'},
            {text: 'State 4'},
            {text: 'State 5'},
            {text: 'State 6'},
            {text: 'State 7'},
        ],
    }),
    created() {
        // axios
        //     .get(`/business/user/all`)
        //     .then(response => {
        //         this.businesses = response.data;
        //     })
        //     .catch(error => {
        //         console.log(error);
        //     });
    },
    watch: {
        group() {
            this.drawer ? this.setDrawer(false) : this.setDrawer(true);
        },
    },
    computed: {
        ...mapState(["drawer", "links", "linksWithAuth", "expand"]),
        localDrawer: {
            get() {
                return this.drawer;
            },
            set(val) {
                this.setDrawer(val);
            }
        }
    },
    methods: {
        ...mapMutations([
            "setDrawer", "setExpand",
        ]),

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
    }
}
</script>

<style>
.ps {
    height: 100vh;
}
</style>
