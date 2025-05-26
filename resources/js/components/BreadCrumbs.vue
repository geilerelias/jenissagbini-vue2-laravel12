<template>
    <v-row class="row mx-0">
        <v-col class="px-0 mx-0 col-sm-12 col-12">
            <v-card class="px-2  mx-0 rounded-0">
                <v-toolbar dense flat extended
                           class="transparent px-0 mx-0">
                    <v-toolbar-title class="text--primary">{{ name }}</v-toolbar-title>
                    <template
                        v-slot:extension>
                        <v-breadcrumbs class="px-0 mx-0"
                                       :items="items"
                        >
                            <template v-slot:item="{ item }">
                                <v-breadcrumbs-item v-if="item.disabled"
                                                    :disabled="item.disabled"
                                >
                                    {{ item.text }}
                                </v-breadcrumbs-item>

                                <inertia-link v-else :href="item.href">
                                    <v-breadcrumbs-item
                                        :disabled="item.disabled"
                                    >
                                        {{ item.text }}
                                    </v-breadcrumbs-item>
                                </inertia-link>
                            </template>
                        </v-breadcrumbs>
                    </template>
                </v-toolbar>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
export default {
    props: ['name', 'items'],
    name: "BreadCrumbs"
}
</script>

<style scoped>

</style>
