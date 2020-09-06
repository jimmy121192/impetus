<template>
  <div class="master">

    <div class="sidebar" id="sidebar">
      <b-list-group>
        <b-list-group-item :class="{selected:title== 'HOME'}" @click="changeTab('HOME')" class="d-flex justify-content-between align-items-center bars ">
          HOME
          <font-awesome-icon icon="home" />

        </b-list-group-item>
        <!-- <b-list-group-item :class="{selected:title== 'FEEDS'}" @click="changeTab('FEEDS')" class="d-flex justify-content-between align-items-center bars">
    FEEDS <font-awesome-icon icon="newspaper"/>
  </b-list-group-item> -->
        <b-list-group-item :class="{selected:title== 'CHALLENGE'}" @click="changeTab('CHALLENGE')" class="d-flex justify-content-between align-items-center bars">
          CHALLENGE
          <font-awesome-icon icon="trophy" />
        </b-list-group-item>
        <b-list-group-item :class="{selected:title== 'TEAMS'}" @click="changeTab('TEAMS')" class="d-flex justify-content-between align-items-center bars">
          TEAMS
          <font-awesome-icon icon="share-alt" />
        </b-list-group-item>
        <b-list-group-item :class="{selected:title== 'FRIENDS'}" @click="changeTab('FRIENDS')" class="d-flex justify-content-between align-items-center bars">
          FRIENDS
          <font-awesome-icon icon="users" />
          <!-- <b-badge variant="primary" pill>14</b-badge> -->
        </b-list-group-item>
        <b-list-group-item :class="{selected:title== 'PROFILE'}" @click="changeTab('PROFILE')" class="d-flex justify-content-between align-items-center bars">
          PROFILE
          <font-awesome-icon icon="cog" />
        </b-list-group-item>

        <b-list-group-item v-if="role==='Admin' || role==='Moderator'" @click="adminPanel()" class="d-flex justify-content-between align-items-center bars" style="width:100%;position: absolute; bottom:0">
          ADMIN PANEL
          <font-awesome-icon icon="code" />
        </b-list-group-item>
      </b-list-group>

    </div>
    <div class="corner">
      <img src="../img/logo.svg" width="130px">
    </div>

    <div class="topbar">
      <h1 id="title" style="margin-left:30px;color:#83091d">{{ title }}</h1>
      <font-awesome-icon icon="bars" class="menu" @click="toggleSideBar"/>
      <div class="profile">
        <b-row>
          <b-col>
            <b-button id="notification" variant="info"> <font-awesome-icon icon="bell" /></b-button>
            <b-popover
              target="notification"
              placement="bottomleft"
              title="Notifications"
              triggers="hover focus"
              :content="`You have `+ 0 + ` new notification`"
            />
          </b-col>
          <b-col>
            <b-button id="message" variant="info"> <font-awesome-icon icon="comment" /></b-button>
            <b-popover
              target="message"
              placement="bottomleft"
              title="Recent Messages"
              triggers="hover focus"
              :content="`Hello World`"
            />
          </b-col>
        </b-row>
        



        <div id="user">
          <img id="avatar" :src="avatar" />
          <b-dropdown :text="name" variant="default">
            <!-- <b-dropdown-item class="ddown"><font-awesome-icon icon="user" /> Profile</b-dropdown-item> -->
            <b-dropdown-item class="ddown">
              <font-awesome-icon icon="tasks" /> Tasks</b-dropdown-item>
            <b-dropdown-item class="ddown">
              <font-awesome-icon icon="calendar" /> Schedule</b-dropdown-item>
            <b-dropdown-divider></b-dropdown-divider>
            <b-dropdown-item class="ddown">
              <router-link to="/" style="color:#83091d; text-decoration:none">
                <font-awesome-icon icon="power-off" /> Log Out</router-link>
            </b-dropdown-item>
          </b-dropdown>
        </div>
      </div>


    </div>



    <Events v-if="this.$store.getters.tab==='HOME'" />
    <Challenge v-if="this.$store.getters.tab==='CHALLENGE'" />
    <Profile v-if="this.$store.getters.tab==='PROFILE'" />
    <Friends v-if="this.$store.getters.tab==='FRIENDS'" />
    <!-- <Feeds v-if="this.$store.getters.tab==='FEEDS'"/> -->
    <Teams v-if="this.$store.getters.tab==='TEAMS'" />



  </div>
</template>

<script>
  // @ is an alias to /src
  import '../css/master.css'
  import router from '../router'
  import store from '../store'
  import Profile from '@/components/Profile.vue'
  import Challenge from '@/components/Challenge.vue'
  import Events from '@/components/Events.vue'
  import Friends from '@/components/Friends.vue'
  import Feeds from '@/components/Feeds.vue'
  import Teams from '@/components/Teams.vue'

  export default {
    name: 'master',
    data() {
      return {
        showContent: 'HOME',
        title: 'HOME',
        role:'',
        name: '',
        avatar: 'place-holder-avatar.jpg',
      }
    },
    mounted() {
      var item = JSON.parse(sessionStorage.getItem("userInfo"));
      this.role = item.type;
      this.name = item.username;
      this.avatar = item.avatar;
      store.dispatch('changeTab', 'HOME');
      

    },
    methods: {
      changeTab(tabName) {
        store.dispatch('changeTab',tabName)   //for actions
        console.log(store.getters.tab)
        this.title = tabName;
      },
      toggleSideBar(){

        (document.getElementById("sidebar").style.left == "-200px") ? document.getElementById("sidebar").style.left = 0 :document.getElementById("sidebar").style.left = "-200px"
      },
      adminPanel() {
        router.push({
          name: "admin"
        });
      }
    },
    computed:{
      test(){
          return store.getters.tab
      }
  },
    components: {
      Challenge,
      Profile,
      Events,
      Friends,
      Feeds,
      Teams
    }
  }

</script>
