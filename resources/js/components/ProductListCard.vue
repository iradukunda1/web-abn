<template>
  <div class="product-list-container">
    <div class="product-list-container" v-if="!disableProductList">
      <input
        type="search"
        v-model="searchInput"
        class="search-input px-3 rounded form-control mb-3 w-25 ml-auto"
        :placeholder="placeholder"
      />
      <div v-if="filteredProducts && filteredProducts.length > 0">
        <div
          class="container border rounded cursor-pointer px-0 mb-3 bg-gray"
          v-for="(product, index) in filteredProducts"
          :key="product.title + index"
          @mouseover="showCheckBox(product)"
          @mouseleave="hideCheckBox"
        >
          <div class="col-md-12 col-lg-12 px-0">
            <div class="row mx-0 w-100">
              <div class="col-xs-12 col-sm-5 col-md-3 px-0">
                <div class="post-type post-img w-100" style="height: 10em;">
                  <a href="#"
                    ><img
                      :src="product.product_image"
                      class="img-responsive d-block w-100 h-100"
                      :alt="product.title"
                      style="object-fit: fill;"
                  /></a>
                </div>
              </div>
              <div class="col-xs-12 col-md-9 col-sm-7">
                <div class="caption">
                  <h3 class="md-heading">
                    <a href="#" class="font-weight-bold">{{
                      product.title.slice(0, 70) + "..."
                    }}</a>
                  </h3>
                  <p v-html="product.description.slice(0, 100) + '....'"></p>
                  <div class="row mx-0 w-100 justify-content-between">
                    <div>
                      <b>Sale Price:</b>
                      <p class="badge ml-2 fa-1x mb-0">
                        {{ product.sale_price }} Rfw
                      </p>
                      <br />
                      <b>Purchased Price:</b>
                      <p class="badge ml-2 fa-1x mb-0">
                        {{ product.price }} Rfw
                      </p>
                    </div>
                    <input
                      type="checkbox"
                      class="select-product bg-info"
                      :value="product"
                      size="lg"
                      v-model="selectedProducts"
                      style="cursor: pointer;"
                      v-show="product.quantity > 0"
                      title="select product to be included in request"
                    />
                    <a
                      class="btn bg-primary border rounded btn h-100 ml-auto mb-2"
                      href="#"
                      role="button"
                      @click.self="details(product.id)"
                      >View Details</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="bg-danger">
        <p class="alert-danger fa-2x text-center">No available products</p>
      </div>
      <button
        class="btn btn-primary float-right"
        v-if="selectedProducts && selectedProducts.length > 0"
        @click="submitProduc"
      >
        Submit-Request
      </button>
    </div>
    <div class="request-form-container" v-else>
      <form @submit.prevent="submit">
        <div
          class="form-row"
          v-if="selectedProducts && selectedProducts.length > 0"
        >
          <div
            class="selected-order-products col-md-10 mb-3"
            v-for="(product, index) in selectedProducts"
            :key="product.title + index"
          >
            <div class="form-group col-md-12">
              <label>Title</label>
              <input
                type="text"
                class="form-control"
                v-model="product.title"
                disabled
              />
            </div>
            <div class="form-group col-md-8">
              <label>Price</label>
              <input
                type="text"
                class="form-control"
                v-model="product.sale_price"
                disabled
              />
            </div>
            <div class="form-group col-md-8">
              <label>Available Quantity</label>
              <input
                type="number"
                class="form-control"
                v-model="product.quantity"
                disabled
              />
            </div>
            <div class="form-group col-md-6">
              <label>Required Quantity</label>
              <input
                type="number"
                class="form-control"
                v-model.number="product.request_quantity"
                :placeholder="`Quantity Required for product No.${index + 1}`"
                autocomplete="off"
                required
                :max="`${product.quantity}`"
                min=1
              />
            </div>
            <div class="row">
              <div class="col-md-12">
                <button
                  class="btn btn-danger float-right"
                  @click="removeProduct(index)"
                  :disabled="selectedProducts.length <= 1"
                  :class="{ 'd-none': selectedProducts.length <= 1 }"
                  type="button"
                >
                  Remove Product
                </button>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12 border-top">
            <label>Select Merchant By Bussiness Name</label>
            <multiselect
              v-model="form.merchant"
              track-by="id"
              :allow-empty="false"
              placeholder="Select Merchant"
              :multiple="false"
              label="bussiness_name"
              :options="merchants"
            ></multiselect>
            <has-error :form="form" field="merchants"></has-error>
          </div>
          <div class="form-group col-md-12">
            <button
              class="btn btn-primary float-right"
              type="submit"
              v-if="form.merchant.length !=0 && selectedProducts.length != 0"
            >
              Submit Order
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import Multiselect from "vue-multiselect";
import { Form } from "vform";
export default {
  components: { Multiselect },
  props: ["products"],
  name: "ProductListCard",
  data() {
    return {
      placeholder: "⌕ search here please ...",
      searchInput: null,
      selected: "not-defined",
      selectedProducts: [],
      disableProductList: false,
      merchants: [],
      form: new Form({
        quantity: "",
        merchant: [],
        products: [],
      }),
    };
  },
  methods: {
    toast(title, message, type) {
      this.$swal({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 6000,
        type: type ? type : "success",
        title: title,
        text: message,
      });
    },
    removeProduct(index) {
      this.selectedProducts.splice(index, 1);
    },
    loadMerchants() {
      axios
        .get("/agent/merchants")
        .then((resp) => {
          this.merchants = resp.data.data;
        })
        .catch(() => {
          this.toast("Network Error", "Unable To Load Merchants", "error");
        });
    },
    submit() {
      this.form.products.push(this.selectedProducts);
      this.$Progress.start();
      this.form
        .post("/agent/orders")
        .then((resp) => {
          this.$Progress.finish();
          this.form.clear();
          this.form.reset();
          this.toast("Congratulations", resp.data, "success");
          window.location=""
        })
        .catch(() => {
          this.$Progress.fail();
          this.toast(
            "Unable To Submit Order",
            "Error While Submitting Order",
            "error"
          );
        });
    },
    details(id) {
      this.$emit("product-details", id);
    },
    showCheckBox(product) {
      this.selected = product.slug;
    },
    hideCheckBox() {
      this.selected = "not-undefined";
    },
    submitProduc() {
      this.loadMerchants();
      this.disableProductList = true;
    },
  },
  computed: {
    filteredProducts() {
      if (this.searchInput != undefined) {
        return this.products.filter((product) => {
          return (
            (product.title &&
              product.title
                .toLowerCase()
                .includes(this.searchInput.toLowerCase())) ||
            (product.tags &&
              product.tags.includes(this.searchInput.toLowerCase())) ||
            (product.description &&
              product.description
                .toLowerCase()
                .includes(this.searchInput.toLowerCase()))
          );
        });
      } else {
        return this.products;
      }
    },
  },
  watch: {
    selectedProducts() {
      if (this.selectedProducts.length < 0) {
        this.disableProductList = false;
      }
    },
  },
  mounted() {
    this.loadMerchants();
  },
};
</script>
<style lang="scss">
@media screen and (max-width: 768px) {
  .search-input {
    width: 90% !important;
  }
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type="number"] {
  -moz-appearance: textfield;
}
</style>