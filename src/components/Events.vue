<template>
  <b-container fluid class="dashboard">

    <b-carousel id="carousel-fade" style="padding:5px; border:0.5px solid #12355B" fade indicators img-width="1920"
      img-height="1080">
      <b-carousel-slide :img-src="require('../img/ad1.jpg')" />
      <b-carousel-slide :img-src="require('../img/ad2.jpg')" />
      <b-carousel-slide :img-src="require('../img/ad3.jpg')" />
    </b-carousel>

    <marquee behavior="scroll" direction="left" style="margin:2em 0">
      <h1>{{this.annoucement}}</h1>
    </marquee>
    <b-row class="event-container">

      <b-col cols lg="8">
        <label>
          <h1>🏆 UPCOMING EVENTS</h1>
        </label>
        <div v-bind:key="item.event_id" class="eventBox" v-for="item in items">
          <b-row>
            <b-col cols="2" class="d-flex flex-column align-items-center justify-content-around img-box">
              <img :src="require('../img/'+item.thumb)" class="event-thumb" />

            </b-col>
            <b-col cols="10" style="text-align:justify">
              <h2>
                <b-badge variant="success">{{item.sport}}</b-badge>
              </h2>
              <h1 style="color:#83091d">{{item.name}}</h1><br>
              <p>{{item.description}}</p>
              <b-modal centered :title="modalName" hide-footer v-model="modalShow">
                <h1>Are you going to the event?</h1>
                <b-button class="mt-3" variant="outline-danger" @click="hideModal">Cancel</b-button>&nbsp;&nbsp;
                <b-button class="mt-3" variant="outline-success" @click="accept">OK</b-button>
              </b-modal>
            </b-col>
          </b-row>
          <hr>

          <b-row class="d-flex align-items-center">
            <b-col cols="8" class="d-flex align-items-center justify-content-around flex-wrap">
              <div class="d-flex align-items-center">
                <span class="faIcons">
                  <font-awesome-icon icon="map-marked-alt" /></span><span class="location" style="text-align:left;width: 100px">{{item.location}}</span>
              </div>
              <div class="d-flex align-items-center">
                <span class="faIcons">
                  <font-awesome-icon icon="clock" /></span><span class="location" style="text-align:left;width: 100px">{{item.date}}
                  {{item.time}}</span>
              </div>
            </b-col>
            <b-col cols="4" class="d-flex align-items-center justify-content-around">
              <b-list-group-item @click="showModal(item.name, item.event_id)" :id="item.event_id" class="d-flex justify-content-between align-items-center join-buttons">JOIN
                <span>
                  <font-awesome-icon icon="paper-plane" /></span>
              </b-list-group-item>
            </b-col>

          </b-row>

        </div>
      </b-col>

      <b-col cols lg="4">

        <div class="rightPanel">
          <date-pick v-model="date" :hasInputElement="false"></date-pick>
        </div>

        <div class="leader-board">
          <label>
            <h1>
              <font-awesome-icon icon="medal" /> LEADER BOARD</h1>
          </label>
          <div v-for="(user,index) in leaderBoard" v-bind:key="index">
            <b-list-group-item class="d-flex justify-content-between align-items-center leaders">
              {{medal[index]}} {{user.firstname}} {{user.lastname}} <h1>
                <b-badge variant="success">{{user.sport}}</b-badge>&nbsp;&nbsp;<b-badge variant="info">{{user.score}}</b-badge>
              </h1>
            </b-list-group-item>
          </div>
        </div>

        <div class="leader-board">
          <label>
            <h1>
              <font-awesome-icon icon="medal" /> TEAM RANKINGS</h1>
          </label>
          <div v-for="(team,index) in teamLeaderBoard" v-bind:key="index">
            <b-list-group-item class="d-flex justify-content-between align-items-center leaders">
              {{medal[index]}} {{team.teamname}}<h1>
                <b-badge variant="success">{{team.sport}}</b-badge>&nbsp;&nbsp;<b-badge variant="info">{{team.team_score}}</b-badge>
              </h1>
            </b-list-group-item>
          </div>
        </div>

      </b-col>
    </b-row>
  </b-container>
