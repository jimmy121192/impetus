<template>
  <div class="login">
    <particlesJS />
    <div id="impetus">
      <img src="../img/logo.svg" style="pointer-events: none;user-select: none;">
    </div>
    <Login />
  </div>
</template>

<script>
  import '../css/style.css'
  import '../css/index.css'

  import Vue from 'vue'
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  import particlesJS from './ParticlesJS'
  import Login from './Login'
  import Register from './Register'

  Vue.use(VueAxios, axios)

  export default {
    name: 'Index',
    data() {
      return {
        register: false,
      }

    },
    methods: {
      signup: function () {
        this.register = true;
      }
    },
    components: {
      particlesJS,
      Login,
      Register
    }
  }

</script>
