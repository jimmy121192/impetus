<template>
	<b-container fluid  class="dashboard">
        <b-row>
            <b-col lg="6" class="p-3">
                <b-table style="font-size:12pt;" striped hover :items="mods" />
            </b-col>
            <b-col lg="6" class="p-3">
                <b-input-group  prepend="#ID" class="mt-3">
                    <b-form-input v-model.lazy="add_id" placeholder="Add Mod"/>
                    <b-input-group-append>
                
                    <b-button variant="success" @click="addMod()">Add</b-button>
                    </b-input-group-append>
                </b-input-group>


                <b-input-group  prepend="#ID" class="mt-3">
                
                    <b-form-input v-model.lazy="del_id" placeholder="Delete Mod"/>
                    <b-input-group-append>
                    
                    <b-button variant="danger" @click="delMod()">Delete</b-button>
                    </b-input-group-append>
                </b-input-group>
                <b-modal centered title="Impetus" :ok-only="true" v-model="modalShow">
                  <h1>New Moderator added successfully!</h1>
                </b-modal>
                <b-modal centered title="Impetus" :ok-only="true" v-model="modalShow2">
                  <h1>New Moderator deleted successfully!</h1>
                </b-modal>
            </b-col>
            
            
        </b-row>

    </b-container>
</template>

<script>

import '../css/admin.css'
import 'bootstrap/dist/css/bootstrap.css';
import axios from 'axios'
import VueAxios from 'vue-axios'
import Vue from 'vue';
Vue.use(VueAxios, axios);

export default {
  name: 'EditMod',  
  data () {
    return {
      mods: [],
      add_id:'',
      del_id:'',
      modalShow: false,
      modalShow2: false
    }
  },
  mounted() {
      axios.get('https://impetus-php.herokuapp.com/getMods.php', {
          withCredentials: true
        })
        .then((response) => {
          this.mods = response.data;

          console.log(response.data);
        //   for (var i = 0; i < response.data.length; i++) {
        //     // console.log(this.items[i].sports)
        //     this.items[i].sports = JSON.parse(response.data[i].sports)
        //   }
        //   // console.log(this.items)
        }).catch(function (error) {
          // Error handling
          console.log(error)
        });
    },
    methods: {
        addMod(){
            axios.get('https://impetus-php.herokuapp.com/addMod.php?id='+this.add_id, {
             withCredentials: true
            }).then((response) => {
                this.modalShow = !this.modalShow
            })
        },
        delMod(){
            axios.get('https://impetus-php.herokuapp.com/delMod.php?id='+this.del_id, {
             withCredentials: true
            }).then((response) => {
                this.modalShow2 = !this.modalShow2
            })
        }
    },
  
    components: {

    }
}
</script>
