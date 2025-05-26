<template>
    <v-app>
        <v-breadcrumbs :items="items"></v-breadcrumbs>
        <v-card>
            <v-toolbar dark flat>
                <v-btn icon @click="$router.push({ name: 'project/main' })">
                    <v-icon>mdi-arrow-left</v-icon>
                </v-btn>
                <v-toolbar-title
                    >Planes de Negocios Desarrollados</v-toolbar-title
                >
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
                :items="businesses"
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
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        clearable
                                        v-model="editedItem.title"
                                        :rules="titleRules"
                                        label="Titulo"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        clearable
                                        v-model="editedItem.entity"
                                        :rules="entityRules"
                                        label="Entidad promotora"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-menu
                                        ref="menu"
                                        v-model="menu"
                                        :close-on-content-click="false"
                                        :return-value.sync="editedItem.year"
                                        transition="scale-transition"
                                        offset-y
                                        max-width="290px"
                                        min-width="290px"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-text-field
                                                v-model="editedItem.year"
                                                :rules="yearRules"
                                                label="Fecha"
                                                readonly
                                                v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                            v-model="editedItem.year"
                                            type="month"
                                            locale="es"
                                            no-title
                                            scrollable
                                        >
                                            <div class="flex-grow-1"></div>
                                            <v-btn
                                                text
                                                color="primary"
                                                @click="menu = false"
                                                >Cancel</v-btn
                                            >
                                            <v-btn
                                                text
                                                color="primary"
                                                @click="
                                                    $refs.menu.save(
                                                        editedItem.year
                                                    )
                                                "
                                                >OK</v-btn
                                            >
                                        </v-date-picker>
                                    </v-menu>
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
                                <v-col cols="12">
                                    <v-textarea
                                        clearable
                                        v-model="editedItem.description"
                                        :rules="descriptionRules"
                                        label="Descripción"
                                    ></v-textarea>
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
            { text: "Entidad", value: "entity" },
            { text: "Año", value: "year" },
            { text: "Descripción", value: "description" },
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
                text: "Planes de Negocios ",
                disabled: true,
                href: "/dashboard/project/business"
            }
        ],
        businesses: [],
        editedIndex: -1,
        editedItem: {
            id: "",
            title: "",
            description: "",
            year: "",
            entity: "",
            state: ""
        },
        defaultItem: {
            id: "",
            title: "",
            description: "",
            year: "",
            entity: "",
            state: ""
        },
        states: ["Abierto", "Cerrado", "Terminado"],
        search: "",
        valid: true,
        titleRules: [v => !!v || "Titulo es requirido"],
        yearRules: [v => !!v || "Año es requerido"],
        entityRules: [v => !!v || "Entidad promotora es requerida"],
        descriptionRules: [v => !!v || "Descripción es requerida"],
        stateRules: [v => !!v || "Estado  es requerido"],
        states: ["Abierto", "Cerrado", "Terminado"],

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
            this.businesses = [
                {
                    title: `
                        PLAN DE NEGOCIO “CREACIÓN DE UNA COMERCIALIZADORA DE SEMOVIENTES, PRODUCTOS Y SERVICIOS PECUARIOS EN LA ZONA NORTE
                        DEL DEPARTAMENTO DEL CESAR”.
                      `,
                    description: `
                        Plan de Negocios orientado a la creación de una empresa digital regional lamada “Ganaventas” en el sector
                        agrario cuyas principales actividades son: Asesorías y evaluación de proyectos productivos destinados al sector pecuario,
                        Comercializar Ganados, compra y venta de tierra, maquinaria usadas agrícolas.
                      `,
                    state: "Terminado",
                    id: 0
                }
            ];
            this.axios
                .get("/api/business")
                .then(res => {
                    this.businesses = this.businesses.concat(res.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        editItem(item) {
            this.editedIndex = this.businesses.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            const index = this.businesses.indexOf(item);
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
                        .delete(`/api/business/${item.id}`)
                        .then(response => {
                            Swal.fire(
                                "Eliminado!",
                                "Eliminado correctamente.",
                                "success"
                            );
                            this.businesses.splice(index, 1);
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
                    const businessesNuevo = this.editedItem;
                    axios
                        .post("/api/business", businessesNuevo)
                        .then(res => {
                            const businessesServidor = res.data;
                            this.businesses.push(businessesServidor);
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
                .put(`/api/business/${this.businesses[index].id}`, params)
                .then(res => {
                    Object.assign(this.businesses[index], item);
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
