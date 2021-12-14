<template>
  <form @submit.prevent="submit">
    <div class="form-row">
      <div class="form-group col-md-12">
        <label>Title</label>
        <input
          type="text"
          class="form-control"
          v-model="form.title"
          :class="{ 'is-invalid': form.errors.has('title') }"
        />
        <has-error :form="form" field="title"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Maximum Quantity For Customer</label>
        <input
          type="number"
          class="form-control"
          v-model.trim="form.quantity"
          :class="{ 'is-invalid': form.errors.has('quantity') }"
        />
        <has-error :form="form" field="quantity"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Price </label>
        <input
          type="number"
          class="form-control"
          v-model.trim="form.price"
          :class="{ 'is-invalid': form.errors.has('price') }"
        />
        <has-error :form="form" field="price"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Sale Price </label>
        <input
          type="number"
          class="form-control"
          v-model.trim="form.sale_price"
          :class="{ 'is-invalid': form.errors.has('sale_price') }"
        />
        <has-error :form="form" field="sale_price"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Category</label>
        <multiselect
          v-model="form.category"
          track-by="id"
          :allow-empty="false"
          placeholder="Select Category"
          :multiple="false"
          label="name"
          :options="categories"
        ></multiselect>
        <has-error :form="form" field="categories"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Tags (Optional)</label>
        <input-tag
          v-model="form.tags"
          placeholder="tags eg: tanzinia no1, tanzinia no2"
        ></input-tag>
      </div>
      <div class="form-group col-md-12" style="height: 350px;">
        <label>Product Description</label>
        <div class="example">
          <quill-editor
            v-model="form.description"
            style="height: 200px;"
            class="editor"
            :class="{ 'is-invalid': form.errors.has('description') }"
            ref="myQuillEditor"
          ></quill-editor>
        </div>
        <has-error :form="form" field="description"></has-error>
      </div>
      <div
        class="form-group col-md-12"
        v-if="form.category.length != 0 && form.description.trim() != ''"
      >
        <button class="btn btn-primary float-right">Submit</button>
      </div>
    </div>
  </form>
</template>

<script>
import Multiselect from "vue-multiselect";
import { Form } from "vform";
import { VueEditor, Quill } from "vue2-editor";
import { quillEditor } from "vue-quill-editor";

export default {
  name: "CreateProduct",
  components: { Multiselect, VueEditor, quillEditor },
  data() {
    return {
      categories: [],
      tags: [],
      form: new Form({
        title: "",
        price: "",
        sale_price:"",
        quantity: "",
        category: [],
        tags: [],
        description: "",
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
    loadCategories() {
      axios
        .get("/admin/api/category")
        .then((resp) => {
          this.categories = resp.data.data;
        })
        .catch(() => {
          this.toast("Network Error", "Unable To Load Categories", "error");
        });
    },
    submit() {
      this.$Progress.start();
      this.form
        .post("/admin/products")
        .then((resp) => {
          this.$Progress.finish();
          this.form.clear();
          this.form.reset();
          this.toast("Congratulations", resp.data, "success");
          window.location.href = "/admin/products";
        })
        .catch(() => {
          this.$Progress.fail();
          this.toast(
            "Unable To Submit",
            "Error While Submitting Product",
            "error"
          );
        });
    },
  },
  created() {
    this.loadCategories()
  },
  computed: {
    editor() {
      return this.$refs.myQuillEditor.quill;
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss" scoped>
.example {
  display: flex;
  flex-direction: column;

  .output {
    width: 100%;
    height: 20rem;
    margin: 0;
    border: 1px solid #ccc;
    overflow-y: auto;
    resize: vertical;

    &.code {
      padding: 1rem;
      height: 16rem;
    }

    &.ql-snow {
      border-top: none;
      height: 24rem;
    }
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
