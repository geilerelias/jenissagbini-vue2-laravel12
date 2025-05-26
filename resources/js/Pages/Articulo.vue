<template>
    <page-layout>
        <v-container fluid class="mt-12 mb-0 pb-0">
            <v-row>
                <v-col
                    style="position: fixed"
                    md="1"
                    lg="2"
                    v-if="$vuetify.breakpoint.mdAndUp"
                    class="shrink ma-0 pa-0"
                >
                    <v-card
                        class="mx-auto"
                        style="border-radius: 0px; left: 0"
                        fixed
                        elevation="7 - 1"
                        permanent
                    >
                        <v-img :src="img13" height="100vh" />
                    </v-card>
                </v-col>
                <v-col
                    md="1"
                    lg="2"
                    v-if="$vuetify.breakpoint.mdAndUp"
                    class="shrink ma-0 pa-0"
                ></v-col>
                <v-col
                    sm="12"
                    md="11"
                    lg="10"
                    class="text-end justify-end ma-0 pa-0 mt-100 mb-0 pb-0"
                >
                    <v-container
                        fluid
                        class="ma-0 mt-6"
                        style="min-height: 90vh"
                    >
                        <v-card flat>
                            <v-tabs
                                show-arrows
                                background-color="white"
                                color="grey darken-4"
                                right
                            >
                                <v-tab>Publicados en revistas</v-tab>
                                <v-tab>Otros Artículos</v-tab>
                                <v-tab-item>
                                    <v-container>
                                        <v-timeline
                                            reverse
                                            :dense="
                                                $vuetify.breakpoint.smAndDown
                                            "
                                        >
                                            <v-timeline-item
                                                large
                                                v-for="(
                                                    item, index
                                                ) in publishedArticles"
                                                :key="index"
                                            >
                                                <template v-slot:icon>
                                                    <v-avatar>
                                                        <img :src="logo" />
                                                    </v-avatar>
                                                </template>
                                                <template v-slot:opposite>
                                                    <span>{{ item.year }}</span>
                                                </template>
                                                <v-card class="elevation-2">
                                                    <p
                                                        class="subtitle-2 text-justify mx-3 pt-3 text-example"
                                                    >
                                                        {{ item.title }}
                                                    </p>
                                                    <v-card-text
                                                        class="justify-end align-end text-start"
                                                    >
                                                        <small
                                                            class="text-muted mt-2"
                                                        >
                                                            En
                                                            {{
                                                                item.country
                                                            }}
                                                            ISBN:
                                                            {{ item.isbn }} Ed:
                                                            {{ item.ed }}.
                                                        </small>
                                                        <br />
                                                        <p class="mb-2 mt-1">
                                                            {{
                                                                item.description
                                                            }}
                                                        </p>
                                                    </v-card-text>

                                                    <v-card-actions
                                                        class="justify-center align-center"
                                                    >
                                                        <v-btn
                                                            text
                                                            color="orange"
                                                            v-if="
                                                                item.link !==
                                                                    '' &&
                                                                item.link !==
                                                                    null
                                                            "
                                                            :href="item.link"
                                                            target="_blank"
                                                        >
                                                            <v-icon left>
                                                                mdi-eye
                                                            </v-icon>
                                                            ver enlace
                                                        </v-btn>
                                                        <v-btn
                                                            text
                                                            color="orange"
                                                            v-if="
                                                                item.file !==
                                                                    '' &&
                                                                item.file !==
                                                                    null &&
                                                                item.file !==
                                                                    undefined
                                                            "
                                                            @click="
                                                                viewPdf(
                                                                    'storage/' +
                                                                        item.file
                                                                )
                                                            "
                                                            target="_blank"
                                                        >
                                                            <v-icon left>
                                                                mdi-eye
                                                            </v-icon>
                                                            ver pdf
                                                        </v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-timeline-item>
                                        </v-timeline>
                                    </v-container>
                                </v-tab-item>
                                <v-tab-item>
                                    <v-container fluid>
                                        <v-row>
                                            <v-col
                                                v-for="(
                                                    item, index
                                                ) in othersArticles"
                                                :key="index"
                                                cols="12"
                                                md="4"
                                            >
                                                <v-card
                                                    max-width="344"
                                                    class="mx-auto"
                                                >
                                                    <v-list-item>
                                                        <v-list-item-avatar
                                                            color="grey"
                                                        >
                                                            {{ index + 1 }}
                                                        </v-list-item-avatar>
                                                        <v-list-item-content>
                                                            <v-list-item-title
                                                                class="headline"
                                                            >
                                                                {{ item.title }}
                                                            </v-list-item-title>
                                                        </v-list-item-content>
                                                    </v-list-item>

                                                    <pdf
                                                        :src="
                                                            '/storage/' +
                                                            item.file
                                                        "
                                                        @num-pages="
                                                            pageCount = $event
                                                        "
                                                        @page-loaded="
                                                            currentPage = $event
                                                        "
                                                        height="194"
                                                    ></pdf>

                                                    <v-card-text>
                                                        {{ item.description }}
                                                    </v-card-text>

                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn
                                                            icon
                                                            @click="
                                                                openFile(
                                                                    item.file
                                                                )
                                                            "
                                                        >
                                                            <v-icon
                                                                >mdi-file-eye
                                                            </v-icon>
                                                        </v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-tab-item>
                            </v-tabs>
                        </v-card>
                    </v-container>
                </v-col>
            </v-row>
        </v-container>
        <v-dialog
            v-model="dialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <view-pdf @close="onClose" :url="url"></view-pdf>

            <div class="pdf-container"></div>
        </v-dialog>
    </page-layout>
