<template>
  <div>
    <h1 v-if="!hasTeam">YOU DON'T HAVE A TEAM</h1>
    <b-row v-if="hasTeam" class="mt-5">
      <b-col lg="6" class="d-flex flex-wrap flex-column align-items-center mb-5">

        <b-img :src="this.team.logo" fluid width="300px"></b-img>

        <div class="teamdetails-info">
          <b-list-group-item class="d-flex justify-content-between align-items-center user-stats">
            TEAM <span>
              <h1>
                <b-badge variant="info">{{this.team.teamname}}</b-badge>
              </h1>
            </span>
          </b-list-group-item>
          <b-list-group-item class="d-flex justify-content-between align-items-center user-stats">
            SPORT <span>
              <h1>
                <b-badge variant="info">{{this.team.sport}}</b-badge>
              </h1>
            </span>
          </b-list-group-item>
          <b-list-group-item class="d-flex justify-content-between align-items-center user-stats">
            <font-awesome-icon icon="medal" /><span>
              <h4>{{this.team.team_score}}</h4>

            </span>
          </b-list-group-item>
        </div>
        <p style="text-align: justify">
          {{this.team.intro}}
        </p>

      </b-col>
      <b-col lg="6">
        <h1 style="text-align:center;color:#83091d; margin-bottom: 1em">TEAM MEMBERS</h1>
        <b-table style="font-size:12pt;" striped hover :items="members" />

      </b-col>
    </b-row>

  </div>
</template>

<script>
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  import Vue from 'vue';
  Vue.use(VueAxios, axios);

  export default {
    name: 'MyTeam',
    data() {
      return {
        modalShow: false,
        team: [],
        members: [],
        hasTeam: ''
      }
    },
    mounted() {
      var item = JSON.parse(sessionStorage.getItem("userInfo"));
      this.hasTeam = item.teamname;
      axios.get('https://impetus-php.herokuapp.com/TeamDetail.php?name=' + item.teamname, {
          withCredentials: true
        })
        .then((response) => {
          this.team = response.data[0][0]
          this.members = response.data[1]

          // this.projects = response.data
        })

    },

    methods: {

    },

    components: {

    }
  }

</script>
