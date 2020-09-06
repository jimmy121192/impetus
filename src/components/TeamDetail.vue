<template>
  <div>

    <b-row class="mt-5">
      <b-col lg="6" class="d-flex flex-wrap flex-column align-items-center">

        <b-img :src="this.team.logo" fluid width="300px"></b-img>

        <div class="teamdetails-info">
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
      </b-col>
      <b-col lg="6">
        <b-jumbotron>
          <template slot="header">{{this.team.teamname}}</template>

          <hr class="my-4" />

          <p>
            {{this.team.intro}}
          </p>

          <b-button class="mt-4" variant="success" @click="joinRequest()">JOIN TEAM</b-button>
        </b-jumbotron>
        <b-modal centered title="Impetus" :ok-only="true" v-model="modalShow">
          <h1>Your request to join {{this.team.teamname}} has been sent!</h1>
        </b-modal>
      </b-col>
    </b-row>

  </div>
</template>
<style>
  .teamdetails-info {
    width: 300px;
    margin-top: 3em;
    font-size: 14pt;

  }

  .jumbotron {
    background-color: #FAFAFA;
    text-align: justify
  }

</style>

<script>
  import store from '../store'
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  import Vue from 'vue';
  Vue.use(VueAxios, axios);

  export default {
    name: 'TeamDetail',
    data() {
      return {
        modalShow: false,
        team: '', // get clicked team info
        form: {
          user_id: '',
          username: '',
          team_id: '',
          teamname: '',
          score: '',
          rank: '',
        },
        userteam: '' //check if user already has a team
      }
    },
    computed: {
      test() {
        return store.getters.page, store.getters.teamID
      }
    },
    mounted() {

      axios.get('http://impetus.localhost/src/php/TeamDetail.php?name=' + this.$store.getters.teamID.teamName, {
          withCredentials: true
        })
        .then((response) => {
          this.team = response.data[0][0];
        })

      var item = JSON.parse(sessionStorage.getItem("userInfo"));
      this.form.user_id = item.user_id;
      this.form.username = item.username;
      this.form.score = item.score;
      this.form.rank = item.rank;
      this.userteam = item.teamname;

    },
    methods: {

      joinRequest() {
        if (this.userteam) {
          alert("You already have a team!");
          return false;
        }

        this.form.team_id = this.team.team_id;
        this.form.teamname = this.team.teamname;
        axios.post('http://impetus.localhost/src/php/joinRequest.php', {
            newResq: this.form,
          })
          .then((response) => {
            console.log(response.data)
            if (response.data === true) {
              this.modalShow = !this.modalShow;
            } else if (response.data === false) {
              alert("You already sent a request. Please wait!!!")
            }

          })
      }

    },

    components: {

    }
  }

</script>
