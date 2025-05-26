<template>
    <page-layout>
        <v-container fluid class="mt-12 mb-0">
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
                        <v-img :src="img11" height="100vh" />
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
                    class="text-end justify-end ma-0 pa-0 mb-0"
                >
                    <v-container fluid class="ma-0">
                        <v-card color="basil" class="pa-2">
                            <v-card-title
                                class="text-center justify-center py-6"
                            >
                                <h4 class="font-weight-bold">
                                    PROYECTOS REALIZADOS
                                </h4>
                            </v-card-title>

                            <v-tabs
                                v-model="tab"
                                background-color="transparent"
                                color="basil"
                                show-arrows
                                grow
                            >
                                <v-tab v-for="item in items" :key="item"
                                    >{{ item }}
                                </v-tab>
                            </v-tabs>
                            <v-divider class="mt-4"></v-divider>
                            <v-tabs-items v-model="tab">
                                <v-tab-item
                                    class="text-left justify-start py-6"
                                >
                                    <v-list three-line>
                                        <v-subheader class="headline"
                                            >Emprendimientos
                                        </v-subheader>
                                        <div
                                            v-for="(
                                                item, index
                                            ) in entrepreneurship"
                                            :key="index"
                                        >
                                            <v-list-item>
                                                <v-list-item-avatar color="grey"
                                                    >{{ index + 1 }}
                                                </v-list-item-avatar>
                                                <v-list-item-content>
                                                    <v-list-item-title
                                                        class="title"
                                                        >{{ item.title }}
                                                    </v-list-item-title>
                                                    <v-list-item-content
                                                        class="grey--text"
                                                    >
                                                        {{ item.description }}
                                                    </v-list-item-content>

                                                    <v-list-item-content
                                                        >Estado actual:
                                                        {{ item.state }}.
                                                    </v-list-item-content>
                                                </v-list-item-content>
                                            </v-list-item>
                                            <v-divider></v-divider>
                                        </div>
                                    </v-list>
                                </v-tab-item>

                                <v-tab-item
                                    class="text-left justify-start py-6"
                                >
                                    <v-list three-line>
                                        <v-subheader class="headline"
                                            >Software Desarrollados
                                        </v-subheader>
                                        <div
                                            v-for="(item, index) in softwares"
                                            :key="index"
                                        >
                                            <v-list-item>
                                                <v-list-item-avatar
                                                    color="grey"
                                                    class="mt-6"
                                                    >{{ index + 1 }}
                                                </v-list-item-avatar>
                                                <v-list-item-content>
                                                    <v-list-item-content
                                                        class="body-1"
                                                        >{{ item.title }}
                                                    </v-list-item-content>

                                                    <v-list-item-content
                                                        class="grey--text"
                                                    >
                                                        {{ item.description }}
                                                    </v-list-item-content>

                                                    <v-list-item-content>
                                                        Estado:
                                                        {{ item.state }}.
                                                        Empresa patrocinadora:
                                                        {{ item.entity }}.
                                                        {{ item.year }}.
                                                    </v-list-item-content>
                                                </v-list-item-content>
                                            </v-list-item>
                                            <v-divider></v-divider>
                                        </div>
                                    </v-list>
                                </v-tab-item>

                                <v-tab-item
                                    class="text-left justify-start py-6"
                                >
                                    <v-list three-line>
                                        <v-subheader class="headline"
                                            >Planes de Negocios Desarrollados
                                        </v-subheader>
                                        <div
                                            v-for="(item, index) in business"
                                            :key="index"
                                        >
                                            <v-list-item>
                                                <v-list-item-avatar color="grey"
                                                    >{{ index + 1 }}
                                                </v-list-item-avatar>
                                                <v-list-item-content>
                                                    <v-list-item-content
                                                        class="body-1"
                                                        >{{ item.title }}
                                                    </v-list-item-content>

                                                    <v-list-item-content
                                                        class="grey--text"
                                                    >
                                                        {{ item.description }}
                                                    </v-list-item-content>

                                                    <v-list-item-content
                                                        >Estado:
                                                        {{ item.state }}.
                                                        Empresa patrocinadora:{{
                                                            item.entity
                                                        }}
                                                        {{ item.year }}.
                                                    </v-list-item-content>
                                                </v-list-item-content>
                                            </v-list-item>
                                            <v-divider></v-divider>
                                        </div>
                                    </v-list>
                                </v-tab-item>

                                <v-tab-item
                                    class="text-left justify-start py-6"
                                >
                                    <v-list three-line>
                                        <v-subheader
                                            class="headline"
                                            :class="{
                                                'text-truncate':
                                                    !$vuetify.breakpoint
                                                        .mdAndUp,
                                            }"
                                            >Tesis de Grado Dirigidas en
                                            Instituciones Educativas Nivel
                                            Profesional y Formación para el
                                            Trabajo
                                        </v-subheader>
                                        <div
                                            v-for="(item, index) in thesis"
                                            :key="index"
                                        >
                                            <v-list-item>
                                                <v-list-item-avatar
                                                    color="grey"
                                                    class="mt-7"
                                                    >{{ index + 1 }}
                                                </v-list-item-avatar>
                                                <v-list-item-content>
                                                    <v-list-item-content
                                                        class="body-1"
                                                    >
                                                        {{ item.title }}
                                                    </v-list-item-content>
                                                    <v-list-item-subtitle
                                                        >{{ item.entity }}
                                                    </v-list-item-subtitle>
                                                    <v-list-item-subtitle
                                                        v-if="item.People != ''"
                                                        >Personas orientadas:
                                                        {{ item.People }}
                                                    </v-list-item-subtitle>
                                                    <v-list-item-subtitle
                                                        >{{ item.year }}
                                                    </v-list-item-subtitle>
                                                </v-list-item-content>
                                            </v-list-item>
                                            <v-divider></v-divider>
                                        </div>
                                    </v-list>
                                </v-tab-item>

                                <v-tab-item
                                    class="text-left justify-start py-6"
                                >
                                    <v-list three-line>
                                        <v-subheader
                                            class="headline"
                                            :class="{
                                                'text-truncate':
                                                    !$vuetify.breakpoint
                                                        .mdAndUp,
                                            }"
                                            >Participación como Jurado de Tesis
                                            en Instituciones Educativas Nivel
                                            Profesional y Formación para el
                                            Trabajo
                                        </v-subheader>
                                        <div
                                            v-for="(item, index) in jurys"
                                            :key="index"
                                        >
                                            <v-list-item>
                                                <v-list-item-avatar
                                                    color="grey"
                                                    class="mt-8"
                                                    >{{ index + 1 }}
                                                </v-list-item-avatar>
                                                <v-list-item-content>
                                                    <v-list-item-content
                                                        class="body-1"
                                                        >{{ item.title }}
                                                    </v-list-item-content>
                                                    <v-list-item-subtitle>
                                                        {{ item.entity }}
                                                    </v-list-item-subtitle>
                                                    <v-list-item-subtitle
                                                        v-if="item.people != ''"
                                                    >
                                                        Personal Orientado:
                                                        {{ item.people }}
                                                    </v-list-item-subtitle>
                                                    <v-list-item-subtitle>
                                                        {{ item.year }}.
                                                    </v-list-item-subtitle>
                                                </v-list-item-content>
                                            </v-list-item>
                                            <v-divider></v-divider>
                                        </div>
                                    </v-list>
                                </v-tab-item>
                            </v-tabs-items>
                        </v-card>
                    </v-container>
                </v-col>
            </v-row>
        </v-container>
    </page-layout>
