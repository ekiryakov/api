<template>
  <section>
    <v-tabs v-model="user" centered slider-color="yellow">
      <v-tab :href="`customer`">
        customer
      </v-tab>
      <v-tab :href="`vendor`">
        vendor
      </v-tab>
    </v-tabs>
    <v-tabs-items v-model="user">
      <v-tab-item :value="`customer`">
        customer content
      </v-tab-item>
      <v-tab-item :value="`vendor`">
        vendor content
      </v-tab-item>
    </v-tabs-items>
  </section>
</template>

<script>
export default {
  data () {
    return {
      user: 'customer',
    }
  },
}
</script>

<style scoped>

</style>