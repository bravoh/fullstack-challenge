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
    Pinging the api...
  </div>

  <div v-if="apiResponse">
    The api responded with: <br />
    <code>
    {{ apiResponse }}
    </code>


        <div>
            <div class="user-list">
                
                <div class="user-item" v-for="user in apiResponse.users" v-bind:key="user.id">
                    <div class="user-name">
                        <h2>{{ user.name }}</h2>
                    </div>
                    <div class="user-data">
                       <!-- --->
                    </div>
                </div>
            </div>

            <div class="clear-button">
              User Details
            </div>
        </div>


      

  </div>

</template>