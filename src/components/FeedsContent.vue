<template>
  <div>
    <label>
      <h1>NEWEST TOPICS</h1>
    </label>

    <div v-bind:key="post.post_id" v-for="post in posts" class="feed-boxes">
      <b-row>
        <b-col cols="3" class="d-flex align-items-center justify-content-space-evenly flex-wrap">
          <div class="flex-column align-items-center justify-content-center num-blocks">
            <h2>2</h2>
            <h3>Answers</h3>
          </div>
          <div class="flex-column align-items-center justify-content-center num-blocks">
            <h2>5</h2>
            <h3>Likes</h3>
          </div>
        </b-col>
        <b-col cols="9" style="text-align:left">
          <h1 style="color:#83091d">{{post.title}}</h1><br>
          <h3>By {{post.poster}}<vue-moments-ago prefix=", posted" suffix="ago" :date="post.date +' '+ post.time"></vue-moments-ago>
          </h3>

          <hr>
          <h2>

            <b-badge class="badges" v-bind:key="index" variant="success" v-for="(tag,index) in JSON.parse(post.tags)">{{tag}}</b-badge>

          </h2>
        </b-col>
      </b-row>
    </div>

  </div>

</template>

<style>
  .badges {
    margin-right: 0.5em
  }

</style>

<script>
  import Vue from 'vue'
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  import VueMomentsAgo from 'vue-moments-ago'
  export default {
    name: 'FeedsContent',
    data() {
      return {
        posts: ''
      }

    },
    mounted() {
      axios.get('https://impetus-php.herokuapp.com/getPosts.php', {
          withCredentials: true
        })
        .then((response) => {
          this.posts = response.data;
          console.log(this.posts);
        }).catch(function (error) {

          console.log(error)
        });
    },
    methods: {},
    components: {
      VueMomentsAgo
    }
  }

</script>
