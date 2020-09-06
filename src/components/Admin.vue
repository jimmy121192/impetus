<template>
  <div>
    <div class="sidebar">
      <b-list-group>
        <b-list-group-item :class="{selected:title== 'Stats'}" @click="changeContent('Stats')" class="d-flex justify-content-between align-items-center bars">
          Dashboard
          <font-awesome-icon icon="chart-pie" />
        </b-list-group-item>
        <b-list-group-item :class="{selected:title== 'NewEvent'}" @click="changeContent('NewEvent')" class="d-flex justify-content-between align-items-center bars">
          Event Management
          <font-awesome-icon icon="podcast" />
        </b-list-group-item>

        <b-list-group-item v-if="role==='Admin'" :class="{selected:title== 'EditMod'}" @click="changeContent('EditMod')" class="d-flex justify-content-between align-items-center bars">
          Edit Moderators
          <font-awesome-icon icon="users" />

        </b-list-group-item>
        <b-list-group-item @click="goHome()" class="d-flex justify-content-between align-items-center bars" style="width:100%;position: absolute; bottom:0">
          GO HOME
          <font-awesome-icon icon="home" />
        </b-list-group-item>
      </b-list-group>

    </div>
    <div class="corner">
      <img src="../img/logo.svg" width="130px">
    </div>

    <div class="topbar">
      <h1 id="title" style="margin-left:30px;color:#83091d">{{this.title}}</h1>

      <div id="profile">

        <div id="user">
          <img id="avatar" :src="avatar" />
          <b-dropdown :text="name" variant="default">
            <b-dropdown-item class="ddown">
              <font-awesome-icon icon="user" /> Profile</b-dropdown-item>
            <b-dropdown-item class="ddown">
              <font-awesome-icon icon="tasks" /> Tasks</b-dropdown-item>
            <b-dropdown-item class="ddown">
              <font-awesome-icon icon="calendar" /> Schedule</b-dropdown-item>
            <b-dropdown-divider></b-dropdown-divider>
            <b-dropdown-item class="ddown">
              <router-link to="/" style="color:red; text-decoration:none">
                <font-awesome-icon icon="power-off" /> Log Out</router-link>
            </b-dropdown-item>
          </b-dropdown>
        </div>
      </div>


    </div>
    <NewEvent v-if="showContent==='NewEvent'" />
    <Stats v-if="showContent==='Stats'" />
    <EditMod v-if="showContent==='EditMod'" />

  </div>



</template>

<script>
  import '../css/admin.css'
  import router from '../router'
  import NewEvent from "./NewEvent"
  import Stats from './AdminPanel/Stats'
  import EditMod from './EditMod'
  import Vue from 'vue'
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  Vue.use(VueAxios, axios)

  export default {
    name: 'Admin',
    data() {
      return {
        showContent: 'Stats',
        title:'Stats',
        role:'',
        name: '',
        avatar: 'place-holder-avatar.jpg',
      }

    },
    mounted(){
      var item = JSON.parse(sessionStorage.getItem("userInfo"));
      this.role = item.type;
      this.name = item.username;
      this.avatar = item.avatar;

      axios.get('http://impetus.localhost/src/php/getStats.php',{
          withCredentials: true
        }).then((resp) => {
          console.log(resp)
       
        })

    },
    methods: {
      changeContent(params) {
        this.showContent = params
        this.title = params
      },
      goHome() {
        router.push({
          name: "master"
        });
      }
    },
    components: {
      NewEvent,
      Stats,
      EditMod
    }
  }

</script>
