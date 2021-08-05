<template>
  <div class="PostHeader" :id="postId" :key="reloa">
    <div v-if="admin" @click="deletePost(post.id)" class="Delete">
      <h3>&nbsp;✖&nbsp;</h3>
    </div>
    <div class="imgPost">
      <div class="image"></div>
      <!-- <button class="badge">🤟</button> -->
    </div>
    
    <h2>{{post.name}}</h2>
    <button v-if="admin" class="delete_user" @click="deleteUser">delete user</button>
  </div>
  <div class="description">
    <h3>{{ post.title }}</h3>
    <p>{{ post.description }}</p>
  </div>
  <div
    class="comment"
    v-for="comment in comments"
    :id="comment.id"
    ref="comment"
    :key="comment"
  >
    <div v-if="admin" class="Delete">
      <h6 @click="deleteComment(comment.id)">&nbsp;✖&nbsp;</h6>
    </div>
    <div class="commentHeader" style="display: flex">
      <div class="image"></div>
      <h3>{{ comment.name }}</h3>
    </div>
    <p>the comment : {{ comment.comment }}</p>
  </div>
  <form @submit.prevent="createComment(post.id)" class="replyHolder">
    <h4>write a reply</h4>
    <div class="replyContainer">
      <textarea
        class="textArea"
        name=""
        id=""
        rows="2"
        v-model="comment"
      ></textarea>

      <div class="submit">
        <input type="submit" value="comment" />
      </div>
    </div>
  </form>
</template>

<script>
export default {
  name: "Post",
  data() {
    return {
      comments: [],
      reloa: 0,
      postId: "",
      admin:false
    };
  },
  props: {
    post: Array,
  },
  methods: {
    deletePost(id) {
      var myHeaders = new Headers();
      myHeaders.append("Accept", "application/json");
      myHeaders.append("Content-Type", "application/json");
      myHeaders.append(
        "Authorization",
        "Bearer "+ localStorage.getItem('token')
      );

      var requestOptions = {
        method: "DELETE",
        headers: myHeaders,
        redirect: "follow",
      };
      console.log(id);
      fetch(`http://localhost:8000/api/postes/${id}`, requestOptions)
        .then((response) => response.text())
        .then((result) => console.log(result))
        .catch((error) => console.log("error", error));
      document.getElementById(`post${id}`).parentElement.style.transform =
        "translateX(-1000px)";
      setTimeout(() => {
        document.getElementById(`post${id}`).parentElement.remove();
      }, 300);
    },
    deleteComment(id) {
      document.getElementById(`${id}`).style.transform = "translateX(-1000px)";
      setTimeout(() => {
        document.getElementById(`${id}`).remove();
      }, 300);
    },
    async createComment(id) {
      var myHeaders = new Headers();
      myHeaders.append("Accept", "application/json");
      myHeaders.append("Content-Type", "application/json");

      var raw = JSON.stringify({
        comment: this.comment,
        post_id: id,
        creator: JSON.parse(localStorage.getItem("user")).id,
      });

      var requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow",
      };

      fetch("http://localhost:8000/api/Comment", requestOptions)
        .then((response) => response.json())
        .then((result) => console.log(result))
        .then(this.$emit("reload"))
        .then(this.reloa++)
        .catch((error) => console.log("error", error));
    },
    async getComment() {
      var myHeaders = new Headers();
      myHeaders.append("Accept", "application/json");
      myHeaders.append("Content-Type", "application/json");
      var requestOptions = {
        method: "GET",
        headers: myHeaders,
        redirect: "follow",
      };

      fetch(
        `http://localhost:8000/api/Comment/show/${this.post.id}`,
        requestOptions
      )
        .then((response) => response.json())
        .then((result) => (this.comments = result))
        .catch((error) => console.log("error", error));
    },
  },
  beforeMount() {
    this.getComment();
    this.postId = "post" + this.post.id;
    if(JSON.parse(localStorage.getItem('user')).role == 'admin' ){
      this.admin = true
    }
  },
};
</script>


<style scoped lang="scss">
.PostHeader {
  transition: 0.3s;
  display: flex;
  gap: 10px;
  position: relative;
  .Delete {
    padding: 5px;
    border-radius: 50px;
    cursor: pointer;
    position: absolute;
    top: 5px;
    right: 5px;
    background: grey;
    transition: 0.3s;
    &:hover {
      transform: translateY(-3px);
      transition: 0.3s;
      background: rgb(156, 0, 0);
      box-shadow: 0px 5px 20px rgba(0, 0, 68, 0.331);
      transform: scale(1.04);
    }
  }
  .imgPost {
    position: relative;
    width: 11%;
    max-width: 85px;
    .image {
      width: 40px;
      height: 40px;
      border-radius: 100%;
      background-color: rgb(114, 114, 114);
      background-position: center;
      background-size: cover;
      background-image: url("../assets/iQ9iF.png");
    }
    // .badge {
    //   position: absolute;
    //   min-width: 30px;
    //   border: 0px;
    //   height: 30px;
    //   background-color: lawngreen;
    //   border-radius: 50px;
    //   top: 0;
    //   right: 0;
    // }
  }
}
.description {
  width: 100%;
  margin: 20px 0px;
  text-align: left;
  padding-bottom: 20px;
  border-bottom: 1px solid rgb(134, 134, 134);
}
.comment {
  text-align: left;
  background: #323335;
  border-radius: 15px;
  padding: 10px;
  margin-bottom: 10px;
  position: relative;
  transition: 0.3s;
  .Delete {
    padding: 5px;
    border-radius: 50px;
    cursor: pointer;
    position: absolute;
    top: 5px;
    right: 5px;
    background: grey;
    transition: 0.3s;
    &:hover {
      transform: translateY(-3px);
      transition: 0.3s;
      background: rgb(156, 0, 0);
      box-shadow: 0px 5px 20px rgba(0, 0, 68, 0.331);
      transform: scale(1.04);
    }
  }
  .commentHeader {
    display: flex;
    gap: 10px;
    .image {
      width: 25px;
      height: 25px;
      border-radius: 100%;
      background-color: rgb(114, 114, 114);
      background-position: center;
      background-size: cover;
      background-image: url("../assets/iQ9iF.png");
    }
  }
}
.replyHolder {
  width: 100%;
  text-align: left;
  text-align: left;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  align-content: flex-start;
  justify-content: flex-start;
  h4 {
    text-align: left;
    width: 100%;
    display: flex;
  }
  .replyContainer {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    textarea {
      margin-top: 15px;
      width: 100%;
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
      width: 100%;
      display: flex;
      justify-content: flex-end;
      input {
        background: #3a3b3c;
        margin-top: 20px;
        border: 0px;
        width: 30%;
        padding: 10px;
        border-radius: 15px;
        color: white;
        cursor: pointer;
        transition: 0.3s;

        &:hover {
          transform: translateY(-3px);
          transition: 0.3s;
          box-shadow: 0px 5px 20px rgba(0, 0, 68, 0.331);
        }
      }
    }
  }
}
</style>