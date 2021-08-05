<template>
  <div class="home">
    <h3>hello {{ UserNamee }}</h3>
    <form class="createPost" @submit.prevent="createPost">
      <h4>Title</h4>
      <input @focus="Posting" @onfocusout="notPosting" type="text" v-model="title" :placeholder="placeHolder" />

      <h4 v-show="Post">Content</h4>
      <textarea
      v-show="Post"
        class="textArea"
        name=""
        id=""
        rows="2"
        v-model="description"
      ></textarea>
      <div class="submit">
        <input type="submit" value="Post" />
      </div>
    </form>
    <div  >
      <PostHolder :key="reload" />
    </div>
  </div>
</template>

<script>
// import { onBeforeMount } from '@vue/runtime-core';
// @ is an alias to /src
import PostHolder from "@/components/PostHolder.vue";

export default {
  name: "Home",
  data() {
    return {
      UserNamee: "hello",
      placeHolder: "",
      reload: 0,
      Post:false,
    };
  },
  components: {
    PostHolder,
  },
  methods: {
    Posting(){
      this.Post=true
    },
    
      
    

    UserName() {
      if (localStorage.getItem("user") !== undefined) {
        this.UserNamee = JSON.parse(localStorage.getItem("user")).name;
        this.placeHolder = "Whats on your mind, " + this.UserNamee + "?";
      }
    },

    ifLogged() {
      if (!localStorage.getItem("token")) {
        this.$router.push("/Login");
      } else {
        console.log("the boy is logged");
      }
    },

    async createPost() {
      
      
      let id = JSON.parse(localStorage.getItem("user")).id;

      console.table(id);
      var raw = JSON.stringify({
        title: this.title,
        description: this.description,
        creator: id,
      });

      const res = await fetch("http://localhost:8000/api/postes", {
        method: "POST",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
        body: raw,
      });
      const result = await res.json();
      console.log(result);
      this.reload++;
      this.Post=false
      this.title=""
      this.description=""
    },
  },
  beforeMount() {
    this.ifLogged();
    this.UserName();
    // this.getPosts();
  },
  components: {
    PostHolder,
  },
};
</script>
<style lang="scss" scoped>
.home {
  min-height: 100vh;
  overflow-y: hidden;
  padding-top: 20px;
  color: white;
  background: #18191a;
  width: 60%;
  height: 85vh;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  overflow-y: scroll;
  &::-webkit-scrollbar {
    display: none;
  }
  h3 {
    width: 80%;
  }
  .createPost {
    overflow-y: hidden;
    border-radius: 25px;
    width: 80%;
    height: max-content;
    background-color: #242526;
    border: 1px solid black;
    border-radius: 10px;
    padding: 20px;
    h4 {
      text-align: left;
      margin-left: 10%;
      width: 80%;
    }
    input {
      margin: 15px 0px;
      width: 90%;
      height: 24px;
      padding: 17px 15px;
      padding-left: 10px;
      outline: none;
      font-size: 16px;
      color: white;
      background: #3a3b3c;
      border-radius: 50px;
      border: 0px;
    }
    textarea {
      margin-top: 15px;
      width: 90%;
      min-height: 250px;
      padding: 17px 15px;
      padding-left: 10px;
      outline: none;
      font-size: 16px;
      color: white;
      background: #3a3b3c;
      border-radius: 15px;
      border: 0px;
    }
    .submit {
      width: 80%;
      display: flex;
      justify-content: flex-end;
      input {
        width: 30%;
        padding: 20px;
        cursor: pointer;
        transition: 0.3s;

        &:hover {
          transform: translateY(-3px);
          transition: 0.3s;
          box-shadow: 0px 5px 20px rgba(0, 0, 255, 0.503);
        }
      }
    }
  }
  
}
</style>
