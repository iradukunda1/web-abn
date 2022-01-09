<template>
    <div>
        <div class="card">
            <div class="card-body table-responsive">
                <br />
                <table
                    class="table table-stripped"
                    v-if="users.length > 0"
                    style="width: 100%"
                >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Phone_Number</th>
                            <th>Names</th>
                            <th>Country</th>
                            <th>Province</th>
                            <th>District</th>
                            <th>Verified</th>
                            <th>Created</th>
                            <th>Modify</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users" :key="user.id">
                            <td>{{ index + 1 }}</td>
                            <td>
                                {{ user.email }}
                            </td>
                            <td>{{ user.phone_number }}</td>
                            <td class="text-capitalize">
                                {{ user.first_name + "  " + user.last_name }}
                            </td>
                            <td>{{ user.country }}</td>
                            <td :class="user.user_address != null && user.user_address.province ? '' :'text-danger'">{{ user.user_address != null && user.user_address.province != null ? user.user_address.province : 'not-set'    }}</td>
                            <td :class="user.user_address != null && user.user_address.district ? '' :'text-danger'">{{ user.user_address != null && user.user_address.district != null ? user.user_address.district : 'not-set'    }}</td>

                            <td>
                                <a
                                    href="#"
                                    @click="changeVerified(user)"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    :title="
                                        user.verified != 0
                                            ? 'Click To Remove From Verified User'
                                            : 'Click To Add To Verified User'
                                    "
                                >
                                    <span
                                        class="badge text-white"
                                        :class="
                                            user.verified != 0
                                                ? 'badge-success'
                                                : 'badge-warning'
                                        "
                                        >{{
                                            user.verified != 0
                                                ? "Verified"
                                                : "Un-verified"
                                        }}</span
                                    >
                                </a>
                            </td>
                            <td>{{ user.created_at }}</td>
                            <td>
                                <a
                                    href="#"
                                    class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"
                                    @click="deleteUser(user)"
                                    ><i
                                        class="feather icon-trash btn-icon-wrapper"
                                    >
                                    </i
                                ></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="alert alert-info" v-else>No District Management List yet</div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "User",
    data() {
        return {
            users: [],
            updateMode: false,
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
        loadUsers() {
            axios.get("/admin/api/users?role=reporter_2").then((resp) => {
                this.users = resp.data;
            });
        },
        deleteUser(user) {
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
                        .delete("/admin/api/user/" + user.id)
                        .then((resp) => {
                            this.$Progress.finish();
                            const index = this.users.findIndex(
                                (s) => s.id === user.id
                            );
                            this.users.splice(index, 1);
                            this.$swal(
                                "Deleted!",
                                "User has been deleted.",
                                "success"
                            );
                        })
                        .catch((err) => {
                            this.$Progress.fail();
                            this.$swal(
                                "Error!",
                                "Problem while deleting.",
                                "error"
                            );
                        });
                }
            });
        },
        changeVerified(user) {
            this.$swal({
                title: "Are you sure?",
                text: `The user ${user.first_name} will be ${
                    user.verified ? "un" : ""
                }verified are you sure?`,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: `Yes, ${user.verified ? "un" : ""}verify!`,
            }).then((result) => {
                if (result.value) {
                    this.$Progress.start();
                    axios
                        .put("/admin/api/user/verify/" + user.id, {
                            verified: !user.verified,
                        })
                        .then((resp) => {
                            this.$Progress.finish();
                            const index = this.users.findIndex(
                                (s) => s.id === user.id
                            );
                            this.users[index].verified = resp.data.verified;
                            this.$swal(
                                "Updated!",
                                "User has been Updated.",
                                "success"
                            );
                        })
                        .catch((err) => {
                            this.$Progress.fail();
                            this.$swal(
                                "Error!",
                                "Problem while updating.",
                                "error"
                            );
                        });
                }
            });
        }
    },
    created() {
        this.loadUsers();
    },
};
</script>
