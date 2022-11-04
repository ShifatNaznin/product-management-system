<template>
    <div class="product-card">
      <!-- product-card left -->
      <div class="product-imgs">
        <div class="img-display">
          <div class="img-showcase">
            <img :src="'/img/' + JSON.parse(img)[0]" alt="" />
          </div>
        </div>
        <div class="img-select">
          <div
            class="img-item"
            v-for="(img, index) in JSON.parse(img)"
            :key="index"
          >
            <a href="#" data-id="1">
              <img :src="'/img/' + img" :alt="img" />
            </a>
          </div>
        </div>
      </div>
      <!-- product-card right -->
      <div class="product-content">
        <h2 class="product-title">{{ name }}</h2>

        <div class="product-price">
          <p class="new-price">
            Price: <span>৳ {{ price }}</span>
          </p>
        </div>

        <div class="product-detail">
          <h2>about this item:</h2>
          <p>
           {{description}}
          </p>
          <ul>
            <li>Color: <span v-for="color in colorAll" :key="color.id">{{
                color.colorName
              }},</span></li>
            <li>
              Category:
              <span v-for="category in categoryAll" :key="category.id">{{
                category.categoryName
              }},</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      categoryList: [],
      categoryAll: [],
      colorAll: [],
      name: "",
      categoryId: [],
      img: "",
      price: "",
      description: "",
    };
  },
  created() {
    axios
      .get(`/api/products/singleProduct/${this.$route.params.slug}`)
      .then((response) => {
        console.log(response);
        this.name = response.data["name"];
        this.category = response.data["category"];
        this.img = response.data["image"];
        this.imgPreview = response.data["img"];
        this.categoryAll = response.data["categoryAll"];
        this.colorAll = response.data["colorAll"];
        this.price = response.data["price"];
        this.description = response.data["description"];
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>
