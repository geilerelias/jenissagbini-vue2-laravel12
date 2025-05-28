<template>
    <app-layout>
        <bread-crumbs name="Gestión de Otros Artículos " :items="items"></bread-crumbs>
        <v-container fluid>
            <v-row class="ma-0">
                <v-card class="ma-1" style="width: 100%;">
                    <v-card-text class="">
                        <v-row class=" no-gutters">
                            <div class="d-flex justify-space-between justify-md-start col-md-6 col-12">
                                <v-btn
                                    @click="dialog = !dialog"
                                    class="mr-3 success">
                                    <v-icon class="notranslate mr-2">
                                        mdi-plus
                                    </v-icon>
                                    Add
                                </v-btn>

                                <v-btn outlined
                                       class="button-shadow primary--text">
                                    <v-icon aria-hidden="true"
                                            class="notranslate mr-2">
                                        mdi-filter-variant
                                    </v-icon>
                                    Filters
                                </v-btn>
                            </div>
                            <v-spacer></v-spacer>

                            <div style="max-width: 250px;" class="mx-auto mt-4 mt-md-0">
                                <v-text-field hide-details dense enclosed outlined
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
                <v-card class="ma-1" style="width: 100%;">
                    <v-card-text class="">
                        <v-data-table
                            :search="search"
                            :headers="headers"
                            :items="othersArticles"
                        >
                            <template v-slot:item.action="{ item }">
                                <v-icon small class="mr-2" @click="editItem(item)">
                                    mdi-pencil
                                </v-icon>
                                <v-icon small @click="deleteItem(item)">
                                    mdi-delete
                                </v-icon>
                            </template>
                            <template v-slot:no-data>
                                <v-btn color="primary" @click="initialize">Reset</v-btn>
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-row>

            <v-row justify="center">
                <v-dialog
                    v-model="dialog"
                    fullscreen
                    hide-overlay
                    transition="dialog-bottom-transition"
                >
                    <v-card>
                        <add-other-article
                            :formTitle="formTitle"
                            :editedItem="editedItem"
                            :editedIndex="editedIndex"
                            :idItem="othersArticles[editedIndex]"
                            @updateArrayOfOthersArticles="
                            Object.assign(othersArticles[index], $event)
                        "
                            @addOthersArticles="othersArticles.push($event)"
                            @closeDialog="dialog = $event"
                            @editedItem="editedItem = $event"
                            @editedIndex="editedIndex = $event"
                        ></add-other-article>
                    </v-card>
                </v-dialog>
            </v-row>
        </v-container>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import BreadCrumbs from "@/components/BreadCrumbs.vue";
import AddOtherArticle from "./AddOtherArticle.vue";
// var loadingTask = pdf.createLoadingTask('/pdfs/Resolucion 29452 de 2017.pdf');
export default {
    components: {
        AddOtherArticle,
        AppLayout,
        BreadCrumbs
    },
    data: () => ({
        dialog2: false,
        notifications: false,
        sound: true,
        widgets: false,
        viewDocument: false,
        dialog: false,
        headers: [
            {
                text: "Id",
                align: "left",
                sortable: false,
                value: "id"
            },
            {text: "Titulo", value: "title"},
            {text: "Descripción", value: "description"},
            {text: "Accion", align: "left", sortable: false, value: "action"}
        ],
        items: [
            {
                text: "Dashboard",
                disabled: false,
                href: "/dashboard"
            },
            {
                text: "Artículos",
                disabled: false,
                href: "/dashboard/articles"
            },
            {
                text: "Otros Artículos",
                disabled: true,
                href: "#"
            }
        ],
        othersArticles: [],
        editedIndex: -1,
        editedItem: {
            id: "",
            title: "",
            description: "",
            file: null
        },
        defaultItem: {
            id: "",
            title: "",
            description: "",
            file: null
        },
        search: ""
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Nuevo Item" : "Editar Item";
        }
    },
    mounted() {
        this.initialize();
    },

    methods: {
        initialize() {
            this.othersArticles = [
                {
                    id: "0",
                    title: "Ejemplo de otro articulo",
                    description: "Este es el ejemplo de otro articulo",
                    file: "",
                    created_at: "2019-10-11 03:09:46",
                    updated_at: "2019-10-11 03:09:46"
                }
            ];
            axios
                .get("/othersArticle/all")
                .then(res => {
                    console.log('hasta aqui esta todo bien', res)
                    this.othersArticles = this.othersArticles.concat(res.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        editItem(item) {
            console.log("this is item: ", item);
            this.editedIndex = this.othersArticles.indexOf(item);
            console.log(this.editedIndex);
            this.editedItem = Object.assign({}, item);
            console.log(this.editedItem);
            this.dialog = true;
        },

        deleteItem(item) {
            const index = this.othersArticles.indexOf(item);


            this.$swal({
                title: "Estás seguro?",
                html: `Eliminar <b>${item.title}</b>, No podrás revertir esto!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#424242",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Eliminar!",

            }).then(result => {
                console.log("item.id", item.id);

                if (result.value) {
                    axios
                        .delete(`/articles/others/${item.id}`)
                        .then(response => {
                            this.$swal(
                                "Eliminado!",
                                "Eliminado correctamente.",
                                "success"
                            );
                            this.othersArticles.splice(index, 1);
                        })
                        .catch(error => {
                            this.$swal(
                                "Oops...",
                                "Algo salió mal! " + error,
                                "error"
                            );
                        });
                }
            });
        }
    }
};
</script>
