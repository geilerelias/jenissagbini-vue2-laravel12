<template>
    <app-layout>
        <bread-crumbs name="¿Quién soy?" :items="items"></bread-crumbs>
        <v-container fluid>
            <v-card class="rounded-0">
                <v-toolbar flat>
                    <v-toolbar-title>¿Quién soy?</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <div>
                        <v-switch
                            v-model="viewAll"
                            label="Expandir todos"
                            hide-details
                        ></v-switch>
                    </div>
                </v-toolbar>
                <v-banner>
                    En esta sesión esta a disponibilidad del usuario registrar la
                    información pertinente en cada item. recuerda dar click en la
                    opción que deseas editar o puedes mostrar todos
                    <template v-slot:actions>
                        <v-btn text color="deep-purple accent-4" @click="add">
                            Agregar Item
                        </v-btn>
                    </template>
                </v-banner>
                <v-card-text class="grey lighten-4">
                    <v-row justify="center">
                        <v-expansion-panels
                            popout
                            focusable
                            v-model="panel"
                            multiple
                        >
                            <v-expansion-panel
                                v-for="(item, i) in data"
                                :key="i"
                                @click="dimensionar(`panelInterno${i}`)"
                                :id="`panelInterno${i}`"
                            >
                                <v-expansion-panel-header>
                                <span>
                                    <v-avatar size="36" color="grey lighten-2">
                                        <v-icon dark color="grey darken-3">
                                            {{ item.icon }}
                                        </v-icon>
                                    </v-avatar>
                                    {{ item.name }}
                                </span>
                                </v-expansion-panel-header>

                                <v-expansion-panel-content>
                                    <v-card outlined class="mt-5">
                                        <v-card-title primary-title>
                                            <v-spacer></v-spacer>

                                            <v-btn
                                                icon
                                                color="red light"
                                                @click="remove(item)"
                                            >
                                                <v-icon>mdi-delete</v-icon>
                                            </v-btn>
                                        </v-card-title>

                                        <v-card-title></v-card-title>
                                        <v-row align="center" justify="center">
                                            <v-col cols="12" sm="8" md="4">
                                                {{ item.image }}
                                                <v-card class="elevation-12">
                                                    <v-img
                                                        height="300px"
                                                        :src="item.image"
                                                    />
                                                    <v-card-actions>
                                                        <v-file-input
                                                            :id="`imagen${item.id}`"
                                                            label="Elige una imagen"
                                                            prepend-icon="mdi-camera"
                                                            @change="
                                                            onFileChange(item)
                                                        "
                                                        ></v-file-input>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-col>
                                        </v-row>

                                        <v-card-text>
                                            <v-text-field
                                                v-model="item.title"
                                                label="Titulo"
                                            ></v-text-field>

                                            Contenido
                                            <vue-editor ref="myTextEditor"
                                                        v-model="item.content"/>
                                            <v-row>
                                                <v-col>
                                                    <v-text-field
                                                        v-model="item.icon"
                                                        label="Icono"
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col>
                                                    <v-text-field
                                                        v-model="item.name"
                                                        label="Nombre"
                                                    ></v-text-field>
                                                </v-col>
                                            </v-row>
                                        </v-card-text>

                                        <v-card-actions>
                                            <v-spacer/>

                                            <v-btn
                                                color="primary"
                                                @click="edit(item)"
                                            >
                                                Guardar Cambios
                                            </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-container>
    </app-layout>
</template>

<script>

import PictureInput from "vue-picture-input";
//import PictureInput from "./PictureInput.vue";
import AppLayout from '@/Layouts/AppLayout'
import BreadCrumbs from "@/components/BreadCrumbs";

