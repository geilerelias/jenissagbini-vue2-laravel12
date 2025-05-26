<template>
    <page-layout>
        <v-container fluid>
            <v-row>
                <v-col
                    style="position: fixed"
                    md="1"
                    lg="2"
                    v-if="$vuetify.breakpoint.mdAndUp"
                    class="shrink ma-0 pa-0"
                >
                    <v-card
                        class="mx-auto"
                        style="border-radius: 0px; left: 0"
                        fixed
                        elevation="7 - 1"
                        permanent
                    >
                        <v-img :src="img4" height="100vh" />
                    </v-card>
                </v-col>
                <v-col
                    md="1"
                    lg="2"
                    v-if="$vuetify.breakpoint.mdAndUp"
                    class="shrink ma-0 pa-0"
                ></v-col>
                <v-col
                    sm="12"
                    md="11"
                    lg="10"
                    class="text-end justify-end ma-0 pa-0"
                >
                    <v-container fluid class="ma-0 mt-10">
                        <v-row
                            class="fill-height justify-center align-content-center"
                        >
                            <v-col cols="12">
                                <h1 class="display-2 text-center">
                                    Contácteme
                                </h1>
                            </v-col>
                            <v-col cols="12" class="ma-0 pa-0">
                                <div class="body-1 text-center">
                                    Tienes alguna pregunta? Por favor, no dudes
                                    en contactarme. Te ayudaré.
                                </div>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="7">
                                <template>
                                    <v-card
                                        class="mt-5"
                                        style="border-radius: 0px !important"
                                    >
                                        <v-toolbar dark flat>
                                            <v-toolbar-title
                                                >Formulario de Contacto
                                            </v-toolbar-title>
                                            <v-spacer></v-spacer>
                                        </v-toolbar>
                                        <v-form
                                            @submit.prevent="enviar(mail)"
                                            ref="form"
                                            class="pa-5"
                                            v-model="valid"
                                            :lazy-validation="false"
                                        >
                                            <v-layout>
                                                <v-row>
                                                    <v-col>
                                                        <v-text-field
                                                            clearable
                                                            v-model="mail.name"
                                                            :counter="30"
                                                            :rules="nameRules"
                                                            label="Nombres"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col>
                                                        <v-text-field
                                                            clearable
                                                            v-model="mail.email"
                                                            :rules="emailRules"
                                                            label="E-mail"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                </v-row>
                                            </v-layout>

                                            <v-text-field
                                                clearable
                                                v-model="mail.subject"
                                                :rules="themeRules"
                                                :counter="50"
                                                label="Asunto"
                                                required
                                            ></v-text-field>
                                            <v-textarea
                                                v-model="mail.content"
                                                :rules="messageRules"
                                                clearable
                                                label="Tu mensaje"
                                                value="This is clearable text."
                                            ></v-textarea>
                                            <v-btn
                                                :disabled="!valid"
                                                color="#212121"
                                                class="ma-2 white--text mr-4"
                                                @click="validate"
                                            >
                                                Enviar
                                                <v-icon right>mdi-send</v-icon>
                                            </v-btn>
                                        </v-form>

                                        <v-snackbar v-model="snackbar">
                                            {{ response }}
                                            <v-btn
                                                color="pink"
                                                text
                                                @click="snackbar = false"
                                            >
                                                <v-icon
                                                    >mdi-close-outline
                                                </v-icon>
                                            </v-btn>
                                        </v-snackbar>
                                    </v-card>
                                </template>
                            </v-col>
                            <v-col
                                cols="12"
                                md="5"
                                class="text-center justify-center"
                            >
                                <v-container class="text-center justify-center">
                                    <v-row
                                        style="height: 100px"
                                        no-gutters
                                        align="center"
                                        class="ma-0 pa-0"
                                    >
                                        <v-col class="text-left">
                                            <p>
                                                <v-icon class="mr-3" size="44"
                                                    >mdi-map-marker
                                                </v-icon>
                                                Av. Simón Bolívar No. 6-04
                                                Valledupar, Co
                                            </p>
                                        </v-col>
                                    </v-row>
                                    <v-row
                                        style="height: 100px"
                                        no-gutters
                                        align="center"
                                        class="ma-0 pa-0"
                                    >
                                        <v-col class="text-left">
                                            <p>
                                                <v-icon class="mr-3" size="44"
                                                    >mdi-email
                                                </v-icon>
                                                contacto@jenissagbini.com
                                            </p>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-col>
                        </v-row>

                        <v-row
                            class="fill-height justify-center align-content-center"
                        >
                            <v-col cols="12" class="text-center">
                                <template>
                                    <v-card
                                        class="pa-4"
                                        height="300px"
                                        :img="imgMaps"
                                    ></v-card>
                                </template>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-col>
            </v-row>
        </v-container>
        <v-overlay :value="overlay">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
        </v-overlay>
    </page-layout>
</template>

<script>
import imgMaps from "@/../img/maps.jpg";
import img4 from "@/../img/4.jpg";
import PageLayout from "@/Layouts/PageLayout.vue";

export default {
    name: "Contacto",
    components: {
        PageLayout,
    },
    data: () => ({
        imgMaps: imgMaps,
        img4: img4,
        overlay: false,
        snackbar: false,
        response: "",
        mail: { name: "", email: "", subject: "", content: "" },
        valid: true,
        nameRules: [
            (v) => !!v || "El nombre es requerido",
            (v) =>
                (v && v.length <= 30) ||
                "El nombre no puede tener mas de 30 caracteres",
        ],
        themeRules: [
            (v) => !!v || "El asunto es requerido",
            (v) =>
                (v && v.length <= 50) ||
                "El asunto no puede tener mas de 50 caracteres",
        ],
        messageRules: [(v) => !!v || "El contenido del mensaje es requerido"],
        emailRules: [
            (v) => !!v || "E-mail es requerido",
            (v) => /.+@.+\..+/.test(v) || "E-mail invalido",
        ],
    }),

    methods: {
        validate() {
            if (!this.$refs.form.validate()) {
                return;
            }
            this.overlay = true;
            const newMail = this.mail;
            axios
                .post("/send-mail", newMail)
                .then((res) => {
                    this.overlay = false;
                    this.$swal(
                        "Mensaje enviado!",
                        "Mensaje enviado correctamente 😀",
                        "success"
                    );
                    this.reset();
                })
                .catch((res) => {
                    this.$swal(
                        "Error en el envío",
                        "ha ocurrido un error en el envío del mensaje 😥",
                        "error"
                    );
                    this.overlay = false;
                });
            console.log(this.mail);
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        },
    },
};
</script>

<style></style>
