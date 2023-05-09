<script setup>
defineProps({
  city: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <div class="container">
    <img :src="`./images/` + this.city.name + `.jpg`" alt="city image" />
    <h3>{{ city.description }}</h3>
  </div>
</template>

<style scoped>
img {
  width: 100%;
}
</style>