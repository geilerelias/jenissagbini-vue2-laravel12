<template>
    <AppLayout>
        <bread-crumbs name="Gestión de Artículos" :items="items"></bread-crumbs>

        <v-container grid-list-lg>
            <v-layout row wrap>
                <v-flex xs12 sm12 md6>
                    <v-hover v-slot:default="{ hover }" open-delay="200">
                        <inertia-link href="articles/published">
                            <v-card
                                :elevation="hover ? 16 : 2"
                                @click="">
                                <v-list-item three-line>
                                    <v-list-item-avatar
                                        color="grey lighten-2"
                                        size="80"
                                    >
                                        <v-icon color="grey darken-3" size="60"
                                        >mdi-newspaper-variant-outline
                                        </v-icon
                                        >
                                    </v-list-item-avatar>
                                    <v-list-item-content>
                                        <v-list-item-title
                                            class="headline mb-1  darken-4--text"
                                        >Articulos Publicados
                                        </v-list-item-title>
                                        <v-list-item-subtitle
                                        >Gestión de Articulos Publicados en
                                            revistas
                                        </v-list-item-subtitle
                                        >
                                    </v-list-item-content>
                                </v-list-item>

                                <v-card-actions>
                                    <div class="flex-grow-1"></div>
                                    <v-btn text color="grey darken-3" dark
                                    >Gestionar
                                    </v-btn
                                    >
                                </v-card-actions>
                            </v-card>
                        </inertia-link>
                    </v-hover>
                </v-flex>

                <v-flex xs12 sm12 md6>
                    <v-hover v-slot:default="{ hover }" open-delay="200">
                        <inertia-link href="/articles/others">
                            <v-card
                                :elevation="hover ? 16 : 2"
                                @click=""
                            >
                                <v-list-item three-line>
                                    <v-list-item-avatar
                                        color="grey lighten-2"
                                        size="80"
                                    >
                                        <v-icon color="grey darken-3" size="60"
                                        >mdi-pdf-box
                                        </v-icon
                                        >
                                    </v-list-item-avatar>
                                    <v-list-item-content>
                                        <v-list-item-title
                                            class="headline mb-1  darken-4--text"
                                        >
                                            Otros Artículos
                                        </v-list-item-title>
                                        <v-list-item-subtitle>
                                            Administre artículos que aún no se han
                                            publicado en
                                            revistas.
                                        </v-list-item-subtitle
                                        >
                                    </v-list-item-content>
                                </v-list-item>

                                <v-card-actions>
                                    <div class="flex-grow-1"></div>
                                    <v-btn text color="grey darken-3" dark
                                    >Gestionar
                                    </v-btn
                                    >
                                </v-card-actions>
                            </v-card>
                        </inertia-link>
                    </v-hover>
                </v-flex>
            </v-layout>
        </v-container>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import BreadCrumbs from "@/components/BreadCrumbs";

export default {
    components: {
        AppLayout,
        BreadCrumbs,
    },
    data() {
        return {
            items: [
                {
                    text: "Dashboard",
                    disabled: false,
                    href: "/dashboard"
                },
                {
                    text: "Artículos",
                    disabled: true,
                    href: "#"
                }
            ]
        };
    }
}
;
</script>

<style lang="scss" scoped></style>
