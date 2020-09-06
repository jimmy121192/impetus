<template>
  <div class="login">
    <div id="login-form">

      <form>
        <div class="form-group form-group-default" style="text-align:left ">
          <div class="controls" style="margin-top:10px">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <font-awesome-icon icon="at" />
                </div>
              </div>
              <input type="text" name="email" class="form-control" id="email" @focus="hide" v-model.lazy="email"
                required placeholder="Email">
            </div>
          </div>

          <div class="controls" style="margin-top:20px">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <font-awesome-icon icon="key" />
                </div>
              </div>
              <input name="password" type="password" class="form-control" @focus="hide" @keydown="pressEnter()" id="password"
                v-model.lazy="password" required placeholder="Password">
            </div>
          </div>
          <p id="fail" style="color:red;display:none">Email or Password is not correct!</p>
        </div>
      </form>
      <div class="signin">

        <button class="btn btn-info pull-left" @click="authenticate()">LOGIN</button>
        <router-link to="/" class="pull-right">Forgot your password?</router-link>
      </div>
      <p>Not having an account? <router-link to="/register">Sign up</router-link> now</p>
    </div>

  </div>

</template>

<script>
  var fail = document.getElementById("fail")

</script>

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
    name: 'Login',
    data() {
      return {
        show: false,
        email: "",
        password: "",
        // ajaxRequest: false
      }

    },
    methods: {
      hide: function () {
        fail.style.display = "none"
      },
      authenticate() {

        axios.post('https://impetus-php.herokuapp.com/authenticate.php', {
                userEmail: this.email,
                userPassword:this.password
              },
              {withCredentials: true}
              )
          .then(function (response) {
            //   console.log(response.data)
            var str = response.data;
            //   response.data.replace(/\n/ig, ''); //remove return symbols
            if (str[0] === true) {

              //store session with Vuex
              var userInfo = {
                username: str[1],
                email: str[2],
                avatar: str[3],
                user_id: str[4],
                type: str[5],
                teamname: str[6],
                score: str[7],
                rank: str[8],

              }

              sessionStorage.setItem("userInfo", JSON.stringify(userInfo));

              router.push({
                name: "master"
              });

            } else {
              fail.style.display = "block"
            }

          })
          .catch(function (error) {
            console.log(error);
          });

      },
      pressEnter() {
        if (event.keyCode == 13) {
          this.authenticate();
        }
      }
    },
  }

</script>
