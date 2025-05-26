<template>
    <v-app id="inspire">
        <v-container class="fill-height justify-center" id="login">
            <v-row class="justify-center">
                <v-col class="col-sm-8 col-lg-11 col-xl-7 col">
                    <v-card class="elevation-4" style="padding: 11px !important;">
                        <v-row class="">
                            <v-col class="pr-0 col-lg-5 col">
                                <div class="pa-7 pa-sm-12">
                                    <inertia-link href="/">
                                        <img style="max-height: 40px" :src="logo" alt="">
                                    </inertia-link>
                                    <h2 class="font-weight-bold mt-4 blue-grey--text text--darken-2">
                                        Sign Up
                                    </h2>
                                    <h6
                                        class="subtitle-1">
                                        Don't have an account?
                                        <inertia-link href="/login">
                                            Sign in
                                        </inertia-link>
                                    </h6>

                                    <v-form
                                        ref="form"
                                        v-model="valid"
                                        lazy-validation
                                    >
                                        <v-text-field
                                            outlined
                                            clearable
                                            v-model="user.name"
                                            :counter="100"
                                            :rules="nameRules"
                                            label="Nombre"
                                            required
                                        ></v-text-field>

                                        <v-text-field
                                            outlined
                                            clearable
                                            v-model="user.email"
                                            :rules="emailRules"
                                            label="Email"
                                            required
                                        ></v-text-field>


                                        <v-text-field
                                            outlined
                                            autocomplete="off"
                                            v-model="user.password"
                                            :append-icon="
                                                    show1
                                                        ? 'mdi-eye'
                                                        : 'mdi-eye-off'
                                                "
                                            :rules="passwordRules"
                                            :type="
                                                    show1 ? 'text' : 'password'
                                                "
                                            label="Password"
                                            hint="Al menos 4 carácteres"
                                            counter
                                            @click:append="show1 = !show1"
                                        ></v-text-field>

                                        <v-text-field
                                            outlined
                                            v-model="
                                                    user.password_confirmation
                                                "
                                            :append-icon="
                                                    show2
                                                        ? 'mdi-eye'
                                                        : 'mdi-eye-off'
                                                "
                                            :rules="passwordConfirmRules"
                                            :type="
                                                    show2 ? 'text' : 'password'
                                                "
                                            label="Confirmar password"
                                            hint="Al menos 4 carácteres"
                                            counter
                                            @click:append="show2 = !show2"
                                        ></v-text-field>


                                        <v-row
                                            class="justify-center aling-center text-center ma-0 pa-0"
                                        >
                                            <v-col cols="12" class="ma-0 pa-1 text-start">
                                                <v-btn
                                                    block
                                                    :disabled="!valid"
                                                    color="#212121"
                                                    class="white--text"
                                                    @click="validate"
                                                >Registrar
                                                </v-btn
                                                >
                                            </v-col>

                                            <v-col cols="12" class="ma-0 pa-1 text-center">
                                                <v-btn text color="error" @click="reset"
                                                >Limpiar
                                                </v-btn
                                                >
                                            </v-col>
                                        </v-row>
                                    </v-form>
                                </div>
                            </v-col>
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
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>

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
import logo from '@/../img/logo.png'

export default {
    data() {
        return {
            logo,
            name: "",
            email: "",
            password: "",
            user: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            show1: false,
            show2: false,
            snackbar: false,
            color: "",
            text: "",
            mode: "",
            response: "",
            valid: true,
            nameRules: [
                v => !!v || "El nombre es requerido",
                v =>
                    (v && v.length <= 100) ||
                    "El nombre no puede tener mas de 100 caracteres"
            ],
            emailRules: [
                v => !!v || "E-mail es requerido",
                v => /.+@.+\..+/.test(v) || "E-mail invalido"
            ],
            passwordRules: [
                v => !!v || "Requerido.",
                v => (v && v.length >= 4) || "Mínimo 4 caracteres"
            ],
            passwordConfirmRules: [
                v => !!v || "Requerido.",
                v => (v && v.length >= 4) || "Mínimo 4 caracteres",
                v => v === this.user.password || "No coinciden."
            ],
            overlay: false
        };
    },

    methods: {
        validate() {
            if (!this.$refs.form.validate()) {
                return;
            }
            this.register();
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        },
        register() {
            console.log(this.user);
            const newUser = this.user;
            this.overlay = true;

            axios
                .post("/register", newUser)
                .then(response => {
                    console.log('this is response: ', response)
                    this.$swal(
                        response.status === 201
                            ? "!Buen trabajo! 😀" : "Oops... 😮",
                        response.data.message,
                        response.status === 201 ? "success" : "error"
                    ).then(result => {
                        if (response.status === 201) {
                            this.$inertia.get('/dashboard');
                        }
                    });
                    this.reset();
                })
                .catch(error => {
                    this.overlay = false;
                    this.color = "red darken-3";
                    this.mode = "vertical";
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
                    this.$swal("Oops... 😮", this.text, "error");
                });

            // this.$inertia.post(route('register'), newUser, {
            //     onSuccess: (response) => {
            //         console.log('this is :',response);
            //         this.$swal(
            //             response.data.status === 201
            //                 ? "!Buen trabajo! 😀"
            //                 : "Oops... 😮",
            //             response.data.message,
            //             response.data.status === 201 ? "success" : "error"
            //         ).then(result => {
            //             if (response.data.status === 201) {
            //                 this.$router.push("/login");
            //             }
            //         });
            //         this.reset();
            //     },
            //     onError: (error) => {
            //         console.log(error);
            //         this.overlay = false;
            //         this.color = "red darken-3";
            //         this.mode = "vertical";
            //         console.log(error);
            //         console.log(error.response.data);
            //         console.log(error.response.data.message);
            //         const array = error.response.data.errors;
            //         console.log(array);
            //         this.text = "";
            //         for (var clave in array) {
            //             this.text += clave + ": " + array[clave] + "\n ";
            //         }
            //
            //         console.log(this.text);
            //         this.text += error.response.data.message;
            //         this.$swal("Oops... 😮", this.text, "error");
            //     }
            // })
        }
    }
};
</script>
