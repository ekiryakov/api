<template>
  <tr>
    <td>{{ offer.id }}</td>
    <td>{{ offer.image }}</td>
    <td>{{ offer.title }}</td>
    <td>{{ offer.description }}</td>
    <td>{{ offer.cost }}</td>
    <td>
      <a :href="show">show</a>
      <a :href="edit">edit</a>
    </td>
  </tr>
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