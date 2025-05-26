<template>
    <v-container class="py-4 py-lg-8">
        <div class="text-center">
            <div class="text-uppercase overline  primary--text mb-2">trabajando con nosotros</div>
            <h2 class="text-h5 font-weight-bold mb-2 text-center">Conoce nuestro equipo</h2>
            <v-responsive class="base-divider primary mx-auto mb-6" style="max-width: 28px;">
                <v-divider style="padding-bottom: 1px"></v-divider>
            </v-responsive>

            <v-responsive class="mx-auto" style="max-width: 1200px;">
                <div class="subtitle-1 text-lg-subtitle-1  mt-4">
                    Contamos con un talento comprometido, apasionados y emprendedor, cuya motivación y
                    dedicación a su trabajo es vital para el éxito de CAFE Producciones.
                    <br>Promovemos un entorno de trabajo
                    basado en la
                    igualdad de oportunidades, la diversidad y la inclusión.
                </div>
            </v-responsive>
        </div>

        <v-row class="my-6">
            <v-col class="text-center col-sm-6 col-lg-3 col-12" v-for="item in team" :key="item.id">

                <v-card
                    class="light">
                    <v-img style="height: 340px;"
                           :src="item.src">
                    </v-img>
                    <div class="pa-3">
                        <div class="title">
                            {{ item.name }}
                        </div>
                        <div class="subtitle-2 secondary--text">
                            {{ item.ocupation }}
                        </div>
                    </div>
                </v-card>
            </v-col>
        </v-row>

        <v-img :src="equipodetrabajo"></v-img>
    </v-container>
</template>

<script>
import equipodetrabajo from '@/../images/team/equipodetrabajo.jpg'
import carmenbarros from '@/../images/team/carmenbarros.png'
import ferneybarros from '@/../images/team/ferneybarros.png'
import gennerradillo from '@/../images/team/gennereliasradillosarmiento.png'
import geilerradillo from '@/../images/team/geilerelias.png'


export default {
    name: "TeamComponent",
    data: () => ({
        equipodetrabajo: equipodetrabajo,
        team: [

            {
                name: 'Carmen Barros Diaz',
                src: carmenbarros,
                ocupation: 'Fundador - CEO -Gerente',
                perfil: ''
            },
            {
                name: 'Genner Radillo Sarmiento',
                src: gennerradillo,
                ocupation: 'Director de operaciones',
                perfil: ''
            },
            {
                name: 'Ferney Barros Diaz',
                src: ferneybarros,
                ocupation: 'Fundador - Coordinador general',
                perfil: ''
            },
            {
                name: 'Geiler Radillo Sarmiento',
                src: geilerradillo,
                ocupation: 'Desarrollador - Coordinador',
                perfil: ''
            },

        ]
    })
}
</script>

<style>

</style>
