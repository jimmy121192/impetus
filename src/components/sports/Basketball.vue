<template>

    <b-row>
    <b-col cols lg="6" id="basketball-info">
     <p id="desc">Basketballis ateam sportin which two teams, most commonly of five playerseach, opposing one another on a rectangularcourt, compete with the primary objective ofshootingabasketballthrough the defender's hoop while preventing the opposing team from shooting through their own hoop. Afield goalis worth two points, unless made from behind thethree-point line, when itis worth three. After a foul, timed play stops and the player fouled or designated to shoot a technical foul is given one or more one-pointfree throws. The team with the most points at the end of the game wins, but if regulation play expires with the score tied, an additional period of play (overtime) is mandated.</p>

        <b-button @click="findPlayers" size="lg" id="find-button" variant="outline-danger"><font-awesome-icon icon="share-alt" /> FIND PLAYERS</b-button><br>
         <img src="../../img/basketball.svg" height="300px"/>
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
#basketball-info{
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
  name: 'Basketball',
  data(){
      return{
        show:false,
        players: []
      }

    },
    mounted() {
        axios.get('http://impetus.localhost/src/php/getPlayers.php?sport=Basketball', {withCredentials: true})
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