export default {

    components: {
        AppLayout,
        BreadCrumbs,
        "picture-input": PictureInput
    },
    props: ['data'],
    data() {
        return {
            isUploadImage: false,
            itemTemp: null,
            image: null,
            hasUrl: null,
            dialog: false,
            panel: [],
            viewAll: false,
            name: "01-example",
            content: "",
            changedImage: false,
            items: [
                {
                    text: "Dashboard",
                    disabled: false,
                    href: "/dashboard"
                },
                {
                    text: "¿Quién soy?",
                    disabled: true,
                    href: "#"
                }
            ]
        };
    },
    created() {
        this.initialize();
    },
    methods: {
        dimensionar(panel) {
            console.log("intento cambiar el tamaño");

            var element = document.getElementById(panel);
            element.style.width = "100vh";
            console.log(element);
        },
        add() {
            var params = {
                id: "",
                image: "",
                name: "",
                title: "",
                content: "",
                icon: ""
            };

            axios
                .post("/about", params)
                .then(res => {
                    this.data.push(params);
                    console.log(res.data);
                    this.$swal(
                        "Buen trabajo!",
                        "Iten adiccionado de manera exitosa!",
                        "success"
                    );
                })
                .catch(error => {
                    this.$swal("Lo sentimos!", "Algo ha ido mal!", "error");
                });
        },
        edit(item) {
            var editedIndex = this.data.indexOf(item);
            var image = document.getElementById(`imagen${item.id}`).files[0];
            console.log(item.image);

            var formData = new FormData();

            if (image !== undefined) {
                formData.append("image", image);
            } else {
                formData.append("image", item.image.replace("/storage/", ""));
            }

            formData.append("image", item.image);
            console.log("image", item.image);

            formData.append("title", item.title);
            console.log("title: ", item.title);
            formData.append("name", item.name);
            console.log("name: ", item.name);
            formData.append("icon", item.icon);
            console.log("icon: ", item.icon);
            formData.append("content", item.content);
            console.log("content: ", item.content);

            console.log("enviado: ", formData);

            axios.post(`/about/update/${item.id}`, formData)
                .then(response => {
                    console.log("data: ", response.data);
                    var res = response.data;
                    image = undefined;
                    console.log("item ", this.data[editedIndex]);
                    this.data[editedIndex].image = `/storage/${res.image}`;
                    console.log("data ", this.data);

                    this.$swal(
                        "Buen trabajo!",
                        "Información modificada con éxito!",
                        "success"
                    );
                })
                .catch(error => {
                    this.$swal(
                        "Lo sentimos!",
                        "Algo ha ido mal en la modificación!",
                        "error"
                    );
                });
        },
        remove(item) {
            const params = item;

            this.$swal({
                title: "¿Estas seguro?",
                text: "No podrás revertir esto!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, elimínar!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete(`/about/${item.id}`)
                        .then(res => {
                            console.log(res.data);
                            const index = this.data.indexOf(item);
                            this.data.splice(index, 1);
                            this.$swal(
                                "Buen trabajo!",
                                "Información eliminada con éxito!",
                                "success"
                            );
                        })
                        .catch(error => {
                            this.$swal(
                                "Lo sentimos!",
                                "Algo ha ido mal!",
                                "error"
                            );
                        });
                }
            });
        },

        initialize() {
            console.log('for each')
            this.data.forEach(function (item) {
                item.image = '/storage/' + item.image
                console.log(item.image)
            });
        },
        onFileChange(item) {
            this.changedImage = true;
            var element = document.getElementById(`imagen${item.id}`);
            var e = element.files[0];
            console.log(e);
            const editedIndex = this.data.indexOf(item);
            let editedItem = Object.assign({}, item);
            editedItem.image = window.URL.createObjectURL(e);

            Object.assign(this.data[editedIndex], editedItem);
            console.log(this.data);
        }
    },
    watch: {
        viewAll(val) {
            if (val) {
                this.panel = [...Array(this.data.length).keys()].map(
                    (k, i) => i
                );
            } else {
                this.panel = [];
            }
            console.log();
        }
    }
};
</script>

