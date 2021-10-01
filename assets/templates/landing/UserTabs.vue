<template>
  <section>
    <v-tabs v-model="user" centered>
      <v-tab href="#customer">
        customer
      </v-tab>
      <v-tab href="#vendor">
        vendor
      </v-tab>
    </v-tabs>
    <v-tabs-items v-model="user">
      <v-tab-item value="customer">
        <p class="font-weight-light">
          customer content
        </p>
        <v-btn :href="customer_register" elevation="2" rounded x-large>Registration</v-btn>
      </v-tab-item>
      <v-tab-item value="vendor">
        <p class="font-weight-light">
          vendor content
        </p>
        <v-btn :href="vendor_register" elevation="2" rounded x-large>Registration</v-btn>
      </v-tab-item>
    </v-tabs-items>
  </section>
</template>

<script>
export default {
  props: {
    customer_register: String,
    vendor_register: String,
  },
  data () {
    return {
      user: 'customer',
    }
  },
}
</script>

<style scoped>

</style>