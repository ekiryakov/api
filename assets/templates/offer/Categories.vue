<template>
  <v-tabs dark background-color="teal darken-3" show-arrows v-model="selected">
    <v-tabs-slider color="teal lighten-3"></v-tabs-slider>
    <v-tab v-for="category in categories" :key="category.id">
      {{ category.name }}
    </v-tab>
  </v-tabs>
</template>

<script>
export default {
  props: {
    data: String
  },
  data: () => ({
    selected: 2,
    categories: [],
  }),
  mounted() {
    this.categories = JSON.parse(this.data);
  }
}
</script>

<style scoped>

</style>