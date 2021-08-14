<template>
  <v-list-item :key="offer.title">
    <template v-slot:default="{ active }">
      <v-list-item-content>
        <v-list-item-title v-text="offer.title"></v-list-item-title>
        <v-list-item-subtitle class="text--primary" v-text="offer.cost"></v-list-item-subtitle>
        <v-list-item-subtitle v-text="offer.description"></v-list-item-subtitle>
      </v-list-item-content>
      <v-list-item-action>
        <v-list-item-action-text>Action</v-list-item-action-text>
        <v-btn :href="show"></v-btn>
        <v-btn :href="edit"></v-btn>
      </v-list-item-action>
    </template>
  </v-list-item>
</template>

<script>
export default {
  props: {
    data: String,
    show: String,
    edit: String,
  },
  data: () => ({
    offer: {},
  }),
  mounted() {
    this.offer = JSON.parse(this.data);
  }
}
</script>

<style scoped>

</style>