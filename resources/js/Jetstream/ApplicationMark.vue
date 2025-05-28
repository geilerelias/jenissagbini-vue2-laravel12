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
import logo from '../../img/logo.png';
import { Link } from "@inertiajs/inertia-vue";

export default {
    components: {
        InertiaLink: Link,
    },
    data() {
        return {
            logo: logo
        }
    }
}
</script>

<style scoped>

</style>
