<template>
    <app-layout>
        <bread-crumbs name="Dashboard" :items="items"></bread-crumbs>

        <v-container class="mt-5">
            <v-row class="row">
                <v-col class="col col-12">
                    <v-row class="row">
                        <v-col class="py-0 mb-7 col-sm-6 col-lg-3 col-12">
                            <v-card class="v-card v-sheet theme--light">
                                <v-card-text class="pa-5">
                                    <div class="d-flex align-center">
                                        <v-btn
                                            contained
                                            fab
                                            round
                                            dark
                                            class="elevation-0 info"
                                        >
                                            <v-icon dark> mdi-wallet </v-icon>
                                        </v-btn>
                                        <div class="ml-2 mr-1">
                                            <h2
                                                class="headline font-weight-light"
                                            >
                                                $3249
                                            </h2>
                                            <h5
                                                class="subtitle-2 font-weight-regular"
                                            >
                                                Total Revenue
                                            </h5>
                                        </div>
                                    </div>
                                </v-card-text>
                            </v-card>
                        </v-col>

                        <div
                            revenuecard="[object Object]"
                            class="py-0 mb-7 col-sm-6 col-lg-3 col-12"
                        >
                            <div class="v-card v-sheet theme--light">
                                <div class="v-card__text pa-5">
                                    <div class="d-flex align-center">
                                        <button
                                            type="button"
                                            class="elevation-0 v-btn v-btn--contained v-btn--fab v-btn--round theme--dark v-size--default warning"
                                        >
                                            <span class="v-btn__content"
                                                ><i
                                                    aria-hidden="true"
                                                    class="v-icon notranslate mdi mdi-cellphone-link theme--dark"
                                                ></i
                                            ></span>
                                        </button>
                                        <div class="ml-2 mr-1">
                                            <h2
                                                class="headline font-weight-light"
                                            >
                                                $2376
                                            </h2>
                                            <h5
                                                class="subtitle-2 font-weight-regular"
                                            >
                                                Online Revenue
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            revenuecard="[object Object]"
                            class="py-0 mb-7 col-sm-6 col-lg-3 col-12"
                        >
                            <div class="v-card v-sheet theme--light">
                                <div class="v-card__text pa-5">
                                    <div class="d-flex align-center">
                                        <button
                                            type="button"
                                            class="elevation-0 v-btn v-btn--contained v-btn--fab v-btn--round theme--dark v-size--default deep-purple accent-2"
                                        >
                                            <span class="v-btn__content"
                                                ><i
                                                    aria-hidden="true"
                                                    class="v-icon notranslate mdi mdi-cart-outline theme--dark"
                                                ></i
                                            ></span>
                                        </button>
                                        <div class="ml-2 mr-1">
                                            <h2
                                                class="headline font-weight-light"
                                            >
                                                $1795
                                            </h2>
                                            <h5
                                                class="subtitle-2 font-weight-regular"
                                            >
                                                Offline Revenue
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            revenuecard="[object Object]"
                            class="py-0 mb-7 col-sm-6 col-lg-3 col-12"
                        >
                            <div class="v-card v-sheet theme--light">
                                <div class="v-card__text pa-5">
                                    <div class="d-flex align-center">
                                        <button
                                            type="button"
                                            class="elevation-0 v-btn v-btn--contained v-btn--fab v-btn--round theme--dark v-size--default error"
                                        >
                                            <span class="v-btn__content"
                                                ><i
                                                    aria-hidden="true"
                                                    class="v-icon notranslate mdi mdi-bullseye theme--dark"
                                                ></i
                                            ></span>
                                        </button>
                                        <div class="ml-2 mr-1">
                                            <h2
                                                class="headline font-weight-light"
                                            >
                                                $687
                                            </h2>
                                            <h5
                                                class="subtitle-2 font-weight-regular"
                                            >
                                                Ad. Expense
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </v-row>
                </v-col>

                <v-col class="col-sm-12 col-lg-8 col-12">
                    <v-card
                        class="mb-7 w-100 v-card v-card--flat v-sheet theme--light"
                    >
                        <v-card-text class="v-card__text pa-5">
                            <div class="d-md-flex align-start">
                                <h3 class="title font-weight-regular">
                                    Projects of the Month
                                </h3>
                                <v-spacer class="spacer"></v-spacer>
                                <div class="ml-auto">
                                    <div style="width: 150px">
                                        <div
                                            class="v-input pt-0 mt-0 v-input--is-label-active v-input--is-dirty theme--light v-text-field v-text-field--single-line v-text-field--is-booted v-select"
                                        >
                                            <div class="v-input__control">
                                                <div
                                                    role="button"
                                                    aria-haspopup="listbox"
                                                    aria-expanded="false"
                                                    aria-owns="list-2652"
                                                    class="v-input__slot"
                                                >
                                                    <div class="v-select__slot">
                                                        <div
                                                            class="v-select__selections"
                                                        >
                                                            <div
                                                                class="v-select__selection v-select__selection--comma"
                                                            >
                                                                January
                                                            </div>
                                                            <input
                                                                id="input-2652"
                                                                readonly="readonly"
                                                                type="text"
                                                                aria-readonly="false"
                                                                autocomplete="off"
                                                            />
                                                        </div>
                                                        <div
                                                            class="v-input__append-inner"
                                                        >
                                                            <div
                                                                class="v-input__icon v-input__icon--append"
                                                            >
                                                                <i
                                                                    aria-hidden="true"
                                                                    class="v-icon notranslate mdi mdi-menu-down theme--light"
                                                                ></i>
                                                            </div>
                                                        </div>
                                                        <input
                                                            type="hidden"
                                                            value="[object Object]"
                                                        />
                                                    </div>
                                                    <div class="v-menu">
                                                        <!---->
                                                    </div>
                                                </div>
                                                <div
                                                    class="v-text-field__details"
                                                >
                                                    <div
                                                        class="v-messages theme--light"
                                                    >
                                                        <div
                                                            class="v-messages__wrapper"
                                                        ></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="v-data-table month-table theme--light">
                                <div class="v-data-table__wrapper">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th
                                                    class="font-weight-regular subtitle-2"
                                                >
                                                    Assigned
                                                </th>
                                                <th
                                                    class="font-weight-regular subtitle-2"
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    class="font-weight-regular subtitle-2"
                                                >
                                                    Priority
                                                </th>
                                                <th
                                                    class="font-weight-regular subtitle-2"
                                                >
                                                    Budget
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="item in 4"
                                                :key="item.id"
                                                class="month-item"
                                            >
                                                <td>
                                                    <div
                                                        class="d-flex align-center"
                                                    >
                                                        <img
                                                            src="/images/logo.png"
                                                            alt="user"
                                                            width="45"
                                                            class="rounded-circle"
                                                        />

                                                        <div class="mx-4">
                                                            <h4
                                                                class="font-weight-medium text-no-wrap"
                                                            >
                                                                Sunil Joshi
                                                            </h4>
                                                            <h6
                                                                class="blue-grey--text text-no-wrap text--lighten-2 font-weight-regular caption"
                                                            >
                                                                Web Designer
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5
                                                        class="font-weight-light text-no-wrap subtitle-2"
                                                    >
                                                        Elite Admin
                                                    </h5>
                                                </td>
                                                <td>
                                                    <span
                                                        class="ma-2 v-chip v-chip--label v-chip--no-color theme--light v-size--small success"
                                                    >
                                                        <span
                                                            class="v-chip__content"
                                                        >
                                                            Low
                                                        </span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <h5
                                                        class="font-weight-light subtitle-2"
                                                    >
                                                        $3.9K
                                                    </h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </v-card-text>
                    </v-card>
                </v-col>

                <div class="col-sm-12 col-lg-4 col-12">
                    <div class="mb-7 v-card v-card--flat v-sheet theme--light">
                        <div class="v-card__text pa-0">
                            <img
                                src="/images/quien-soy.jpg"
                                height="100"
                                class="img-fluid rounded-top bt4 w-100 profile-bg-height"
                            />
                            <div class="pa-4 mt-n12 text-center">
                                <div class="d-flex justify-center mt-n5">
                                    <img
                                        class="rounded-full h-20 w-20"
                                        :src="$page.user.profile_photo_url"
                                        :alt="$page.user.name"
                                        height="128"
                                        width="128"
                                    />
                                </div>
                                <h2 class="mb-0 mt-4 font-weight-regular">
                                    {{ $page.user.name }}
                                </h2>
                                <p class="font-weight-light subtitle-2">
                                    {{ $page.user.email }}
                                </p>
                                <p>
                                    <small>
                                        Lorem ipsum dolor sit amet, this is a
                                        consectetur adipisicing elit orem ipsum
                                        dolor sit amet, this is a consectetur
                                        adipisicing elit orem ipsum dolor sit
                                        amet adipisicing elit orem ipsum</small
                                    >
                                </p>
                                <button
                                    type="button"
                                    class="text-capitalize font-weight-regular px-7 v-btn v-btn--contained v-btn--rounded theme--dark v-size--x-large deep-purple accent-2"
                                >
                                    <span class="v-btn__content">Follow</span>
                                </button>
                                <div class="row mt-3">
                                    <div class="col col-4">
                                        <h2 class="mb-0 font-weight-light">
                                            1099
                                        </h2>
                                        <small>Articles</small>
                                    </div>
                                    <div class="col col-4">
                                        <h2 class="mb-0 font-weight-light">
                                            23,469
                                        </h2>
                                        <small>Followers</small>
                                    </div>
                                    <div class="col col-4">
                                        <h2 class="mb-0 font-weight-light">
                                            6035
                                        </h2>
                                        <small>Following</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </v-row>
        </v-container>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import BreadCrumbs from "@/components/BreadCrumbs.vue";

export default {
    components: {
        AppLayout,
        BreadCrumbs,
    },
    data: () => ({
        items: [
            {
                text: "Dashboard",
                disabled: false,
                href: "/dashboard",
            },
            {
                text: "Home",
                disabled: true,
                href: "#",
            },
        ],
    }),
};
</script>
