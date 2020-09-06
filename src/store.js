import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    page: 'FeedsContent',
    teamID:'',
    tab: 'HOME'

  },
  mutations: {   // use for syncronous func
    changePage(state,pageName){
      state.page = pageName
    },
    teamID(state,id){
      state.teamID = id
    },
    changeTab(state,name){
      state.tab = name
    },

  },
  actions: {  // use for asyncronous func
    changePage(state,pageName){
      state.commit('changePage', pageName)
    },
    teamID(state,id){
      state.commit('teamID', id)
    },
    changeTab(state,name){
      state.commit('changeTab', name)
    }

  },
  getters: {
    page(state){
      return state.page
    },
    teamID(state){
      return state.teamID
    },
    tab(state){
      return state.tab
    }

  }

})
