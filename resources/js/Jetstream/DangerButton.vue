<template>
    <v-btn :type="type" class="error px-4 py-2 ">
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
