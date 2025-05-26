<template>
    <app-layout>
        <v-form @submit.prevent="submit">
            <v-container>
                <v-row>
                    <v-col
                        cols="12"
                        md="4"
                    >
                        <v-text-field
                            v-model="form.name"
                            label="Name"
                            required
                        ></v-text-field>
                    </v-col>

                    <v-col
                        cols="12"
                        md="4"
                    >
                        <v-text-field
                            v-model="form.price"
                            label="Price"
                            prefix="$"
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col>
                        <v-btn @click="submit">registrar</v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </v-form>

        <v-form @submit.prevent="submit"
                ref="form"
                v-model="valid"
        >

            <v-alert
                v-if="$page.errors.email"
                text
                prominent
                type="error"
                icon="mdi-alert"
                dismissible
            >
                {{$page.errors.email[0]}}
            </v-alert>



            <v-text-field
                dense
                v-model="form.name"
                :rules="nameRules"
                label="Name"
                outlined
                required
                autofocus
                autocomplete="name"
            ></v-text-field>

            <v-text-field
                dense
                v-model="form.email"
                :rules="emailRules"
                label="E-mail"
                outlined
                name="email"
                required
            ></v-text-field>

            <v-text-field
                dense
                v-model="form.password"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="passwordRules"
                :type="show ? 'text' : 'password'"
                label="password"
                outlined
                hint="At least 8 characters"
                @click:append="show = !show"
                name="password"
                required
                autocomplete="new-password"
            ></v-text-field>

            <v-text-field
                dense
                v-model="form.password_confirmation"
                :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="confirmPasswordRules"
                :type="show2 ? 'text' : 'password'"
                label="Confirm Password"
                outlined
                hint="At least 8 characters"
                @click:append="show2 = !show2"
                name="password_confirmation"
                required
                autocomplete="new-password"
            ></v-text-field>


            <v-checkbox
                v-model="checkbox"
                :rules="[v => !!v || 'You must agree to continue!']"
                label="¿Estás de acuerdo?"
                required
            ></v-checkbox>

            <v-btn @click="submit" block contained depressed :disabled="!valid"
                   class="mr-4 text-none primary">
                Registrarse
            </v-btn>

        </v-form>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    name: "Create",
    components: {
        AppLayout,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: {
                name: null,
                price: null,
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.post(route('products.store'), this.form);
        },
    },
};
</script>
