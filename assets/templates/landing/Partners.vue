<template>
  <v-slide-group v-model="model" active-class="success" show-arrows>
    <v-slide-item v-for="n in 15" :key="n" v-slot="{ active, toggle }">
      <v-card height="200" width="200"></v-card>
    </v-slide-item>
  </v-slide-group>
</template>

<script>
export default {
  data: () => ({
    model: null,
  }),
}
</script>

<style scoped>

</style>