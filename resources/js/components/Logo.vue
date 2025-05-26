<template>
    <inertia-link
        :href="route('inicio')"
        class="d-flex align-center text-decoration-none mr-2 router-link-exact-active router-link-active"
        aria-current="page">
        <v-avatar color="white" size="50">
            <v-avatar size="46">
                <v-img cover :src="logo" alt="logo"></v-img>
            </v-avatar>
        </v-avatar>
    </inertia-link>
</template>

<script>
import logo from '@/../img/logo.png';

export default {
    name: "Logo",
    data: () => ({
        logo: logo,
    })
}
</script>

<style scoped>

</style>
