<template>
    <v-app>
        <!-- Header -->
        <v-app-bar app color="primary" dark>
            <v-toolbar-title>Mi Aplicación</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon>
                <v-icon>mdi-account</v-icon>
            </v-btn>
        </v-app-bar>

        <!-- Drawer -->
        <v-navigation-drawer app v-model="drawer" color="grey lighten-4">
            <v-list dense>
                <v-list-item-group>
                    <v-list-item
                        v-for="(item, index) in menuItems"
                        :key="index"
                        link
                    >
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>{{
                                item.title
                            }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>

        <!-- Main Content -->
        <v-main>
            <v-container fluid>
                <slot></slot>
            </v-container>
        </v-main>

        <!-- Footer -->
        <v-footer app color="primary" dark>
            <v-col class="text-center white--text">
                © {{ new Date().getFullYear() }} - Mi Aplicación
            </v-col>
        </v-footer>
    </v-app>
</template>

<script>
export default {
    name: "BaseLayout",
    data: () => ({
        drawer: false,
        menuItems: [
            { title: "Inicio", icon: "mdi-home", link: "/" },
            {
                title: "Artículos",
                icon: "mdi-file-document",
                link: "/articulos",
            },
            { title: "Acerca de", icon: "mdi-information", link: "/about" },
        ],
    }),
};
</script>

<style scoped lang="scss">
.v-application {
    font-family: "Roboto", sans-serif;
}

.v-footer {
    text-align: center;
}
</style>
