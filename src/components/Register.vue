<template>
  <div class="register">
    <particlesJS />
    <div id="impetus">
      <img src="../img/logo.svg" style="pointer-events: none;user-select: none;">
    </div>
    <div id="register-form">

      <form>
        <div class="form-group form-group-default" style="text-align:left">

          <div class="flex">

            <div class="f-items">
              <label for="firstname">Firstname</label>
              <div class="controls">
                <input name="firstname" type="text" class="form-control" id="firstname" v-model.lazy="firstname"
                  required>
              </div>
            </div>

            <div class="f-items">
              <label for="lastname">Lastname</label>
              <div class="controls">
                <input name="lastname" type="text" class="form-control" id="lastname" v-model.lazy="lastname" required>
              </div>
            </div>

          </div>
          <label for="email" style="margin-top:10px;">Email</label>
          <div class="controls">
            <input name="email" type="text" class="form-control" id="email" v-model.lazy="email" required>

          </div>

          <label for="password" style="margin-top:10px;">Password</label>
          <div class="controls">
            <input name="password" type="password" class="form-control" id="password" v-model.lazy="password" required>

          </div>
          <label for="cfpassword" style="margin-top:10px;">Confirm Password</label>
          <div class="controls">
            <input name="cfpassword" type="password" class="form-control" id="cfpassword" v-model.lazy="cfpassword"
              required>
          </div>
          <label for="cfpassword" style="margin-top:10px;">Choose Your Sports</label>

          <div class="controls">

            <div class="flex">

              <div class="f-items">
                <input type="checkbox" name="sports" v-model.lazy="sports" value="Badminton"> Badminton<br>
                <input type="checkbox" name="sports" v-model.lazy="sports" value="Basketball"> Basketball<br>
                <input type="checkbox" name="sports" v-model.lazy="sports" value="Esport"> Esport<br>
                <input type="checkbox" name="sports" v-model.lazy="sports" value="Soccer"> Soccer<br>
              </div>

              <div class="f-items">
                <input type="checkbox" name="sports" v-model.lazy="sports" value="TableTennis"> Table Tennis<br>
                <input type="checkbox" name="sports" v-model.lazy="sports" value="Tennis"> Tennis<br>
                <input type="checkbox" name="sports" v-model.lazy="sports" value="Volleyball" checked> Volleyball<br>
              </div>

            </div>

          </div>
        </div>
      </form>
      <div class="signin">

        <button class="btn btn-success pull-left" @click="register">REGISTER</button>
        <button class="btn btn-danger pull-right" @click="back">BACK</button>
      </div>

    </div>


  </div>


</template>
<script>
  import '../css/style.css'
  import '../css/index.css'
  import router from '../router'


  import Vue from 'vue'
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  import particlesJS from './ParticlesJS'

  Vue.use(VueAxios, axios)


  export default {
    name: 'Register',
    data() {
      return {
        firstname: "",
        lastname: "",
        email: "",
        password: "",
        cfpassword: "",
        sports: []
        // ajaxRequest: false
      }

    },
    methods: {


      register: function () {

        if (this.password && this.cfpassword && this.password === this.cfpassword) {

          axios.post('https://impetus-php.herokuapp.com/register.php', {
              firstName: this.firstname,
              lastName: this.lastname,
              userEmail: this.email,
              userPassword: this.password,
              sports: JSON.stringify(this.sports)
            })
            .then(function (response) {

              if (response.data === true) {
                var json = JSON.parse(response.config.data);
                alert("Welcome " + json["firstName"] + "!\nPlease log in using your new account");
                router.push({
                  name: "home"
                });
              } else if (response.data === "email") {
                alert("A user with this email address already exists!")
              } else {
                alert("Please try again!")
              }

            })
            .catch(function (error) {
              console.log(error);
            });
        } else {
          alert("Password does not match")
        }



      },
      back: function () {
        router.push({
          name: "home"
        });
      }
    },
    components: {
      particlesJS
    }
  }

</script>
