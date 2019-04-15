<template>
  <div class="page">
    <Form title="登录">
      <FormItem>
        <input
          type="text"
          placeholder="账号/邮箱"
          v-model="account"
          maxlength="50"
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
          class="item"
          tag="div"
          :to="{ name: 'register' }"
          exact
        >前往注册&nbsp;<i
            class="fa fa-angle-right"
            aria-hidden="true"
          ></i>
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
      const { account, password } = this;
      if (!account) {
        this.$vux.toast.text('请输入账号', 'top')
        return;
      }
      if (!password) {
        this.$vux.toast.text('请输入密码', 'top')
        return;
      }
      this.$vux.loading.show({
        text: '正在登录'
      })
      const params = {
        account,
        password: md5(password)
      }
      axios.post(
        ApiRoot + '/user/login', params
      ).then((res) => {
        this.$vux.loading.hide()
        const response = res.data
        if (response.success) {
          const { user_id, token } = response.data;
          this.saveTokenInfo({ userId: user_id, token });
          this.$vux.toast.text('登录成功', 'top')
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