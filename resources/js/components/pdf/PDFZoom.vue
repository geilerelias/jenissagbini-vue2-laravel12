<template>
  <div>
    <v-btn small text icon @click.prevent.stop="zoomIn" :disabled="isDisabled">
      <v-icon>mdi-magnify-plus</v-icon>
    </v-btn>
    <v-btn small text icon @click.prevent.stop="zoomOut" :disabled="isDisabled">
      <v-icon>mdi-magnify-minus</v-icon>
    </v-btn>
    <v-btn small text icon @click.prevent.stop="fitWidth" :disabled="isDisabled">
      <v-icon>mdi-arrow-expand-all</v-icon>
    </v-btn>
    <v-btn small text icon @click.prevent.stop="fitAuto" :disabled="isDisabled">
      <v-icon>mdi-arrow-collapse-all</v-icon>
    </v-btn>

  </div>
</template>

<script>

  export default {
    name: 'PDFZoom',

    props: {
      scale: {
        type: Number,
      },
      increment: {
        type: Number,
        default: 0.25,
      },
    },
    data() {
      return {
        toggle_exclusive: undefined,
      }
    },
    computed: {
      isDisabled() {
        return !this.scale;
      },
    },

    methods: {
      zoomIn() {
        this.updateScale(this.scale + this.increment);
      },

      zoomOut() {
        if (this.scale <= this.increment) return;
        this.updateScale(this.scale - this.increment);
      },

      updateScale(scale) {
        this.$emit('change', { scale });
      },

      fitWidth() {
        this.$emit('fit', 'width');
      },

      fitAuto() {
        this.$emit('fit', 'auto');
      },
    },
  }
</script>

<style>
</style>
