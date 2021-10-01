<template>
  <v-slide-group active-class="success" show-arrows>
    <v-slide-item v-for="partner in partners" :key="partner.id" v-slot="{ active, toggle }">
      <v-img height="200" width="200" :src="partner.logo"></v-img>
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
  }),
  mounted() {
    this.partners = JSON.parse(this.data);
  }
}
</script>

<style scoped>

</style>