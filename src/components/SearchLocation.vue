<script>
import axios from 'axios'

const host = import.meta.env.VITE_APP_HOST

export default {
  data () {
    return {
      query: '',
      limit: 10,
      loading: false,
      results: null
    }
  },
  methods: {
    searchLocation () {
      this.results = []
      this.loading = true
      this.scrollToSearch()
      axios.get(host + '/api/search', {
        params: {
          query: this.query,
          near: this.city,
          limit: this.limit
        }
      }).then(res => {
        this.loading = false
        this.results = res.data
      }).catch(err => {
        console.log(err)
      }).finally(() => {
        this.scrollToSearch()
      })
    },
    scrollToSearch() {
      this.$el.scrollIntoView({ behavior: 'smooth' })
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
    <h2>Search Location</h2>
    <div class="search">
      <form @submit.prevent="searchLocation">
        <input type="text" v-model="query" placeholder="ex: restaurant, cafe, mall, gas station">
        <label>Results</label>
        <input type="number" v-model="limit" min="10" max="50" step="10">
        <input type="submit">
      </form>
    </div>

    <div class="results">
      <table v-if="results && results.length > 0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Categories</th>
            <th>Address</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="result in results">
            <td>{{ result.name }}</td>
            <td>{{ result.categories.join(", ") }}</td>
            <td>{{ result.address }}</td>
          </tr>
        </tbody>
      </table>
      <div v-else-if="loading" class="message">
        <Loading />
      </div>
      <div v-else-if="results && results.length === 0" class="message">
        <h3>No Results :(</h3>
      </div>
    </div>
  </div>
</template>

<style scoped>
div.container {
  display: flex;
  flex-direction: column;
  gap: 30px;
}

form {
  display: flex;
}

input {
  border: 1px solid black;
  border-radius: 5px;
  font-size: large;
  height: 40px;
  padding: 10px;
  transition: border 0.5s;
  width: 100%;
}

input:hover {
  border: 1px solid lightskyblue;
}

input[type=number] {
  width: 60px;
}

input[type=submit] {
  display: none;
}

label {
  align-self: center;
  margin: 0 10px;
}

div.results {
  max-height: 600px;
  overflow-y: auto;
}

table {
  border-collapse: collapse;
  width: 100%;
}

table th {
  background-color: cyan;
  z-index: 999;
}

table tr:nth-child(even) {
  background-color: lightcyan;
}

div.message {
  display: flex;
  flex-direction: column;
  height: 200px;
  justify-content: center;
  text-align: center;
}
</style>