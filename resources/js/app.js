import VueProgressBar from "vue-progressbar";
import { Form, HasError, AlertError } from "vform";
import VueSweetalert2 from "vue-sweetalert2";
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import VModal from "vue-js-modal";
import InputTag from "vue-input-tag";

Vue.use(VModal);

require("./bootstrap");
Vue.use(VueSweetalert2);
import VueLazyload from "vue-lazyload";

Vue.use(VueLazyload);

Vue.use(VueProgressBar, {
    color: "#21cde4",
    failedColor: "#d33",
    height: "10px",
    thickness: "10px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300,
    },
});
require("./bootstrap");

Vue.component(AlertError.name, AlertError);
Vue.component(HasError.name, HasError);
Vue.component("app-user", User);
Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component("app-create-product", CreateProduct);
Vue.component("app-create-merchant", CreateMerchant);
Vue.component("app-category", Category);
Vue.component("input-tag", InputTag);
Vue.component("app-edit-product", EditProduct);
Vue.component("app-image", Image);
Vue.component("app-user-profile", UserProfile);
Vue.component("app-bussiness-category", BussinessCategory);
Vue.component("app-edit-merchant", EditMerchant);
Vue.component("app-products-list-card", ProductListCard);
Vue.component("app-province", ProvinceManager);
Vue.component("app-district", DistrictManager);
Vue.component("app-user-province", CreateProvinceManager);
Vue.component("app-user-district", CreateDistrictManager);
Vue.component("app-complete-profile", CompletProfile);
import Vue from "vue";
import User from "./components/User";
import CreateProduct from "./components/CreateProduct";
import CreateMerchant from "./components/CreateMerchant";
import Category from "./components/Category";
import EditProduct from "./components/EditProduct";
import Image from "./components/Image";
import UserProfile from "./components/UserProfile";
import BussinessCategory from "./components/BussinessCategory";
import EditMerchant from "./components/EditMerchant";
import ProductListCard from "./components/ProductListCard";
import ProvinceManager from "./components/ProvinceManager";
import CreateProvinceManager from "./components/CreateProvinceManager";
import CreateDistrictManager from "./components/CreateDistrictManager";
import DistrictManager from "./components/DistrictManager";
import CompletProfile from "./components/CompleteProfile";

const app = new Vue({
    el: "#app",
    data: {
        order_products: null,
        order: null,
        product: null,
    },
    methods: {
        showOrderProducts(order) {
            this.$Progress.start();
            this.order = order;
            axios
                .get("/order/" + order.id)
                .then((resp) => {
                    this.order_products = resp.data.data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            $("#exampleModal").modal("show");
        },
        adminshowOrderProducts(order) {
            this.$Progress.start();
            this.order = order
            axios.get("/admin/order/" + order.id)
                .then(resp => {
                    this.order_products = resp.data.data;
                    this.$Progress.finish()
                })
                .catch(() => {
                    this.$Progress.fail()
                });
            $("#exampleModal").modal("show");
        },
        showHomeModal(product) {
            this.homepage.product = product;
            this.homepage.home_section_id = product.home_section_id ? product.home_section_id : 'none';
            $("#homepageModal").modal("show")
        },
        toast(title, message, type) {
            this.$swal({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 6000,
                type: type ? type : 'success',
                title: title,
                text: message
            });
        },
        deleteProduct(product) {
            this.$swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.value) {
                    this.$Progress.start();
                    axios
                        .delete("/admin/products/" + product.id)
                        .then((resp) => {
                            this.$Progress.finish();
                            this.$swal(
                                "Deleted!",
                                "Product has been deleted Successfully.",
                                "success"
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload(true);
                                    return false;
                                }
                            });
                        })
                        .catch((err) => {
                            this.$Progress.fail();
                            this.$swal(
                                "Deleted!",
                                "Item has been deleted!",
                                "success"
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload(true);
                                    return false;
                                }
                            });
                        });
                }
            });
        },
        deleteMerchant(merchant) {
            this.$swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete!",
            }).then((result) => {
                if (result.value) {
                    this.$Progress.start();
                    axios
                        .delete("/agent/merchants/" + merchant.id)
                        .then((resp) => {
                            this.$Progress.finish();
                            this.$swal(
                                "Deleted!",
                                "Merchant has been deleted Successfully.",
                                "success"
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload(true);
                                    return false;
                                }
                            });
                        })
                        .catch((err) => {
                            this.$Progress.fail();
                            this.$swal(
                                "Deleted!",
                                "Merchant has been deleted!",
                                "success"
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload(true);
                                    return false;
                                }
                            });
                        });
                }
            });
        },
        showModal(product_id) {
            this.product = null;
            this.$Progress.start();
            axios
                .get("/products/details/" + product_id)
                .then((resp) => {
                    this.product = resp.data.data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            $("#productModal").modal("show");
        },
    },
    created() {
        // this.$on("fillAddress", address => {
        //     this.form_buy.address = address
        // })
    },
});
