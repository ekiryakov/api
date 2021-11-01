<template>
  <v-slide-group v-if="isDesktop" center-active v-model="model" active-class="success" show-arrows>
    <v-slide-item v-for="set in sets" :key="set.id" v-slot="{ active, toggle }">
      <Set :data="set"></Set>
    </v-slide-item>
  </v-slide-group>
  <v-carousel v-else v-model="model" hide-delimiters height="auto">
    <v-carousel-item v-for="set in sets" :key="set.id">
      <Set :data="set"></Set>
    </v-carousel-item>
  </v-carousel>
</template>

<script>
import Set from "./Set";
export default {
  components: { Set },
  props: {
    data: String
  },
  data: () => ({
    sets: [],
    model: null,
    isDesktop: false,
  }),
  mounted() {
    this.sets = JSON.parse(this.data);
    this.isDesktop = ['xl','lg','md'].includes(this.$vuetify.breakpoint.name);
  }
}
</script>

<style scoped>

</style>