<template>
    <AppLayout>
        <bread-crumbs name="Eliminar noticias" :items="items"></bread-crumbs>
        <v-container fluid>
            <v-card class="rounded-0">
                <v-card-text>
                    <v-container fluid>
                        <v-row>
                            <v-col sm="5">
                                <v-card>
                                    <v-img height="300px" :src="path"></v-img>
                                </v-card>
                            </v-col>
                            <v-col sm="7">
                                <v-row>
                                    <v-col>
                                        <p>
                                            <v-input
                                                class="black--text"
                                                :messages="[notice.title]"
                                            >
                                                Título
                                            </v-input>
                                        </p>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-input
                                            class="black--text"
                                            :messages="[notice.city]"
                                        >
                                            Ciudad o lugar
                                        </v-input>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-input
                                            class="black--text"
                                            :messages="[
                                            computedDateFormattedMomentjs
                                        ]"
                                        >
                                            Fecha
                                        </v-input>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-input
                                            class="black--text"
                                            :messages="[notice.time]"
                                        >
                                            Hora
                                        </v-input>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                        <v-input class="black--text">
                            Descripción
                        </v-input>
                        <v-input class="gray--text" v-html="notice.description">
                        </v-input>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-btn block color="error" @click="deleteNotice">
                        Eliminar noticia
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-container>
    </AppLayout>
</template>

<script>
import moment from "moment";
import format from "date-fns/format";

import AppLayout from '@/Layouts/AppLayout'
import BreadCrumbs from "@/components/BreadCrumbs";

moment.locale("es");

export default {
    props: ['notice'],
    components: {
        AppLayout,
        BreadCrumbs,
    },
    data: () => ({
        path: "",
        snackbar: false,
        response: "",
        items: [
            {
                text: "Dashboard",
                disabled: false,
                href: "/dashboard"
            },
            {
                text: "Noticias",
                disabled: false,
                href: "/notices"
            },
            {
                text: "Eliminar",
                disabled: true,
                href: "#"
            }
        ],
    }),
    mounted: function () {
        this.path = "/storage/" + this.notice.image;
    },

    methods: {
        deleteNotice() {
            this.$swal({
                title: "¿Estás seguro?",
                text: "No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete(`/notices/${this.notice.id}`)
                        .then(response => {
                            this.$swal(
                                "Eliminada!",
                                "Su noticia ha sido eliminada.",
                                "success"
                            ).then(result => {
                                this.$inertia.get(route('notices.index'));
                            });
                            //console.log(response.data);
                        })
                        .catch(error => {
                            this.$swal(
                                "No eliminada!",
                                "Su noticia no ha sido eliminada.",
                                "error"
                            ).then(result => {
                                this.$router.go(-1);
                            });
                            console.log(error);
                        });
                }
            });
        }
    },
    computed: {
        computedDateFormattedMomentjs() {
            return this.notice.date
                ? moment(this.notice.date).format("dddd, D MMMM YYYY")
                : "";
        }
    }
};
</script>

<style lang="scss" scoped></style>
