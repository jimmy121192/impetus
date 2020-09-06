<template>
	<b-container fluid  class="dashboard">
    <b-row>
      <b-col cols lg="6">
        <h1 style="text-align:center;color:#83091d; margin-bottom: 1em">CREATE AN EVENT</h1>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group label="Event Name:">
        <b-form-input id="event" v-model="form.name" required>
        </b-form-input>
      </b-form-group>

      <b-form-group label="Sports:">
        <b-form-select id="sport" :options="sports" required v-model="form.sport">
        </b-form-select>
      </b-form-group>
    <b-row>
        <b-col cols="6">
         <b-form-group label="Date:">
        <b-form-input type="date" v-model="form.date" required placeholder="Date">
            </b-form-input>
        </b-form-group>
        </b-col>
        <b-col cols="6">
            <b-form-group label="Time:">
        <b-form-input type="time" v-model="form.time" required placeholder="Time">
            </b-form-input>
        </b-form-group>
        </b-col>
    </b-row>
    <b-form-group label="Location:">
        <b-form-input id="location" v-model="form.location" required>
        </b-form-input>
      </b-form-group>

    <b-form-group label="Description:">
      <b-form-textarea id="description" v-model="form.desc" placeholder="Enter something" :rows="3" :max-rows="6" required>
        </b-form-textarea>
    </b-form-group>

      <b-button type="submit" variant="info" style="margin-right:20px">Create</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
      </b-col>

      <b-col cols lg="6">
        <h1 style="text-align:center;color:#83091d; margin-bottom: 1em">EVENTS STATS</h1>
        <b-table style="font-size:12pt;" striped hover :items="eventsInfo" />
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
  name: 'NewEvent',  
  data () {
    return {
      eventsInfo:[],
      form: {
        date: '',
        name: '',
        sport: null,
        desc: '',
        location:'',
        time:'',
        date:'',
        thumb:'',
   
      },
      sports: [
        { text: 'Select One', value: null },
        'Soccer', 'Badminton', 'Basketball', 'Table tennis','Volleyball', 'Tennis', 'Esport', 'Other'
      ],
      show: true,
      
    }
  },
  mounted(){
      axios.get('https://impetus-php.herokuapp.com/getEventsParticipants.php', {
          withCredentials: true
        })
        .then((response) => {
          this.eventsInfo = response.data;
          console.log(response.data)

        })
  },
  methods: {
    onSubmit (evt) {
      if(this.form.sport === "Soccer"){
         this.form.thumb = "soccer.svg"
      } else if (this.form.sport === "Badminton"){
         this.form.thumb = "badminton.svg"
      } else if (this.form.sport === "Basketball"){
         this.form.thumb = "basketball.svg"
      } else if (this.form.sport === "Table tennis"){
         this.form.thumb = "table-tennis.svg"
      } else if (this.form.sport === "Volleyball"){
         this.form.thumb = "volleyball.svg"
      } else if (this.form.sport === "Tennis"){
         this.form.thumb = "tennis.svg"
      } else if (this.form.sport === "Esport"){
         this.form.thumb = "esport.svg"
      } else {
        this.form.thumb = "impetus.svg"
      }

      evt.preventDefault();

      var formData = new FormData();

      // var imagefile = document.querySelector('#file');
      // formData.append("image", imagefile.files[0]);
      
    axios.post('https://impetus-php.herokuapp.com/createEvent.php', {
                event: this.form,
                // image:formData,
                // headers: {
                //   'Content-Type': 'multipart/form-data'
                // }
              }).then((resp)=>{
                
                  console.log(resp)
                  alert("New Event Created Successfully!")

                })



    },
    onReset (evt) {
      evt.preventDefault();
      /* Reset our form values */
      this.form.name = ''; 
      this.form.date = '';
      this.form.desc = '';
      this.form.location = '';
      this.form.time = '';
      this.form.sport = null;
      /* Trick to reset/clear native browser form validation state */
      this.show = false;
      this.$nextTick(() => { this.show = true });
    }
  },
  
    components: {

    }
}
</script>
