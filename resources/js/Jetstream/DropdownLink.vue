<template>
    <div>
        <button type="submit"
                class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                v-if="as == 'button'">
            <slot></slot>
        </button>

        <inertia-link :href="href"
                      class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                      v-else>
            <slot></slot>
        </inertia-link>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue";

export default {
    components: {
        InertiaLink: Link,
    },
    props: ['href', 'as']
}
</script>
