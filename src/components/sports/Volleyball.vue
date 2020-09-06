<template>

  <b-row>
    <b-col cols lg="6" id="volleyball-info">
      <p id="desc">Volleyballis a popularteam sportin which two teams of six players are separated by a net. Each team tries to score points by grounding a ball on the other team's court under organized rules.The ball is usually played with the hands or arms, but players can legally strike or push (short contact) the ball with any part of the body.A point is scored when the ball contacts the floor within the court boundaries or when an error is made: when the ball strikes one team's side of the court, the other team gains a point; and when an error is made, the team that did not make the error is awarded a point, in either case paying no regard to whether they served the ball or not. If any part of theball hits the line, the ball is counted as in the court.
      </p>

      <b-button @click="findPlayers" size="lg" id="find-button" variant="outline-danger">
        <font-awesome-icon icon="share-alt" /> FIND PLAYERS</b-button><br>
      <img src="../../img/volleyball.svg" height="300px" />
    </b-col>


    <b-col cols lg="6">
      <div style="padding:2em" v-if="show">
        <h1>RESULTS</h1>

        <div v-for="player in players" v-bind:key="player.user_id">
          <b-list-group-item class="d-flex justify-content-between align-items-center players">
            {{player.username}} <h1>
              <b-badge variant="success">Accept</b-badge>&nbsp;&nbsp;<b-badge variant="danger">Ignore</b-badge>
            </h1>
          </b-list-group-item>
        </div>
      </div>
    </b-col>
  </b-row>

</template>
<style>
  #volleyball-info {
    padding: 2em;


  }

  #desc {
    text-align: justify;
    margin-top: 50px;
    padding: 1em 
  }

  img {
    pointer-events: none;
    user-select: none;
  }

  #find-button {
    margin: 50px 0;
  }

  .players {
    margin: 20px 0;
  }

  h1 {
    cursor: pointer;
  }

</style>


<script>
  import Vue from 'vue'
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  Vue.use(VueAxios, axios)
  export default {
    name: 'Volleyball',
    data() {
      return {
        show: false,
        players: []
      }

    },
    mounted() {
      axios.get('http://impetus.localhost/src/php/getPlayers.php?sport=Volleyball', {
          withCredentials: true
        })
        .then((response) => {
          this.players = response.data;

          console.log(this.players)
        }).catch(function (error) {
          // Error handling
          console.log(error)
        });
    },
    methods: {
      findPlayers() {
        this.show = !this.show
      }
    },
    components: {}
  }

</script>
