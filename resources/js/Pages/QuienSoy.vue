<template>
    <page-layout>
        <section id="hero" class="mt-12 mx-0 px-0">
            <v-img height="60vh" :src="img5">
                <v-container
                    class="d-flex justify-center align-end fill-height"
                >
                    <v-row class="white--text mx-auto text-center">
                        <v-col
                            class="white--text text-center"
                            cols="12"
                            tag="h1"
                        >
                            <span
                                :class="[
                                    $vuetify.breakpoint.smAndDown
                                        ? 'display-1'
                                        : 'display-2',
                                ]"
                                class="font-weight-black"
                            >
                                ¿Quién soy?
                            </span>
                            <br />
                            <v-btn
                                small
                                class="align-self-end"
                                fab
                                outlined
                                color="white"
                                @click="$vuetify.goTo('#about-me')"
                            >
                                <v-icon dark class="white--text">
                                    mdi-chevron-double-down
                                </v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-container>
            </v-img>
        </section>
        <section id="about-me" class="mx-0 px-0">
            <v-main mb-12 class="scroll-y">
                <v-container grid-list-xs>
                    <v-row
                        v-for="(item, i) in items"
                        :key="i"
                        class="mb-5 align-center"
                    >
                        <v-col
                            class="col-md-4 col-12"
                            :class="i % 2 ? 'order-md-2' : ''"
                        >
                            <v-card
                                @click="showImage(`/storage/${item.image}`)"
                            >
                                <v-img
                                    cover
                                    :aspect-ratio="16 / 9"
                                    elevation="12"
                                    :src="`/storage/${item.image}`"
                                    style="max-height: 300px; height: 300px"
                                >
                                    <template v-slot:placeholder>
                                        <v-row
                                            class="fill-height ma-0"
                                            align="center"
                                            justify="center"
                                        >
                                            <v-progress-circular
                                                indeterminate
                                                color="primary lighten-5"
                                            ></v-progress-circular>
                                        </v-row>
                                    </template>
                                </v-img>
                            </v-card>
                        </v-col>
                        <v-col class="px-0 col-md-8 col-12">
                            <v-card color="transparent" flat>
                                <v-card-title primary-title>
                                    <p
                                        class="headline font-weight-black"
                                        style="border-bottom-style: solid"
                                    >
                                        {{ item.title }}
                                    </p>
                                </v-card-title>

                                <v-card-text
                                    class="black--text text-justify"
                                    v-html="item.content"
                                >
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>

                <v-container>
                    <v-row class="py-5 px-3 align-center justify-center">
                        <div class="theme--light">
                            <v-row class="d-flex justify-end align-end">
                                <div
                                    class="pt-2 mb-0 d-flex justify-start align-content-start align-start"
                                >
                                    <div
                                        class="base-avatar d-inline-flex"
                                        style="margin-left: -10"
                                    >
                                        <v-icon color="primary" size="32">
                                            mdi-format-quote-open
                                        </v-icon>
                                    </div>
                                    <div class="ml-3">
                                        <h3
                                            class="body-1 font-weight-bold mb-1"
                                        >
                                            ¡Haciendo a la Gente Exitosa en un
                                            mundo cambiante!.
                                        </h3>
                                    </div>
                                    <div class="base-avatar d-inline-flex ml-2">
                                        <v-icon color="primary" size="32">
                                            mdi-format-quote-close
                                        </v-icon>
                                    </div>
                                </div>
                            </v-row>

                            <footer class="text-right d-flex justify-end">
                                <v-row class="d-flex justify-end align-end">
                                    <div class="text-center mt-4 mb-12">
                                        <v-divider
                                            style="
                                                max-width: 180px;
                                                padding-bottom: 1.5px;
                                            "
                                            class="mt-2 mx-auto primary"
                                        ></v-divider>
                                        <h1 class="headline font-weight-medium">
                                            Jenis Sagbini
                                        </h1>
                                    </div>
                                </v-row>
                            </footer>
                        </div>
                    </v-row>
                </v-container>
            </v-main>
        </section>

        <preview-image
            :dialog="dialog"
            :close="closeDialog"
            :selected-image="selectedImage"
        />
    </page-layout>
</template>

<script>
import img5 from "@/../img/quien-soy.jpg";
import img17 from "@/../img/17.jpg";
import PageLayout from "@/Layouts/PageLayout.vue";
import PreviewImage from "@/components/PreviewImage.vue";

export default {
    name: "QuienSoy",
    components: {
        PageLayout,
        PreviewImage,
    },
    data: () => ({
        img5: img5,
        img17: img17,
        par: 0,
        items: null,
        tab: null,
        centered: false,
        width: window.innerWidth,
        selectedImage: "",
        dialog: false,
    }),
    methods: {
        showImage(image) {
            this.selectedImage = image;
            this.dialog = true;
            console.log("show image dialog", this.dialog, this.getDialog);
        },

        closeDialog() {
            this.dialog = false;
        },
        getHeig() {
            return document.documentElement.clientHeight - 50;
        },
        onScroll(e) {
            //console.log("algo esta mal aqui");
            var tabs = document.querySelector(
                "div.v-item-group.theme--light.v-slide-group.v-tabs-bar.v-tabs-bar--is-mobile.v-tabs-bar--show-arrows > div > div > main"
            );

            if (tabs.length > 0) {
                tabs.style.padding = "0px";
                console.log("entra");
            }
        },
    },
    computed: {
        vertical() {
            return this.$vuetify.breakpoint.smAndUp;
        },
    },
    created() {
        axios.get("/about/all").then((res) => {
            this.items = res.data;
            //console.log(this.items);
        });
    },
};
</script>

<style scoped></style>
