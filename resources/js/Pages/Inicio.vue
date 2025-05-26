<template>
    <page-layout>
        <v-overlay :value="loading">
            <v-progress-circular
                color="primary"
                indeterminate
                size="64"
            ></v-progress-circular>
        </v-overlay>

        <v-img height="100vh" :src="img15">
            <div
                class="hidden-sm-and-down mt-5 ml-5 white--text text-start align-start"
            >
                <v-container fluid>
                    <v-row
                        no-gutters
                        align="center"
                        justify="start"
                        style="height: 80vh"
                    >
                        <v-col cols="12">
                            <v-row
                                no-gutters
                                style="height: 100px"
                                class="animate__animated animate__slideInLeft"
                            >
                                <v-col
                                    cols="12"
                                    align-self="start"
                                    class="ma-0 pa-0"
                                >
                                    <v-row class="ma-0 pa-0">
                                        <v-col
                                            cols="7"
                                            sm="8"
                                            md="12"
                                            class="ma-0 pa-0"
                                        >
                                            <h1
                                                class="text-uppercase display-1"
                                            >
                                                Jenis Sagbini
                                            </h1>
                                        </v-col>
                                    </v-row>
                                </v-col>
                                <v-col
                                    cols="12"
                                    align-self="start"
                                    class="ma-0 pa-0"
                                >
                                    <v-row class="ma-0 pa-0">
                                        <v-col
                                            cols="7"
                                            sm="8"
                                            md="4"
                                            lg="3"
                                            class="ma-0 pa-0"
                                        >
                                            <div class="px-0">
                                                <div
                                                    style="
                                                        height: 2px;
                                                        border-radius: 1px;
                                                        margin: 0;
                                                        background-color: white;
                                                    "
                                                ></div>
                                            </div>
                                        </v-col>
                                    </v-row>
                                </v-col>
                                <v-col
                                    cols="12"
                                    align-self="start"
                                    class="ma-0 pa-0"
                                >
                                    <v-row class="ma-0 pa-0">
                                        <v-col cols="12" class="ma-0 pa-0">
                                            <v-flex xs12>
                                                <p
                                                    class="py-2"
                                                    style="
                                                        font-size: 18px;
                                                        letter-spacing: 0.3em;
                                                    "
                                                >
                                                    Proyectos &amp; Ingeniería
                                                </p>
                                            </v-flex>
                                        </v-col>
                                    </v-row>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                </v-container>
            </div>
        </v-img>

        <v-layout class="flex sm8 offset-sm2 mt-2">
            <v-card flat class="pb-0">
                <v-card-text class="black--text body-1">
                    <v-container class="pb-0">
                        <p class="text-justify black--text body-1">
                            <b></b>
                            Cuando era adolescente leía muchos libros
                            filosóficos que me hacían pensar y novelas que me
                            hacían soñar. Me encantaba usaba una libreta donde
                            anotaba todas las frases que me llamaban la atención
                            a veces escribía su autor y otras veces no…y es así,
                            que quiero compartir dos frases que marcaron mi
                            vida:
                        </p>
                        <v-row>
                            <v-col cols="12" md="10">
                                <div class="d-flex align-start">
                                    <v-icon class="grey--text mr-3 mt-2">
                                        mdi-check-circle-outline
                                    </v-icon>

                                    <div class="subtitle-1">
                                        <b>
                                            <i>
                                                “La manera más rápida de mejorar
                                                cualquier habilidad, es combinar
                                                un entrenamiento físico
                                                constante con un entrenamiento
                                                mental constante.”
                                            </i>
                                        </b>
                                        Autor desconocido.
                                    </div>
                                </div>
                                <div class="d-flex align-start mt-3">
                                    <v-icon class="grey--text mr-3 mt-2">
                                        mdi-check-circle-outline
                                    </v-icon>

                                    <div class="subtitle-1">
                                        <b>
                                            <i>
                                                “Todo lo que puedas hacer o
                                                sueñes poder hacer… empieza a
                                                hacerlo. En la temeridad hay
                                                genio, poder y magia.”
                                            </i>
                                        </b>
                                        Goethe
                                    </div>
                                </div>
                            </v-col>
                            <v-col
                                cols="12"
                                md="2"
                                class="d-flex justify-center align-center"
                            >
                                <v-divider
                                    class="mr-4 hidden-sm-and-down"
                                    vertical
                                ></v-divider>
                                <v-avatar
                                    size="128"
                                    class="d-fex justify-center align-center"
                                >
                                    <img
                                        :src="personaLeyendo"
                                        alt="jenis sagbini"
                                    />
                                </v-avatar>
                            </v-col>
                        </v-row>
                        <p class="text-justify mt-3">
                            Con ello deseo decirte que cada uno de nosotros
                            tenemos dos grandezas: nuestro intelecto y nuestras
                            emociones…por lo tanto, debemos trabajar en esas
                            áreas… ¡Tenemos mucho trabajo por hacer, tenemos que
                            descubrirnos, Somos Grandes!
                        </p>
                        <p>
                            Soy Jenis y deseo darte la bienvenida a este espacio
                            de experiencias y proyectos.
                        </p>
                    </v-container>
                </v-card-text>
            </v-card>
        </v-layout>

        <v-container class="flex sm8 offset-sm2">
            <v-container
                fluid
                mb-12
                class="scroll-y text-start align-start"
                grid-list-xl
            >
                <v-row>
                    <v-col cols="12" md="12">
                        <v-layout wrap>
                            <v-flex pt-0 mt-0>
                                <v-container
                                    fluid
                                    mb-12
                                    class="scroll-y"
                                    grid-list-xl
                                >
                                    <div
                                        class="pricing-header px-3 pt-md-5 pb-0 mx-auto text-center"
                                    >
                                        <div
                                            class="base-section-heading text-center mb-0 animate__animated:hover animate__zoomIn"
                                        >
                                            <div class="d-inline-flex mb-4">
                                                <v-avatar
                                                    large
                                                    color="grey"
                                                    size="56"
                                                >
                                                    <v-icon dark>
                                                        mdi-newspaper-variant-multiple-outline
                                                    </v-icon>
                                                </v-avatar>
                                            </div>
                                            <h1
                                                class="headline font-weight-bold mb-2 text-center"
                                            >
                                                NOTICIAS
                                            </h1>
                                            <v-divider
                                                class="grey mx-auto mb-6"
                                                style="max-width: 28px"
                                            >
                                            </v-divider>
                                            <p
                                                class="base-body body-1 mx-auto grey--text text--darken-1 text-center mb-10"
                                            >
                                                Estas son algunas de las
                                                noticias mas destacadas.
                                            </p>
                                        </div>
                                    </div>
                                    <v-layout row wrap>
                                        <v-flex
                                            :md6="index !== 0"
                                            sm12
                                            v-for="(notice, index) in notices"
                                            :key="index"
                                        >
                                            <v-card class="mx-auto">
                                                <v-hover
                                                    v-slot="{ hover }"
                                                    open-delay="200"
                                                >
                                                    <v-card
                                                        color="transparent"
                                                        :elevation="
                                                            hover ? 16 : 0
                                                        "
                                                        flat
                                                        class="ma-0 pa-0 transparent"
                                                        @click="
                                                            showImage(
                                                                `/storage/${notice.image}`
                                                            )
                                                        "
                                                    >
                                                        <v-img
                                                            :contain="
                                                                index == 0
                                                            "
                                                            :aspect-ratio="
                                                                10 / 8
                                                            "
                                                            class="white--text ma-0"
                                                            :class="
                                                                hover
                                                                    ? 'zoom'
                                                                    : ''
                                                            "
                                                            :src="`/storage/${notice.image}`"
                                                            :max-height="
                                                                $vuetify
                                                                    .breakpoint
                                                                    .smAndDown
                                                                    ? 'auto'
                                                                    : '500px'
                                                            "
                                                        >
                                                            <v-card-title
                                                                class="align-end fill-height"
                                                            >
                                                                <p
                                                                    style="
                                                                        border-radius: 10px;
                                                                        background-color: rgba(
                                                                            10,
                                                                            10,
                                                                            10,
                                                                            0.38
                                                                        );
                                                                    "
                                                                    class="text-uppercase text-break pa-2 mb-0 rounded body-1 body-1"
                                                                >
                                                                    {{
                                                                        notice.title
                                                                    }}
                                                                </p>
                                                            </v-card-title>
                                                        </v-img>
                                                    </v-card>
                                                </v-hover>
                                                <v-card-text>
                                                    <span
                                                        >{{ notice.city }} -
                                                        {{
                                                            computedDateFormattedMomentjs(
                                                                notice.date
                                                            )
                                                        }}
                                                        a las
                                                        {{ notice.time }}
                                                        horas.</span
                                                    >
                                                    <br />
                                                    <span class="text--primary">
                                                        <span
                                                            v-html="
                                                                notice.description
                                                            "
                                                        >
                                                        </span>
                                                    </span>
                                                </v-card-text>
                                                <v-card-actions>
                                                    <div
                                                        v-for="(
                                                            link, i
                                                        ) in getArray(
                                                            notice.links
                                                        )"
                                                        :key="i"
                                                    >
                                                        <v-btn
                                                            text
                                                            color="orange"
                                                            :href="link.link"
                                                            target="blank"
                                                        >
                                                            <span
                                                                v-if="i === 0"
                                                            >
                                                                Ver mas aquí
                                                            </span>
                                                            <span v-else>
                                                                y aquí
                                                            </span>
                                                        </v-btn>
                                                    </div>
                                                </v-card-actions>
                                            </v-card>
                                        </v-flex>
                                    </v-layout>
                                </v-container>
                            </v-flex>
                        </v-layout>
                    </v-col>
                    <!-- <v-col cols="12" md="3">
                    <v-divider class="mb-4"> </v-divider>

                    <v-card style="border-radius:0">
                        <v-card-text
                            class="grey darken-3  headline white--text text-wrap "
                            primary-title
                        >
                            <p class="text-center">
                                Comunicate Conmigo en redes sociales
                            </p>
                            <v-col class="text-center">
                                <v-btn
                                    v-for="item in icons"
                                    :key="item.icon"
                                    :href="item.link"
                                    target="_blank"
                                    dark
                                    icon
                                >
                                    <v-icon>{{ item.icon }}</v-icon>
                                </v-btn>
                            </v-col>

                            <div
                                class="d-flex justify-center align-center"
                            ></div>
                        </v-card-text>
                        <v-card-text class="grey darken-1">
                            <p class="title white--text text-center">
                                No te pierdas ninguno de nuestros eventos
                            </p>

                            <br />
                            <p class="white--text text-center">
                                ¡Reciba la información de nuestros próximos
                                eventos directamente en su bandeja de entrada!
                            </p>
                        </v-card-text>
                    </v-card>
                </v-col> -->
                </v-row>
            </v-container>
        </v-container>

        <preview-image
            :dialog="dialog"
            :close="closeDialog"
            :selected-image="selectedImage"
        />
    </page-layout>
