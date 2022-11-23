<template>
    <Head title="List of Products" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                List of Products
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-rows-1 grid-cols-4">
                            <div class="mb-4 max-w-xs">
                                <input type="search" v-model="params.search" aria-label="Search" placeholder="Search..." class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                            </div>
                            <div class="col-span-3 text-right">
                                <Link
                                    :href="route('products.create')"
                                    class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded align-baseline">

                                    Add Product
                                </Link>
                            </div>
                        </div>
                        <table style="width: 100%" class="rounded-lg">
                            <thead>
                                <tr class="row border-t-1 bg-slate-100 text-left">
                                    <th class="border-slate-200" style="padding: .5em">
                                        <span class="inline-flex w-full" @click="sort('name')"><span class="pr-2">Name</span>
                                            <svg v-if="params.field === 'name' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-left" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                            </svg>

                                            <svg v-if="params.field === 'name' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                            </svg>
                                        </span>
                                    </th>
                                    <th class="border-slate-200" style="padding: .5em">
                                        <span class="inline-flex w-full"><span class="pr-2">Category</span>
                                        </span>
                                    </th>
                                    <th class="border-slate-200">
                                        <span class="inline-flex w-full" @click="sort('created_at')"><span class="pr-2">Created At</span>
                                            <svg v-if="params.field === 'created_at' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-left" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                            </svg>

                                            <svg v-if="params.field === 'created_at' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                            </svg>
                                        </span>
                                    </th>
                                    <th style="width: 90px" class="border-slate-200"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product) in products.data"
                                    :key="product.id"
                                    class="row border-t-2 hover:bg-slate-100"
                                    :class="{'bg-green-200': justAdded && product.id === item_id}">

                                    <td class="border-slate-200" style="padding: .5em">{{ product.name }}</td>
                                    <td class="border-slate-200" style="padding: .5em">{{ product.category.name }}</td>
                                    <td class="border-slate-200">{{ new Date(product.created_at).toLocaleString() }}</td>
                                    <td class="border-slate-200">
                                        <div class="grid grid-cols-3 gap-0">
                                            <div class="">
                                                <Link :href="route('products.edit', product.id)" class="text-gray-300 hover:text-gray-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </Link>
                                            </div>
                                            <div class="">
                                                <Link :href="route('products.show', product.id)" class="text-blue-300 hover:text-blue-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </Link>
                                            </div>
                                            <div class="">
                                                <button
                                                    onclick="confirm('Are you sure you want to delete this Record?') || event.stopImmediatePropagation()"
                                                    class="text-red-300 hover:text-red-700"
                                                    @click="destroy(product.id)">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <pagination class="mt-6" :links="products.links"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { pickBy, throttle } from 'lodash';

export default {
    components: {
        Head, Link, Pagination, BreezeButton, BreezeAuthenticatedLayout,
    },

    props: {
        filters: Object,
        item_id: Number,
        products: Object,
    },

    data() {
        return {
            params: {
                search: this.filters.search,
                field: this.filters.field,
                direction: this.filters.direction,
            },
            justAdded: false,
            timeout: null,
        }
    },

    methods: {
        sort(field) {
            this.params.field = field;
            this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
        },

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
        },

        params: {
            handler: throttle(function () {
                let params = pickBy(this.params);

                this.$inertia.get(this.route('products.index'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
        }
    },
}
</script>
