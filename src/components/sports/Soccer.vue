<template>

    <b-row>
    <b-col cols lg="6" id="soccer-info">
     <p id="desc">Soccer is ateam sportplayed with a sphericalballbetween two teams of elevenplayers. It is played by 250 million players in over 200 countries and dependencies, making it the world's most popular sport. The game is played on a rectangular field called apitchwith agoalat each end. The object of the game is toscoreby moving the ball beyond the goal line into the opposing goal. Players are not allowed to touch the ball with hands or arms while it is in play, except for thegoalkeeperswithin thepenalty area. Other players mainly use their feet to strike or pass the ball but may also use any other part of their body except the hands and the arms.</p>

        <b-button @click="findPlayers" size="lg" id="find-button" variant="outline-danger"><font-awesome-icon icon="share-alt" /> FIND PLAYERS</b-button><br>
         <img src="../../img/soccer.svg" height="300px"/>
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
#soccer-info{
    padding: 2em
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
  name: 'Soccer',
  data(){
      return{
        show:false,
        players:[]
      }

    },
    mounted() {
    axios.get('https://impetus-php.herokuapp.com/getPlayers.php?sport=Soccer', {withCredentials: true})
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