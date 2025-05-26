<template>
    <div>
        <v-footer
            dark
        >
            <v-app-bar flat dense>
                <strong class="subheading">¡Conéctate con nosotros en las redes sociales!</strong>

                <v-spacer></v-spacer>

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
            </v-app-bar>
        </v-footer>
        <v-footer
            dark
            padless
        >
            <v-card
                class="flex"
                flat
                tile
            >
                <v-card-text>
                    <div class="text-center caption"> © jenissagbini.com 2018-{{ new Date().getFullYear() }}. Todos los
                        derechos reservados
                    </div>
                </v-card-text>
            </v-card>
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