</template>

<script>
  import '../css/events.css'
  import Vue from 'vue'
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  import DatePick from 'vue-date-pick'
  import 'vue-date-pick/dist/vueDatePick.css'

  Vue.use(VueAxios, axios)

  export default {
    name: 'Events',
    data() {
      return {
        modalShow: false,
        modalName: '',
        medal: ['🥇', '🥈', '🥉', '4️⃣', '5️⃣'],
        form: {
          event_id: '',
          email: '',
          userID: '',
        },
        items: [],
        date: "",
        isRegistered: [],
        leaderBoard: [],
        teamLeaderBoard: [],
        annoucement: '',
      }
    },

    async mounted() {
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      if (dd < 10) {
        dd = '0' + dd;
      }

      if (mm < 10) {
        mm = '0' + mm;
      }
      today = yyyy + '-' + mm + '-' + dd;
      this.date = today;

      var session = await JSON.parse(sessionStorage.getItem("userInfo"));
      this.form.userID = session.user_id
      this.form.email = session.email

        try {
        // fetch data from a url endpoint
        var response = await axios.get("http://impetus.localhost/src/php/showEvents.php",{
          withCredentials: true
        });

        } catch(error) {
            console.log("error", error);
            // appropriately handle the error
          }
      

        this.items = response.data[0];
        this.isRegistered = response.data[1];
        this.leaderBoard = response.data[2];
        this.annoucement = response.data[3][0]['text'];
        this.teamLeaderBoard = response.data[4];

        if(this.isRegistered){
          this.isRegistered.map((reg, index) => {
            this.registeredEvent(reg.event_id, reg.status)
            //console.log(reg.event_id, reg.status)
        })
        }
        
      // axios.get('http://impetus.localhost/src/php/showEvents.php', {
      //     withCredentials: true
      //   })
      //   .then((response) => {
      //     this.items = response.data[0];
      //     this.isRegistered = response.data[1];
      //     this.leaderBoard = response.data[2];
      //     this.annoucement = response.data[3][0]['text'];
      //     this.teamLeaderBoard = response.data[4];

      //     console.log(response.data)

      //   })
      //   .then(() => {
      //     this.isRegistered.map((reg, index) => {
      //       this.registeredEvent(reg.event_id, reg.status)
      //       // console.log(reg.event_id, reg.status)
      //     })
      //   })
      //   .catch(function (error) {
      //     console.log(error)
      //   });
    },

    methods: {
      editProfile() {
        this.edit = !this.edit
      },
      editClose() {
        this.edit = !this.edit
      },
      showModal(param1, param2) {
        this.modalName = param1
        this.form.event_id = param2
        this.modalShow = !this.modalShow
      },
      registeredEvent(id, status) {

        if (status === "Yes") {

          document.getElementById(id).innerHTML = 'GOING';
          document.getElementById(id).style.backgroundColor = "#e5174d";
          document.getElementById(id).style.pointerEvents = "none";
          document.getElementById(id).style.userSelect = "none";
        }
      },
      hideModal() {
        this.modalShow = !this.modalShow
      },
      accept() {
        axios.post('https://impetus-php.herokuapp.com/registerEvent.php', {
          register: this.form,
        }).then((resp) => {

          console.log(resp)
          document.getElementById(this.form.event_id).innerHTML = 'GOING';
          document.getElementById(this.form.event_id).style.backgroundColor = "#e5174d"
          document.getElementById(this.form.event_id).style.pointerEvents = "none";
          document.getElementById(this.form.event_id).style.userSelect = "none";

        })
        this.modalShow = !this.modalShow
      }

    },

    components: {
      DatePick
    },
  }

</script>
