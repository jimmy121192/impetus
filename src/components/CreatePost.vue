<template>
  <div>
    <label>
      <h1>NEW POST</h1>
    </label>

    <div style="text-align:left; margin-top: 3em">
      <b-form @submit="onSubmit">
        <b-form-group label="Title">
          <b-form-input id="post-title" v-model="form.title" required>
          </b-form-input>
        </b-form-group>

        <b-form-group label="Body">
          <b-form-textarea id="post-body" v-model="form.body" :rows="5" :max-rows="10" required>
          </b-form-textarea>
        </b-form-group>
        <b-form-group label="Tags">
          <input-tag placeholder="Add Tag" v-model="form.tagsArray" :limit="4"></input-tag>
   
        </b-form-group>

        <div style="margin-top:20px">
        <b-button @click="changePage('FeedsContent')" variant="danger">Back</b-button>&nbsp;&nbsp;
        <b-button type="submit" variant="success" >Create</b-button>
        <b-modal centered title="Impetus" :ok-only="true" v-model="modalShow">
          <h1>Thanks {{form.name}}! Post successfully created!</h1>
        </b-modal>
        </div>
      </b-form>
    </div>

  </div>
</template>

<script>
  import axios from 'axios'
  import VueAxios from 'vue-axios'
  import Vue from 'vue';
  import store from '../store'
  import InputTag from 'vue-input-tag'
  Vue.component('input-tag', InputTag)
  Vue.use(VueAxios, axios);

  export default {
    name: 'CreatePost',
    data() {
      return {
        modalShow: false,   
        form: {
          title: '',
          tagsArray: [],
          body: '',
          name: ''
        },
        }
    },
    mounted() {
      var item = JSON.parse(sessionStorage.getItem("userInfo"));

      this.form.name =item.username
    },


    methods: {
      onSubmit(evt) {
        evt.preventDefault();
        axios.post('http://impetus.localhost/src/php/createPost.php', {
          post: this.form,
        }).then((resp) => {
          this.modalShow = !this.modalShow
        })
        
      },
      changePage(params) {
        store.dispatch('changePage', params) //for actions
      }

    },

    components: {

    }
  }

</script>
