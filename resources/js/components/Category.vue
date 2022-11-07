<template>
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between pb-2 mb-2">
        <h5 class="card-title">All Category</h5>
        <div>
          <button
            class="btn btn-success"
            type="button"
            @click="this.$router.push('/category/create')"
          >
            Add New Category
          </button>
        </div>
      </div>

      <table class="table table-hover table-sm">
        <thead class="bg-dark text-light">
          <tr>
            <th width="50" class="text-center">#</th>
            <th>Category Name</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(post, index) in posts" :key="post.id">
            <td class="text-center">{{ index + 1 }}.</td>
            <td>{{ post.categoryName }}</td>
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
        .get("api/category/category")
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
  },
  beforeRouteEnter(to, from, next) {
    if (!window.Laravel.isLoggedin) {
      window.location.href = "/";
    }
    next();
  },
};
</script>