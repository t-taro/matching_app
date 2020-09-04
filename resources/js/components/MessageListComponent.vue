<template>
  <div class="message_list_area">
    <div class="form-inline justify-content-center">
      <div class="form-group mb-3">
        <textarea
          name="message"
          class="form-control"
          cols="50"
          rows="1"
          placeholder="Please input message here"
          v-model="newMessage"
        ></textarea>
      </div>
      <div class="form-group mx-sm-3 mb-3">
        <button type="submit" class="btn btn-primary" @click="addMessage">Submit</button>
      </div>
    </div>
    <ul>
      <li v-for="msg in messages" :key="msg.id">
        <div v-if="msg['user_id'] == currentUserId">
          <div class="msg_right bg-light">
            <p class="msg_body text-right">{{ msg['message'] }}</p>
          </div>
          <p class="user_name_right text-right">{{ msg['user_name'] }}</p>
        </div>
        <div v-else>
          <div class="msg_left bg-light">
            <p class="msg_body">{{ msg['message'] }}</p>
          </div>
          <p class="user_name_left">{{ msg['user_name'] }}</p>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  // propsはproject_detail.blade.phpから受け取っている
  props: ["project"],
  data() {
    return {
      messages: [],
      currentUserId: "",
      newMessage: "",
    };
  },
  mounted() {
    // メッセージの表示を左右に分けるために現在ログインしているユーザーIDが必要
    axios
      .get("/message/getCurrentUser")
      .then((response) => {
        this.currentUserId = response.data.current_user_id;
      });
    
    // Laravel-Echoでpusherから受信してメッセージリストに追加する
    // FIXME：追加した時に受信した側にユーザー名が表示されない。
    window.Echo.channel("message-add-channel")
                .listen("MessageAdded", response =>
                {
                  response.message.user_name = response.userName;
                  this.messages.unshift(response.message);
                });
    
    // プロジェクトIDに属するメッセージ群を取得している
    axios
      .get("/api/messages", {
        params: {
          projectId: this.project.id,
        },
      })
      .then((response) => (this.messages = response.data));
  },
  methods: {
    addMessage() {
      // 新規のメッセージ情報をphpに渡した後、返り値を一覧に追加
      axios
        .post("/message/store", {
          message: this.newMessage,
          project_id: this.project.id,
          })
        .then((response) => {
          this.messages.unshift(response.data);
          });

      this.newMessage = "";
    },
  },
};
</script>