<template>
    <app-layout>
        <bread-crumbs name="Roles" :items="items"></bread-crumbs>
        <v-container class="d-flex justify-center">
            <div>
                <v-data-table
                    v-model="selectedRole"
                    :headers="headers"
                    :items="data"
                    sort-by="calories"
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


                            <v-dialog
                                v-model="dialog"
                                max-width="500px"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        color="primary"
                                        dark
                                        class="mb-2"
                                        v-bind="attrs"
                                        v-on="on"
                                        :loading="loadingNewItem"
                                        :disabled="loadingNewItem"
                                    >
                                        New Item
                                    </v-btn>
                                </template>
                                <v-card>
                                    <v-card-title>
                                        <span class="text-h5">{{ formTitle }}</span>
                                    </v-card-title>

                                    <v-card-text>
                                        <v-container>
                                            <v-row>
                                                <v-col
                                                    cols="12"
                                                >
                                                    <v-text-field
                                                        v-model="editedItem.name"
                                                        label="Name"
                                                    ></v-text-field>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </v-card-text>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="close"
                                        >
                                            Cancel
                                        </v-btn>
                                        <v-btn v-if="editedIndex === -1"
                                               color="blue darken-1"
                                               text
                                               @click="save(editedItem)"
                                        >
                                            Save
                                        </v-btn>
                                        <v-btn v-else
                                               color="blue darken-1"
                                               text
                                               @click="update(editedItem)"
                                        >
                                            update
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-toolbar>
                    </template>


                    <template v-slot:item.actions="{ item }">
                        <v-icon
                            small
                            class="mr-2"
                            @click="editItem(item)"
                            :loading="loadingEditItem"
                            :disabled="loadingEditItem"
                        >
                            mdi-pencil
                        </v-icon>
                        <v-icon
                            small
                            @click="deleteItem(item)"
                            :loading="loadingDeleteItem"
                            :disabled="loadingDeleteItem"
                        >
                            mdi-delete
                        </v-icon>
                    </template>

                    <template v-slot:expanded-item="{ headers, item }">
                        <td :colspan="headers.length">
                            established permissions:
                            <v-chip v-for="permission in item.permission" :key="permission.id"
                                    class="ma-2 white--text"
                                    color="indigo"
                                    small
                            >
                                {{ permission.name }}
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
                    <v-toolbar-title>Permission</v-toolbar-title>
                    <v-spacer></v-spacer>

                    <span v-if="selectedRole.length>0">selected role {{ selectedRole[0].name }}</span>
                    <span v-else> role not selected</span>

                </v-toolbar>
                <v-banner
                    single-line
                >
                    choose the permissions for the selected role.

                    <template v-slot:actions>
                        <v-btn
                            text
                            color="deep-purple accent-4"
                            @click="grantPermissions"
                            :loading="loading"
                            :disabled="loading"

                        >
                            grant permissions
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
                                v-model="selectedPermission"
                                :headers="headersPermission"
                                :items="permission"
                                sort-by="calories"
                                :search="searchPermission"
                                class="elevation-1"
                                show-select
                            >
                                <template v-slot:top>
                                    <v-toolbar
                                        flat
                                    >
                                        <v-text-field
                                            class="mx-auto"
                                            v-model="searchPermission"
                                            append-icon="mdi-magnify"
                                            label="Search"
                                            single-line
                                            hide-details
                                        ></v-text-field>
                                    </v-toolbar>
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
    components: {
        AppLayout,
        BreadCrumbs,
    },
    props: ['data', 'errors'],
    data() {
        return {
            loadingNewItem: false,
            loadingEditItem: false,
            loadingDeleteItem: false,
            selectedRole: [],
            selectedPermission: [],
            //role: [],
            permission: [],
            editMode: false,
            isOpen: false,
            search: '',
            searchPermission: '',
            form: {
                id: null,
                name: null,
            },
            items: [
                {
                    text: 'Dashboard',
                    disabled: false,
                    href: '/dashboard',
                },
                {
                    text: 'Roles',
                    disabled: true,
                    href: '/roles',
                },
            ],
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: 'Id',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },
                {text: 'Name', value: 'name'},
                {text: 'Actions', value: 'actions', sortable: false},
            ],
            loading: false,
            headersPermission: [
                {
                    text: 'Id',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },
                {text: 'Name', value: 'name'},
            ],
            desserts: [],
            editedIndex: -1,
            editedItem: {
                name: '',
            },
            defaultItem: {
                name: '',
            },
        }
    },
    created() {
        for (let i = 0; i < this.data.length; i++) {
            axios.get(`/role/${this.data[i].id}/permissions`)
                .then(res => {
                    this.data[i].permission = res.data
                })
                .catch(error => {
                    this.$swal(
                        'Opps...!',
                        'Excuse me, an error occurred.',
                        'warning'
                    )
                })

        }

        axios.get('permission/all')
            .then(res => {
                this.permission = res.data
            })
            .catch(error => {
                this.$swal(
                    'Opps...!',
                    'Excuse me, an error occurred.',
                    'warning'
                )
            })
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },
    },

    watch: {
        selectedRole(val) {
            if (val.length > 0) {
                //console.log('selected Rol', val[0])
                this.selectedPermission = [];
                let permissions = val[0].permission;
                // console.log(permissions);
                //console.log(this.permission);

                for (const valKey in permissions) {
                    let res = this.permission.find(item => item.name === permissions[valKey].name);
                    this.selectedPermission.push(res)
                }

                //console.log(this.selectedPermission)
            }
        },

        dialog(val) {
            val || this.close()
        },
    },

    methods: {
        grantPermissions() {
            if (this.selectedRole.length > 0) {
                if (this.selectedPermission.length > 0) {
                    let permissionArray = [];
                    for (let i = 0; i < this.selectedPermission.length; i++) {
                        // console.log(this.selectedPermission[i])
                        permissionArray.push(this.selectedPermission[i].name)
                    }

                    let data = {role: this.selectedRole[0].id, permission: permissionArray};
                    this.$inertia.post('/role/assign/permissions', data, {
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
                        'you must select a permission.',
                        'warning'
                    )
                }
            } else {
                this.$swal(
                    'Opps...!',
                    'you must select a role.',
                    'warning'
                )
            }
        },
        closeModal: function () {
            this.isOpen = false;
            this.reset();
            this.editMode = false;
        },

        reset() {
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        update(data) {
            data._method = 'PUT';
            this.$inertia.post('/role/' + data.id, data, {
                onStart: (visit) => {
                    this.loadingEditItem = true;
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
                    this.loadingEditItem = false;
                },
            })
            this.reset();
            this.closeModal();
            this.editMode = false;
            this.close()
        },

        editItem(item) {
            this.editedIndex = this.data.indexOf(item)
            console.log(this.editedIndex)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            item._method = 'DELETE';
            this.$swal({
                title: 'Are you sure you want to delete this item?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.post('/role/' + item.id, item, {
                        onStart: (visit) => {
                            this.loadingDeleteItem = true;
                        },
                        onSuccess: (page) => {
                            this.$swal(
                                'Deleted!',
                                'Your item has been deleted.',
                                'success'
                            )
                        },
                        onError: (errors) => {
                            this.$swal(
                                'Opps...!',
                                'Excuse me, an error occurred.',
                                'warning'
                            )
                        },
                        onFinish: visit => {
                            this.loadingDeleteItem = false;
                        },
                    })
                    this.$nextTick(() => {
                        this.editedItem = Object.assign({}, this.defaultItem)
                        this.editedIndex = -1
                    })
                }
            })

            this.reset();
        },


        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        }
        ,

        save(data) {
            if (this.editedIndex === -1) {
                console.log('save')
                this.$inertia.post('/role', data, {

                    onStart: (visit) => {
                        this.loadingNewItem = true;
                    },
                    onSuccess: (page) => {
                        this.$swal({
                            icon: `${page.props.errors.name ? 'error' : 'success'}`,
                            title: `${page.props.errors.name ? 'Oops...' : '¡Buen trabajo!'}`,
                            text: `${page.props.errors.name ? page.props.errors.name[0] : page.props.flash.message}`
                        })
                    },
                    onError: (errors) => {
                        console.log(errors)
                        this.$swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: this.errors.errors.name[0],
                        })
                    },
                    onFinish: visit => {
                        this.loadingNewItem = false;
                        this.reset();
                        this.closeModal();
                        this.editMode = false;
                        this.close()
                    },
                });
            } else {
                console.log('update')
                this.$inertia.put('/posts/' + data.id, data, {
                    onSuccess: (page) => {
                        console.log(page)
                        this.$swal({
                            icon: `${page.props.errors.name ? 'error' : 'success'}`,
                            title: `${page.props.errors.name ? 'Oops...' : '¡Buen trabajo!'}`,
                            text: `${page.props.errors.name ? page.props.errors.name[0] : page.props.flash.message}`
                        })
                    },
                    onError: (errors) => {
                        console.log(errors)
                        this.$swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: this.errors.errors.name[0],
                        })
                    },
                    onFinish: visit => {
                        this.reset();
                        this.closeModal();
                        this.editMode = false;
                        this.close()
                    },

                })
            }


        }
        ,
        initialize() {
            location.reload();
        }
    }
}
</script>
