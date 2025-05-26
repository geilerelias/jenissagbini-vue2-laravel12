<template>
    <v-app id="inspire">
        <v-container class="fill-height justify-center" id="login">
            <v-row class="justify-center">
                <v-col class="col-sm-8 col-lg-11 col-xl-7 col">
                    <v-card class="elevation-4" style="padding: 11px !important;">
                        <v-row>
                            <v-col class="primary d-none d-md-flex align-center justify-center col-lg-7 col">
                                <div class="d-none d-sm-block">
                                    <div class="d-flex align-center pa-10">
                                        <div>
                                            <h2 class="display-1 white--text font-weight-medium">
                                                ¡Haciendo a la Gente Exitosa en un mundo cambiante!
                                            </h2>
                                            <inertia-link href="/quien-soy">
                                                <v-btn text depressed outlined x-large
                                                       class="mt-4 text-capitalize white--text">
                                                    saber más
                                                </v-btn>
                                            </inertia-link>
                                        </div>
                                    </div>
                                </div>
                            </v-col>

                            <v-col class="col-lg-5 col">
                                <div class="pa-7 pa-sm-12">
                                    <inertia-link href="/">
                                        <img style="max-height: 40px" :src="logo" alt="">
                                    </inertia-link>

                                    <h2 class="font-weight-bold mt-4 blue-grey--text text--darken-2">
                                        Sign in
                                    </h2>

                                    <h6
                                        class="subtitle-1">
                                        Don't have an account?
                                        <inertia-link href="/register">
                                            Sign Up
                                        </inertia-link>
                                    </h6>

                                    <v-form novalidate="novalidate"
                                            v-on:submit.prevent="login"
                                            ref="form"
                                            v-model="valid"
                                            lazy-validation
                                            class="mt-4">

                                        <v-text-field
                                            prepend-icon="mdi-email"
                                            v-model="user.email"
                                            :rules="emailRules"
                                            label="Email"
                                            required
                                            clearable
                                            outlined
                                        ></v-text-field>
                                        <v-text-field
                                            prepend-icon="mdi-key"
                                            v-model="user.password"
                                            :append-icon="show1? 'mdi-eye': 'mdi-eye-off'"
                                            :rules="passwordRules"
                                            :type="show1 ? 'text' : 'password'"
                                            label="Password"
                                            hint="Al menos 4 carácteres"
                                            counter
                                            @click:append="show1 = !show1"
                                            outlined
                                        ></v-text-field>
                                        <div class="d-block d-sm-flex align-center mb-4 mb-sm-0">
                                            <v-checkbox
                                                v-model="user.remember"
                                                label="Recuerdame"
                                            ></v-checkbox>
                                            <div class="ml-auto">
                                                <v-btn
                                                    text
                                                    color="error"
                                                    @click="reset"
                                                >
                                                    Limpiar
                                                </v-btn>
                                            </div>
                                        </div>
                                        <v-container class="ma-0 pa-0 pb-8">
                                            <v-row
                                                class="justify-center aling-center text-center ma-0 pa-0"
                                            >
                                                <v-col class="ma-0 pa-1">
                                                    <v-btn
                                                        block
                                                        :disabled="!valid"
                                                        color="#212121"
                                                        class="white--text"
                                                        @click="validate"
                                                    >Ingresar
                                                    </v-btn>
                                                </v-col>
                                            </v-row>
                                            <v-row
                                                class="justify-center aling-center text-center ma-0 pa-0"
                                            >
                                                <v-col class="ma-0 pa-0">
                                                    <inertia-link
                                                        :href="route('password.request')"
                                                        text
                                                    >
                                                        Olvidaste tu contraseña
                                                    </inertia-link
                                                    >
                                                </v-col>
                                            </v-row>
                                        </v-container>

                                    </v-form>

                                </div>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>

        <v-snackbar
            v-model="snackbar"
            :color="color"
            :right="true"
            :timeout="4000"
            :top="true"
        >
            {{ text }}
            <v-btn dark text icon @click="snackbar = false">
                <v-icon>mdi-close</v-icon>
            </v-btn>
        </v-snackbar>

        <div class="text-center">
            <v-overlay :absolute="true" :opacity="0.9" :value="overlay">
                <v-row class="mb-6" no-gutters>
                    <v-col sm="12"
                    >
                        <v-progress-circular
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
import bg from '@/../img/4.jpg'
import logo from '@/../img/logo.png'

export default {
    data() {
        return {
            logo,
            bg,
            email: "",
            password: "",
            valid: true,
            snackbar: false,
            color: "",
            mode: "",
            text: "",
            user: {email: "", password: "", remember: true},
            show1: false,
            passwordRules: [
                v => !!v || "El password es Requirido.",
                v => (v && v.length >= 4) || "Minimo 4 caracteres"
            ],
            emailRules: [
                v => !!v || "EL email es requerido",
                v => /.+@.+\..+/.test(v) || "El email debe ser válido"
            ],
            checkbox: false,
            overlay: false,
            code: null
        };
    },
    mounted() {
        let params = new URLSearchParams(location.search);
        var status = params.get("status");
        var message = params.get("message");
        if (status !== null) {
            this.$swal(
                status === "200" ? "!Buen trabajo! 😀" : "Oops... 😮",
                message,
                status === "200" ? "success" : "error"
            );
        }
    },
    methods: {
        validate() {
            if (!this.$refs.form.validate()) {
                return;
            }
            this.login();
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        },

        login() {
            console.log(this.user);
            const newUser = this.user;
            this.overlay = true;
            axios
                .post("/login", newUser)
                .then(response => {
                    this.color = "green";
                    this.mode = "";
                    this.text = "Información correcta 😀, Bienvenido! ";
                    this.snackbar = true;
                    console.log("hasta aqui yo voy");
                    console.log('response', response);

                    // console.log("despues del login");

                    try {
                        this.overlay = false;
                        this.$swal(
                            "¡Buen trabajo!",
                            "Información correcta 😀, Bienvenido! ",
                            "success"
                        ).then(result => {
                            if (response.status === 200) {
                                this.$inertia.get('/dashboard');
                            }
                        });
                    } catch (error) {
                        this.overlay = false;
                        console.log(error);
                    }
                })
                .catch(error => {
                    this.mode = "";
                    this.color = "red darken-3";
                    //console.log('soy error',error);
                    // console.log(`soy error.response.data ${error.response.data}`);
                    //console.log(
                    // `soy error.response.data.message ${error.response.data.message}`
                    // );
                    const array = error.response.data.errors;
                    this.overlay = false;
                    console.log(`soy un array ${array}`);
                    this.text = "";
                    for (var clave in array) {
                        this.text += clave + ": " + array[clave] + "\n ";
                    }
                    //console.log(this.text);
                    this.text += error.response.data.message;
                    // this.snackbar = true;

                    this.$swal("¡Algo salió mal! 😥", this.text, "error");
                    // if (typeof array === "undefined") {
                    //     setTimeout(() => location.reload(), 500);
                    // }
                });
        }
    }
};
</script>
