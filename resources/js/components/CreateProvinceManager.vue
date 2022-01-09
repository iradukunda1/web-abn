<template>
    <form @submit.prevent="submit">
        <div class="form-row">
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
                <label>Email</label>
                <input
                    type="email"
                    require="true"
                    class="form-control"
                    v-model.trim="form.email"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                />
                <has-error :form="form" field="email"></has-error>
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
                <label>Phone Number</label>
                <input
                    type="number"
                    class="form-control"
                    v-model.trim="form.phone_number"
                    :class="{ 'is-invalid': form.errors.has('phone_number') }"
                />
                <has-error :form="form" field="phone_number"></has-error>
            </div>

            <div
                class="form-group col-md-12"
                v-if="
                    form.first_name.length != 0 &&
                    form.last_name.length != 0 &&
                    form.email.length != 0 &&
                    form.province.length != 0
                "
            >
                <button class="btn btn-primary float-right">Submit</button>
            </div>
        </div>
    </form>
</template>

<script>
import Multiselect from "vue-multiselect";
import { Form } from "vform";

const { Provinces } = require("rwanda");
export default {
    data() {
        return {
            tags: [],
            Provinces,
            form: new Form({
                first_name: "",
                phone_number: "",
                last_name: "",
                email: "",
                country: "rwanda",
                province: "",
            }),
        };
    },
    methods: {
        changeProvince() {},
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

        submit() {
            this.$Progress.start();
            this.form
                .post("/admin/user/province/store")
                .then((resp) => {
                    this.$Progress.finish();
                    this.form.clear();
                    this.form.reset();
                    this.toast("Congratulations", resp.data, "success");
                    window.location.href = "/admin/user/province";
                })
                .catch(() => {
                    this.$Progress.fail();
                    this.toast(
                        "Unable To Submit",
                        "Error While Creating Province manager",
                        "error"
                    );
                });
        },
    },
    computed: {
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
