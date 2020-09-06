<template>
  <b-container fluid class="dashboard">

    <b-row>
      <b-col cols lg="6" style="padding: 2em">

        <b-row class="d-flex justify-content-between flex-wrap">
          <b-col cols lg="6">
            <div id="info-box">
              <b-img thumbnail id="user-avatar" :src="avatarUrl" />&nbsp;&nbsp;
            </div>
            <h1 style="margin:20px; text-align:left; text-transform: uppercase;">{{user.firstname}} {{user.lastname}}
              (#ID: {{user.user_id}})</h1>
          </b-col>
          <b-col cols lg="6">
            <b-list-group-item class="d-flex justify-content-between align-items-center user-stats">
              CLASS <span>
                <h1>
                  <b-badge variant="info">{{user.type}}</b-badge>
                </h1>
              </span>
            </b-list-group-item>
            <b-list-group-item class="d-flex justify-content-between align-items-center user-stats">
              <font-awesome-icon icon="medal" /><span>
                <h4>{{user.rank}}</h4>
              </span>
            </b-list-group-item>
            <b-list-group-item class="d-flex justify-content-between align-items-center user-stats">
              TEAM <span>
                <h4>{{user.team}}</h4>
              </span>
            </b-list-group-item>

            <b-list-group-item v-if="user.team" class="d-flex justify-content-between align-items-center user-stats">
              TEAM ROLE <span>
                <h4>{{role}}</h4>
              </span>
            </b-list-group-item>

            <b-list-group-item class="d-flex justify-content-between align-items-center user-stats">
              SCORE <span>
                <h4>{{user.score}}</h4>
              </span>
            </b-list-group-item>
          </b-col>
        </b-row>
        <hr style="margin-bottom:20px">

        <div class="form-group form-group-default" style="text-align:left">
          <b-row>
            <b-col cols lg="6">
              <label>
                <font-awesome-icon icon="at" /> Email</label>
              <input name="email" type="text" class="form-control form-inputs" readonly v-model="user.email" />
            </b-col>
            <b-col cols lg="6">
              <label>
                <font-awesome-icon icon="calendar-alt" /> Date of Birth</label>
              <input name="email" type="text" class="form-control form-inputs" readonly v-model="user.birthday" />
            </b-col>
          </b-row>
          <label>
            <font-awesome-icon icon="football-ball" /> Sports</label>
        </div>

        <div class="sport-items">
          <h1>
            <b-badge v-for="(sport,index) in sports" v-bind:key="index" variant="success">{{sport}}</b-badge>
          </h1>
        </div>

        <hr style="margin-bottom:20px">
        <b-card header="About me" class="text-left">
          <p class="card-text">{{user.description}}</p>
        </b-card>
        <hr style="margin: 20px 0">
        <div class="buttons-bar">
          <b-button @click="editProfile()" variant="info" v-if="!edit">
            <font-awesome-icon icon="edit" /> Edit</b-button>
        </div>
        <b-modal centered hide-footer title="Impetus" v-model="modalShow">

          <form>

            <div class="form-group form-group-default" style="text-align:left">

              <div class="d-flex flex-column align-items-center justify-content-between">
                <h2 style="margin-top:10px;color:#83091d">Avatar</h2>

                <b-form-input v-model.lazy="avatarUrl" type="text" placeholder="Paste Your Avatar Url Here" />

                <h2 style="margin-top:20px;color:#83091d">Your Favourite Sports</h2>

                <div>
                  <b-form-checkbox name="sports" v-model.lazy="sports" value="Badminton"> Badminton</b-form-checkbox>
                  <b-form-checkbox name="sports" v-model.lazy="sports" value="Basketball"> Basketball</b-form-checkbox>
                  <b-form-checkbox name="sports" v-model.lazy="sports" value="Esport"> Esport</b-form-checkbox>
                  <b-form-checkbox name="sports" v-model.lazy="sports" value="Soccer"> Soccer</b-form-checkbox>
                  <b-form-checkbox name="sports" v-model.lazy="sports" value="TableTennis"> Table Tennis
                  </b-form-checkbox>
                  <b-form-checkbox name="sports" v-model.lazy="sports" value="Tennis"> Tennis</b-form-checkbox>
                  <b-form-checkbox name="sports" v-model.lazy="sports" value="Volleyball"> Volleyball</b-form-checkbox>
                </div>
                <h2 style="margin-top:20px;color:#83091d">About You</h2>
                <b-form-textarea id="post-body" v-model.lazy="body" :rows="5" :max-rows="10">
                </b-form-textarea>

              </div>
            </div>
          </form>

          <b-button class="mt-3" variant="outline-danger" @click="editProfile">Cancel</b-button>&nbsp;&nbsp;
          <b-button class="mt-3" variant="outline-success" @click="accept">OK</b-button>

        </b-modal>
        <b-modal centered title="Impetus" v-model="modalShow2">
          <h1>Unregistered successfully!!!</h1>
        </b-modal>
      </b-col>

      <b-col cols lg="6" style="padding: 2em">
        <b-col>
          <h1>REGISTERED EVENTS</h1>
        </b-col>

        <b-row align-v="center" v-for="(event,index) in events" :key="index">

          <b-list-group-item v-b-toggle.index style="width: 100%; font-weight:bold; color:#83091d;"
            class="d-flex justify-content-between align-items-center leaders">
            {{event.name}} <h1>&nbsp;&nbsp;<b-button variant="warning" @click="decline(event.event_id)">Decline
              </b-button>
            </h1>
          </b-list-group-item>
        </b-row>

        <div class="mt-5" v-if="this.role ==='Captain'">
          <b-col>
            <h1>NEW JOIN REQUESTS</h1>
          </b-col>

          <b-row align-v="center" v-for="(request,index) in requests" :key="index">

            <b-list-group-item v-b-toggle.index style="width: 100%; font-weight:bold; color:#83091d;"
              class="d-flex justify-content-between align-items-center leaders">
              {{request.username}} <span style="color:#12355B;">requested to join</span> {{request.teamname}}<h1>
                <b-button variant="success"
                  @click="handleReq(request.user_id, request.username, request.teamname, request.rank,request.score )">
                  Accept</b-button>&nbsp;&nbsp;<b-button variant="warning"
                  @click="handleReq(request.user_id, request.username, null, request.rank,request.score)">Decline
                </b-button>
              </h1>
            </b-list-group-item>
          </b-row>
        </div>

        <!-- <div class="mt-5">
        <b-col>
          <h1>NEW FRIEND REQUESTS</h1>
        </b-col>

        <b-row align-v="center" v-for="(request,index) in requests" :key="index">

          <b-list-group-item  v-b-toggle.index style="width: 100%; font-weight:bold; color:#83091d;" class="d-flex justify-content-between align-items-center leaders">
            {{request.username}} <span style="color:#12355B;">sent you a friend request</span> <h1><b-button variant="success" @click="handleReq(request.user_id, request.username, request.teamname, request.rank,request.score )">Accept</b-button>&nbsp;&nbsp;<b-button variant="warning" @click="handleReq(request.user_id, request.username, null, request.rank,request.score)">Decline</b-button>
            </h1>
          </b-list-group-item>
        </b-row>
        </div> -->

      </b-col>

    </b-row>
  </b-container>

</template>

<script>
  import '../css/profile.css'
  import store from '../store'
  import Vue from 'vue'
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  Vue.use(VueAxios, axios)

  export default {
    name: 'Profile',
    data() {
      return {
        modalShow: false,
        modalShow2: false,
        edit: false,
        user: "",
        userAvatar: "place-holder-avatar.jpg",
        sports: [],
        events: [],
        role: '',
        requests: [],
        body: '',
        avatarUrl: ''
      }

    },
    mounted() {
      this.fetchData()
    },
    methods: {
      editProfile() {
        this.modalShow = !this.modalShow

      },
      fetchData() {
        axios.get('http://impetus.localhost/src/php/ajaxProfile.php', {
            withCredentials: true
          })
          .then((response) => {
            this.user = response.data[0];
            this.avatarUrl = response.data[0].avatar;
            this.sports = JSON.parse(response.data[0].sports)
            this.events = response.data[1]
            this.role = response.data[2].role
            this.requests = response.data[3]
          })
      },

      decline(param) {

        axios.get('http://impetus.localhost/src/php/declineEvent.php?event_id=' + param, {
          withCredentials: true
        }).then((resp) => {
          console.log(resp)
          this.modalShow2 = !this.modalShow2
          this.fetchData()
        })

      },
      handleReq(id, user, team, player_rank, player_score) {
        axios.post('http://impetus.localhost/src/php/handleRequest.php', {
          user_id: id,
          username: user,
          teamname: team,
          rank: player_rank,
          score: player_score

        }).then((resp) => {
          this.fetchData()
        })

      },
      accept() {
        axios.post('http://impetus.localhost/src/php/editProfile.php', {
          sports: JSON.stringify(this.sports),
          description: this.body,
          avatar: this.avatarUrl,
          username: user.firstname + ' ' + user.lastname
        }, {
          withCredentials: true
        }).then((resp) => {
          this.modalShow = !this.modalShow
          this.fetchData()
        })

      }
    },
    components: {}
  }

</script>
