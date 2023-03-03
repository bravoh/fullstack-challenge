<script>
export default {
  data: () => ({
    apiResponse: null
  }),
  created() {
    this.fetchData()
  },

  methods: {
    async fetchData() {
      const url = 'http://localhost:8000/'
      this.apiResponse = await (
          await fetch(url)
      ).json();

      //console.log(apiResponse)
    }
  }
}
</script>

<template>
  <div v-if="!apiResponse">
    Pinging the api.
  </div>
  <div v-if="apiResponse">
    <div>
        <b-list-group v-for="user in apiResponse.users" v-bind:key="user.id">
            <b-list-group-item :to="`/user/${user.id}`">
                {{ user.name }}

                 <div class="h2 mb-0">
            <b-icon icon="exclamation-circle-fill" variant="success"></b-icon>
            <b-icon icon="exclamation-circle-fill" variant="warning"></b-icon>
            <b-icon icon="exclamation-circle-fill" variant="danger"></b-icon>
            <b-icon icon="exclamation-circle-fill" variant="info"></b-icon>
            <b-icon icon="exclamation-circle-fill" variant="primary"></b-icon>
            <b-icon icon="exclamation-circle-fill" variant="secondary"></b-icon>
            <b-icon icon="exclamation-circle-fill" variant="dark"></b-icon>
          </div>
            </b-list-group-item>
        </b-list-group>
    </div>
  </div>
</template>