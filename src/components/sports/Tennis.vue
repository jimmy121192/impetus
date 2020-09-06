<template>

    <b-row>
    <b-col cols lg="6" id="tennis-info">
     <p id="desc">Tennisis aracket sportthat can be played individually against a single opponent (singles) or between two teams of two players each (doubles). Eachplayer uses atennis racketthat is strung with cord to strike a hollow rubberballcovered with felt over or around a net and into the opponent'scourt. The object of the game is to maneuver the ball in such a way that the opponent is not able to play a valid return. The player who is unable to return the ball will not gain a point, while the opposite player will.</p>

        <b-button @click="findPlayers" size="lg" id="find-button" variant="outline-danger"><font-awesome-icon icon="share-alt" /> FIND PLAYERS</b-button><br>
         <img src="../../img/tennis.svg" height="300px"/>
         </b-col>


         <b-col cols lg="6">
            <div style="padding:2em" v-if="show">
             <h1>RESULTS</h1>
                <div v-for="player in players" v-bind:key="player.user_id">
                    <b-list-group-item class="d-flex justify-content-between align-items-center players">
                    {{player.username}} <h1><b-badge variant="success">Accept</b-badge>&nbsp;&nbsp;<b-badge variant="danger">Ignore</b-badge></h1>
                    </b-list-group-item>
                </div>
        </div> 
        </b-col>
        </b-row>

</template>
<style>
#tennis-info{
    padding: 2em;

    
}
#desc{
    text-align: justify;
    margin-top: 50px;
    padding: 1em  
}
img{
    pointer-events: none;
    user-select: none;
}

#find-button{
    margin: 50px 0;
}
.players{
    margin: 20px 0;
}
h1{
    cursor: pointer;
}
</style>


<script>
import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
export default {
  name: 'Tennis',
  data(){
      return{
        show:false,
        players: []
      }

    },
    mounted() {
        axios.get('http://impetus.localhost/src/php/getPlayers.php?sport=Tennis', {withCredentials: true})
            .then((response)=>{
                this.players = response.data;

                console.log(this.players)
            }).catch(function(error){
            // Error handling
                console.log(error)
            });
        },
  methods:{
      findPlayers(){
          this.show =!this.show
      }
  },
  components: { }
}
</script>