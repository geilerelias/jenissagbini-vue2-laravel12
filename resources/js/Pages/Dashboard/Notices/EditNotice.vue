<template>
    <AppLayout>
        <bread-crumbs name="Editar noticias" :items="items"></bread-crumbs>
        <v-container fluid>
            <v-card class="rounded-0">
                <v-container fluid>
                    <v-card-text>
                        <v-form
                            @submit.prevent="editNotice"
                            ref="form"
                            v-model="valid"
                            :lazy-validation="lazy"
                            enctype="multipart/form-data"
                        >
                            <v-row>
                                <v-col cols="12">
                                    <picture-input
                                        :prefill="prefill"
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
                                        accept="image/jpeg,image/png,,image/jpg"
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
                                        counter="60"
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
                    </v-card-text>
                    <links-component
                        ref="linksComponets"
                        class="mt-4"
                        @addLink="notice.links = $event"
                        :link="
                        Array.isArray(notice.links)
                            ? notice.links
                            : JSON.parse(notice.links)
                    "
                    ></links-component>

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
                            Editar
                        </v-btn>
                    </v-card-actions>
                </v-container>
            </v-card>
        </v-container>
    </AppLayout>
</template>

<script>
import PictureInput from "vue-picture-input";
import moment from "moment";
import format from "date-fns/format";
import links from "../Links.vue";

import AppLayout from '@/Layouts/AppLayout'
import BreadCrumbs from "@/components/BreadCrumbs";

moment.locale("es");

export default {
    components: {
        "picture-input": PictureInput,
        "links-component": links,
        AppLayout,
        BreadCrumbs,
    },
    props: ['notice'],
    data: () => ({
        prefill: "",
        imageMiniatura: "",
        menu: false,
        menu2: false,
        valid: true,
        lazy: false,
        snackbar: false,
        response: "",
        newNotice: {
            id: "",
            image: "",
            title: "",
            city: "",
            date: "",
            time: "",
            description: "",
            links: []
        },

        titleRules: [
            v => !!v || "El título es requerido",
            v =>
                (v && v.length <= 60) ||
                "El título no puede tener mas de 60 caracteres"
        ],
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
                text: "Editar",
                disabled: true,
                href: "#"
            }
        ],

    }),
    mounted: function () {
        this.notice.links = JSON.parse(this.notice.links);
        this.prefill = encodeURI("/storage/" + this.notice.image);
        console.log(this.prefill);
    },
    methods: {
        closeDialog() {
            this.$emit("closeDialog", false);
        },
        onChange(image) {
            console.log("New picture selected!");
            if (image) {
                // console.log('Picture loaded.')
                this.notice.image = this.$refs.pictureInput.file;
                //  console.log(this.$refs.pictureInput.file);
            } else {
                console.log(
                    "FileReader API not supported: use the <form>, Luke!"
                );
            }
        },
        editNotice() {
            console.log('edit notice')
            this.notice.image = this.$refs.pictureInput.file;
            // console.log(this.notice.links);
            let formData = new FormData();
            formData.append("image", this.notice.image);
            formData.append("title", this.notice.title);
            formData.append("city", this.notice.city);
            formData.append("date", this.notice.date);
            formData.append("time", this.notice.time);
            formData.append("description", this.notice.description);
            let linkAux = this.notice.links;
            formData.append("links", JSON.stringify(linkAux));

            console.log(this.notice);

            try {
                axios
                    .post(`/notices/update/${this.notice.id}`, formData)
                    .then(response => {
                        this.$swal(
                            "Editada!",
                            "Su noticia ha sido editada exitosamente!",
                            "success"
                        ).then(result => {
                            this.$inertia.get(route('notices.index'));
                        });
                        //console.log('response: ', response.data);
                    })
                    .catch(error => {
                        //console.log(error);
                        const array = error.response.data.errors;
                        let text = "";
                        for (var clave in array) {
                            text += clave + ": " + array[clave] + "\n ";
                        }
                        this.$swal("Error!", text, "error");
                        // console.log(text);
                    });
            } catch (error) {
                console.log(error);
            }
        },

        validate() {
            if (!this.$refs.form.validate()) {
                return;
            }
            this.editNotice();
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
