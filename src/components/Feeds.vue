<template>
    <b-container fluid  class="dashboard">
    
    <b-row>
       	<marquee behavior="scroll" direction="left" ><h1>{{this.announcement}}</h1></marquee>
        <b-col cols lg="8" class="d-flex justify-content-start flex-column feed-menu align-items-start">
         <b-list-group-item @click="changePage('newPost')" class="d-flex justify-content-between align-items-center feed-buttons">
            CREATE POST <span class="pull-right"><font-awesome-icon icon="comments" /></span>
        </b-list-group-item>
        </b-col>
        
        <b-col cols lg="4" class="d-flex feed-menu">
        </b-col>
        
    </b-row>
    <hr>
    <b-row class="feed-container">

			<b-col cols lg="8">
				<FeedsContent v-if="this.$store.getters.page==='FeedsContent'"/>
        <CreatePost v-if="this.$store.getters.page==='newPost'"/>
			</b-col>

 
			<b-col cols lg="4">

				<div class="top-questions">
					<label><h1>TOP QUESTIONS</h1></label>
					
				</div>

				
			</b-col>
		</b-row>
    </b-container>



</template>

<script>
  
import '../css/feeds.css';
import FeedsContent from './FeedsContent';
import CreatePost from './CreatePost';
import store from '../store'

import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)

export default {
  name: 'Feeds',
  data(){
      return{
        announcement:'',
      }

    },
    computed:{
      test(){
          return store.getters.page
      }
  },
  mounted(){
    // console.log(store.getters.page)
    axios.get('https://impetus-php.herokuapp.com/getAnnouncement.php')
			.then((response)=>{

				this.announcement = response.data[0]['text'];
			})
			.catch(function(error){
				console.log(error)
		});
  }
  ,
  methods:{
      // newPost(params){
      //     this.post = params;

      // },
     
      changePage(params){

        store.dispatch('changePage',params)   //for actions
        console.log(store.getters.page)
  
    }

  },
  components: { 
    FeedsContent,
    CreatePost
   }
}
</script>
