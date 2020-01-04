<template>
  <div class="page">
    <Form title="登录">
      <FormItem>
        <input
            maxlength="50"
            placeholder="账号/邮箱"
            type="text"
            v-model="account"
        >
      </FormItem>
      <FormItem>
        <input
            maxlength="20"
            placeholder="密码"
            type="password"
            v-model="password"
        >
      </FormItem>
      <FormItem>
        <button @click="login">立即登录</button>
      </FormItem>
      <FormFooter>
        <!-- <router-link
          class="item"
          tag="div"
          :to="{ name: 'ForgetPassword' }"
          exact
        >
          <div class="item">忘记密码&nbsp;?</div>
        </router-link>
        <div class="item">|</div> -->
        <router-link
            :to="{ name: 'register' }"
            class="item"
            exact
            tag="div"
        >前往注册&nbsp;<i
            aria-hidden="true"
            class="fa fa-angle-right"
        ></i>
        </router-link>
      </FormFooter>
    </Form>
  </div>
</template>
<script>
  import Form from '@/components/common/LoginForm';
  import FormItem from '@/components/common/LoginFormItem';
  import FormFooter from '@/components/common/LoginFormFooter';
  import axios from 'axios';
  import {ApiRoot} from '@/api/config';
  import {md5} from 'vux'
  import {mapMutations} from 'vuex'

  export default {
    name: "login",
    components: {
      Form,
      FormItem,
      FormFooter,
    },
    data() {
      return {
        account: '',
        password: '',

      };
    },
    mounted() {
    },
    methods: {
      login: function () {
        const {account, password} = this;
        if (!account) {
          this.$vux.toast.text('请输入账号', 'top');
          return;
        }
        if (!password) {
          this.$vux.toast.text('请输入密码', 'top');
          return;
        }
        this.$vux.loading.show({
          text: '正在登录'
        });
        const params = {
          account,
          password: md5(password)
        };
        axios.post(
          ApiRoot + '/user/login', params
        ).then((res) => {
          this.$vux.loading.hide();
          const response = res.data;
          if (response.success) {
            const {user_id, token} = response.data;
            this.saveTokenInfo({userId: user_id, token});
            this.$vux.toast.text('登录成功', 'top');
            this.$router.push('/');
          } else {
            this.$vux.toast.text(response.msg, 'top')
          }
        }).catch((error) => {
          this.$vux.loading.hide();
          this.$vux.toast.text('网络错误', 'top')
        });
      },
      ...mapMutations([
        'saveTokenInfo',
      ]),
    },
  };
</script>
<style lang='less' scoped>
</style>
