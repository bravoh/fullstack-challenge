<template>
  <div v-if="user">
    <h2>{{ user.name }}</h2>
  </div>
</template>

<script>
export default {
  name: "ApiWeather",
  data: () => ({
    user: null,
    location: null
  }),
  computed: {
    userId() {
      return this.$route.params.id
    }
  },
  mounted() {
    this.getUser()
  },
  methods: {
    async getUser() {
      const url = `http://localhost:8000/user/${this.userId}`
      let response = await (
          await fetch(url)
      ).json();

      this.user = response.user
      this.location = response.location
    }
  }
}
</script>

<style scoped>

</style>