<template>
    <v-btn :type="type">
        <slot></slot>
    </v-btn>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: 'button',
        },
    }
}
</script>
