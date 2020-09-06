<template>
  <b-container fluid class="dashboard">

    <FriendsList />

    <ChatRoom />

  </b-container>
</template>

<script>
  import FriendsList from './FriendsList'
  import ChatRoom from './ChatRoom'
  import '../css/friends.css'

  export default {
    name: 'Friends',
    data() {
      return {
        edit: false,
        items: '',
        date: '',
        sports: []
      }
    },

    mounted() {

    },

    methods: {
      editProfile() {
        this.edit = !this.edit
      },
      editClose() {
        this.edit = !this.edit
      }
    },

    components: {
      FriendsList,
      ChatRoom
    },
  }

</script>
