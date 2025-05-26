<template>
    <v-app id="inspire">
        <header-app-component></header-app-component>
        <drawer-app-component></drawer-app-component>
        <v-content>
            <v-container fluid>
                <v-layout align-start justify-center>
                    <v-flex xs12 sm8 md4>
                        <template>
                            <v-card
                                class="mt-5"
                                style="border-radius:0px!important"
                            >
                                <v-toolbar dark flat>
                                    <v-toolbar-title>
                                        Restablecimiento de contraseña
                                    </v-toolbar-title>
                                    <v-spacer></v-spacer>
                                </v-toolbar>
                                <v-card-text v-if="!tokenFound">
                                    <v-list>
                                        <v-list-item>
                                            <v-list-item-avatar
                                                color="amber darken-4"
                                                size="40"
                                            >
                                                <v-icon
                                                    icon="mdi-alert"
                                                    color="white"
                                                >
                                                    mdi-lock
                                                </v-icon>
                                            </v-list-item-avatar>

                                            <v-list-item-content>
                                                {{ message }}
                                            </v-list-item-content>

                                            <v-list-item-action>
                                                <v-tooltip bottom>
                                                    <template
                                                        v-slot:activator="{
                                                            on
                                                        }"
                                                    >
                                                        <v-btn
                                                            icon
                                                            to="/send-notification"
                                                            v-on="on"
                                                        >
                                                            <v-icon
                                                                color="grey lighten-1"
                                                            >
                                                                mdi-email-send-outline
                                                            </v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <span>Reenviar email</span>
                                                </v-tooltip>
                                            </v-list-item-action>
                                        </v-list-item>
                                    </v-list>
                                </v-card-text>
                                <v-card-text v-if="tokenFound">
                                    <v-form
                                        valid="true"
                                        ref="form"
                                        class="pa-5"
                                        v-model="valid"
                                        :lazy-validation="false"
                                    >
                                        ingresa la nueva contraseña y su
                                        confirmación para actualizar
                                        <v-row>
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                    v-model="item.password"
                                                    :append-icon="
                                                        show1
                                                            ? 'mdi-eye'
                                                            : 'mdi-eye-off'
                                                    "
                                                    :rules="passwordRules"
                                                    :type="
                                                        show1
                                                            ? 'text'
                                                            : 'password'
                                                    "
                                                    label="Password"
                                                    hint="Al menos 4 carácteres"
                                                    counter
                                                    @click:append="
                                                        show1 = !show1
                                                    "
                                                ></v-text-field>
                                            </v-col>

                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                    v-model="
                                                        item.password_confirmation
                                                    "
                                                    :append-icon="
                                                        show2
                                                            ? 'mdi-eye'
                                                            : 'mdi-eye-off'
                                                    "
                                                    :rules="
                                                        passwordConfirmRules
                                                    "
                                                    :type="
                                                        show2
                                                            ? 'text'
                                                            : 'password'
                                                    "
                                                    label="Confirmar password"
                                                    hint="Al menos 4 carácteres"
                                                    counter
                                                    @click:append="
                                                        show2 = !show2
                                                    "
                                                ></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-form>
                                </v-card-text>
                                <v-card-actions v-if="tokenFound">
                                    <v-spacer></v-spacer>
                                    <v-btn color="error" @click="reset">
                                        Limpiar
                                    </v-btn>
                                    <v-btn
                                        :disabled="!valid"
                                        color="#212121"
                                        class="white--text"
                                        @click="validate"
                                    >
                                        Continuar
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </template>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <div class="text-center">
            <v-overlay :absolute="true" :opacity="0.9" :value="overlay">
                <v-row class="mb-6" no-gutters>
                    <v-col sm="12"
                        ><v-progress-circular
                            indeterminate
                            size="64"
                        ></v-progress-circular>
                    </v-col>

                    <v-col class="mt-5">
                        <span class="white--text">
                            Un momento por favor, estamos procesando su
                            solicitud
                        </span>
                    </v-col>
                </v-row>
            </v-overlay>
        </div>
    </v-app>
</template>

<script>
export default {
    props: ["response"],
    data() {
        return {
            message: "",
            tokenFound: false,
            item: {
                email: "",
                password: "",
                password_confirmation: "",
                token: ""
            },
            valid: true,
            emailRules: [
                v => !!v || "E-mail es requerido",
                v => /.+@.+\..+/.test(v) || "E-mail invalido"
            ],
            show1: false,
            show2: false,
            passwordRules: [
                v => !!v || "Requerido.",
                v => (v && v.length >= 4) || "Mínimo 4 caracteres"
            ],
            passwordConfirmRules: [
                v => !!v || "Requerido.",
                v => (v && v.length >= 4) || "Mínimo 4 caracteres",
                v => v === this.item.password || "No coinciden."
            ],
            overlay: false
        };
    },
    mounted: function() {
        this.verifyToken();
    },
    methods: {
        verifyToken() {
            const token = this.$route.params.id;
            console.log("token", token);
            this.overlay = true;
            axios
                .get(`/api/password/find/${token}`)
                .then(response => {
                    if (response.data.status === 201) {
                        this.tokenFound = true;
                        //console.log(response.data[0]);
                        this.item.email = response.data[0].email;
                        this.item.token = response.data[0].token;
                    } else {
                        this.message = response.data.message;
                        Swal.fire("Oops... 😮", response.data.message, "error");
                    }
                    this.overlay = false;
                })
                .catch(error => {
                    this.overlay = false;

                    console.log(error);
                    console.log(error.response.data);
                    console.log(error.response.data.message);
                    const array = error.response.data.errors;
                    console.log(array);
                    this.text = "";
                    for (var clave in array) {
                        this.text += clave + ": " + array[clave] + "\n ";
                    }

                    console.log(this.text);
                    this.text += error.response.data.message;
                    this.message = this.text;
                    Swal.fire("Oops... 😮", this.text, "error");
                });
        },
        validate() {
            if (!this.$refs.form.validate()) {
                return;
            }
            this.resetPassword();
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        },
        resetPassword() {
            this.overlay = true;
            var data = this.item;
            axios
                .post("/api/password/reset", data)
                .then(response => {
                    Swal.fire(
                        response.data.status === 201
                            ? "!Buen trabajo! 😀"
                            : "Oops... 😮",
                        response.data.message,
                        response.data.status === 201 ? "success" : "error"
                    ).then(result => {
                        if (response.data.status === 201) {
                            this.$router.push("/login");
                        }
                    });
                    this.reset();
                    this.overlay = false;
                })
                .catch(error => {
                    this.overlay = false;

                    console.log(error);
                    console.log(error.response.data);
                    console.log(error.response.data.message);
                    const array = error.response.data.errors;
                    console.log(array);
                    this.text = "";
                    for (var clave in array) {
                        this.text += clave + ": " + array[clave] + "\n ";
                    }

                    console.log(this.text);
                    this.text += error.response.data.message;
                    Swal.fire("Oops... 😮", this.text, "error");
                });
        }
    }
};
</script>
