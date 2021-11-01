<template>
  <v-slide-group center-active v-model="model" active-class="success" show-arrows>
    <v-slide-item v-for="partner in partners" :key="partner.id" v-slot="{ active, toggle }">
      <v-img max-height="50" contain :src="partner.logo"></v-img>
    </v-slide-item>
  </v-slide-group>
</template>

<script>
export default {
  props: {
    data: String
  },
  data: () => ({
    partners: [],
    model: null,
  }),
  mounted() {
    this.partners = JSON.parse(this.data);
  }
}
</script>

<style scoped>

</style>