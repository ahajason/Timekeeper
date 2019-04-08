<template>
  <div class="page">
    <Form title="注册">
      <FormItem>
        <input
          type="text"
          placeholder="账号"
        >
      </FormItem>
      <FormItem>
        <input
          type="password"
          placeholder="密码"
        >
      </FormItem>
      <FormItem>
        <input
          type="repassword"
          placeholder="确认密码"
        >
      </FormItem>
      <FormItem>
        <button>立即注册</button>
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
export default {
  name: "register",
  components: {
    Form,
    FormItem,
    FormFooter,
  },
  data() {
    return {
      msg: "Welcome to Your Vue.js App"
    };
  },
  methods: {
  },
};
</script>
<style scoped lang='less'>
</style>