</template>

<script>
import img11 from "@/../img/11.jpg";
import PageLayout from "@/Layouts/PageLayout.vue";

export default {
    name: "Proyectos",
    components: {
        PageLayout,
    },
    data: () => ({
        img11: img11,
        tab: null,
        items: [
            "Emprendimientos",
            "Software desarrollados",
            "Planes de negocio",
            "Tesis dirigidas",
            "Jurado de tesis",
        ],
        entrepreneurship: [],
        softwares: [],
        business: [],
        thesis: [],
        jurys: [],
    }),
    created: function () {
        this.initilize();
    },
    methods: {
        initilize() {
            try {
                this.loadEntrepreneurship();
                this.loadSoftwares();
                this.loadBusiness();
                this.loadThesis();
                this.loadJury();
            } catch (e) {
                console.log(e);
            }
        },

        loadEntrepreneurship() {
            this.entrepreneurship = [
                {
                    id: "0",
                    title: "HUMUS DEL CESAR S.A.S.",
                    description:
                        " Socia de una empresa privada tipo S.A.S. dedicada a la producción y comercialización de abonos orgánicos y a la prestación de servicios en diseño y elaboración de jardines. Empresa que funcionó en Valledupar y se destacó por su liderazgo en la zona caribeña pues sus productos y servicios tuvieron una cobertura significativa por su buena calidad y excelente servicio a nivel institucional para clientes como Homecenter, Centro Comercial Guatapurí Plaza y profesionales independientes del sector agrícola.",
                    state: "cerrado",
                },
                {
                    id: "1",
                    title: "PRACTIKA BOUTIQUE.",
                    description:
                        "Socia de empresa privada del Régimen Simplificado dedicada al alquiler de ropa de gala para toda la familia. Empresa que funcionó en Valledupar.",
                    state: "cerrado",
                },
                {
                    id: "2",
                    title: "HOSTAL VALLEDUPAR.",
                    description:
                        "Socia de empresa privada del Régimen Simplificado dedicada a la prestación del servicio hotelero y/o turístico en la ciudad de Valledupar. Empresa que funcionó en Valledupar.",
                    state: "cerrado",
                },
            ];

            axios
                .get("/entrepreneurship/all")
                .then((res) => {
                    this.entrepreneurship = this.entrepreneurship.concat(
                        res.data
                    );
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        loadSoftwares() {
            this.softwares = [
                {
                    id: "0",
                    title: "DISEÑO E IMPLEMENTACIÓN DE UN SOFTWARE DE GESTIÓN PARA EL MANEJO DE CITAS MÉDICAS E HISTORIAS CLÍNICAS EN EL CONSULTORIO ESPECIALIZADO DEL DOCTOR HERNÁN AUGUSTO APONTE PENSO EN LA CIUDAD DE VALLEDUPAR.",
                    description:
                        "Software para el sector salud, dirigido al Consultorio Particular de Neumología del Dr. Hernán Augusto Aponte Penso que permite administrar citas médicas y manejo de la historia clínica de pacientes. Desarrollado en lenguaje php y con el manejador de base de datos MySQL, que es un sistema de gestión de bases de datos relacional desarrollado bajo una Licencia pública general y una Licencia comercial por Oracle Corporation.",
                    state: "terminado",
                    entity: "Fundación Universitaria San Martín",
                    year: "2006",
                },
                {
                    id: "1",
                    title: "DISEÑO E IMPLEMENTACIÓN DE UN SOFTWARE PARA LA COMERCIALIZACIÓN DE PRODUCTOS AGRARIOS “GANAVENTAS”",
                    description:
                        "Implementación de una empresa digital regional lamada “Ganaventas” en el sector agrario cuyas principales actividades son: Asesorías y evaluación de proyectos productivos destinados al sector pecuario, Comercializar Ganados, compra y venta de tierra, maquinaria usadas agrícolas.",
                    state: "terminado",
                    entity: "Universidad Jorge Tadeo Lozano de Bogotá",
                    year: "2009",
                },
                {
                    id: "1",
                    title: "PÁGINA WEB DE ULTRALINE DE LA COSTA.",
                    description:
                        " Diseño e Implementación de la Página Institucional de la empresa ULTRALINE DE LA COSTA, actualmente ULTRALINE ELECTRÓNICA destinada a la comercialización de productos electrónicas.",
                    state: "terminado",
                    entity: "Ultraline Electrónica. Barranquilla, Colombia.",
                    year: "2012",
                },
            ];
            axios
                .get("/software/all")
                .then((res) => {
                    this.softwares = this.softwares.concat(res.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        loadBusiness() {
            this.business = [
                {
                    id: "0",
                    title: "PLAN DE NEGOCIO “CREACIÓN DE UNA COMERCIALIZADORA DE SEMOVIENTES, PRODUCTOS Y SERVICIOS PECUARIOS EN LA ZONA NORTE DEL DEPARTAMENTO DEL CESAR”.",
                    description:
                        "Plan de Negocios orientado a la creación de una empresa digital regional lamada “Ganaventas” en el sector agrario cuyas principales actividades son: Asesorías y evaluación de proyectos productivos destinados al sector pecuario, Comercializar Ganados, compra y venta de tierra, maquinaria usadas agrícolas. ",
                    state: "terminado",
                    entity: "Universidad Jorge Tadeo Lozano de Bogotá",
                    year: "2009",
                },
                {
                    id: "1",
                    title: "PLAN DE NEGOCIOS “ABONO ORGÁNICO Y REFORESTACIÓN”.",
                    description:
                        " Plan de negocios que consiste en la creación de una empresa privada llamada HUMUS DEL CARIBE SAS, productora de abono orgánico para cultivos agrícolas y proyectos de reforestación.",
                    state: "terminado",
                    entity: "Instituto Eurothecnology Empesas IEE. División de Estudios de Postgrados e Investigación. España.",
                    year: "2011",
                },
            ];
            axios
                .get("/business/all")
                .then((res) => {
                    this.business = this.business.concat(res.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        loadThesis() {
            this.thesis = [
                {
                    id: "0",
                    title: "EMPRENDIMIENTO DIGITAL “SOMOS UNO”.",
                    entity: "Universidad Popular del Cesar.",
                    year: "2018",
                    People: "Aldair Nuñez Florian.",
                },
                {
                    id: "1",
                    title: "LA REALIDAD AUMENTADA EN COMERCIALIZACIÓN DE PRODUCTOS PARA EL HOGAR: CRECIMIENTO Y TENDENCIAS EN COLOMBIA.",
                    entity: "Universidad Popular del Cesar.",
                    year: "2018",
                    People: "Yesid Linares y Sergio Luis Barragán",
                },
                {
                    id: "2",
                    title: "SISTEMA DE DIALOGO HUMANO-ROBOT BASADO EN CASOS.",
                    entity: "Universidad Popular del Cesar.",
                    year: "2017",
                    People: "Efraim Alfonso Orozco y Karen Dayana Quiroga.",
                },
                {
                    id: "3",
                    title: "ESTILOS DE APRENDIZAJE: CONDICIONES PEDAGÓGICAS PRESENTES EN EL PROCESO FORMATIVO EN LOS APRENDICES DEL PROGRAMA CONTABILIDAD Y FINANZAS DEL COMM VALLEDUPAR.",
                    entity: "Servicio Nacional de Aprendizaje SENA Regional Cesar.",
                    year: "2017",
                    People: "",
                },
                {
                    id: "4",
                    title: "USABILIDAD DE LAS REDES SOCIALES COMO ESTRATEGIA DE MARKETING EN LAS MYPIMES EN LA CIUDAD DE VALLEDUPAR",
                    entity: "Servicio Nacional de Aprendizaje SENA Regional Cesar.",
                    year: "2017",
                    People: "",
                },
                {
                    id: "5",
                    title: "SISTEMA DE INFORMACION WEB Y APP PARA LA GESTION ADMINISTRATIVA DEL HOTEL SERRANO PLAZA EN LA CIUDAD DE VALLEDUPAR.",
                    entity: "Universidad Popular del Cesar.",
                    year: "2017",
                    People: "José Luis Arias Carranza y Carlos Julio Pitre Martínez",
                },
                {
                    id: "6",
                    title: "SISTEMA DE INFORMACION PARA LA GESTION DE LOS PROCESOS DE LA EMPRESA SERVIFLASH DEL VALLE.",
                    entity: "Universidad Popular del Cesar.",
                    year: "2016",
                    People: "Jefferson David Saurith Chacón y Fabio Andrés Rojas",
                },
                {
                    id: "7",
                    title: "SISTEMA DE CONTROL PARA LA ENTREGA DE ESTUDIANTES DEL INSTITUTO DE APRENDIZAJE LA PAZ EN LA CIUDAD DE VALLEDUPAR.",
                    entity: "Universidad Popular del Cesar.",
                    year: "2016",
                    People: "Sandy Martínez Camacho y Esteffany Paola Romero Luna",
                },
                {
                    id: "8",
                    title: "SISTEMA DE INFORMACIÓN PARA EL CONTROL DE CARTERA E INVENTARIO DE LA EMPRESA RPB DISTRIBUCIONES.",
                    entity: "Universidad Popular del Cesar.",
                    year: "2016",
                    People: "Josías Elisad Ibarra Paternostro y José de la Cruz Pertuz Mena",
                },
            ];
            axios
                .get("/thesis/all")
                .then((res) => {
                    this.thesis = this.thesis.concat(res.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        loadJury() {
            this.jurys = [
                {
                    id: 0,
                    title: "APLICATIVO MOVIL PARA LA GESTION DE LOS PROCESOS JUDICIALES EN UNA OFICINA DE ABOGADOS INDEPENDIENTES.",
                    year: "2017",
                    entity: "Universidad Popular del Cesar. ",
                    people: "Kevin Luis Florez Lozada y Ricardo Andrés Sanchez Atuesta.",
                },
                {
                    id: 1,
                    title: "AUDITORÍA AL SISTEMA DE INFORMACIÓN EN LA EMPRESA ASISTENCIA MÉDICA INMEDIATA “AMEDI S.A.S.” EN EL MUNICIPIO DE VALLEDUPAR.",
                    year: "2016",
                    entity: "Universidad Popular del Cesar.",
                    people: "",
                },
                {
                    id: 2,
                    title: "POLÍTICAS DE SEGURIDAD INFORMÁTICAS PARA LA EMPRESA SOLUCIONES HUMANAS CONSULTORES LTDA. DEL MUNICIPIO DE VALLEDUPAR.",
                    year: "2016",
                    entity: "Universidad Popular del Cesar.",
                    people: "Alejandra Milena Laskar Echeverría y María del Rosario Vanegas Rivera.",
                },
                {
                    id: 3,
                    title: "DISEÑO, DESARROLLO E IMPLEMENTACION DE UN SISTEMA DE GESTIÓN DE NÓMINA PARA LA EMPRESA DE SERVICIOS PÚBLICOS DE AGUSTIN CODAZZI “EMCODAZZI E.S.P.”.",
                    year: "2014",
                    entity: "Fundación Universitaria San Martín.",
                    people: "David Alfonso Panesso Sanchez.",
                },
                {
                    id: 4,
                    title: "DESARROLLO DE UN SOFTWARE INTERACTIVO PARA LA ENSEÑANZA- APRENDIZAJE DEL ARHUACO-ESPAÑOL.",
                    year: "2014",
                    entity: "Fundación Universitaria San Martín.",
                    people: "Jesús David Romero Torregrosa.",
                },
            ];
            axios
                .get("/jury/all")
                .then((res) => {
                    this.jurys = this.jurys.concat(res.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style>
.sidebar {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 0;
}

.w-lg-half {
    width: 50% !important;
}
</style>
