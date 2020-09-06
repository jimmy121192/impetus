<template>
  <div>

    <h1 class="title">
      FIND A TEAM
    </h1>

    <div class="filters">
      <span class="filter" v-bind:class="{ active: currentFilter === 'ALL' }" v-on:click="setFilter('ALL')">ALL</span>
      <span class="filter" v-bind:class="{ active: currentFilter === 'Badminton' }" v-on:click="setFilter('Badminton')">BADMINTON</span>
      <span class="filter" v-bind:class="{ active: currentFilter === 'Basketball' }" v-on:click="setFilter('Basketball')">BASKETBALL</span>
      <span class="filter" v-bind:class="{ active: currentFilter === 'Esport' }" v-on:click="setFilter('Esport')">ESPORT</span>
      <span class="filter" v-bind:class="{ active: currentFilter === 'Soccer' }" v-on:click="setFilter('Soccer')">SOCCER</span>
      <span class="filter" v-bind:class="{ active: currentFilter === 'TableTennis' }" v-on:click="setFilter('TableTennis')">TABLE
        TENNIS</span>
      <span class="filter" v-bind:class="{ active: currentFilter === 'Tennis' }" v-on:click="setFilter('Tennis')">TENNIS</span>
      <span class="filter" v-bind:class="{ active: currentFilter === 'Volleyball' }" v-on:click="setFilter('Volleyball')">VOLLEYBALL</span>

    </div>

    <transition-group class="projects" name="projects">
      <div class="project" v-if="currentFilter === project.sport || currentFilter === 'ALL'" v-bind:key="project.team_id"
        v-for="project in projects" @click="showTeam(project.teamname, project.team_id)">
        <div class="project-image-wrapper">
          <span class="project-title">{{project.teamname}}</span>
          <img class="project-image" v-bind:src="project.image">
          <div class="gradient-overlay"></div>
          <div class="circle">
            <img class="team-logos" v-bind:src="project.logo">

          </div>
        </div>
      </div>
    </transition-group>

  </div>
</template>

<script>
  import store from '../store'
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  import Vue from 'vue';
  Vue.use(VueAxios, axios);

  export default {
    name: 'FindTeam',
    data() {
      return {
        modalShow: false,
        currentFilter: 'ALL',
        projects: [],
        form: {

        },
      }
    },
    mounted() {
      axios.get('http://impetus.localhost/src/php/getTeams.php', {
          withCredentials: true
        })
        .then((response) => {
          console.log(response.data)
          this.projects = response.data
        })
    },
    computed: {
      test() {
        return store.getters.page, store.getters.teamID
      }
    },

    methods: {
      setFilter: function (filter) {
        this.currentFilter = filter;
      },
      showTeam(team, id) {
        store.dispatch('changePage', 'TeamDetail');
        store.dispatch('teamID', {
          'teamName': team,
          'teamID': id
        });
        console.log(store.getters.page, store.getters.teamID)

      },

    },

    components: {

    }
  }

</script>
