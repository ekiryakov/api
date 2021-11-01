<template>
  <v-slide-group active-class="success" show-arrows>
    <v-slide-item v-for="set in sets" :key="set.id" v-slot="{ active, toggle }">
      <Set :data="set"></Set>
    </v-slide-item>
  </v-slide-group>
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
  }),
  mounted() {
    this.sets = JSON.parse(this.data);
  }
}
</script>

<style scoped>

</style>