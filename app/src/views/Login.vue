<template>
  <div class="Login">
    <form class="formCotroll" @submit.prevent="login" >
      <input type="text" v-model="emailLogin">
      <input type="password" v-model="passwordLogin">
      <input type="submit" value="login">
    </form>
  </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'

export default {
  name: 'Login',
  
  // components: {
  //   HelloWorld
  // }
  data(){
    return{
      resultJSON:{}
    }
  },

methods:{
  async login(){
        var raw = JSON.stringify({
  "email": this.emailLogin,
  "password": this.passwordLogin
});
        let date = Date.now()
        console.log(raw);
        
        const res = await fetch('http://localhost:8000/api/login',{
            method: 'POST',
            headers: {"Accept": "application/json","Content-Type": "application/json"},
            body:raw
            })
            const result = await res.json()
            const token = result.token;
            console.log(result,(Date.now()-date));
            let user = JSON.stringify(result.user);
            localStorage.setItem('token', token);
            localStorage.setItem('user', user);
            // console.log(r);
            this.$router.push("/");
  return result
  

  },
}
  
  
}
</script>
<style  scoped>
.login{
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
}
  .formCotroll{
    display: flex;
    justify-content: center;
    flex-direction: column;
    width: 200px;
  }
</style>