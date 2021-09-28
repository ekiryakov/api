<template>
  <v-list class="pa-0" two-line>
    <v-list-item-group active-class="pink--text" multiple>
      <Offer v-for="offer in offers" :key="offer.id" :data="offer"></Offer>
    </v-list-item-group>
  </v-list>
</template>

<script>
import Offer from "./Offer";
export default {
  components: { Offer },
  props: {
    data: String
  },
  data: () => ({
    offers: [],
  }),
  mounted() {
    this.offers = JSON.parse(this.data);
  }
}
</script>

<style scoped>

</style>