</template>

<script>
import logo from "@/../img/logo.png";
import img13 from "@/../img/13.jpg";
import PageLayout from "@/Layouts/PageLayout.vue";

import ViewPdf from "@/components/ViewPdf.vue";

//ssimport pdf from "vue-pdf";
//import AppPdf from "@/components/pdf/AppPdf.vue";

export default {
    name: "Articulo",
    components: {
        ViewPdf,
        PageLayout,
        //"pdf-component": AppPdf,
        //pdf,
    },
    data: () => ({
        logo: logo,
        img13: img13,
        url: "",
        dialog: false,
        currentPage: 0,
        pageCount: 0,
        othersArticles: [],
        publishedArticles: [],
    }),
    mounted() {
        this.initialize();
    },
    methods: {
        onClose() {
            this.dialog = false;
        },
        initialize() {
            this.initializePublishedArticles();
            this.initializeOthersArticles();
        },
        initializePublishedArticles() {
            this.publishedArticles = [
                {
                    year: "2018-03",
                    title: "SISTEMA DE DIALOGO HUMANO ROBOT UTILIZANDO RAZONAMIENTO BASADO EN CASOS. LA INVESTIGACIÓN APLICADA EN LA SOCIEDAD DE LA INFORMACIÓN INNOVACIÓN Y DESARROLLO TECNOLÓGICO",
                    country: "Colombia",
                    isbn: "9789585660847",
                    ed: "CIMTED , v. , p.38 - 45  1 ,2018",
                    description:
                        "Socializado en el CONGRESO INTERNACIONAL SOBRE TECNOLOGÍA E INNOVACIÓN+CIENCIA E INVESTIGACIÓN. BUENOS AIRES, ARGENTINA. 2018.",
                    link: "http://memoriascimted.com/wp-content/uploads/2017/01/La-investigaci%C3%B3n-aplicada-a-la-sociedad-de-la-informaci%C3%B3n.pdf",
                },
                {
                    year: "2018-06",
                    title: 'EMPRENDIMIENTO DIGITAL "SOMOS UNO" PARA LA GESTIÓN DEL SEGUIMIENTO Y CONSOLIDACIÓN DE IGLESIAS CRISTIANAS. REVISTA INNDECOM.',
                    country: "Colombia",
                    isbn: "2665-2358",
                    ed: "SERVICIO NACIONAL DE APRENDIZAJE “SENA”. Vol.1. p.81-88. 2018.",
                    description:
                        "Socializado en el III SIMPOSIO DE INVESTIGACIÓN, INNOVACIÓN Y DESARROLLO TECNOLÓGICO. VALLEDUPAR, COLOMBIA. 2018.",
                    link: "http://eventossinndetec.com/#/revista/inndecomm/actual",
                    file: "published-articles/article-1662937184.pdf",
                },
                {
                    year: "2018-01",
                    title: 'HABILIDADES GERENCIALES PARA EL DESARROLLO DE INGENIEROS. DESARROLLO E INNOVACIÓN TECNOLÓGICA "UN APRENDIZAJE INVESTIGATIVO',
                    country: "Colombia",
                    isbn: "978-958-5493-01-8",
                    ed: "UNIVERSIDAD POPULAR DEL CESAR , v. , p.49 - 54  1 ,2018",
                    description: "",
                    link: "",
                },
                {
                    year: "2017-05",
                    title: "ESTILOS DE APRENDIZAJE: CONDICIONES PEDAGÓGICAS PRESENTES EN EL PROCESO FORMATIVO EN LOS APRENDICES DEL PROGRAMA CONTABILIDAD Y FINANZAS DEL COMM VALLEDUPAR. MEMORIAS DEL II SIMPOSIO DE INVESTIGACION, INNOVACION Y DESARROLLO TECNOLOGICO ",
                    country: "Colombia",
                    isbn: "2590-6151",
                    ed: "SERVICIO NACIONAL DE APRENDIZAJE SENA , v. , p.36 - 40  1 ,2017",
                    description:
                        "Socializado en el II SIMPOSIO DE INVESTIGACIÓN, INNOVACIÓN Y DESARROLLO TECNOLÓGICO. VALLEDUPAR, COLOMBIA. 2017.",
                    link: "http://eventossinndetec.com/#/memorias",
                    file: "published-articles/article-1662937184.pdf",
                },
                {
                    year: "2017-04",
                    title: 'SISTEMA DE INFORMACIÓN PARA LA GESTIÓN DE LOS PROCESOS DE LA EMPRESA SERVIFLASH DEL VALLE, EN LA CIUDAD DE VALLEDUPAR" MEMORIAS DE SIMPOSIO DE INVESTIGACIÓN, INNOVACIÓN Y DESARROLLO TECNOLÓGICO . ',
                    country: "Colombia",
                    isbn: "2590-6151",
                    ed: "SERVICIO NACIONAL DE APRENDIZAJE SENA, v. , p.82 - 88  ,2017",
                    description:
                        "Socializado en el II SIMPOSIO DE INVESTIGACIÓN, INNOVACIÓN Y DESARROLLO TECNOLÓGICO. VALLEDUPAR, COLOMBIA. 2017.",
                    link: "http://eventossinndetec.com/#/memorias",
                    file: "published-articles/article-1662937184.pdf",
                },
            ];
            axios
                .get("/publishedArticle/all")
                .then((res) => {
                    var arrayAux = res.data;
                    this.publishedArticles = arrayAux.concat(
                        this.publishedArticles
                    );
                    this.publishedArticles.sort(function (a, b) {
                        if (a.year < b.year) {
                            return 1;
                        }
                        if (a.year > b.year) {
                            return -1;
                        }
                        // a must be equal to b
                        return 0;
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        initializeOthersArticles() {
            this.othersArticles = [];
            axios
                .get("/othersArticle/all")
                .then((res) => {
                    this.othersArticles = this.othersArticles.concat(res.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        openFile(file) {
            this.url = "/storage/" + file;
            this.dialog = true;

            console.log(file);
        },
        viewPdf(ruta) {
            this.url = ruta;
            this.dialog = true;
        },
    },
};
</script>

<style scoped></style>
