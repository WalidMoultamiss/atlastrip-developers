<template>

    <div class="postHolder" v-for="EachPost in posts" :key="EachPost">
     <Post  @reload="reload" :post="EachPost" :key="roloadCom"/>
    </div>
    
</template>



<script>
import Post from "@/components/Post.vue";
export default {
  name: 'PostHolder',
  data(){
    return{
      posts:[],
      roloadCom:0
    }
  },
  components:{
    Post,
  },
methods:{
  reload(){
    this.roloadCom++
  },
  getPosts() {
      var myHeaders = new Headers();
      myHeaders.append("Accept", "application/json");

      var requestOptions = {
        method: "GET",
        headers: myHeaders,
        redirect: "follow",
      };

      fetch("http://localhost:8000/api/postes", requestOptions)
        .then((response) => response.json())
        .then((result) => (this.posts = result))
        .catch((error) => console.log("error", error));
    }

},
beforeMount(){
  this.getPosts()
}
}


</script>


<style scoped lang="scss">
.postHolder {
  transition: 0.3s;
    display: block;
    width: 100%;
    height: max-content;
    padding: 30px;
    margin-top: 10px;
    background-color: #242526;
    // border: 1px solid rgb(107, 91, 91);
    border-radius: 15px;
    
  } 



</style>