<template>
  <div id="notification-wrapper">
    <span id="bell-icon" class="material-icons d-block" v-on:click="ConfirmNoticeList">notifications</span>
    <span id="notice-mark" v-bind:class="{ hidden: isHiddenForNoticeMark}"></span>
    <div class="notice-list-wrapper" v-bind:class="{ hidden: isHiddenForMsgList}">
      <ul class="list-group">
        <li class="list-group-item" v-for="notice in notifications" :key="notice.id">
          <p class="notice-message">{{notice.user_name}}さんがコメントしました。</p>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: ["currentUser"],
  data() {
    return {
      notifications: [],
      messageId : '',
      isHiddenForNoticeMark: true,
      isHiddenForMsgList: true
    };
  },
  mounted() {
    window.Echo.private("notification-channel." + this.currentUser)
                .listen("UpdateNotice", response =>
                {
                  response.message.user_name = response.userName;
                  this.notifications.unshift(response.message);
                  this.ToggleNotificationIcon();
                });
    
    this.ToggleNotificationIcon();
  },
  
  methods: {
   ConfirmNoticeList() {
    this.isHiddenForNoticeMark = true;
    this.isHiddenForMsgList = !this.isHiddenForMsgList;
   },
   
   ToggleNotificationIcon() {
    if (this.notifications.length){
      this.isHiddenForNoticeMark = false; 
    } else {
      this.isHiddenForNoticeMark = true; 
    }
   },
  },
};
</script>