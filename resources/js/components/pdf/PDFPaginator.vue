<template>
    <div class="pdf-paginator">
        <template v-if="pageCount">
            <v-text-field class="mt-4 ml-2 black--text" color="gray" style="width:60px; color:black" :value="value"
                          @input="input" min="1" :max="pageCount" type="number" :suffix="'/ '+pageCount"/>
        </template>
        <v-text-field v-else style="width:60px" type="number"/>
    </div>
</template>

<script>
    export default {
        name: 'PDFPaginator',
        props: {
            value: Number,
            pageCount: Number,
        },
        methods: {
            input(event) {
                this.$emit('input', parseInt(event, 10));
            },
        },

        watch: {
            pageCount() {
                this.$emit('input', 1);
            },
        }
    }
</script>

<style>
    .pdf-paginator {
        color: white;
        font-weight: bold;
    }

    .pdf-paginator.header-item
    > div.v-input.v-input--is-label-active.v-input--is-dirty.theme--light.v-text-field.v-text-field--is-booted
    > div
    > div.v-input__slot
    > div
    > div {
        color: gray;
    }
</style>
