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
          type="repassword"
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
    <toast
      v-model="showToast"
      type="text"
      :text="toastText"
      position="top"
    ></toast>
  </div>
</template>
<script>
import { Toast } from 'vux'
import Form from '@/components/common/Form';
import FormItem from '@/components/common/FormItem';
import FormFooter from '@/components/common/FormFooter';
import axios from 'axios';
import {ApiRoot} from '@/api/config';
export default {
  name: "Register",
  components: {
    Form,
    FormItem,
    FormFooter,
    Toast,
  },
  data() {
    return {
      account: '',
      password: '',
      repassword: '',
      toastText: '',
      showToast: false,
    };
  },
  methods: {
    register: function () {
      let params = {}
      axios.post(
        ApiRoot + '/user/register', params
      ).then((response) => {
        console.log(response);
      }).catch((error) => {
        console.log(error);
      });
    },

  },
};
</script>
<style scoped lang='less'>
</style>