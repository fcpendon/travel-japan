<script>
import { cities } from './data/cities.js'

export default {
  data () {
    return {
      cities: [],
      city: null
    }
  },
  methods: {
    setCity(index) {
      this.city = cities[index]
    }
  }
}
</script>

<script setup>
import CitySelector from './components/CitySelector.vue'
import CityInfo from './components/CityInfo.vue'
import WeatherForecast from './components/WeatherForecast.vue'
import SearchLocation from './components/SearchLocation.vue'
</script>

<template>
  <main>
    <CitySelector :cities="cities" @set-city="setCity" />
    <template v-if="city">
      <CityInfo :city="city" />
      <WeatherForecast :city="city.name" />
      <SearchLocation :city="city.name" />
    </template>
  </main>
</template>

<style scoped>
main {
  display: flex;
  flex-direction: column;
  gap: 30px;
  width: 100%;
}
</style>