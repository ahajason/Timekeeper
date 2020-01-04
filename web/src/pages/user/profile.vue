<template>
  <div class="page">
    <THeader>
      <div @click="goback" slot="l">
        <i aria-hidden="true" class="fa fa-angle-left"></i>
        <div class="text">返回</div>
      </div>
      <div slot="c">个人信息</div>
      <div slot="r"></div>
    </THeader>
    <div class="settings-list">
      <div class="setting-item">
        <div class="title">
          <div class="text">头像</div>
        </div>
        <div class="value">
          <img
              :src="
              userInfo && userInfo.portrait && userInfo.portrait.portrait_url
            "
              alt=""
          />
        </div>
        <div class="right-icon">
          <i aria-hidden="true" class="fa fa-angle-right"></i>
        </div>
      </div>
      <div class="setting-item">
        <div class="title">
          <div @click="goProfile" class="text">昵称</div>
        </div>
        <div class="value">
          <div class="text">{{ userInfo.user_nickname }}</div>
        </div>
        <div class="right-icon">
          <i aria-hidden="true" class="fa fa-angle-right"></i>
        </div>
      </div>
      <div class="setting-item">
        <div class="title">
          <div class="text">账号</div>
        </div>
        <div class="value">
          <div class="text">{{ userInfo.user_account }}</div>
        </div>
        <div class="right-icon"></div>
      </div>
      <div class="setting-item">
        <div class="title">
          <div class="text">邮箱</div>
        </div>
        <div class="value">
          <div class="text">
            {{ userInfo.user_email || "未绑定" }}
          </div>
        </div>
        <div class="right-icon">
          <i aria-hidden="true" class="fa fa-angle-right"></i>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import THeader from "../../components/THeader";

  export default {
    name: "profile",
    components: {
      THeader
    },
    data() {
      return {
        userInfo: {}
      };
    },
    computed: {},
    mounted() {
      this.getUserInfo();
    },
    methods: {
      goback() {
        this.$router.back();
      },
      navToLogin() {

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
          title: "确认删除",
          content: "确定要删除该类别吗？删除后所属的所有事项与计划都会被删除~",
          onCancel: () => {
          },
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

<style lang="less" scoped>
  .page {
    padding: 60px 20px;

    .settings-list {
      width: 100%;
      color: @white;

      .setting-item {
        display: flex;
        align-items: center;
        padding: 6px 10px 6px 20px;
        border-bottom: 1px solid @white;
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
            opacity: 0.8;
          }

          img {
            margin: 0 8px;
            width: 80px;
            height: 80px;
          }
        }

        .right-icon {
          font-size: 25px;
        }
      }
    }
  }
</style>
