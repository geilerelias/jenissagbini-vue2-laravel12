<template>
    <div>
        <v-app>
            <v-card>
                <v-toolbar
                    dark
                    color="primary"
                >
                    <v-btn
                        icon
                        dark
                        @click.prevent.stop="close()"
                    >
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Visualización de PDF</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <!-- HERE -->
                <iframe :src="url" style="width: 100%;height:calc(100vh - 70px); border: none;">
                    Oops! an error has occurred.b
                </iframe>
            </v-card>

        </v-app>
    </div>


</template>

<script>

export default {

    name: "ViewPdf",
    props: ['url'],
    methods: {
        close() {
            this.$emit('close', true);
        },
    }

}
</script>

<style scoped>

</style>
