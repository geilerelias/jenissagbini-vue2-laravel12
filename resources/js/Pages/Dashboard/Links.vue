<template>
    <div>
        <v-banner single-line>
            <v-icon icon="mdi-lock" size="40" color="grey darken-1">
                mdi-link
            </v-icon>
            Enlaces externos
            <v-divider class="mx-4" inset vertical></v-divider>
            <template v-slot:actions>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on }">
                        <v-btn small dark v-on="on">
                            <v-icon>mdi-link-plus</v-icon>
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>
                        <v-form
                            @submit.prevent="save"
                            ref="form"
                            v-model="valid"
                            :lazy-validation="true"
                        >
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="editedItem.link"
                                                :rules="linkRules"
                                                label="Enlace"
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                        </v-form>
                        <v-card-actions>
                            <div class="flex-grow-1"></div>
                            <v-btn color="warning" @click="close">Cancel</v-btn>
                            <v-btn color="success" @click="save">Save</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </template>
        </v-banner>

        <v-data-table
            v-if="lengthLink !== 0"
            :headers="headers"
            :items="links"
            sort-by="calories"
            class="elevation-1 mt-3"
        >
            <template v-slot:item.action="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)">
                    mdi-pencil
                </v-icon>
                <v-icon small @click="deleteItem(item)">
                    mdi-delete
                </v-icon>
            </template>
        </v-data-table>
    </div>
</template>

<script>
export default {
    props: ["link"],
    data() {
        return {
            valid: true,
            dialog: false,
            headers: [
                { text: "Enlace", value: "link" },
                { text: "Actions", value: "action", sortable: false }
            ],
            links: [],
            linkRules: [
                v => !!v || "el enlace es requerido",
                v => /^(http|https)/.test(v) || "el enlace no es valido"
            ],
            editedIndex: -1,
            editedItem: {
                link: ""
            },
            defaultItem: {
                link: ""
            }
        };
    },
    mounted: function() {
        if (typeof this.link == "undefined") {
            console.log("undefined");
            return;
        }
        this.links = this.link;
    },
    methods: {
        editItem(item) {
            this.editedIndex = this.links.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteAllItem() {
            this.links = [];
        },
        deleteItem(item) {
            const index = this.links.indexOf(item);
            Swal.fire({
                title: "¿Estás seguro?",
                text: "No podrás revertir esto!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    this.links.splice(index, 1);
                    Swal.fire(
                        "Eliminada!",
                        "Su item ha sido eliminado.",
                        "success"
                    );
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
            if (!this.$refs.form.validate()) {
                return;
            }
            if (this.editedIndex > -1) {
                Object.assign(this.links[this.editedIndex], this.editedItem);
                this.$emit("addLink", this.links);
            } else {
                this.links.push(this.editedItem);
                this.$emit("addLink", this.links);
            }
            this.close();
        }
    },
    watch: {
        dialog(val) {
            val || this.close();
        }
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Nuevo enlace" : "Editar enlace";
        },
        lengthLink() {
            if (typeof this.link == "undefined") {
                console.log("undefined");
                return 0;
            }

            if (this.link === null) {
                return 0;
            }

            this.links = this.link;
            //console.log('links', this.links);
            return this.links.length;
        }
    }
};
</script>

<style lang="scss" scoped></style>
