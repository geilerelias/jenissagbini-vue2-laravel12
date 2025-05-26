<template>
    <v-app>
        <v-breadcrumbs :items="items"></v-breadcrumbs>
        <v-card>
            <v-toolbar dark flat>
                <v-btn icon @click="$router.push({ name: 'project/main' })">
                    <v-icon>mdi-arrow-left</v-icon>
                </v-btn>
                <v-toolbar-title>Emprendimientos </v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <div class="flex-grow-1"></div>
                <v-text-field
                    max-width="200"
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>

                <v-btn icon @click="dialog = !dialog">
                    <v-icon>mdi-plus-circle</v-icon>
                </v-btn>
            </v-toolbar>

            <v-data-table
                :headers="headers"
                :search="search"
                :items="entrepreneurships"
                class="elevation-1"
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
        </v-card>

        <v-dialog
            v-model="dialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <v-card>
                <v-toolbar dark>
                    <v-btn icon dark @click="dialog = !dialog">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title class="headline">{{
                        formTitle
                    }}</v-toolbar-title>
                    <div class="flex-grow-1"></div>
                    <v-toolbar-items>
                        <v-btn
                            text
                            :disabled="!valid"
                            class="mr-4"
                            @click="validate"
                        >
                            Registrar
                        </v-btn>
                    </v-toolbar-items>
                </v-toolbar>

                <v-card-text>
                    <v-container>
                        <v-form
                            ref="form"
                            v-model="valid"
                            :lazy-validation="lazy"
                        >
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        :rules="titleRules"
                                        v-model="editedItem.title"
                                        label="Título"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-textarea
                                        :rules="descriptionRules"
                                        v-model="editedItem.description"
                                        label="Descripción"
                                    ></v-textarea>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-select
                                        :rules="stateRules"
                                        v-model="editedItem.state"
                                        :items="states"
                                        :menu-props="{
                                            top: true,
                                            offsetY: true
                                        }"
                                        label="Estado"
                                    ></v-select>
                                </v-col>
                            </v-row>
                        </v-form>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn color="warning" class="mr-4" @click="close">
                        Cancelar
                    </v-btn>
                    <v-btn color="error" class="mr-4" @click="reset">
                        Reiniciar
                    </v-btn>
                    <v-btn
                        :disabled="!valid"
                        color="success"
                        class="mr-4"
                        @click="save"
                    >
                        Guardar
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>
</template>

<script>
export default {
    data: () => ({
        dialog: false,
        headers: [
            {
                text: "Id",
                align: "left",
                sortable: false,
                value: "id"
            },
            { text: "Titulo", value: "title" },
            { text: "Descripcion", value: "description" },
            { text: "Estado", value: "state" },
            { text: "Actions", value: "action", sortable: false }
        ],
        items: [
            {
                text: "Dashboard",
                disabled: false,
                href: "/dashboard"
            },
            {
                text: "Proyectos",
                disabled: false,
                href: "/dashboard/project"
            },
            {
                text: "Emprendimientos",
                disabled: true,
                href: "/dashboard/project/entrepreneurship"
            }
        ],
        entrepreneurships: [],
        editedIndex: -1,
        editedItem: {
            id: "",
            title: "",
            description: "",
            state: ""
        },
        defaultItem: {
            id: "",
            title: "",
            description: "",
            state: ""
        },
        states: ["Abierto", "Cerrado"],
        search: "",
        valid: true,
        titleRules: [v => !!v || "Titulo es requirido"],
        descriptionRules: [v => !!v || "Descripción es requerida"],
        stateRules: [v => !!v || "Estado es requerido"],

        lazy: false
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New Item" : "Edit Item";
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        }
    },

    mounted() {
        this.initialize();
    },

    methods: {
        initialize() {
            this.entrepreneurships = [
                {
                    title: "HUMUS DEL CESAR S.A.S.",
                    description: `
                        Socia de una empresa privada tipo S.A.S. dedicada a la producción y comercialización
                        de abonos orgánicos y a la prestación de servicios en diseño y elaboración de jardines.
                        Empresa que funcionó en Valledupar y se destacó por su liderazgo en la zona caribeña
                        pues sus productos y servicios tuvieron una cobertura significativa por su buena calidad y
                        excelente servicio a nivel institucional para clientes como Homecenter, Centro Comercial Guatapurí Plaza
                        y profesionales independientes del sector agrícola.
                      `,
                    state: "cerrado",
                    id: 0
                }
            ];
            this.axios
                .get("/api/entrepreneurship")
                .then(res => {
                    this.entrepreneurships = this.entrepreneurships.concat(
                        res.data
                    );
                })
                .catch(error => {
                    console.log(error);
                });
        },
        editItem(item) {
            this.editedIndex = this.entrepreneurships.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            const index = this.entrepreneurships.indexOf(item);
            Swal.fire({
                title: "Estás seguro?",
                html: `Eliminar <b>${item.title}</b>, No podrás revertir esto!`,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#424242",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Eliminar!"
            }).then(result => {
                console.log("item.id", item.id);

                if (result.value) {
                    axios
                        .delete(`/api/entrepreneurship/${item.id}`)
                        .then(response => {
                            Swal.fire(
                                "Eliminado!",
                                "Eliminado correctamente.",
                                "success"
                            );
                            this.entrepreneurships.splice(index, 1);
                        })
                        .catch(error => {
                            Swal.fire(
                                "Oops...",
                                "Algo salió mal!" + error,
                                "error"
                            );
                        });
                }
            });
        },

        close() {
            this.dialog = false;
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            }, 300);
        },

        save() {
            if (this.validate()) {
                if (this.editedIndex > -1) {
                    this.edit();
                } else {
                    const entrepreneurshipsNuevo = this.editedItem;
                    axios
                        .post("/api/entrepreneurship", entrepreneurshipsNuevo)
                        .then(res => {
                            const entrepreneurshipsServidor = res.data;
                            this.entrepreneurships.push(
                                entrepreneurshipsServidor
                            );
                            Swal.fire(
                                "Buen trabajo! 😃",
                                "Registro Exitoso! ",
                                "success"
                            );
                        })
                        .catch(error => {
                            console.error(error);
                        });
                    this.close();
                }
            } else {
                Swal.fire({
                    type: "error",
                    title: "Oops...",
                    text: "Campos no validados!"
                });
            }
        },
        edit() {
            const params = this.editedItem;
            const index = this.editedIndex;
            const item = this.editedItem;
            axios
                .put(
                    `/api/entrepreneurship/${this.entrepreneurships[index].id}`,
                    params
                )
                .then(res => {
                    Object.assign(this.entrepreneurships[index], item);
                    Swal.fire(
                        "Buen trabajo!",
                        "Editado correctamente!",
                        "success"
                    );
                    this.close();
                })
                .catch(error => {
                    Swal.fire({
                        type: "error",
                        title: "Oops...",
                        text: "Algo salió mal!"
                    });
                });
        },
        validate() {
            if (this.$refs.form.validate()) {
                return true;
            }
            console.log("fallo la validacion");
            return false;
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        }
    }
};
</script>

<style lang="scss" scoped></style>
