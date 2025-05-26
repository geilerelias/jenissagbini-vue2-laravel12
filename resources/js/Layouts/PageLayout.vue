<template>
    <v-app>
        <drawer-component></drawer-component>
        <header-component></header-component>
        <div style="min-height:100vh" class="mt-0">
            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>

        </div>
        <footer-component></footer-component>
    </v-app>
</template>

<script>
import DrawerComponent from "../base/DrawerComponent.vue";
import FooterComponent from "../base/FooterComponent.vue";
import HeaderComponent from "../base/HeaderComponent.vue";

export default {


    components: {
        DrawerComponent,
        FooterComponent,
        HeaderComponent
    },
    name: "PageLayout",
    methods: {
        getHeight() {
            return document.documentElement.clientHeight - 100;
        },
    }
}
</script>

<style>
.v-btn {
    outline: none !important;
}
</style>
