<template>
    <div class="card">
        <div class="card-body border-top-0">
            <div class="mt-4">
                <form
                    @submit.prevent="submitForm"
                    enctype="multipart/form-data"
                >
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input
                                type="text"
                                class="form-control text-capitalize"
                                :value="form.first_name + ' ' + form.last_name"
                                required
                                Readonly
                                :class="{
                                    'is-invalid': form.errors.has('first_name'),
                                }"
                            />
                            <has-error
                                :form="form"
                                field="first_name"
                            ></has-error>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Email</label>
                            <input
                                type="email"
                                class="form-control"
                                required
                                Readonly
                                v-model="form.email"
                                :class="{
                                    'is-invalid': form.errors.has('email'),
                                }"
                            />
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Phone Number</label>
                            <input
                                type="tel"
                                class="form-control"
                                required
                                Readonly
                                v-model="form.phone_number"
                                :class="{
                                    'is-invalid':
                                        form.errors.has('phone_number'),
                                }"
                            />
                            <has-error
                                :form="form"
                                field="phone_number"
                            ></has-error>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Country</label>
                            <select
                                required
                                readonly
                                v-model="form.country"
                                :class="{
                                    'is-invalid': form.errors.has('country'),
                                }"
                                class="form-control"
                            >
                                <option selected disabled>{{form.country}}</option>
                            </select>
                            <has-error :form="form" field="country"></has-error>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Province</label>
                            <select
                                type="text"
                                class="form-control border cursor-pointer"
                                :class="{
                                    'is-invalid': form.errors.has('province'),
                                }"
                                v-model.trim="form.province"
                                @change="changeProvince"
                            >
                                <option selected value="" disabled>
                                    Choose Province
                                </option>
                                <option
                                    v-for="(province, index) in provinces"
                                    v-bind:value="province"
                                    :key="index"
                                >
                                    {{ province }}
                                </option>
                            </select>
                            <has-error
                                :form="form"
                                field="province"
                            ></has-error>
                        </div>
                        <div class="form-group col-md-4">
                            <label>District</label>
                            <select
                                type="text"
                                class="form-control border cursor-pointer"
                                v-model="form.district"
                                :class="{
                                    'is-invalid': form.errors.has('district'),
                                }"
                                @change="changeDistrict"
                                :disabled="form.province == ''"
                            >
                                <option selected value="" disabled>
                                    Choose District
                                </option>
                                <option
                                    v-for="(district, index) in districts"
                                    v-bind:value="district"
                                    :key="index"
                                >
                                    {{ district }}
                                </option>
                            </select>
                            <has-error
                                :form="form"
                                field="district"
                            ></has-error>
                        </div>
                        <div class="form-group col-md-4">
                            <label>sector</label>
                            <select
                                type="text"
                                class="form-control border cursor-pointer"
                                v-model.trim="form.sector"
                                :class="{
                                    'is-invalid': form.errors.has('sector'),
                                }"
                                @change="changeSector"
                                :disabled="form.district == ''"
                            >
                                <option selected value="" disabled>
                                    Choose Sector
                                </option>
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
                        <div class="form-group col-md-8">
                            <button
                                type="submit"
                                :disabled="form.busy"
                                class="btn btn-primary float-right"
                                v-if="form.province && form.district && form.sector"
                            >
                                {{ form.busy ? "Submitting..." : "Update" }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from "vform";
const { Provinces, Districts, Sectors, Cells, Villages } = require("rwanda");

export default {
    name: "UserProfile",
    data() {
        return {
            user: {},
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
                id: "",
                email: "",
                phone_number: "",
                first_name: "",
                last_name: "",
                country: "rwanda",
                province:"",
                district:"",
                sector:""
            }),
        };
    },
    methods: {
        submitForm() {
            this.$Progress.start();
            this.form.busy = true;
            let config = { headers: { "Content-Type": "multipart/form-data" } };
            let data = new FormData();
            data.append("email", this.form.email);
            data.append("phone_number", this.form.phone_number);
            data.append("country", this.form.country);
            data.append("first_name", this.form.first_name);
            data.append("last_name", this.form.last_name);
            data.append("province", this.form.province);
            data.append("district", this.form.district);
            data.append("sector", this.form.sector);

            axios
                .post("/complete/profile/store/" + this.form.id, data, config)
                .then((resp) => {
                    this.form.busy = false;
                    window.location = "/agent";
                })
                .catch((err) => {
                    this.$Progress.fail();
                    this.form.busy = false;
                    if (err.response.status === 422) {
                        this.form.errors.set(err.response.data);
                    }
                    if (err.response.status === 400) {
                        this.oldError = "Wrong Old Password";
                    }
                });
        },
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
    },
    computed: {
        provinces() {
            return this.Provinces();
        },
    },

    created() {
        axios.get("/api/user").then((resp) => {
            this.user = resp.data.user;
            this.form.fill(this.user);
        });
    },
};
</script>

<style scoped></style>
