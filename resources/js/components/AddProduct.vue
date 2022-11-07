<template>
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between pb-2 mb-2">
        <h5 class="card-title">Add New Product</h5>
        <div>
          <router-link :to="{ name: 'products' }" class="btn btn-success"
            >Go Back</router-link
          >
        </div>
      </div>

      <div
        v-if="success"
        class="alert alert-success alert-dismissible fade show"
        role="alert"
      >
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"
        ></button>
        <strong>{{ success }}</strong>
      </div>

      <div
        v-if="error"
        class="alert alert-danger alert-dismissible fade show"
        role="alert"
      >
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"
        ></button>
        <strong>{{ error }}</strong>
      </div>

      <form @submit.prevent="submitForm" enctype="multipart/form-data">
        <div class="form-group mb-2">
          <label>Name</label><span class="text-danger"> *</span>
          <input
            type="text"
            class="form-control"
            v-model="name"
            placeholder="Enter Product Name"
          />
        </div>
        <div class="form-group mb-2">
          <label>Price</label><span class="text-danger"> *</span>
          <input
            type="text"
            class="form-control"
            v-model="price"
            placeholder="Enter Price"
          />
        </div>

        <div class="form-group mb-2">
          <label>Select Category</label><span class="text-danger"> *</span>
          <div
            class="form-group form-group-check-box mb-2"
            v-for="category in categoryList"
            :key="category.id"
          >
            <input
              type="checkbox"
              v-model="categoryId"
              v-bind:value="category.id"
            />
            <label> {{ category.categoryName }}</label>
          </div>
        </div>
        <div class="form-group mb-2">
          <label>Select Color</label><span class="text-danger"> *</span>
          <div
            class="form-group mb-2"
            v-for="color in colorList"
            :key="color.id"
          >
            <input
              class="form-group-check-box"
              type="checkbox"
              v-model="colorId"
              v-bind:value="color.id"
            />
            <label> {{ color.colorName }}</label>
          </div>
        </div>
        <div class="form-group mb-2">
          <label>Description</label><span class="text-danger"> *</span>

          <textarea
            type="text"
            class="form-control"
            v-model="description"
            cols="20"
            rows="5"
          >
          </textarea>
        </div>

        <div class="form-gorup mb-2">
          <label>Imagee</label><span class="text-danger"> *</span>
          <input
            id="upload-file"
            type="file"
            multiple
            class="form-control"
            @change="fieldChange"
          />
        </div>

        <button type="submit" class="btn btn-primary mt-4 mb-4">
          Add Post
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categoryList: [],
      colorList: [],
      name: "",
      price: "",
      description: "",
      categoryId: [],
      colorId: [],
      img: [],
      success: "",
      error: "",
      imgPreview: null,
    };
  },
  created() {
    this.$axios.get("/sanctum/csrf-cookie").then((response) => {
      this.$axios
        .get("/api/category/category")
        .then((response) => {
          console.log(response.data);
          this.categoryList = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      this.$axios
        .get("/api/color/color")
        .then((response) => {
          console.log(response.data);
          this.colorList = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    });
  },
  methods: {
    fieldChange(e) {
      let selectedFiles = e.target.files;

      if (!selectedFiles.length) {
        return false;
      }

      for (let i = 0; i < selectedFiles.length; i++) {
        this.img.push(selectedFiles[i]);
      }
    },
    submitForm(e) {
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        let thisObj = this;
        const config = {
          headers: {
            "content-type": "multipart/form-data",
          },
        };

        const formData = new FormData();
        for (let i = 0; i < this.img.length; i++) {
          formData.append("file[]", this.img[i]);
        }
        formData.append("name", this.name);
        formData.append("categoryId", this.categoryId);
        formData.append("colorId", this.colorId);
        formData.append("price", this.price);
        formData.append("description", this.description);

        this.$axios
          .post("/api/products/store", formData, config)
          .then((response) => {
            console.log(response.data);
            thisObj.error = "";
            thisObj.success = response.data.success;
            this.name = "";
            this.categoryId = "";
            this.colorId = "";
            this.price = "";
            this.img = "";
            this.description = "";
          })
          .catch(function (error) {
            thisObj.success = "";
            thisObj.error = error.response.data.message;
          });
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