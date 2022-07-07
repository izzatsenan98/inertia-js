<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head, Link, BreezeButton, BreezeAuthenticatedLayout,
    },

    props: {
        item_id: Number,
        products: Object,
    },

    data() {
        return {
            justAdded: false,
            timeout: null,
        }
    },

    methods: {
        toastDeleteSuccess() {
            return {
                type: 'success',
                message: 'Product has been deleted successfully.'
            }
        },

        destroy(product) {
            // delete then reload list
            axios.delete("/products/" + product).then(response => {
                this.$page.props.toast = this.toastDeleteSuccess();
                this.$inertia.reload();
            });
        },
    },

    watch: {
        item_id: {
            handler(n) {
                if (n) {
                    this.justAdded = true;
                }

                if (this.timeout) {
                    clearTimeout(this.timeout);
                }

                setTimeout(() => this.justAdded = false, 1500);
            },
            deep: true,
            immediate: true,
        }
    },
}
</script>

<template>
    <Head title="List of Products" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                List of Products
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-rows-1 grid-flow-col gap-4">
                            <div class="mb-5">
                                <Link
                                    :href="route('products.create')"
                                    class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded">

                                    Add Product
                                </Link>
                            </div>
                        </div>
                        <table style="width: 100%" class="rounded-lg">
                            <thead>
                                <tr class="row border-t-1 bg-slate-100 text-left">
                                    <th class="border-slate-200" style="padding: .5em">Name</th>
                                    <th class="border-slate-200">Created At</th>
                                    <th style="width: 90px" class="border-slate-200"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product) in products"
                                    :key="product.id"
                                    class="row border-t-2 hover:bg-slate-100"
                                    :class="{'bg-green-200': justAdded && product.id === item_id}">

                                    <td class="border-slate-200" style="padding: .5em">{{ product.name }}</td>
                                    <td class="border-slate-200">{{ product.created_at }}</td>
                                    <td class="border-slate-200">
                                        <div class="grid grid-cols-3 gap-0">
                                            <div class="mt-1">
                                                <Link :href="route('products.edit', product.id)" class="text-gray-300 hover:text-gray-700 font-bold py-1 px-2 rounded w-8 text-3xl">
                                                    o
                                                </Link>
                                            </div>
                                            <div class="">
                                                <button
                                                    onclick="confirm('Are you sure you want to delete this Record?') || event.stopImmediatePropagation()"
                                                    class="text-red-300 hover:text-red-700 font-bold py-1 px-2 rounded w-8 text-3xl"
                                                    @click="destroy(product.id)">

                                                    x
                                                </button>
                                            </div>
                                            <div class="mt-1">
                                                <Link :href="route('products.show', product.id)" class="text-blue-300 hover:text-blue-700 font-bold py-1 px-2 rounded w-8 text-3xl">
                                                    >
                                                </Link>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
