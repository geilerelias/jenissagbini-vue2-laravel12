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
                                <v-card-text>
                                    <v-form
                                        valid="true"
                                        ref="form"
                                        class="pa-5"
                                        v-model="valid"
                                        :lazy-validation="false"
                                        v-on:submit.prevent="validate"
                                    >
                                        <v-text-field
                                            clearable
                                            v-model="email"
                                            :rules="emailRules"
                                            label="Ingresa el email"
                                            required
                                        ></v-text-field>
                                    </v-form>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-row
                                        class="justify-center aling-center text-center ma-0 pa-0"
                                    >
                                        <v-col class="ma-0 pa-1 text-end">
                                            <v-btn color="error" @click="reset"
                                                >Limpiar</v-btn
                                            >
                                        </v-col>
                                        <v-col class="ma-0 pa-1 text-start">
                                            <v-btn
                                                :disabled="!valid"
                                                color="#212121"
                                                class="white--text"
                                                @click="validate"
                                                >Continuar</v-btn
                                            >
                                        </v-col>
                                    </v-row>
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
    data() {
        return {
            valid: true,
            email: "",
            emailRules: [
                v => !!v || "E-mail es requerido",
                v => /.+@.+\..+/.test(v) || "E-mail invalido"
            ],

            overlay: false
        };
    },

    methods: {
        validate() {
            if (!this.$refs.form.validate()) {
                return;
            }
            this.sendNotification();
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        },
        sendNotification() {
            this.overlay = true;
            var data = { email: this.email };
            axios
                .post("/api/password/create", data)
                .then(response => {
                    Swal.fire(
                        response.data.status === 201
                            ? "!Buen trabajo! 😀"
                            : "Oops... 😮",
                        response.data.message,
                        response.data.status === 201 ? "success" : "error"
                    );
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
