<template>
    <v-btn :type="type"
           class="px-4 py-2 primary">
        <slot></slot>
    </v-btn>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: 'submit',
        },
    }
}
</script>
