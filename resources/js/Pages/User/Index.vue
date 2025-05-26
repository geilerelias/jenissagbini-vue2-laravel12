<template>
    <app-layout>
        <bread-crumbs name="Users" :items="items"></bread-crumbs>

        <v-container class="d-flex justify-center">
            <div>
                <v-data-table
                    v-model="selectedUser"
                    :headers="headers"
                    :items="data"
                    sort-by="name"
                    :search="search"
                    class="elevation-1"
                    single-select
                    single-expand
                    show-select
                    show-expand
                >
                    <template v-slot:top>
                        <v-toolbar
                            flat
                        >
                            <v-text-field
                                class="mr-3"
                                v-model="search"
                                append-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                            ></v-text-field>
                            <v-divider
                                class="mx-4"
                                inset
                                vertical
                            ></v-divider>
                            <v-spacer></v-spacer>
                            <inertia-link :href="route('user.create')">
                                <v-btn
                                    color="primary"
                                    dark
                                    class="mb-2"
                                >
                                    New Item
                                </v-btn>
                            </inertia-link>
                        </v-toolbar>
                    </template>

                    <template v-slot:item.profile_photo_url="{ item }">
                        <div class="d-flex align-center py-4">
                            <v-btn
                                fab
                                dark
                                text
                                small
                            >
                                <v-img style="max-height: 35px;max-width: 35px" class="rounded-circle" cover
                                       :src="item.profile_photo_url"
                                       :alt="item.name"></v-img>
                            </v-btn>
                        </div>
                    </template>

                    <template v-slot:expanded-item="{ headers, item }">
                        <td :colspan="headers.length">
                            established roles:
                            <v-chip v-for="role in item.roles" :key="role.id"
                                    class="ma-2 white--text"
                                    color="indigo"
                                    small
                            >
                                {{ role }}
                            </v-chip>
                        </td>
                    </template>

                    <template v-slot:no-data>
                        <v-btn
                            color="primary"
                            @click="initialize"
                        >
                            Reset
                        </v-btn>
                    </template>
                </v-data-table>
            </div>
        </v-container>


        <v-container>
            <v-card>
                <v-toolbar flat>
                    <v-toolbar-title>Roles</v-toolbar-title>
                    <v-spacer></v-spacer>

                    <span v-if="selectedUser.length>0">selected User {{ selectedUser[0].name }}</span>
                    <span v-else> User not selected</span>

                </v-toolbar>
                <v-banner
                    single-line
                >
                    choose the Roles for the selected role.

                    <template v-slot:actions>
                        <v-btn
                            text
                            color="deep-purple accent-4"
                            @click="grantRoles"
                            :loading="loading"
                            :disabled="loading"
                        >
                            grant Roles
                        </v-btn>
                    </template>
                </v-banner>
                <v-card-text class="grey lighten-4">
                    <v-sheet
                        max-width="500"
                        class="mx-auto"
                    >
                        <div>
                            <v-data-table
                                v-model="selectedRole"
                                :headers="headersRole"
                                :items="role"
                                sort-by="calories"
                                :search="searchRole"
                                class="elevation-1"
                                show-select
                            >
                                <template v-slot:top>
                                    <v-toolbar
                                        flat
                                    >
                                        <v-text-field
                                            class="mx-auto"
                                            v-model="searchRole"
                                            append-icon="mdi-magnify"
                                            label="Search"
                                            single-line
                                            hide-details
                                        ></v-text-field>
                                    </v-toolbar>
                                </template>
                                <template v-slot:item.actions="{ item }">
                                    <div class="d-flex align-center py-4">
                                        <template v-if="isSelected(item)">
                                            <v-btn icon
                                                   class="primary--text"
                                                   @click="removeRole(item)">
                                                <v-icon>
                                                    mdi-close-circle
                                                </v-icon>
                                            </v-btn>
                                        </template>
                                        <v-btn v-else icon disabled
                                               class="primary--text">
                                            <v-icon>
                                                mdi-close-circle
                                            </v-icon>
                                        </v-btn>

                                    </div>
                                </template>
                            </v-data-table>
                        </div>
                    </v-sheet>
                </v-card-text>
            </v-card>

        </v-container>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import BreadCrumbs from "@/components/BreadCrumbs";

