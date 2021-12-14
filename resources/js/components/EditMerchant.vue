<template>
  <form @submit.prevent="update">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Bussiness Name</label>
        <input
          type="text"
          class="form-control"
          v-model="form.bussiness_name"
          :class="{ 'is-invalid': form.errors.has('bussiness_name') }"
        />
        <has-error :form="form" field="bussiness_name"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>TIN Number</label>
        <input
          type="number"
          class="form-control"
          v-model="form.tin_number"
          :class="{ 'is-invalid': form.errors.has('tin_number') }"
        />
        <has-error :form="form" field="tin_number"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>First Name</label>
        <input
          type="text"
          class="form-control"
          v-model.trim="form.first_name"
          :class="{ 'is-invalid': form.errors.has('first_name') }"
        />
        <has-error :form="form" field="first_name"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Last Name </label>
        <input
          type="text"
          class="form-control"
          v-model.trim="form.last_name"
          :class="{ 'is-invalid': form.errors.has('last_name') }"
        />
        <has-error :form="form" field="last_name"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Country</label>
        <input
          type="text"
          class="form-control"
          v-model.trim="form.country"
          :class="{ 'is-invalid': form.errors.has('country') }"
        />
        <has-error :form="form" field="country"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Province</label>
        <select
          type="text"
          class="form-control border cursor-pointer"
          :class="{ 'is-invalid': form.errors.has('province') }"
          v-model.trim="form.province"
          @change="changeProvince"
        >
          <option selected value="" disabled>Choose Province</option>
          <option
            v-for="(province, index) in provinces"
            v-bind:value="province"
            :key="index"
          >
            {{ province }}
          </option>
        </select>
        <has-error :form="form" field="province"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>District</label>
        <select
          type="text"
          class="form-control border cursor-pointer"
          v-model="form.district"
          :class="{ 'is-invalid': form.errors.has('district') }"
          @change="changeDistrict"
          :disabled="form.province == ''"
        >
          <option selected value="" disabled>Choose District</option>
          <option
            v-for="(district, index) in districts"
            v-bind:value="district"
            :key="index"
          >
            {{ district }}
          </option>
        </select>
        <has-error :form="form" field="district"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>sector</label>
        <select
          type="text"
          class="form-control border cursor-pointer"
          v-model.trim="form.sector"
          :class="{ 'is-invalid': form.errors.has('sector') }"
          @change="changeSector"
          :disabled="form.district == ''"
        >
          <option selected value="" disabled>Choose Sector</option>
          <option
            v-for="(sector, index) in sectors"
            v-bind:value="sector"
            :key="index"
          >
            {{ sector }}
          </option>
        </select>
        <has-error :form="form" field="sector"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Cell</label>
        <select
          type="text"
          class="form-control border cursor-pointer"
          v-model.trim="form.cell"
          :class="{ 'is-invalid': form.errors.has('cell') }"
          @change="changeCell"
          :disabled="form.sector == ''"
        >
          <option selected value="" disabled>Choose Cell</option>
          <option
            v-for="(cell, index) in cells"
            v-bind:value="cell"
            :key="index"
          >
            {{ cell }}
          </option>
        </select>
        <has-error :form="form" field="cell"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Village</label>
        <select
          type="text"
          class="form-control border cursor-pointer"
          v-model.trim="form.village"
          :class="{ 'is-invalid': form.errors.has('village') }"
          :disabled="form.cell == ''"
        >
          <option selected value="" disabled>Choose Village</option>
          <option
            v-for="(village, index) in villages"
            v-bind:value="village"
            :key="index"
          >
            {{ village }}
          </option>
        </select>
        <has-error :form="form" field="village"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Select your Business Category</label>
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
      <div class="form-group col-md-12" style="height: 350px;">
        <label>Short Details</label>
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
        <button class="btn btn-primary float-right">Update</button>
      </div>
    </div>
  </form>
</template>

<script>
import Multiselect from "vue-multiselect";
import { Form } from "vform";
import { VueEditor, Quill } from "vue2-editor";
import { quillEditor } from "vue-quill-editor";
const { Provinces, Districts, Sectors, Cells, Villages } = require("rwanda");
export default {
  name: "CreateMerchant",
  props: ["merchant", "category"],
  components: { Multiselect, VueEditor, quillEditor },
  data() {
    return {
      categories: [],
      tags: [],
      Provinces,
      Districts,
      Sectors,
      Cells,
      Villages,
      districts: [],
      sectors: [],
      cells: [],
      villages: [],
      form: new Form({
        bussiness_name: "",
        tin_number: "",
        first_name: "",
        last_name: "",
        country: "rwanda",
        district: "",
        cell: "",
        sector: "",
        province: "",
        village: "",
        category: [],
        description: "",
      }),
    };
  },
  methods: {
    changeProvince() {
      this.districts = this.Districts(this.form.province);
    },
    changeDistrict() {
      this.sectors = this.Sectors(this.form.province, this.form.district);
    },
    changeSector() {
      this.cells = this.Cells(
        this.form.province,
        this.form.district,
        this.form.sector
      );
    },
    changeCell() {
      this.villages = this.Villages(
        this.form.province,
        this.form.district,
        this.form.sector,
        this.form.cell
      );
    },
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
    loadBussinessCategories() {
      axios
        .get("/agent/api/bussiness/category")
        .then((resp) => {
          this.categories = resp.data.data;
        })
        .catch(() => {
          this.toast(
            "Network Error",
            "Unable To Load Bussiness Categories",
            "error"
          );
        });
    },
    update() {
      this.$Progress.start();
      this.form
        .put(`/agent/merchants/${this.merchant.id}`)
        .then((resp) => {
          this.$Progress.finish();
          this.form.clear();
          this.form.reset();
          this.toast("Congratulations", resp.data, "success");
          window.location.href = "/agent/merchant/lists";
        })
        .catch(() => {
          this.$Progress.fail();
          this.toast(
            "Unable To Update",
            "Error While Updating Merchant",
            "error"
          );
        });
    },
  },
  created() {
    this.form.fill({
      ...this.merchant,
      category: this.category,
    });
    this.loadBussinessCategories();
    this.districts = this.Districts(this.merchant.province);
    this.sectors = this.Sectors(this.merchant.province, this.merchant.district);
    this.cells = this.Cells(
      this.merchant.province,
      this.merchant.district,
      this.merchant.sector
    );
    this.villages = this.Villages(
        this.merchant.province,
        this.merchant.district,
        this.merchant.sector,
        this.merchant.cell
      );
  },
  computed: {
    editor() {
      return this.$refs.myQuillEditor.quill;
    },
    provinces() {
      return this.Provinces();
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
