<template>
  <b-container class="Chat-container">

    <div class="d-flex justify-content-between align-items-center">
      <h1>CHAT ROOMS</h1>
      <b-button v-b-modal.modalPrevent variant="success">
        <font-awesome-icon icon="door-open" /> Join Room</b-button>
    </div>
    <hr>
    <tabs :tabs="tabs" :currentTab="currentTab" :wrapper-class="'default-tabs'" :tab-class="'default-tabs__item'"
      :tab-active-class="'default-tabs__item_active'" :line-class="'default-tabs__active-line'" @onClick="handleClick" />

    <div class="content">

      <div v-if="currentTab === 'tab1'">
        <div class="chat-boxes">
          <div v-for="(m, index) in allMsgs[0].msgs" v-bind:key="index">

            <p :class="{messages:m.username == username, normaly:m.username !== username}">
              {{m.username}} -

              {{m.msg}}
            </p>

          </div>
        </div>

        <div id="control">
          <input type="text" id="input_msg" @keydown="pressEnter()" placeholder="Type a message..." v-model="msg" />

        </div>
      </div>

      <div v-if="currentTab === 'tab2'">
        <p>This is your private room. You can invite anyone. Room Name: {{username}}</p>
        <div class="chat-boxes">
          <div v-for="(m, index) in allMsgs[1].msgs" v-bind:key="index">
            <p :class="{messages:m.username == username, normaly:m.username !== username}">
              {{m.username}} -

              {{m.msg}}
            </p>
          </div>
        </div>

        <div id="control">
          <input type="text" id="input_msg" @keydown="pressEnter()" placeholder="Type a message..." v-model="msg" />

        </div>

      </div>

      <div v-for="room in newRoomArr" v-bind:key="room.value">
        <div v-if="currentTab === room.value">
          <p>You are in {{room.title}}'s room.</p>
          <div>
            <div class="chat-boxes" v-for="(message, i) in allMsgs" v-bind:key="i">
              <div v-if="message.tabName == room.title" v-for="(m, index) in message.msgs" v-bind:key="index">
                <p :class="{messages:m.username == username , normaly:m.username !== username}">
                  {{m.username}} -

                  {{m.msg}}
                </p>
              </div>
            </div>
          </div>

          <div id="control">
            <input type="text" id="input_msg" @keydown="pressEnter()" placeholder="Type a message..." v-model="msg" />

          </div>
        </div>
      </div>
    </div>

    <b-modal id="modalPrevent" ref="modal" title="Join A Room" @ok="handleOk" @shown="clearName" centered>
      <form @submit.stop.prevent="handleSubmit">
        <b-form-input type="text" placeholder="Enter Room Name" v-model="newRoomName" />
      </form>
    </b-modal>

  </b-container>
</template>

<script>
  import '../css/chatroom.css'
  import io from "socket.io-client"
  import Tabs from 'vue-tabs-with-active-line';

  var n = 2;

  export default {
    name: 'ChatRoom',
    data() {
      return {
        room: '',
        //socket: io("https://previews-bcit.herokuapp.com//chat"),
        socket: io("http://localhost:8880/chat"),
        msg: "",
        username: '',
        newRoomName: '',
        newRoomArr: [],
        allMsgs: [{
            tabName: 'team',
            msgs: [],
          },
          {
            tabName: 'private',
            msgs: [],
          }
        ],
        tabs: [{
          title: 'Tab 1',
          value: 'tab1',
        }, {
          title: 'Tab 2',
          value: 'tab2',
        }],
        currentTab: 'tab2',
        currentRoom: 'tab2',

      }
    },

    mounted() {
      var session = JSON.parse(sessionStorage.getItem("userInfo"));
      this.username = session.username
      this.room = (session.teamname) ? session.teamname : '';
      this.allMsgs[0].tabName = (session.teamname) ? session.teamname : '';
      this.allMsgs[1].tabName = this.username;
      this.currentTab = (session.teamname) ? 'tab1' : 'tab2';
      this.currentRoom = (this.currentTab == 'tab1') ? this.room : this.username;

      // console.log(this.room, this.currentTab);

      this.socket.on("incoming_msg", (data) => {
        console.log(data);

        let MsgArr = this.allMsgs;

        for (var i = 0; i < MsgArr.length; i++) {
          if (MsgArr[i].tabName == data.roomName) {
            MsgArr[i].msgs.unshift(data)

          }
        }

      })

      this.tabs = [{
        title: (this.room) ? this.room : 'TEAM 🔒',
        value: 'tab1',
        disabled: (this.room) ? false : true,
      }, {
        title: this.username,
        value: 'tab2',
      }];

    },

    methods: {
      clearName() {
        this.newRoomName = ''
      },
      SendMessage: function () {
        var obj = {
          username: this.username,
          msg: this.msg,
          tab: this.currentTab,
          roomName: this.currentRoom
        }
        this.socket.emit("send_msg", obj)
      },
      pressEnter() {
        if (event.keyCode == 13) {
          this.SendMessage();
          this.msg = ''
        }
      },
      handleClick(newTab) {

        this.currentTab = newTab;

        let Arr = this.tabs;

        for (var i = 0; i < Arr.length; i++) {
          if (Arr[i].value == newTab) {
            this.currentRoom = Arr[i].title;
          }
        }
        var obj = {
          roomName: this.currentRoom
        }
        this.socket.emit("join_room", obj)

        console.log(this.currentTab, this.currentRoom);
      },
      handleOk(evt) {
        // Prevent modal from closing
        evt.preventDefault()
        if (!this.newRoomName) {
          alert('Please enter room name')
        } else {
          this.handleSubmit()
        }
      },
      handleSubmit() {
        n++
        let room = {
          title: this.newRoomName,
          value: 'tab' + n,
        }
        let NewMsgs = {
          tabName: this.newRoomName,
          msgs: []
        }
        this.clearName();
        this.allMsgs.push(NewMsgs);

        this.tabs.push(room);

        this.newRoomArr.push(room);
        this.$nextTick(() => {
          // Wrapped in $nextTick to ensure DOM is rendered before closing
          this.$refs.modal.hide()
        })

      },

    },

    components: {
      Tabs,
    },
  }

</script>

<style>
  .content {
    margin-top: 4em;
  }

  .tabs {
    position: relative;
    margin: 0 auto;
  }

  .tabs__item {
    display: inline-block;
    margin: 0 5px;
    padding: 10px;
    padding-bottom: 8px;
    font-size: 16px;
    letter-spacing: 0.8px;
    color: gray;
    text-decoration: none;
    border: none;
    background-color: transparent;
    border-bottom: 2px solid transparent;
    cursor: pointer;
    transition: all 0.25s;
  }

  .tabs__item_active {
    color: black;
  }

  .tabs__item:hover {
    border-bottom: 2px solid gray;
    color: black;
  }

  .tabs__item:focus {
    outline: none;
    border-bottom: 2px solid gray;
    color: black;
  }

  .tabs__item:first-child {
    margin-left: 0;
  }

  .tabs__item:last-child {
    margin-right: 0;
  }

  .tabs__active-line {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 2px;
    background-color: black;
    transition: transform 0.4s ease, width 0.4s ease;
  }

</style>
