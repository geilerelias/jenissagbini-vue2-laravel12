<template>
    <AppLayout>
        <bread-crumbs name="Noticias" :items="items"></bread-crumbs>
        <v-container fluid>
            <v-row class="ma-0">
                <v-card class="ma-1" style="width: 100%;">
                    <v-card-text class="">
                        <v-row class=" no-gutters">
                            <div
                                class="d-flex justify-space-between justify-md-start col-md-6 col-12"
                            >
                                <v-btn
                                    @click="dialog = !dialog"
                                    class="mr-3 success"
                                >
                                    <v-icon class="notranslate mr-2">
                                        mdi-plus
                                    </v-icon>
                                    Add
                                </v-btn>

                                <v-btn
                                    outlined
                                    class="button-shadow primary--text"
                                >
                                    <v-icon
                                        aria-hidden="true"
                                        class="notranslate mr-2"
                                    >
                                        mdi-filter-variant
                                    </v-icon>
                                    Filters
                                </v-btn>
                            </div>
                            <v-spacer></v-spacer>

                            <div
                                style="max-width: 250px;"
                                class="mx-auto mt-4 mt-md-0"
                            >
                                <v-text-field
                                    hide-details
                                    dense
                                    enclosed
                                    outlined
                                    append-icon="mdi-magnify"
                                    placeholder="search"
                                    v-model="search"
                                ></v-text-field>
                            </div>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-row>

            <v-row class="ma-0">
                <v-card class="ma-6" style="width: 100%;">
                    <v-card-text class="">
                        <v-data-table
                            :headers="headers"
                            :items="notices"
                            :search="search"
                        >
                            <template v-slot:item.action="{ item }">
                                <inertia-link
                                    :href="route('notices.edit', item.id)"
                                >
                                    <v-btn icon small class="mr-2">
                                        <v-icon small>
                                            mdi-pencil-outline
                                        </v-icon>
                                    </v-btn>
                                </inertia-link>
                                <inertia-link
                                    :href="route('notices.show', item.id)"
                                >
                                    <v-btn icon small>
                                        <v-icon small>
                                            mdi-delete-outline
                                        </v-icon>
                                    </v-btn>
                                </inertia-link>
                            </template>

                            <template v-slot:item.image="{ item }">
                                <v-avatar>
                                    <img
                                        :src="'/storage/' + item.image"
                                        alt="image"
                                    />
                                </v-avatar>
                            </template>
                            <template v-slot:no-data>
                                <v-btn small @click="initialize">Reset</v-btn>
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-row>
        </v-container>
        <v-dialog
            v-model="dialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <v-card>
                <add-notice-component
                    @addNotice="updateArray($event)"
                    @closeDialog="dialog = $event"
                ></add-notice-component>
            </v-card>
        </v-dialog>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import BreadCrumbs from "@/components/BreadCrumbs.vue";

import AddNotices from "./AddNotice.vue";

export default {
    components: {
        "add-notice-component": AddNotices,
        AppLayout,
        BreadCrumbs
    },
    props: ["notices"],
    data() {
        return {
            search: "",
            size: { height: null, width: null },
            dialog: false,
            notifications: false,
            sound: true,
            widgets: false,
            items: [
                {
                    text: "Dashboard",
                    disabled: false,
                    href: "/dashboard"
                },
                {
                    text: "Noticias",
                    disabled: true,
                    href: "#"
                }
            ],
            headers: [
                {
                    text: "Id",
                    align: "left",
                    sortable: false,
                    value: "id"
                },
                {
                    text: "Imagen",
                    sortable: false,
                    value: "image"
                },
                { text: "Titulo", value: "title" },
                { text: "Ciudad", value: "city" },
                { text: "Fecha", value: "date" },
                { text: "Hora", value: "time" },
                {
                    text: "Accion",
                    align: "left",
                    sortable: false,
                    value: "action"
                }
            ]
        };
    },
    methods: {
        initialize() {
            axios.get("/notices/all").then(res => {
                this.notices = res.data;
            });
        },
        updateArray(notice) {
            console.log("esta es la noticia", notice);
            this.notices.push(notice);
        }
    }
};
</script>
<style lang="scss" scoped></style>
