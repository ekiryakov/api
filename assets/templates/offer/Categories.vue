<template>
  <v-tabs dark background-color="teal darken-3" show-arrows v-model="selected">
    <v-tabs-slider color="teal lighten-3"></v-tabs-slider>
    <v-tab v-for="category in categories" :key="category.id" :href="initHref(category.id)">
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
    selected: null,
    categories: [],
  }),
  beforeMount() {
    let usp = new URLSearchParams(location.search);
    let category = usp.get('category');

    if (category) {
      this.selected = category;
    }

    this.categories = JSON.parse(this.data);
  },
  methods: {
    initHref(id) {
      return '/offer/?category=' + id;
    }
  }
}
</script>

<style scoped>

</style>