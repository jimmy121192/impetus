<template>
  <b-container fluid class="dashboard">

    <div class="title-container">
      <div>
        <b-button id="myteam" @click="changePage('MyTeam')" variant="info" class="title">
          <b-popover target="myteam" placement="bottomleft" title="My Team" triggers="hover" :content="`Your current team`" />
          <h3>
            <font-awesome-icon icon="shield-alt" />
          </h3>
        </b-button>
        <b-button id="findteam" @click="changePage('FindTeam')" variant="info" class="title">
          <b-popover target="findteam" placement="bottomleft" title="Find A Team" triggers="hover" :content="`Find and Join an exist team`" />
          <h3>
            <font-awesome-icon icon="binoculars" />
          </h3>
        </b-button>
        <b-button id="createteam" variant="info" class="title">
          <b-popover target="createteam" placement="bottomleft" title="Create A Team" triggers="hover" :content="`Coming Soon`" />
          <h3>
            <font-awesome-icon icon="chess" />
          </h3>
        </b-button>

        <hr>
      </div>
    </div>

    <FindTeam v-if="this.$store.getters.page==='FindTeam'" />
    <MyTeam v-if="this.$store.getters.page==='MyTeam'" />
    <TeamDetail v-if="this.$store.getters.page==='TeamDetail'" />

  </b-container>
</template>

<script>
  import '../css/Teams.css'
  import store from '../store'
  import FindTeam from './FindTeam'
  import MyTeam from './MyTeam'
  import TeamDetail from './TeamDetail'
  import Vue from 'vue'
  import axios from 'axios'
  import VueAxios from 'vue-axios'

  Vue.use(VueAxios, axios)

  export default {
    name: 'Teams',
    data() {
      return {

      }
    },

    mounted() {
      store.dispatch('changePage', 'MyTeam');
    },
    computed: {
      test() {
        return store.getters.page
      }
    },
    methods: {
      changePage(page) {
        store.dispatch('changePage', page) //for actions
        console.log(store.getters.page)
      },
    },

    components: {
      FindTeam,
      MyTeam,
      TeamDetail
    },
  }

</script>
