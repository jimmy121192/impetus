<template>

    <b-row>
    <b-col cols lg="6" id="tabletennis-info">
     <p id="desc">Table tennis, also known asping-pong, is a sport in which two or four players hit a lightweight ball back and forth across a table using small rackets. The game takes place on a hard table divided by a net. Except for the initial serve, the rules are generally as follows: players must allow a ball played toward them to bounce one time on their side of the table and must return it so that it bounces on the opposite side at least once. A point is scored when a player fails to return the ball within the rules. Play is fast and demands quick reactions. Spinning the ball alters its trajectory and limits an opponent's options, giving the hitter a great advantage.</p>

        <b-button @click="findPlayers" size="lg" id="find-button" variant="outline-danger"><font-awesome-icon icon="share-alt" /> FIND PLAYERS</b-button><br>
         <img src="../../img/table-tennis.svg" height="300px"/>
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
#tabletennis-info{
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
  name: 'TableTennis',
  data(){
      return{
        show:false,
        players:[]
      }

    },
        mounted() {
        axios.get('https://impetus-php.herokuapp.com/getPlayers.php?sport=TableTennis', {withCredentials: true})
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