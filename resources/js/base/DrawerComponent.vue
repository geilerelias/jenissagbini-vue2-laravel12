<template>
    <v-navigation-drawer
        nav
        v-model="drawer"
        class="text-start py-12"
        app
        temporary
    >
        <v-list-item>
            <v-list-item-avatar>
                <!--                <v-img :src="require('@/../img/15.jpg')"></v-img>-->
            </v-list-item-avatar>

            <v-list-item-content>
                <v-list-item-title>Jenis Sagbini</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item>
            <v-list-item-content>
                <v-list-item-subtitle
                    >¡Haciendo a la Gente Exitosa en un mundo
                    cambiante!.</v-list-item-subtitle
                >
            </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <v-list dense shaped>
            <v-list-item-group v-model="group" color="primary">
                <inertia-link
                    v-for="item in links"
                    :key="item.id"
                    :href="route(item.route)"
                    v-permission="item.can"
                >
                    <v-list-item
                        :dark="route().current(item.route)"
                        class="mb-2"
                        :class="
                            route().current(item.route)
                                ? 'active primary  white--text'
                                : ''
                        "
                    >
                        <v-list-item-icon>
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title
                                v-text="item.title"
                            ></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </inertia-link>
            </v-list-item-group>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";
import { route } from "ziggy-js";
import { mapMutations, mapState } from "vuex";
export default {
    data() {
        return {
            group: null,
            item: parseInt(this.pagina),
        };
    },
    components: {
        InertiaLink: Link,
    },
    methods: {
        route,
        // otros métodos...
    },
    computed: {
        ...mapState(["drawer", "links", "linksWithAuth"]),
        drawer: {
            get() {
                return this.$store.state.drawer;
            },
            set(val) {
                this.$store.commit("setDrawer", val);
            },
        },
    },
};
</script>

<style></style>
