<template>
  <div class="page">
    <Form title="登录">
      <FormItem>
        <input
          type="text"
          placeholder="账号/邮箱"
        >
      </FormItem>
      <FormItem>
        <input
          type="password"
          placeholder="密码"
        >
      </FormItem>
      <FormItem>
        <button>立即登录</button>
      </FormItem>
      <FormFooter>
        <router-link
          class="item"
          tag="div"
          :to="{ name: 'ForgetPassword' }"
          exact
        ><div class="item">忘记密码&nbsp;?</div>
        </router-link>
        <div class="item">|</div>
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
export default {
  name: "HelloWorld",
  data() {
    return {
      msg: "Welcome to Your Vue.js App"
    };
  },
  components: {
    Form,
    FormItem,
    FormFooter,
  },
  methods: {
  }
};
</script>
<style scoped lang='less'>
</style>