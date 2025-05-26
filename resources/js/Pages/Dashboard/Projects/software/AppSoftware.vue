<template>
    <v-app>
        <v-breadcrumbs :items="items"></v-breadcrumbs>
        <v-card>
            <v-toolbar dark flat>
                <v-btn icon @click="$router.push({ name: 'project/main' })">
                    <v-icon>mdi-arrow-left</v-icon>
                </v-btn>
                <v-toolbar-title>Software Desarrollados</v-toolbar-title>
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
                :search="search"
                :headers="headers"
                :items="softwares"
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
                    <v-container fluid>
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
        menu: false,
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
            { text: "Accion", align: "left", sortable: false, value: "action" }
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
                text: "Software Desarrollados",
                disabled: true,
                href: "/dashboard/project/software"
            }
        ],
        softwares: [],
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
            return this.editedIndex === -1 ? "Nuevo Item" : "Editar Item";
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
            this.softwares = [
                {
                    id: 0,
                    title: `
                            DISEÑO E IMPLEMENTACIÓN DE UN SOFTWARE DE GESTIÓN PARA EL MANEJO DE CITAS MÉDICAS E HISTORIAS CLÍNICAS EN
                            EL CONSULTORIO ESPECIALIZADO DEL DOCTOR HERNÁN AUGUSTO APONTE PENSO EN LA CIUDAD DE VALLEDUPAR.
                        `,
                    description: `
                            Software para el sector salud, dirigido al Consultorio Particular de Neumología del Dr. Hernán Augusto Aponte Penso que permite
                            administrar citas médicas y manejo de la historia clínica de pacientes. Desarrollado en lenguaje php y con el manejador de base
                            de datos MySQL, que es un sistema de gestión de bases de datos relacional desarrollado bajo una Licencia pública general y una
                            Licencia comercial por Oracle Corporation.
                        `,
                    created_at: "2019-10-11 03:09:46",
                    updated_at: "2019-10-11 03:09:46",
                    year: "2016-01",
                    entity: "Fundación Universitaria San Martín.",
                    state: "terminado"
                }
            ];
            this.axios
                .get("/api/software")
                .then(res => {
                    this.softwares = this.softwares.concat(res.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        editItem(item) {
            this.editedIndex = this.softwares.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            const index = this.softwares.indexOf(item);
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
                        .delete(`/api/software/${item.id}`)
                        .then(response => {
                            Swal.fire(
                                "Eliminado!",
                                "Eliminado correctamente.",
                                "success"
                            );
                            this.softwares.splice(index, 1);
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
                    const softwareNuevo = this.editedItem;
                    axios
                        .post("/api/software", softwareNuevo)
                        .then(res => {
                            const softwareServidor = res.data;
                            this.softwares.push(softwareServidor);
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
                .put(`/api/software/${this.softwares[index].id}`, params)
                .then(res => {
                    Object.assign(this.softwares[index], item);
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
