
<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
    <b-container>
    <div>
      <b-navbar toggleable="lg" type="dark" variant="info">
        <b-navbar-brand href="#">Weather App</b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-item href="/">Home</b-nav-item>
          </b-navbar-nav>
        </b-collapse>
      </b-navbar>
    </div>

    <div>
        <br/>
        <RouterView />      
    </div>
    </b-container>

</template>

<style scoped>

</style>
