<template>

    <div>
        <pdf-component url="https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf"></pdf-component>
    </div>
</template>

<script>
import AppPdf from './AppPdf.vue'

export default {
    components: {
        "pdf-component": AppPdf
    }
}
</script>

<style lang="scss" scoped>
</style>
