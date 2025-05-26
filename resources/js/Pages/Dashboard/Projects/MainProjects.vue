<template>
    <app-layout>
        <bread-crumbs name="Gestión de proyectos" :items="items"></bread-crumbs>

        <v-container grid-list-lg>
            <v-layout row wrap>
                <v-flex xs12 sm12 md4>
                    <v-hover v-slot:default="{ hover }" open-delay="200">
                        <v-card
                            :elevation="hover ? 16 : 2"
                            @click="
                                $router.push({
                                    name: 'project/entrepreneurship'
                                })
                            "
                        >
                            <v-list-item three-line>
                                <v-list-item-avatar
                                    color="grey lighten-2"
                                    size="80"
                                >
                                    <v-icon color="grey darken-3" size="60"
                                    >mdi-account-tie
                                    </v-icon
                                    >
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title
                                        class="headline mb-1  darken-4--text"
                                    >Emprendimientos
                                    </v-list-item-title
                                    >
                                    <v-list-item-subtitle
                                    >Gestión de proyectos de
                                        emprendimiento
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
                    </v-hover>
                </v-flex>
                <v-flex xs12 sm12 md4>
                    <v-hover v-slot:default="{ hover }" open-delay="200">
                        <v-card
                            :elevation="hover ? 16 : 2"
                            @click="$router.push({ name: 'project/software' })"
                        >
                            <v-list-item three-line>
                                <v-list-item-avatar
                                    color="grey lighten-2"
                                    size="80"
                                >
                                    <v-icon color="grey darken-3" size="60"
                                    >mdi-cellphone-link
                                    </v-icon
                                    >
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title
                                        class="headline mb-1  darken-4--text"
                                    >Software
                                        Desarrollados
                                    </v-list-item-title
                                    >
                                    <v-list-item-subtitle
                                    >Gestión de Software
                                        Desarrollados
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
                    </v-hover>
                </v-flex>
                <v-flex xs12 sm12 md4>
                    <v-hover v-slot:default="{ hover }" open-delay="200">
                        <v-card
                            :elevation="hover ? 16 : 2"
                            @click="$router.push({ name: 'project/business' })"
                        >
                            <v-list-item three-line>
                                <v-list-item-avatar
                                    color="grey lighten-2"
                                    size="80"
                                >
                                    <v-icon color="grey darken-3" size="60"
                                    >mdi-domain
                                    </v-icon
                                    >
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title
                                        class="headline mb-1  darken-4--text"
                                    >Planes de Negocios
                                    </v-list-item-title
                                    >
                                    <v-list-item-subtitle
                                    >Gestión de Planes de Negocios
                                        Desarrollados
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
                    </v-hover>
                </v-flex>
                <v-flex xs12 sm12 md4>
                    <v-hover v-slot:default="{ hover }" open-delay="200">
                        <v-card
                            :elevation="hover ? 16 : 2"
                            @click="$router.push({ name: 'project/thesis' })"
                        >
                            <v-list-item three-line>
                                <v-list-item-avatar
                                    color="grey lighten-2"
                                    size="80"
                                >
                                    <v-icon color="grey darken-3" size="60"
                                    >mdi-book-play
                                    </v-icon
                                    >
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title
                                        class="headline mb-1  darken-4--text"
                                    >Tesis Dirigidas
                                    </v-list-item-title
                                    >
                                    <v-list-item-subtitle
                                    >Tesis de Grado Dirigidas en
                                        Instituciones Educativas Nivel
                                        Profesional y Formación para el
                                        Trabajo
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
                    </v-hover>
                </v-flex>
                <v-flex xs12 sm12 md4>
                    <v-hover v-slot:default="{ hover }" open-delay="200">
                        <v-card
                            :elevation="hover ? 16 : 2"
                            @click="$router.push({ name: 'project/jury' })"
                        >
                            <v-list-item three-line>
                                <v-list-item-avatar
                                    color="grey lighten-2"
                                    size="80"
                                >
                                    <v-icon color="grey darken-3" size="60"
                                    >mdi-book-open-page-variant
                                    </v-icon
                                    >
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <v-list-item-title
                                        class="headline mb-1  darken-4--text"
                                    >Jurado de Tesis
                                    </v-list-item-title
                                    >
                                    <v-list-item-subtitle
                                    >Participación como Jurado de Tesis en
                                        Instituciones Educativas Nivel
                                        Profesional y Formación para el
                                        Trabajo
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
                    </v-hover>
                </v-flex>
            </v-layout>
        </v-container>
    </app-layout>
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
                    text: "Proyectos",
                    disabled: true,
                    href: "#"
                }
            ]
        };
    }
};
</script>

<style lang="scss" scoped></style>
