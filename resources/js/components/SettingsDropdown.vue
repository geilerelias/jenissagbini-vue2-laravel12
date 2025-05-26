<template>
    <div v-if="$page.user!==null" class="text-center">
        <v-menu
            offset-y
            :close-on-content-click="false"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn v-if="$page.jetstream.managesProfilePhotos"
                       fab
                       dark
                       text
                       v-bind="attrs"
                       v-on="on"
                       small
                >
                    <v-img style="max-height: 35px;max-width: 35px" class="rounded-circle" cover
                           :src="$page.user.profile_photo_url"
                           :alt="$page.user.name"></v-img>
                </v-btn>

            </template>

            <v-card class="pa-5">
                <v-list>
                    <v-list-item>
                        <v-list-item-avatar v-if="$page.jetstream.managesProfilePhotos">
                            <img
                                :src="$page.user.profile_photo_url"
                                :alt="$page.user.name"
                            >
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title>{{ $page.user.name }}</v-list-item-title>
                            <v-list-item-subtitle>{{ $page.user.email }}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>

                <v-divider></v-divider>
                <!-- Responsive Settings Options -->
                <v-list v-if="$page.user!==null" dense>
                    <div v-permission="'view dashboard'">
                        <v-subheader>Gestión de páginas</v-subheader>
                        <v-list-item-group
                            color="primary"
                        >
                            <inertia-link :href="route('dashboard')">
                                <v-list-item
                                    :dark="route().current('dashboard')"
                                    :class="route().current('dashboard')?'active primary  white--text':''">
                                    <v-list-item-icon>
                                        <v-icon>mdi-view-dashboard</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title> Dashboard</v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </inertia-link>
                        </v-list-item-group>
                    </div>
                    
                    <v-subheader>Opciones de configuración</v-subheader>
                    <v-list-item-group
                        color="primary"
                    >
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
                            <v-list-item
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
                        <v-subheader>Manage Team</v-subheader>
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

                        <v-subheader>Manejo de sesion</v-subheader>
                        <v-list-item @click="logout">
                            <v-list-item-icon>
                                <v-icon>mdi-logout</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title> Logout</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
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
                                    <button class="w-full text-left">
                                        <div class="flex items-center">
                                            <svg v-if="team.id == $page.user.current_team_id"
                                                 class="mr-2 h-5 w-5 text-green-400" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                 stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div>{{ team.name }}</div>
                                        </div>
                                    </button>
                                </form>
                            </template>
                        </template>

                    </div>
                </div>

            </v-card>
        </v-menu>
    </div>

</template>

<script>
export default {
    name: "SettingsDropdown",
    methods: {
        logout() {
            axios.post(route('logout').url()).then(response => {
                window.location = '/';
            })
        },
    }

}
</script>
