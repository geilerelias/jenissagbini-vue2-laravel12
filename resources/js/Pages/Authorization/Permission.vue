<template>
    <app-layout>
        <bread-crumbs name="Permission" :items="items"></bread-crumbs>

        <v-container class="d-flex justify-center">
            <v-card>
                <v-data-table
                    :headers="headers"
                    :items="data"
                    sort-by="calories"
                    :search="search"
                    class="elevation-1"
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
                                                        @keyup.enter="editedIndex === -1?save(editedItem):update(editedItem)"
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
                        >
                            mdi-pencil
                        </v-icon>
                        <v-icon
                            small
                            @click="deleteItem(item)"
                        >
                            mdi-delete
                        </v-icon>
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
            </v-card>
        </v-container>

    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import BreadCrumbs from "@/components/BreadCrumbs";

export default {
    name: "Permission",
    components: {
        AppLayout,
        BreadCrumbs,
    },
    props: ['data', 'errors'],
    data() {
        return {
            editMode: false,
            isOpen: false,
            search: '',
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
                    text: 'Permission',
                    disabled: true,
                    href: '/Permission',
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
    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },
    },

    watch: {
        dialog(val) {
            val || this.close()
        },
    },

    methods: {
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
            this.$inertia.post('/permission/' + data.id, data, {
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
                }
            })
            this.reset();
            this.closeModal();
            this.editMode = false;
            this.close()
        },

        editItem(item) {
            this.editedIndex = this.data.indexOf(item)
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
                    this.$inertia.post('/permission/' + item.id, item, {
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
                        }
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
        },

        save(data) {
            if (this.editedIndex === -1) {

                this.$inertia.post('/permission', data, {
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
                });

            } else {
                this.$inertia.post('/posts/' + data.id, data, {
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
                })
            }

            this.reset();
            this.closeModal();
            this.editMode = false;
            this.close()
        },
        initialize() {
            location.reload();
        }
    }
}
</script>
