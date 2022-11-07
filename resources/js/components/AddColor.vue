<template>
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between pb-2 mb-2">
        <h5 class="card-title">Add New Color</h5>
        <div>
          <router-link :to="{ name: 'color' }" class="btn btn-success"
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
          <label>Color Name</label><span class="text-danger"> *</span>
          <input
            type="text"
            class="form-control"
            v-model="colorName"
            placeholder="Enter Product Name"
          />
        </div>

        <button type="submit" class="btn btn-primary mt-4 mb-4">
          Add Color
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      colorName: "",
      success: "",
      error: "",
    };
  },
  created() {
  },
  methods: {
    fieldChange(e) {
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
        formData.append("colorName", this.colorName);

        this.$axios
          .post("/api/color/store", formData, config)
          .then((response) => {
            console.log(response.data);
            thisObj.error = "";
            thisObj.success = response.data.success;
            this.colorName = "";
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