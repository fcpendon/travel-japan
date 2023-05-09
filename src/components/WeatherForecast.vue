<script>
import axios from 'axios'
const host = import.meta.env.VITE_APP_HOST

export default {
  data () {
    return {
      forecasts: [],
      today: null
    }
  },
  created () {
    this.getWeatherForecast()
  },
  watch: {
    city () {
      this.getWeatherForecast()
    }
  },
  methods: {
    getWeatherForecast () {
      this.forecasts = []
      axios.get(host + '/api/forecast', {
        params: {
          location: this.city
        }
      }).then(res => {
        if (res.data.length > 0) {
          this.forecasts = res.data
          this.today = this.forecasts.shift()
        }
      }).catch(err => {
        console.log(err)
      })
    }
  }
}
</script>

<script setup>
import Loading from './Loading.vue'

defineProps({
  city: {
    type: String,
    required: true
  }
})
</script>

<template>
  <div class="container">
    <h2>Weather Forecast</h2>
    <div v-if="forecasts.length > 0" class="forecast">
      <div class="today">
        <h3>As of {{ today.time }}</h3>
        <h3>Temperature: {{ today.temp }}°C</h3>
        <h3>Weather: {{ today.weather }} ({{ today.weather_desc }})</h3>
      </div>

      <div class="forecast-table">
        <table>
          <thead>
            <tr>
              <th>Time</th>
              <th>Temperature</th>
              <th>Weather</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="forecast in forecasts">
              <td>{{ forecast.time }}</td>
              <td>{{ forecast.temp }}°C</td>
              <td>{{ forecast.weather }} ({{ forecast.weather_desc }})</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div v-else class="message">
      <Loading />
    </div>
  </div>
</template>

<style scoped>
div.container {
  display: flex;
  flex-direction: column;
  gap: 30px;
}

div.forecast {
  display: flex;
  gap: 30px;
  justify-content: space-between;
}

div.message {
  display: flex;
  flex-direction: column;
  height: 200px;
  justify-content: center;
  text-align: center;
}

div.today {
  flex-direction: column;
  font-size: larger;
  text-align: left;
}

div.forecast-table {
  flex-grow: 1;
  max-height: 300px;
  overflow-y: auto;
}

table {
  border-collapse: collapse;
  width: 100%;
}

table th {
  background-color: cyan;
  position: sticky;
  top: 0;
  z-index: 999;
}

table tr {
  text-align: center;
}

table tr:nth-child(even) {
  background-color: lightcyan;
}

@media (max-width: 1000px) {
  div.forecast {
    flex-direction: column;
  }

  div.today {
    text-align: center;
  }
}
</style>