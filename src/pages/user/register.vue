<template>
  <div class="page">
    <Form title="注册">
      <FormItem>
        <input
          type="text"
          placeholder="账号"
          v-model="account"
          maxlength="20"
        >
      </FormItem>
      <FormItem>
        <input
          type="password"
          placeholder="密码"
          v-model="password"
          maxlength="20"
        >
      </FormItem>
      <FormItem>
        <input
          type="password"
          placeholder="确认密码"
          v-model="repassword"
          maxlength="20"
        >
      </FormItem>
      <FormItem>
        <button @click="register">立即注册</button>
      </FormItem>
      <FormFooter>
        <router-link
          class="item"
          tag="div"
          :to="{ name: 'login' }"
          exact
        >
          <i
            class="fa fa-undo"
            aria-hidden="true"
          ></i>&nbsp;返回登录
        </router-link>
      </FormFooter>
    </Form>
  </div>
</template>
<script>
import Form from '@/components/common/Form';
import FormItem from '@/components/common/FormItem';
import FormFooter from '@/components/common/FormFooter';
import axios from 'axios';
import { ApiRoot } from '@/api/config';
import { md5 } from 'vux'
import { mapMutations } from 'vuex'
export default {
  name: "Register",
  components: {
    Form,
    FormItem,
    FormFooter,
  },
  data() {
    return {
      account: '',
      password: '',
      repassword: '',
    };
  },
  methods: {
    register: function () {
      const { account, password, repassword } = this;
      if (!account) {
        this.$vux.toast.text('请输入账号', 'top')
        return;
      }
      if (!password) {
        this.$vux.toast.text('请输入密码', 'top')
        return;
      }
      if (!repassword) {
        this.$vux.toast.text('请确认密码', 'top')
        return;
      }
      if (password != repassword) {
        this.$vux.toast.text('两次密码不一致', 'top')
        return;
      }
      this.$vux.loading.show({
        text: '正在注册'
      })
      const params = {
        account,
        password: md5(password)
      }
      axios.post(
        ApiRoot + '/user/register', params
      ).then((res) => {
        this.$vux.loading.hide()
        const response = res.data
        if (response.success) {
          const { user_id, token } = response.data;
          this.saveTokenInfo({ userId: user_id, token });
          this.$vux.toast.text('注册成功', 'top')
          this.$router.push('/');
        } else {
          this.$vux.toast.text(response.msg, 'top')
        }
      }).catch((error) => {
        this.$vux.loading.hide()
        this.$vux.toast.text('网络错误', 'top')
      });
    },
    ...mapMutations([
      'saveTokenInfo',
    ]),
  },
};
</script>
<style scoped lang='less'>
</style>