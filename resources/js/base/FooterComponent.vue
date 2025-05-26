<template>
    <div>
        <v-footer dark>
            <v-container class="py-5">
                <v-row>
                    <v-col class="col-md-4 col-12">
                        <div class="text-h6 text-lg-h5 font-weight-bold">
                            Jenis Sagbini
                        </div>
                        <div class="mb-5 mt-1 secondary" style="width: 160px; height: 4px;"></div>
                        <div class="text-body-1 secondary--text ">
                            <div>¡Haciendo a la Gente Exitosa en un mundo cambiante!</div>
                            <div class="mt-2">
                                <v-btn
                                    v-for="item in redesSociales" :key="item.id" :href="item.route" target="_blank"
                                    icon
                                    rounded
                                    light
                                    class="mr-1 secondary--text text--lighten-2">
                                    <v-icon v-text="item.icon"></v-icon>
                                </v-btn>
                                <whatsapp-message-button
                                    class="mr-1 secondary--text text--lighten-2">
                                </whatsapp-message-button>
                            </div>
                        </div>
                    </v-col>
                    <div class="col-md-4 col-12">
                        <div class="text-h6 text-lg-h5 font-weight-bold">Servicios</div>
                        <div class="mb-5 mt-1 secondary" style="width: 110px; height: 4px;"></div>
                        <div class="d-flex flex-wrap">
                            <div class="w-half body-1 mb-1" v-for="item in services" :key="item.id">
                                <inertia-link :href="item.route"
                                              class="text-decoration-none secondary--text text--lighten-2">
                                    {{ item.name }}
                                </inertia-link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="text-h6 text-lg-h5 font-weight-bold">Información de contacto</div>
                        <div class="mb-5 mt-1 secondary" style="width: 285px; height: 4px;"></div>
                        <div class="d-flex mb-2 font-weight-bold">
                            <v-icon
                                class="secondary--text text--lighten-1 mr-1">
                                mdi-map-marker-outline
                            </v-icon>
                            <a href="https://maps.google.com/?q=10.455869110432001, -73.24797745984498"
                               class="text-decoration-none secondary--text text--lighten-2">
                                Av. Simón Bolívar No. 6-04 Valledupar, Colombia
                            </a>
                        </div>
                        <div class="d-flex mb-2">
                            <v-icon
                                class="secondary--text text--lighten-1 mr-1">
                                mdi-email-outline
                            </v-icon>
                            <a
                                href="mailto:contacto@jenissagbini.com"
                                class="text-decoration-none secondary--text text--lighten-2">
                                contacto@jenissagbini.com
                            </a>
                        </div>
                    </div>

                </v-row>
                <hr role="separator" aria-orientation="horizontal" class="my-3 v-divider theme--light">
                <div class="text-center caption"> © jenissagbini.com 2018-{{ new Date().getFullYear() }}. Todos los
                    derechos reservados
                </div>
            </v-container>
        </v-footer>
    </div>
</template>

<script>
import WhatsappMessageButton from '@/components/WhatsappMessageButton.vue'

export default {
    name: "footeer-component",
    components: {
        WhatsappMessageButton
    },
    data() {
        return {
            absolute: true,
            redesSociales: [
                {
                    name: 'facebook',
                    icon: 'mdi-facebook',
                    route: 'https://www.facebook.com/jenis.sagbini.9'
                },
                {
                    name: 'twitter',
                    icon: 'mdi-twitter',
                    route: 'https://twitter.com/JenisSagbini'
                },
                {
                    name: 'inkedin',
                    icon: 'mdi-linkedin',
                    route: 'https://www.linkedin.com/in/jenis-del-carmen-sagbini-ech%C3%A1vez-b66a1410a/'
                },
                {
                    name: 'instagram',
                    icon: 'mdi-instagram',
                    route: 'https://www.instagram.com/jenis_sagbini/'
                },
                // {
                //     name: 'whatsapp',
                //     icon: 'mdi-whatsapp',
                //     route: 'https://api.whatsapp.com/send?phone=573002900321'
                // },
            ],
            services: [
                {name: 'Desarrollo Web', src: '', route: ''},
                {name: 'Auditoría de Sistemas', src: '', route: ''},
                {name: 'Marketing', src: '', route: ''},
                {name: 'Emprendimiento', src: '', route: ''},
                {name: 'Capacitaciones', src: '', route: ''},
                {name: 'Investigación', src: '', route: ''},
                {name: 'Asesorías', src: '', route: ''},
            ]

        };
    },
    methods: {
        cambiarAbsolute() {
            if (screen.width < 1024) {
                console.log(screen.width);
                this.absolute = false;
            } else {
                this.absolute = true;
            }
        }
    },
    mounted() {
        console.log("Component mounted.");
        this.cambiarAbsolute();
    }
};
</script>

<style>
.w-half {
    width: 50% !important;
}
</style>
