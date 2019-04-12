<template>
  <div class="page">
    <div
      class="header-panel flex-box"
      @click="navToLogin"
    >
      <div class="portrait l">
        <img
          :src="userInfo&&userInfo.portrait&&userInfo.portrait.portrait_url"
          alt=""
        >
      </div>
      <div class="userName c">
        <div class="text">{{userInfo&&userInfo.user_nickname}}</div>
      </div>
      
      <div class="right-icon r">
        <i
          class="fa fa-angle-right"
          aria-hidden="true"
        ></i>
      </div>
    </div>
    <div class="settings-list">
      <div class="setting-item">
        <div class="title">
          <div class="text">小鸭子！</div>
        </div>
        <div class="value">
          <div class="text">嘎嘎嘎~~~</div>
        </div>
        <div class="right-icon">
          <i
            class="fa fa-angle-right"
            aria-hidden="true"
          ></i>
        </div>
      </div>
      <div class="setting-item">
        <div class="title">
          <div class="text">小鸭子！</div>
        </div>
        <div class="value">
          <div class="text">嘎嘎嘎~~~</div>
        </div>
        <div class="right-icon">
          <i
            class="fa fa-angle-right"
            aria-hidden="true"
          ></i>
        </div>
      </div>
    </div>
  </div>

</template>
<script>
import { mapMutations, mapState } from 'vuex'
import { GET_TOKEN_INFO } from '@/store/mutation-types'
import tabBar from '@/components/tabBar/tabBar';
import { startRequest } from '@/api'
export default {
  name: 'user',
  components: {
    tabBar
  },
  data() {
    return {
      userInfo: null
    }
  },
  computed: {
    ...mapState([
      'token', 'userId'
    ])
  },
  mounted() {
    this.getUserInfo({
      scb: () => { },
      fcb: (error) => {
        if (error.msg) {
          this.$vux.toast.text(error.msg, 'top')
        } else {
          this.$vux.toast.text('网络错误', 'top')
        }
      },
    })
  },
  methods: {
    navToLogin() {
      this.$router.push({
        name: 'login'
      })
    },
    getUserInfo() {
      let requestData = {};
      if (!this.token || !this.userId) {
        this.GET_TOKEN_INFO()
      }
      let { token, userId } = this;
      if (token) requestData['token'] = token;
      if (userId) requestData['user_id'] = userId;
      var res = null;
      startRequest('/user/getUserInfo', requestData, (response) => {
        this.userInfo = response.data.user_info
      }, () => { });
    },
    ...mapMutations([
      GET_TOKEN_INFO,
    ]),
  }
}

</script>

<style scoped lang='less'>
.page {
  .header-panel {
    margin: 40px 20px;
    color: #fff;

    .portrait {
      width: 80px;
      height: 80px;
      overflow: hidden;
      box-sizing: border-box;
      z-index: 1;
      flex: 0 0 auto;
      border-radius: 50%;
      border: 4px solid #fff;

      img {
        width: 100%;
        height: 100%;
      }
    }

    .userName {
      flex: 1 1 auto;
      margin: 0 10px 0;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      border-bottom: 2px solid #fff;

      .text {
        display: inline-block;
        padding: 0 10px 2px;
      }
    }

    .right-icon {
      font-size: 25px;
    }
  }

  .settings-list {
    padding: 0 20px 100px;
    width: 100%;
    color: #fff;

    .setting-item {
      display: flex;
      align-items: center;
      padding: 6px 8px;
      border-bottom: 1px solid #fff;
      margin: 10px 0;

      .title {
        flex: 1 1 auto;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
      }

      .value {
        padding: 0 8px;
        font-size: 16px;
        opacity: 0.8;
      }

      .right-icon {
        font-size: 25px;
      }
    }
  }
}
</style>
