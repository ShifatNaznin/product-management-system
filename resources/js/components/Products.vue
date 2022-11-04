<template>
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between pb-2 mb-2">
        <h5 class="card-title">All Prodcuts</h5>
        <div>
          <button
            class="btn btn-success"
            type="button"
            @click="this.$router.push('/products/create')"
          >
            New Post
          </button>
        </div>
      </div>

      <table class="table table-hover table-sm">
        <thead class="bg-dark text-light">
          <tr>
            <th width="50" class="text-center">#</th>
            <th>Name</th>
            <th class="text-center" width="120">Image</th>
            <th class="text-center" width="200">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(post, index) in posts" :key="post.id">
            <td class="text-center">{{ index + 1 }}.</td>
            <td>{{ post.name }}</td>
            <td class="text-center">
              <tr v-for="(img,index) in JSON.parse(post.image)" :key="index">
                <td> <img  :src="'/img/'+img"  :alt="img"></td>
              </tr>
            </td>
            <td class="text-center">
              <router-link
                :to="{ name: 'editproduct', params: { id: post.id } }"
                class="btn btn-warning"
                >Edit</router-link
              >
              <button class="btn btn-danger" @click="deletePost(post.id)">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      posts: [],
      success: "",
      error: "",
    };
  },
  created() {
    this.$axios.get("/sanctum/csrf-cookie").then((response) => {
      this.$axios
        .get("/api/products")
        .then((response) => {
          console.log(response);
          this.posts = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    });
  },
  methods: {
    deletePost(id) {
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        let thisObj = this;

        if (confirm("Do you really want to delete this data?")) {
          this.$axios
            .delete(`/api/products/delete/${id}`)
            .then((response) => {
              let i = this.posts.map((item) => item.id).indexOf(id); 
              this.posts.splice(i, 1);
              thisObj.error = "";
              thisObj.success = response.data.success;
              window.location.reload();    
            })
            .catch(function (error) {
              thisObj.error = "";
              thisObj.success = error.response.data.message;
            });
        }
      });
    },
  },
  beforeRouteEnter(to, from, next) {
    if (!window.Laravel.isLoggedin) {
      window.location.href = "/";
    }
    next();
  },
};
</script>