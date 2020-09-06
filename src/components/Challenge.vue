<template>
    <b-container fluid  class="dashboard">
    
    <b-row>
        <b-col class="d-flex justify-content-center sport-boxes">
        
        <b-list-group-item :class="{highlight:sport== 'Badminton'}" @click="chooseSport('Badminton')" class="d-flex justify-content-between align-items-center sports">
            BADMINTON <span>🏸</span>
        </b-list-group-item>
        <b-list-group-item :class="{highlight:sport== 'Basketball'}" @click="chooseSport('Basketball')" class="d-flex justify-content-between align-items-center sports">
            BASKETBALL <span >🏀</span>
        </b-list-group-item>
        <b-list-group-item :class="{highlight:sport== 'Volleyball'}" @click="chooseSport('Volleyball')" class="d-flex justify-content-between align-items-center sports">
            VOLLEYBALL <span >🏐</span>
        </b-list-group-item>
        <b-list-group-item :class="{highlight:sport== 'Soccer'}" @click="chooseSport('Soccer')" class="d-flex justify-content-between align-items-center sports">
            SOCCER <span >⚽️</span>
        </b-list-group-item>
        <b-list-group-item :class="{highlight:sport== 'Tennis'}" @click="chooseSport('Tennis')" class="d-flex justify-content-between align-items-center sports">
            TENNIS <span >🎾</span>
        </b-list-group-item>
        <b-list-group-item :class="{highlight:sport== 'TableTennis'}" @click="chooseSport('TableTennis')" class="d-flex justify-content-between align-items-center sports">
            TABLE TENNIS <span >🏓</span>
        </b-list-group-item>
        <b-list-group-item :class="{highlight:sport== 'Esport'}" @click="chooseSport('Esport')" class="d-flex justify-content-between align-items-center sports">
            ESPORT <span >🎮</span>
        </b-list-group-item>
     
    </b-col>
 
        <Badminton v-if="sport==='Badminton'"/>
        <Basketball v-if="sport==='Basketball'"/>
        <Volleyball v-if="sport==='Volleyball'"/>
        <Soccer v-if="sport==='Soccer'"/>
        <Tennis v-if="sport==='Tennis'"/>
        <TableTennis v-if="sport==='TableTennis'"/>
        <Esport v-if="sport==='Esport'"/>


        
    </b-row>
    </b-container>



</template>

<script>

import '../css/challenge.css'
import Badminton from './sports/Badminton'
import Basketball from './sports/Basketball'
import Volleyball from './sports/Volleyball'
import Soccer from './sports/Soccer'
import Tennis from './sports/Tennis'
import TableTennis from './sports/TableTennis'
import Esport from './sports/Esport'


export default {
  name: 'Challenge',
  data(){
      return{
        sport:""
      }

    },
  methods:{
      chooseSport(params){
          this.sport = params;

      },

  },
  components: { 
      Badminton,
      Basketball,
      Volleyball,
      Soccer,
      Tennis,
      TableTennis,
      Esport
   }
}
</script>
