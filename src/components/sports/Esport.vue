<template>

    <b-row>
    <b-col cols lg="6" id="esport-info">
     <p id="desc">Esports(also known aselectronic sports,e-sports, oreSports) is a form ofcompetition usingvideo games. Most commonly, esports takes the form of organized,multiplayer video gamecompetitions, particularly betweenprofessionalplayers, individually or as teams. Although organized online and offline competitions have long been a part ofvideo game culture, these were largely between amateurs until the late 2000s, when participation by professional gamers and spectatorship in these events throughlive streamingsaw a large surge in popularity. By the 2010s, esports was a significant factor in the video game industry, with many game developers actively designing toward a professional esports subculture.</p>

        <b-button @click="findPlayers" size="lg" id="find-button" variant="outline-danger"><font-awesome-icon icon="share-alt" /> FIND PLAYERS</b-button><br>
         <img src="../../img/esport.svg" height="300px"/>
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
#esport-info{
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
  name: 'Esport',
  data(){
      return{
        show:false,
        players: []
      }

    },
    mounted() {
    axios.get('https://impetus-php.herokuapp.com/getPlayers.php?sport=Esport', {withCredentials: true})
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