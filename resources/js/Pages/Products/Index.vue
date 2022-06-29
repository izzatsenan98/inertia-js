<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head, Link, BreezeButton, BreezeAuthenticatedLayout,
    },

    props: {
        products: Object,
    }
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
                        <table style="width: 100%" class="border-collapse border border-slate-400">
                            <thead>
                                <tr class="row bg-slate-100">
                                    <th class="border border-slate-200">Name</th>
                                    <th class="border border-slate-200">Created At</th>
                                    <th class="border border-slate-200">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product) in products"
                                    :key="product.id"
                                    class="row hover:bg-slate-100">

                                    <td class="border border-slate-200" style="padding: .3em">{{ product.name }}</td>
                                    <td class="border border-slate-200">{{ product.created_at }}</td>
                                    <td class="border border-slate-200">

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
