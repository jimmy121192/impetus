<template>

      <b-row>
    <b-col cols lg="6" id="badminton-info">
     <p id="desc"> 
        Badmintonis aracket sportplayed by either two opposing players (singles) or two opposing pairs (doubles), who take positions on opposite halves of a rectangular court that is divided by a net. Players score points by striking ashuttlecockwith their rackets so that it passes over the net and lands in theiropponents' half of the court. A rally ends once the shuttlecock has struck the ground, and the shuttlecock may only be struck once by each side before it passes over the net.</p>
        
        <b-button @click="findPlayers" size="lg" id="find-button" variant="outline-danger"><font-awesome-icon icon="share-alt" /> FIND PLAYERS</b-button><br>
         <img src="../../img/badminton.svg" width="300px"/>
         </b-col>
         <b-col cols lg="6">
            <div style="padding:2em" v-if="show">
             <h1>RESULTS</h1>
            <div v-for="player in players" v-bind:key="player.user_id">
                <b-list-group-item class="d-flex justify-content-between align-items-center players">
                {{player.username}} <h1><b-button variant="success">Add Friend</b-button></h1>
                </b-list-group-item>
            </div>
            </div>
        </b-col>
        </b-row>

</template>
<style>
#badminton-info{
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
  name: 'Badminton',
  data(){
      return{
        show:false,
        players: []
      }

    },
    mounted() {
		axios.get('http://impetus.localhost/src/php/getPlayers.php?sport=Badminton', {withCredentials: true})
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