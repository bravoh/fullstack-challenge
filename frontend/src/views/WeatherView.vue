<template>
  <main>
    <api-weather></api-weather>
  </main>
</template>

<script>
import ApiWeather from "@/components/ApiWeather.vue";

export default {
  name: "WeatherView",
  components: {ApiWeather},
}
</script>