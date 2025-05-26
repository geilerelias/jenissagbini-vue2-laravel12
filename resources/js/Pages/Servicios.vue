<template>
    <page-layout>
        <v-container fluid class="mt-12">
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
                        <v-img :src="img3" height="100vh" />
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
                    class="text-start justify-start ma-0 pa-0"
                >
                    <v-container fluid class="ma-0">
                        <v-card-text>
                            <v-toolbar color="grey darken-4" dark flat>
                                <v-tabs
                                    slot="extension"
                                    show-arrows
                                    v-model="tabs"
                                    background-color="transparent"
                                    centered
                                >
                                    <v-tab
                                        v-for="(item, index) in items"
                                        :key="index"
                                        >{{ item }}
                                    </v-tab>
                                </v-tabs>
                            </v-toolbar>

                            <v-tabs-items v-model="tabs">
                                <v-tab-item>
                                    <v-card flat>
                                        <v-banner single-line>
                                            <v-card-title
                                                class="title justify-start aling-start text-start"
                                                >Marketing & Emprendimiento
                                            </v-card-title>
                                        </v-banner>
                                        <v-card-text class="black--text">
                                            <v-row>
                                                <v-col>
                                                    <p class="justify-text">
                                                        Para emprender, se hace
                                                        necesario conocer tu
                                                        interior y conocer el
                                                        entorno. El
                                                        emprendimiento es una
                                                        actitud que nace desde
                                                        el “ser” pero debemos
                                                        descubrirlas para
                                                        encontrar grandes cosas
                                                        favorables que nos
                                                        permitan ser creativos e
                                                        innovadores. No basta
                                                        con tener una idea de
                                                        negocio, se debe ir más
                                                        allá porque el
                                                        emprendimiento es una
                                                        “actitud” que unida con
                                                        habilidades generan
                                                        proyectos productivos y
                                                        sostenibles. Es
                                                        necesario conocer de
                                                        marketing y como
                                                        especialista con
                                                        experiencia en la
                                                        temática, puedo
                                                        ayudarte. Tengo un
                                                        compromiso y es trabajar
                                                        con las personas y
                                                        fortalecer la curlturas
                                                        de las empresas.
                                                    </p>
                                                    <ul>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Diseño y ejecuto
                                                            Talleres/Seminarios/Asesorías
                                                            de Marketing.
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Diseño y ejecuto
                                                            Talleres/Seminarios/Asesorías
                                                            de Emprendimiento.
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Diseño y ejecuto
                                                            Mentorías de
                                                            Emprendimiento
                                                            Digital
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Talleres de
                                                            Creatividad &amp;
                                                            Emprendimiento
                                                        </li>
                                                    </ul>
                                                </v-col>
                                                <v-divider
                                                    vertical
                                                    v-if="
                                                        $vuetify.breakpoint
                                                            .smAndUp
                                                    "
                                                ></v-divider>
                                                <v-col
                                                    class="pa-0 pl-4"
                                                    cols="12"
                                                    sm="4"
                                                >
                                                    <v-card
                                                        :img="foto21"
                                                        height="400px"
                                                    ></v-card>
                                                </v-col>
                                            </v-row>
                                        </v-card-text>
                                    </v-card>
                                </v-tab-item>

                                <v-tab-item>
                                    <v-card flat>
                                        <v-banner single-line>
                                            <v-card-title
                                                class="title justify-start aling-start text-start"
                                                >Coaching Ejecutivo/Equipos
                                            </v-card-title>
                                        </v-banner>
                                        <v-card-text class="black--text">
                                            <v-row>
                                                <v-col>
                                                    <p class="justify-text">
                                                        Con la transformación
                                                        digital de los últimos
                                                        años y con todo lo que
                                                        se avecina en Tecnología
                                                        4.0, se hace necesario
                                                        que los miembros de un
                                                        equipo o el líder de un
                                                        equipo perciba el
                                                        entorno positivamente,
                                                        genere una mente nueva
                                                        en los equipos de
                                                        trabajo, involucre a sus
                                                        clientes en los
                                                        resultados de su
                                                        estrategia, conozca
                                                        habilidades de
                                                        comunicación,negociación,
                                                        liderazgo y trabajo en
                                                        equipo.
                                                    </p>
                                                    <ul>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Diseño y ejecuto
                                                            Talleres de Coaching
                                                            para Ejecutivos.
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Diseño y ejecuto
                                                            Talleres de Coaching
                                                            para Equipos de
                                                            Trabajo
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Seminarios de
                                                            Liderazgo
                                                            Transaccional
                                                        </li>
                                                    </ul>
                                                </v-col>
                                                <v-divider
                                                    vertical
                                                    v-if="
                                                        $vuetify.breakpoint
                                                            .smAndUp
                                                    "
                                                ></v-divider>
                                                <v-col
                                                    class="pa-0 pl-4"
                                                    cols="12"
                                                    sm="4"
                                                >
                                                    <v-card
                                                        :img="foto28"
                                                        height="400px"
                                                    ></v-card>
                                                </v-col>
                                            </v-row>
                                        </v-card-text>
                                    </v-card>
                                </v-tab-item>

                                <v-tab-item>
                                    <v-card flat>
                                        <v-banner single-line>
                                            <v-card-title
                                                class="title justify-start aling-start text-start"
                                                >Asesorías y Auditorías de
                                                Sistemas
                                            </v-card-title>
                                        </v-banner>
                                        <v-card-text class="black--text">
                                            <v-row>
                                                <v-col>
                                                    <p class="justify-text">
                                                        Un asesor es un
                                                        profesional que por sus
                                                        conocimientos y
                                                        experiencia puede
                                                        brindar consejos a otras
                                                        personas u empresas.
                                                        Estos servicios están
                                                        basados en una
                                                        especialización que
                                                        genera un valor agregado
                                                        y ayudará a una
                                                        actuación con precisión
                                                        y éxito en un área
                                                        específica. La Auditoría
                                                        de Sistemas en la época
                                                        actual, se convierte en
                                                        un proceso importante
                                                        para cualquier empresa
                                                        que desee garantizar
                                                        integridad.
                                                    </p>
                                                    <ul>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Realizo Análisis de
                                                            riesgo y
                                                            planificación de
                                                            auditorías de TIC.
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Realizo revisiones
                                                            del riesgo y
                                                            controles en los
                                                            sistemas de
                                                            información.
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Evalúo estrategias
                                                            de TI.
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Seguridad de activos
                                                            de información.
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Optimizo controles
                                                            directos en los
                                                            Sistemas de
                                                            Información.
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Desarrollo Políticas
                                                            de Seguridad de la
                                                            Información.
                                                        </li>
                                                    </ul>
                                                </v-col>
                                                <v-divider
                                                    vertical
                                                    v-if="
                                                        $vuetify.breakpoint
                                                            .smAndUp
                                                    "
                                                ></v-divider>
                                                <v-col
                                                    class="pa-0 pl-4"
                                                    cols="12"
                                                    sm="4"
                                                >
                                                    <v-card
                                                        :img="foto24"
                                                        height="400px"
                                                    ></v-card>
                                                </v-col>
                                            </v-row>
                                        </v-card-text>
                                    </v-card>
                                </v-tab-item>

                                <v-tab-item>
                                    <v-card flat>
                                        <v-banner single-line>
                                            <v-card-title
                                                class="title justify-start aling-start text-start"
                                                >Investigación y Eventos
                                                Científicos
                                            </v-card-title>
                                        </v-banner>
                                        <v-card-text class="black--text">
                                            <v-row>
                                                <v-col>
                                                    <p class="justify-text">
                                                        Obtener nuevos
                                                        conocimientos y
                                                        aplicarlos a la solución
                                                        de problemas en nuestro
                                                        entorno, es el objetivo
                                                        primordial de la
                                                        investigación. Como
                                                        investigadora, brindo
                                                        mis conocimientos y
                                                        experiencia en la
                                                        generación de
                                                        contenidos, liderazgo en
                                                        proyectos de
                                                        investigación,
                                                        seguimiento a proyectos
                                                        y cumplimiento de
                                                        estándares científicos.
                                                    </p>
                                                    <ul>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Asesorías en diseño
                                                            y elaboración de
                                                            proyectos de
                                                            investigación
                                                            científica
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Generación de
                                                            contenidos
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Escritura de
                                                            artículos
                                                            científicos
                                                        </li>
                                                        <li
                                                            class="justify-text"
                                                        >
                                                            Elaboración de
                                                            eventos científicos
                                                        </li>
                                                    </ul>
                                                </v-col>
                                                <v-divider
                                                    vertical
                                                    v-if="
                                                        $vuetify.breakpoint
                                                            .smAndUp
                                                    "
                                                ></v-divider>
                                                <v-col
                                                    class="pa-0 pl-4"
                                                    cols="12"
                                                    sm="4"
                                                >
                                                    <v-card
                                                        :img="img7_1"
                                                        height="400px"
                                                    ></v-card>
                                                </v-col>
                                            </v-row>
                                        </v-card-text>
                                    </v-card>
                                </v-tab-item>
                            </v-tabs-items>
                        </v-card-text>
                    </v-container>
                </v-col>
            </v-row>
        </v-container>
    </page-layout>
</template>

<script>
import img3 from "@/../img/3.jpg";
import foto21 from "@/../img/foto21.jpg";
import foto24 from "@/../img/foto24.jpg";
import foto28 from "@/../img/foto28.jpg";

import img7_1 from "@/../img/7_1.jpg";
import PageLayout from "@/Layouts/PageLayout.vue";

export default {
    name: "Servicios",
    components: {
        PageLayout,
    },
    data: () => ({
        foto21: foto21,
        foto24: foto24,
        foto28: foto28,
        img3: img3,
        img7_1: img7_1,
        items: ["Marketing", "Coaching", "Asesorías", "Investigación "],
        tabs: null,
        text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
    }),
};
</script>

<style scoped></style>
