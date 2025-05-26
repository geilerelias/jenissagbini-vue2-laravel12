<template>
    <v-app>
        <v-container fluid>
            <transition name="scroll-x-transition">
                <router-view></router-view>
            </transition>
        </v-container>
    </v-app>
</template>

<script>
    export default {

    }
</script>

<style lang="scss" scoped>
</style>