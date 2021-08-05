<template>
  <div class="Register">
    <form class="formCotroll" @submit.prevent="Register">
      <input type="text" v-model="name" />
      <input type="email" v-model="email" />
      <input type="password" v-model="password" />
      <input type="submit" value="Register" />
    </form>
  </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'

export default {
  name: "Register",

  // components: {
  //   HelloWorld
  // }
  data() {
    return {};
  },

  methods: {
    async Register() {
      const res = await fetch("http://localhost:8000/api/register", {
        method: "POST",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
        },

        body: JSON.stringify({
          name: this.name,
          email: this.email,
          password: this.password,
        }),
      });
      const result = await res.json();
      console.log(result);
      const token = result.token;
      let user = JSON.stringify(result.user);
      localStorage.setItem("token", token);
      localStorage.setItem("user", user);
      this.$router.push("/");
      return result;
    },
  },
};
</script>
<style  scoped>
.login {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
}
.formCotroll {
  display: flex;
  justify-content: center;
  flex-direction: column;
  width: 200px;
}
</style>