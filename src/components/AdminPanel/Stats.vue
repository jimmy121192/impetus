<template>
  <b-container fluid class="dashboard">

    <b-row class="d-flex justify-content-around align-items-center flex-wrap">

      <div class="hightlight hl1 d-flex flex-column justify-content-center align-items-center">
        <div>
          <h1>{{this.totalUsers}}</h1>
        </div>
        <div>
          <h2>Total users</h2>
        </div>
      </div>

      <div class="hightlight hl2 d-flex flex-column justify-content-center align-items-center">
        <div>
          <h1>{{this.newUsers}}</h1>
        </div>
        <div>
          <h2>New users</h2>
        </div>
      </div>

      <div class="hightlight hl3 d-flex flex-column justify-content-center align-items-center">
        <div>
          <h1>100</h1>
        </div>
        <div>
          <h2>Total Post</h2>
        </div>
      </div>

      <div class="hightlight hl4 d-flex  flex-column justify-content-center align-items-center">
        <div>
          <h1>2</h1>
        </div>
        <div>
          <h2>Currently Online</h2>
        </div>
      </div>

    </b-row>

    <b-row style="margin: 4em 0">
      <b-col cols lg="6" class="chart-info">
        <b-col>
          <h1>Event Stats</h1>
        </b-col>
        <b-col>
          <EventStats />
        </b-col>
      </b-col>

      <b-col cols lg="6" class="chart-info ">
        <b-col>
          <h1>Users per Sport Statistics</h1>
        </b-col>
        <b-col>
          <UsersSport />
        </b-col>
      </b-col>

    </b-row>

    <!-- FAST ACTIONS -->
    <b-row>
      <b-col cols lg="6" class="block-info">
        <b-col>
          <h1>New Requests</h1>
        </b-col>
        <b-row align-v="center">
          <b-list-group-item style="width: 100%;" class="d-flex justify-content-between align-items-center leaders">
            John requested to create a group <h1>
              <b-button variant="success">Accept</b-button>&nbsp;&nbsp;<b-button variant="warning">Decline</b-button>
            </h1>
          </b-list-group-item>
          <b-list-group-item style="width: 100%;" class="d-flex justify-content-between align-items-center leaders">
            John want to have a girlfriend <h1>&nbsp;&nbsp;<b-button variant="warning">Decline</b-button>
            </h1>
          </b-list-group-item>
          <b-list-group-item style="width: 100%;" class="d-flex justify-content-between align-items-center leaders">
            Ramin requested to create a group <h1>
              <b-button variant="success">Accept</b-button>&nbsp;&nbsp;<b-button variant="warning">Decline</b-button>
            </h1>
          </b-list-group-item>
        </b-row>
      </b-col>

      <b-col cols lg="6" class="block-info" style="text-align: left">
        <b-col>
          <h1>Fast Action</h1>
        </b-col>

        <b-input-group prepend="#ID" class="mt-3">
          <b-form-input v-model.lazy="delUser_id" placeholder="Delete a user" />
          <b-input-group-append>

            <b-button variant="danger" @click="delUser()">Delete</b-button>
          </b-input-group-append>
        </b-input-group>

        <b-input-group prepend="#ID" class="mt-3">

          <b-form-input v-model.lazy="delEvent_id" placeholder="Delete an event" />
          <b-input-group-append>

            <b-button variant="danger" @click="delEvent()">Delete</b-button>
          </b-input-group-append>
        </b-input-group>

        <b-form-group class="mt-3">
          <b-form-textarea v-model.lazy="announcement" placeholder="New Announcement" :rows="4" :max-rows="10" required>
          </b-form-textarea>
        </b-form-group>
        <b-button variant="info" @click="newAnnouncement()">Send</b-button>

      </b-col>

    </b-row>

    <hr>

    <b-modal centered title="Impetus" :ok-only="true" v-model="modalShow">
      <h1>Fast Action done successfully!</h1>
    </b-modal>

  </b-container>
</template>

<script>
  import '../../css/stats.css'
  import VueCharts from 'vue-chartjs'
  import EventStats from '@/components/AdminPanel/StatCharts/EventStats.vue'
  import UsersSport from '@/components/AdminPanel/StatCharts/UsersSport.vue'
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  import Vue from 'vue';
  Vue.use(VueAxios, axios);

  export default {
    name: 'Stats',
    data() {
      return {
        totalUsers: 200,
        newUsers: 15,
        totalPosts: 1346,
        currOnline: 4,
        delUser_id: '',
        delEvent_id: '',
        announcement: "",
        modalShow: false
      }
    },

    components: {
      EventStats,
      UsersSport
    },

    methods: {
      delUser() {
        axios.get('http://impetus.localhost/src/php/delUser.php?id=' + this.delUser_id, {
          withCredentials: true
        }).then((response) => {
          this.modalShow = !this.modalShow
        })
      },
      delEvent() {
        axios.get('http://impetus.localhost/src/php/delEvent.php?id=' + this.delEvent_id, {
          withCredentials: true
        }).then((response) => {
          this.modalShow = !this.modalShow
        })
      },
      newAnnouncement() {

        // console.log(this.announcement)

        axios.post('http://impetus.localhost/src/php/newAnnouncement.php', {
          body: this.announcement,
        }).then((resp) => {
          console.log(resp)
          alert("New Announcement Created Successfully!")

        })

      },
    }

  }

</script>
