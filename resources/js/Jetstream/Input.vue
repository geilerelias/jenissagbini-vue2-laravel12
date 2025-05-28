<template>
    <v-text-field
        v-model="text"
        outlined :type="type" :value="value" @input="$emit('input', text)"
        ref="input"/>
</template>

<script>
export default {
    props: ['value', 'type'],
    data: () => ({
        text: ''
    }),
    mounted() {
        this.text = this.value
    },
    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>

