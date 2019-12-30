<template>
  <div class="page">
    <div class="header-panel flex-box" @click="navToLogin">
      <div class="portrait l">
        <img
          :src="userInfo.portrait && userInfo.portrait.portrait_url"
          alt=""
        />
      </div>
      <div class="c">
        <div class="userName">
          {{ userInfo.user_nickname || "&nbsp;&nbsp;&nbsp;" }}
        </div>
      </div>
      <div class="right-icon r">
        <!-- <i
          class="fa fa-angle-right"
          aria-hidden="true"
        ></i> -->
      </div>
    </div>
    <div class="settings-list">
      <div class="setting-item">
        <div class="title">
          <div class="text" @click="goProfile">个人信息</div>
        </div>
        <div class="value">
          <div class="text"></div>
        </div>
        <div class="right-icon">
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>
      </div>
      <div class="setting-item">
        <div class="title">
          <div class="text">关于</div>
        </div>
        <div class="value">
          <div class="text">v1.6.0</div>
        </div>
        <div class="right-icon">
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>
      </div>
      <div class="setting-item" @click="confirmLogout">
        <div class="title">
          <div class="text">退出</div>
        </div>
        <div class="value">
          <div class="text"></div>
        </div>
        <div class="right-icon">
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "user",
  components: {},
  data() {
    return {
      userInfo: {
        portrait: null
      }
    };
  },
  computed: {},
  mounted() {
    this.getUserInfo();
  },
  methods: {
    navToLogin() {
      return;
      // this.$router.push({
      //   name: "login"
      // });
    },
    goProfile() {
      this.$router.push({
        name: "profile"
      });
    },
    getUserInfo() {
      let requestData = this.$store.getters.tokenInfo;
      this.$startRequest(
        "/user/getUserInfo",
        requestData,
        response => {
          this.userInfo = response.data.user_info;
        },
        error => {
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    },
    logout() {
      let requestData = this.$store.getters.tokenInfo;
      this.$startRequest(
        "/user/getUserInfo",
        requestData,
        response => {
          this.userInfo = response.data.user_info;
        },
        error => {
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    },
    confirmLogout() {
      this.$vux.confirm.show({
        title: "确认退出",
        content: "确定要退出当前吗？退出后需要重新登录账号才能继续使用~",
        onCancel: () => {},
        onConfirm: () => {
          this.logout(this.editingCategory);
        }
      });
    },
    logout() {
      let requestData = this.$store.getters.tokenInfo;
      this.$startRequest(
        "/user/logout",
        requestData,
        res => {
          this.$vux.toast.text("登出成功", "top");
          this.$router.push({
            name: "login"
          });
        },
        error => {
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    }
  }
};
</script>

<style scoped lang="less">
.page {
  padding: 40px 20px;
  .header-panel {
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
    .c {
      .userName {
        line-height: 1.8;
        font-size: 24px;
        flex: 1 1 auto;
        margin: 0 10px 0;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        padding: 0 10px 2px;
        border-bottom: 2px solid #fff;
      }
    }

    .right-icon {
      font-size: 25px;
    }
  }

  .settings-list {
    width: 100%;
    color: #fff;
    padding: 40px 0;
    .setting-item {
      display: flex;
      align-items: center;
      padding: 6px 10px 6px 20px;
      border-bottom: 1px solid #fff;
      margin: 20px 0;

      .title {
        flex: 1 1 auto;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
      }

      .value {
        .text {
          margin: 0 8px;
          font-size: 16px;
          opacity: 0.6;
        }
      }

      .right-icon {
        font-size: 25px;
      }
    }
  }
}
</style>
