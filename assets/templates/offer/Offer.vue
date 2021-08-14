<template>
  <v-list-item :key="offer.title">
    <v-list-item-content>
      <v-list-item-title v-text="offer.title"></v-list-item-title>
      <v-list-item-subtitle v-text="offer.cost" class="text--primary"></v-list-item-subtitle>
      <v-list-item-subtitle v-text="offer.description"></v-list-item-subtitle>
    </v-list-item-content>
    <v-list-item-action>
      <v-menu bottom left rounded="lg">
        <template v-slot:activator="{ on, attrs }">
          <v-btn icon v-bind="attrs" v-on="on">
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>
        <v-list rounded width="200">
          <v-list-item :href="show">
            <v-list-item-icon>
              <v-icon>mdi-eye</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>show</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :href="edit">
            <v-list-item-icon>
              <v-icon>mdi-pencil</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>edit</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-list-item-action>
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