export default {
    name: "User",
    components: {
        AppLayout,
        BreadCrumbs,
    },
    props: ['data', 'errors'],
    data: () => ({
        loading: false,
        headers: [
            {text: 'Photo', value: 'profile_photo_url'},
            {text: 'Name', value: 'name'},
            {text: 'Email', value: 'email'},
            //{text: 'Actions', value: 'actions', sortable: false},
        ],
        headersRole: [
            {
                text: 'Id',
                align: 'start',
                sortable: false,
                value: 'id',
            },
            {text: 'Name', value: 'name'},
            {text: 'Actions', value: 'actions', sortable: false},
        ],
        selectedRole: [],
        search: '',
        items: [
            {
                text: 'Dashboard',
                disabled: false,
                href: '/dashboard',
            },
            {
                text: 'Users',
                disabled: true,
                href: '/user',
            },
        ],
        selectedUser: [],
        role: [],
        searchRole: '',
        users: [],
    }),
    created() {
        axios.get('role/all')
            .then(res => {
                this.role = res.data
            })
            .catch(error => {
                this.$swal(
                    'Opps...!',
                    'Excuse me, an error occurred.',
                    'warning'
                )
            })
        this.users = this.data;
        // console.log(this.users)

        for (const index in this.users) {
            let user = this.users[index];
            // console.log(user)
            axios.get(`/user/${user.id}/roles`)
                .then(res => {
                    //console.log(res.data)
                    this.users[index].roles = res.data;
                })
                .catch(error => {
                    this.$swal(
                        'Opps...!',
                        'Excuse me, an error occurred.',
                        'warning'
                    )
                })
        }

    },
    watch: {
        selectedUser(val) {
            if (val.length > 0) {
                this.selectedRole = [];
                let roles = val[0].roles;

                for (const valKey in roles) {
                    let res = this.role.find(rol => rol.name === roles[valKey]);
                    this.selectedRole.push(res)
                }
            }
            //console.log(this.selectedRole)
        }
    },
    methods: {
        removeRole(item) {
            console.log(item)
            this.$swal({
                title: 'Are you sure you want to delete this item?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
                .then((result) => {
                    if (result.isConfirmed) {
                        let data = {
                            role: item,
                            user: this.selectedUser[0].id
                        }
                        this.$inertia.post('user/remove/roles', data, {
                            onSuccess: (page) => {
                                console.log(page)
                                this.$swal(
                                    'Deleted!',
                                    this.$page.flash.message,
                                    'success'
                                )
                            },
                            onError: (errors) => {
                                this.$swal(
                                    'Opps...!',
                                    'Excuse me, an error occurred.',
                                    'warning'
                                )
                            }
                        })
                        this.$nextTick(() => {
                            this.editedItem = Object.assign({}, this.defaultItem)
                            this.editedIndex = -1
                        })
                    }
                })
        },
        isSelected(item) {
            var idx = this.selectedRole.indexOf(item);
            if (idx != -1) {
                return true;
            } else {
                return false;
            }
        },
        grantRoles() {
            if (this.selectedUser.length > 0) {

                console.log('selectedRole', this.selectedRole.length)


                if (this.selectedRole.length > 0) {
                    let roleArray = [];
                    for (let i = 0; i < this.selectedRole.length; i++) {
                        // console.log(this.selectedPermission[i])
                        roleArray.push(this.selectedRole[i].name)
                    }

                    let data = {user: this.selectedUser[0].id, role: roleArray};
                    this.$inertia.post('/user/assign/roles', data, {
                        onStart: (visit) => {
                            console.log('onStart', visit)
                            this.loading = true;
                        },
                        onSuccess: (page) => {
                            this.$swal({
                                icon: `${page.props.errors.name ? 'error' : 'success'}`,
                                title: `${page.props.errors.name ? 'Oops...' : 'Good job!'}`,
                                text: `${page.props.errors.name ? page.props.errors.name[0] : page.props.flash.message}`
                            })
                        },
                        onError: (errors) => {
                            this.$swal(
                                'Opps...!',
                                'Excuse me, an error occurred.',
                                'warning'
                            )
                        },
                        onFinish: visit => {
                            this.loading = false;
                        },
                    })
                } else {
                    this.$swal(
                        'Opps...!',
                        'you must select a rol.',
                        'warning'
                    )
                }

            } else {
                this.$swal(
                    'Opps...!',
                    'you must select a user.',
                    'warning'
                )
            }
        },
        initialize() {
            location.reload();
        }
    },
}
</script>

<style scoped>

</style>
