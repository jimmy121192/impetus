<template>
  <b-container class="Lists-container">

    <b-row class="d-flex justify-content-center">

      <div class="friendBox" v-for="item in items" v-bind:key="item.user_id">

        <b-col class="align-items-center">
          <b-row class="small-box">
            <img :src="item.avatar" class="avatars" />
          </b-row>

          <b-row class="big-box">

            <b-col cols="4" class="d-flex justify-content-center align-items-center">

              <img :src="item.avatar" class="avatars" />

            </b-col>
            <b-col cols="8" class="d-flex flex-column">
              <b-col>
                <h2>{{item.firstname}} {{item.lastname}}</h2>
              </b-col>
              <b-col>
                <span class="numPeople">
                  <font-awesome-icon icon="medal" /></span>&nbsp;&nbsp;<b-badge variant="info">{{item.rank}}</b-badge>
              </b-col>
            </b-col>

          </b-row>
        </b-col>

      </div>
    </b-row>
  </b-container>
</template>

<script>
  import '../css/friendslist.css'
  import Vue from 'vue'
  import axios from 'axios'
  import VueAxios from 'vue-axios'

  Vue.use(VueAxios, axios)

  export default {
    name: 'FriendsList',
    data() {
      return {
        edit: false,
        items: '',
        date: '',
        sports: []
      }
    },

    mounted() {
      axios.get('https://impetus-php.herokuapp.com/newUsers.php', {
          withCredentials: true
        })
        .then((response) => {
          this.items = response.data;

          // console.log(response.data);
          for (var i = 0; i < response.data.length; i++) {
            // console.log(this.items[i].sports)
            this.items[i].sports = JSON.parse(response.data[i].sports)
          }
          // console.log(this.items)
        }).catch(function (error) {
          // Error handling
          console.log(error)
        });
    },

    methods: {
      editProfile() {
        this.edit = !this.edit
      },
      editClose() {
        this.edit = !this.edit
      }
    },

    components: {},
  }

</script>
