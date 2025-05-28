<template>
    <app-layout>
        <bread-crumbs name="Servicios" :items="items"></bread-crumbs>
        <v-container>

        </v-container>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import BreadCrumbs from "@/components/BreadCrumbs.vue";

export default {
    components: {
        AppLayout,
        BreadCrumbs
    },
    name: "Services",
    data: () => ({
        items: [
            {
                text: "Dashboard",
                disabled: false,
                href: "/dashboard"
            },
            {
                text: "Services",
                disabled: true,
                href: "#"
            }
        ],
    })
}
</script>

<style scoped>

</style>
