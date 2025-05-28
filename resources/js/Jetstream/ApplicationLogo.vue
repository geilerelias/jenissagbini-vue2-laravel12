<template>
    <inertia-link
        href="/"
        class="d-flex align-center text-decoration-none mr-2">
        <v-card flat max-width="110">
            <v-img
                style="max-height:48px"
                :spect-ratio="5/4"
                contain
                :src="logo"
            />
        </v-card>
    </inertia-link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";

import logo from '../../img/logo.png';

export default {
    data() {
        return {
            logo: logo
        }
    }
}
</script>

<style scoped>

</style>