</template>

<script>
import lazzy from "@/../img/lazy.jpg";
import img15 from "@/../img/15.jpg";
import personaLeyendo from "@/../img/persona_leyendo_un_libro_con_una_taza_de_te.jpg";

import PageLayout from "@/Layouts/PageLayout.vue";
import moment from "moment";
import PreviewImage from "@/components/PreviewImage.vue";

moment.locale("es");

export default {
    components: {
        PreviewImage,
        PageLayout,
    },
    data: () => ({
        loading: true,
        loaded: false,
        lazzy: lazzy,
        img15: img15,
        personaLeyendo: personaLeyendo,
        newArray: [],
        icons: [
            {
                link: "https://www.facebook.com/jenis.sagbini.9",
                icon: "mdi-facebook",
            },
            {
                link: "https://www.instagram.com/jenis_sagbini/",
                icon: "mdi-instagram",
            },
            {
                link: "https://twitter.com/JenisSagbini",
                icon: "mdi-twitter",
            },
            {
                link: "https://linkedin.com/in/jenis-del-carmen-sagbini-echávez-b66a1410a",
                icon: "mdi-linkedin",
            },
        ],
        notices: [],
        ocultar: "hidden-md-and-up",
        bgColor: "transparent",
        fab: false,
        flat: true,
        dialog: false,
        notifications: false,
        sound: true,
        widgets: false,
        selectedImage: "",
    }),
    created() {
        const readyHandler = () => {
            if (document.readyState == "complete") {
                this.loading = false;
                this.loaded = true;
                document.removeEventListener("readystatechange", readyHandler);
                console.log("carga completa de la pagina");
            }
        };
        document.addEventListener("readystatechange", readyHandler);

        readyHandler(); // in case the component has been instantiated lately after loading
    },
    mounted() {
        this.initialize();
    },

    methods: {
        showImage(image) {
            this.selectedImage = image;
            this.dialog = true;
            console.log("show image dialog", this.dialog, this.getDialog);
        },

        closeDialog() {
            this.dialog = false;
        },

        inited(viewer) {
            this.$viewer = viewer;
        },

        show() {
            this.$viewer.show();
        },

        getArray(array) {
            var newArray = [];
            if (Array.isArray(array)) {
                newArray = array;
                return newArray;
            } else {
                try {
                    newArray = JSON.parse(array);
                } catch (error) {
                    console.log(error);
                }
                return newArray;
            }
        },
        onEditorBlur(editor) {
            // console.log('editor blur!', editor)
        },
        onEditorFocus(editor) {
            // console.log('editor focus!', editor)
        },
        onEditorReady(editor) {
            // console.log('editor ready!', editor)
        },
        customButtonClick() {
            alert(
                `You can custom the button and listen click event to do something...`
            );
        },
        mostrarTexto() {
            console.log(this.content);
        },
        getHeight() {
            return document.documentElement.clientHeight - 100;
        },
        initialize() {
            axios.get("/notices/all").then((res) => {
                this.notices = res.data;
                //this.notices = aux;
                //console.log("notices:", this.notices);
            });
            ///console.log(this.notices);
        },
        computedDateFormattedMomentjs(date) {
            return date ? moment(date).format("dddd, D MMMM YYYY") : "";
        },
    },
};
</script>

<style>
/*zoom en imagenes*/
.v-image .v-image__image {
    transition: all 0.6s;
}

.v-image.zoom .v-image__image {
    transform: scale(1.2);
}

strong {
    font-weight: bold !important;
}

nav {
    margin-top: 0px;
    padding: 14px;
    text-align: center;
}

nav a.link {
    transition: 0.7s ease;
    color: #ffffff;
    text-decoration: none;
    border-top: 2px solid;
    border-bottom: 2px solid rgba(0, 0, 0, 0);
    padding: 20px 0;
    margin: 0 5px;
}

nav a.active {
    border-top: 2px solid #bdbdbd;
    border-bottom: 2px solid #bdbdbd;
    padding: 6px 0;
}

nav a.link:hover {
    border-top: 2px solid #bdbdbd;
    border-bottom: 2px solid #bdbdbd;
    padding: 6px 0;
    /* background-color: #ffffff2c; */
}
</style>
