<template>
    <div>
        <v-toolbar dark style="border-radius:0">
            <v-btn dark icon @click="close()">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title class="headline">Agregar nuevo articulo</v-toolbar-title>
            <div class="flex-grow-1"></div>
            <v-toolbar-items>
                <v-btn :disabled="!valid" class="mr-4" text @click="validate">
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
                    enctype="multipart/form-data"
                >
                    <v-row>
                        <v-col cols="12" md="4" sm="6">
                            <v-text-field
                                v-model="editedArticle.title"
                                :rules="titleRules"
                                clearable
                                label="Titulo"
                                prepend-icon="mdi-format-title"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                v-model="editedArticle.description"
                                :rules="descriptionRules"
                                clearable
                                label="Descripción"
                                prepend-icon="mdi-text"
                            ></v-textarea>
                        </v-col>
                        <v-col cols="12">
                            <v-file-input
                                ref="file"
                                v-model="editedArticle.file"
                                :change="onChange(file)"
                                :rules="fileRules"
                                accept=".pdf"
                                label="Seleccione un archivo"
                                single-line
                            />
                        </v-col>
                    </v-row>
                </v-form>
            </v-container>
        </v-card-text>

        <v-card-actions>
            <div class="flex-grow-1 "></div>
            <v-btn class="mr-4 " color="warning " @click="close">
                Cancelar
            </v-btn>
            <v-btn class="mr-4 " color="error " @click="reset">
                Reiniciar
            </v-btn>
            <v-btn
                :disabled="!valid"
                class="mr-4 "
                color="success "
                @click="save"
            >
                Guardar
            </v-btn>
        </v-card-actions>
    </div>
</template>

<script>
//import pdf from "vue-pdf";
export default {
    components: {
        //pdf
    },

    props: ["formTitle", "editedIndex", "editedItem", "idItem"],
    data() {
        return {
            isActive: false,
            loaded: false,
            src: "",
            file: null,
            fileUrl: null,
            show: true,
            numPages: 0,
            rotate: 0,
            valid: true,
            titleRules: [v => !!v || "Titulo es requerido"],
            descriptionRules: [v => !!v || "Descripción es requerida"],
            fileRules: [v => !!v || "El archivo es requerido"],
            lazy: false,
            indexArticle: -1,
            editedArticle: {
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
            }
        };
    },

    methods: {
        Change() {
            let reader = new FileReader();
            reader.onload = () => {
                this.fileUrl = reader.result;
            };
            console.log(reader.readAsDataURL(this.editedArticle.file));
        },
        error: function (err) {
            console.log(err);
        },
        save() {
            if (this.validate()) {
                if (this.editedIndex > -1) {
                    this.edit();
                } else {
                    let formData = new FormData();
                    formData.append("title", this.editedArticle.title);
                    formData.append("description", this.editedArticle.description);
                    formData.append("file", this.editedArticle.file);
                    console.log(formData);
                    axios
                        .post("/articles/others", formData)
                        .then(res => {
                            const othersArticleServidor = res.data;
                            this.$emit(
                                "addOthersArticles",
                                othersArticleServidor
                            );

                            this.$swal(
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
                this.$swal({
                    type: "error",
                    title: "Oops...",
                    text: "Campos no validados!"
                });
            }
        },
        edit() {
            const params = this.editedArticle;
            const index = this.editedIndex;
            let formData = new FormData();
            formData.append("title", this.editedArticle.title);
            formData.append("description", this.editedArticle.description);
            formData.append("file", this.editedArticle.file);

            axios
                .post(`/articles/others/update/${this.idItem}`, formData)
                .then(res => {
                    this.$emit("updateArrayOfOthersArticles", params);

                    this.$swal(
                        "Buen trabajo!",
                        "Editado correctamente!",
                        "success"
                    );
                    this.close();
                })
                .catch(error => {
                    this.$swal({
                        type: "error",
                        title: "Oops...",
                        text: "Algo salió mal!"
                    });
                });
        }
        ,
        validate() {
            if (this.$refs.form.validate()) {
                return true;
            }
            console.log("fallo la validación");
            return false;
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        },
        close() {
            this.$emit("closeDialog", false);
            // this.restoreDefault();

            setTimeout(() => {
                this.editedArticle = Object.assign({}, this.defaultItem);
                this.file = this.defaultItem.file;
                this.$emit("editedItem", this.editedArticle);
                // this.editedItem = Object.assign({}, this.defaultItem);
                this.indexArticle = -1;

                this.$emit("editedIndex", this.indexArticle);
                //this.editedIndex = -1;
                this.reset();
            }, 300);
        },

        onChange(file) {
            console.log("Se presento un cambio file", file);
        }
    }
}
;
</script>

<style></style>
