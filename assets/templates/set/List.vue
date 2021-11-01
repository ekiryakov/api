<template>
  <v-carousel v-model="model">
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
    model: 0,
  }),
  mounted() {
    this.sets = JSON.parse(this.data);
  }
}
</script>

<style scoped>

</style>