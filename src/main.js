import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './registerServiceWorker'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faEnvelope, faUser, faCalendar, faAddressBook, faBell, faTasks, faPowerOff, faKey,faUsers, faCog, faComment, faShareAlt, faNewspaper, faHome, faMedal, faAt, faCalendarAlt, faMale, faFemale, faEdit, faSave, faWindowClose, faWrench, faCode, faChartPie, faVolumeUp, faPodcast, faLevelUpAlt, faMapMarkedAlt, faClock, faTrophy, faShieldAlt, faTags, faComments, faFootballBall, faRegistered, faPaperPlane, faCheck, faUserFriends, faSearchPlus, faChess, faBinoculars, faDoorOpen, faBars, faTimes, } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon, FontAwesomeLayers, FontAwesomeLayersText } from '@fortawesome/vue-fontawesome'

library.add(faEnvelope,faBell,faUser,faCalendar,faAddressBook, faTasks, faPowerOff, faKey, faUsers, faCog, faComment, faShareAlt, faNewspaper, faHome,faMedal, faAt, faCalendarAlt, faMale, faFemale, faEdit, faSave, faWindowClose,faWrench, faCode, faChartPie, faVolumeUp, faPodcast, faLevelUpAlt, faMapMarkedAlt, faClock, faTrophy, faShieldAlt, faTags, faComments, faFootballBall, faRegistered, faPaperPlane,faCheck, faUserFriends, faSearchPlus,faChess, faBinoculars, faDoorOpen, faBars, faTimes)

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('font-awesome-layers', FontAwesomeLayers);
Vue.component('font-awesome-layers-text', FontAwesomeLayersText);

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
