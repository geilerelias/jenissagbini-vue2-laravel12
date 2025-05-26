<template>
    <v-card class="rounded-0">
        <v-toolbar dark>
            <v-btn icon dark @click="closeDialog">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Registro de noticia</v-toolbar-title>
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
        <v-container fluid>
            <v-card-text>
                <v-form
                    @submit.prevent="addNotice"
                    ref="form"
                    v-model="valid"
                    :lazy-validation="lazy"
                    enctype="multipart/form-data"
                >
                    <v-row>
                        <v-col cols="12">
                            <picture-input
                                :crop="false"
                                :width="
                                        $vuetify.breakpoint.xsOnly ? 300 : 1000
                                    "
                                :height="
                                        $vuetify.breakpoint.xsOnly ? 200 : 300
                                    "
                                :zIndex="0"
                                ref="pictureInput"
                                @change="onChange"
                                accept="image/jpeg,image/png"
                                :removable="true"
                                button-class="v-btn v-btn--contained theme--light v-size--small info"
                                removeButtonClass="v-btn v-btn--contained theme--light v-size--small error"
                                :customStrings="customStrings"
                            >
                            </picture-input>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                clearable
                                v-model="notice.title"
                                :rules="titleRules"
                                label="Título"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="4" cols="12">
                            <v-text-field
                                clearable
                                v-model="notice.city"
                                :rules="cityRules"
                                label="Ciudad o lugar"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="4" cols="12">
                            <v-menu
                                v-model="menu"
                                :close-on-content-click="false"
                                transition="scale-transition"
                                max-width="290"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                        :value="
                                                computedDateFormattedMomentjs
                                            "
                                        :rules="dateRules"
                                        clearable
                                        label="Fecha"
                                        readonly
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="notice.date"
                                    @change="menu = false"
                                    locale="es"
                                ></v-date-picker>
                            </v-menu>
                        </v-col>
                        <v-col sm="4" cols="12">
                            <v-menu
                                ref="menu"
                                v-model="menu2"
                                :close-on-content-click="false"
                                :nudge-right="40"
                                :return-value.sync="notice.time"
                                transition="scale-transition"
                                offset-y
                                max-width="290px"
                                min-width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                        v-model="notice.time"
                                        label="Hora"
                                        :rules="timeRules"
                                        readonly
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-time-picker
                                    v-if="menu2"
                                    v-model="notice.time"
                                    full-width
                                    @click:minute="
                                            $refs.menu.save(notice.time)
                                        "
                                ></v-time-picker>
                            </v-menu>
                        </v-col>
                    </v-row>
                    <v-label for="myTextEditor">Descripción</v-label>

                    <vue-editor ref="myTextEditor" :rules="descriptionRules"
                                v-model="notice.description"/>
                </v-form>

                <links-component
                    ref="linksComponents"
                    class="mt-4"
                    @addLink="notice.links = $event"
                    :link="notice.links"
                ></links-component>
            </v-card-text>
            <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-btn color="warning" class="mr-4" @click="reset">
                    Reset Form
                </v-btn>
                <v-btn
                    color="success"
                    :disabled="!valid"
                    class="mr-4"
                    @click="validate"
                >
                    Registrar
                </v-btn>
            </v-card-actions>
        </v-container>
    </v-card>
</template>

<script>
import PictureInput from "vue-picture-input";
import moment from "moment";
import format from "date-fns/format";
import links from "../Links.vue";

moment.locale("es");

export default {
    components: {
        "picture-input": PictureInput,
        "links-component": links
    },
    name: "add-notice",
    data: () => ({
        content: "<h1>Some initial content</h1>",
        imageMiniatura: "",
        menu: false,
        menu2: false,
        valid: true,
        lazy: false,
        snackbar: false,
        response: "",
        notice: {
            image: "",
            title: "",
            city: "",
            date: "",
            time: "",
            description: "",
            links: []
        },
        titleRules: [v => !!v || "El título es requerido"],
        cityRules: [v => !!v || "La ciudad o lugar son requeridas"],
        dateRules: [v => !!v || "La fecha es requerida"],
        timeRules: [v => !!v || "La hora es requerida"],
        descriptionRules: [v => !!v || "La descripción es requerida"],
        imageRules: [
            value =>
                !value ||
                value.size < 5000000 ||
                "El tamaño de la imagen debe ser inferior a 5 MB!"
        ],
        customStrings: {
            upload: "<p> Su dispositivo no admite la carga de archivos. </p>", // HTML allowed
            drag:
                "Arrastre una imagen o <br> haga clic aquí para seleccionar 😼", // HTML allowed
            tap: "Toque aquí para seleccionar una foto <br> de su galería", // HTML allowed
            change: "Cambiar", // Text only
            remove: "Eliminar", // Text only
            select: "Selecciona una foto", // Text only
            fileType: "Este tipo de archivo no es compatible."
        },
    }),
    methods: {

        customButtonClick() {
            alert(
                `You can custom the button and listen click event to do something...\n你可以定义一些自定义按钮做你想做的事，如上传图片至第三方存储再插入内容区...等等`
            );
        },
        deleteAllItem() {
            this.$refs.linksComponents.deleteAllItem();
        },
        removeImage() {
            this.$refs.pictureInput.removeImage();
        },
        closeDialog() {
            this.$emit("closeDialog", false);
        },
        onChange(image) {
            console.log("New picture selected!");
            if (image) {
                console.log("Picture loaded.");
                this.notice.image = this.$refs.pictureInput.file;
                console.log(this.$refs.pictureInput.file);
            } else {
                console.log(
                    "FileReader API not supported: use the <form>, Luke!"
                );
            }
        },
        savedNotice(notice) {
            this.$emit("addNotice", notice);
        },
        addNotice() {
            let formData = new FormData();
            formData.append("image", this.notice.image);
            formData.append("title", this.notice.title);
            formData.append("city", this.notice.city);
            formData.append("date", this.notice.date);
            formData.append("time", this.notice.time);
            formData.append("description", this.notice.description);
            formData.append("links", this.notice.links);
            console.log(formData);

            axios
                .post("/notices", formData)
                .then(response => {
                    let noticeAux = response.data;
                    //this.notice = response.data;
                    console.log("este es response", response.data);
                    this.$swal(
                        "Agregada!",
                        "Su noticia ha sido agregada exitosamente!",
                        "success"
                    ).then(result => {
                        this.savedNotice(noticeAux);

                        this.notice.image = "";
                        this.notice.title = "";
                        this.notice.city = "";
                        this.notice.date = "";
                        this.notice.time = "";
                        this.notice.description = "";
                        this.notice.links = [];
                        this.removeImage();
                        // this.deleteAllIntem();
                        this.closeDialog();
                        this.reset();
                    });
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                    const array = error.response.data.errors;
                    let text = "";
                    for (var clave in array) {
                        text += clave + ": " + array[clave] + "\n ";
                    }
                    this.$swal("Error!", text, "error");
                    console.log(text);
                });
        },

        validate() {
            if (!this.$refs.form.validate()) {
                return;
            }
            this.addNotice();
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
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

<style>
#picture-input > div > div > div > span {
    font-size: 20px !important;
}
</style>
