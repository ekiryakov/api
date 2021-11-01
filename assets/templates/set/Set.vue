<template>
  <v-card class="ma-4" color="primary" dark>
    <div class="d-flex flex-no-wrap justify-space-between">
      <div>
        <v-card-title class="text-h5" v-text="data.name"></v-card-title>
        <v-card-subtitle v-text="data.description"></v-card-subtitle>
        <v-card-actions>
          <v-btn class="ml-2 mt-5" outlined rounded small>Subscribe</v-btn>
        </v-card-actions>
      </div>
      <v-avatar class="ma-3" size="125" tile>
        <v-img :src="data.img"></v-img>
      </v-avatar>
    </div>
  </v-card>
</template>

<script>
export default {
  props: {
    data: Object,
  },
}
</script>

<style scoped>

</style>