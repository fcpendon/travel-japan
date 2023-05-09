<script>
export default {
  methods: {
    cityChanged(e) {
      return this.$emit('setCity', e.target.value)
    }
  }
}
</script>

<script setup>
defineProps({
  cities: {
    type: Array,
    required: true
  }
})

defineEmits(['setCity'])
</script>

<template>
  <div class="container">
    <h1>I want to travel to</h1>

    <select @change="cityChanged" aria-label="city">
      <option selected disabled></option>
      <option v-for="(city, index) in cities" :value="index">{{ city.name }}</option>
    </select>
  </div>
</template>

<style scoped>
div.container {
  align-items: center;
  background: none;
  display: flex;
  justify-content: center;
}

h1 {
  font-size: 3rem;
  top: -3px;
}

select {
  border: 1px solid white;
  border-radius: 10px;
  font-size: 3rem;
  height: 80px;
  margin-left: 6px;
  padding: 5px;
  transition: border 0.5s;
}

select:hover {
  border: 1px solid lightskyblue;
}

@media (max-width: 750px) {
  h1, select {
    font-size: 2rem;
  }
}
</style>