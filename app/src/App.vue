<template>
<div class="homeAll">

  <!-- <div id="nav">
    <router-link to="/">Homee</router-link> |
    <router-link to="/login">Login</router-link> |
    <router-link to="/register">Register</router-link> |
    <router-link to="/about">About</router-link>
  </div> -->
  <router-view @reload="reload" :key="r" />
</div>
</template>
<script>
export default {
  data(){
    return{
      r:0,
    }
  },
  methods:{
    reload(){
      console.log('qsdqsd');
      this.r++
    }
  }
}
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  background: #18191a;
  
}

.homeAll{
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
