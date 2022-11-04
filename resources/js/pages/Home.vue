<template>
  <div class="container">
    <main class="grid">
      <article v-for="post in posts" :key="post.id">
        <div class="image-div">
          <img :src="'/img/'+JSON.parse(post.image)[0]" alt="">
        </div>
        <div class="text">
            <router-link
              :to="{ name: 'singleproduct', params: { slug: post.slug } }"
              ><h3>{{ post.name }}</h3></router-link>
          <p>
            <router-link
              :to="{ name: 'singleproduct', params: { slug: post.slug } }"
              >৳ {{ post.price }}</router-link
            >
          </p>
          <p>
            {{ post.description	 }}
          </p>
          <router-link
            class="btn btn-primary btn-block"
            :to="{ name: 'singleproduct', params: { slug: post.slug } }"
            >View</router-link
          >
        </div>
      </article>
    </main>
  </div>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      posts: [],
    };
  },
  created() {
    axios.get("/api/products").then((response) => {
      this.posts = response.data;
    });
  },
  methods: {},
};
</script>
