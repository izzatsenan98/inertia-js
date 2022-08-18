<template>
    <Head title="List of Categories" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                List of Categories
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
                                    :href="route('categories.create')"
                                    class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded align-baseline">

                                    Add Category
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
                                <tr v-for="(category) in categories.data"
                                    :key="category.id"
                                    class="row border-t-2 hover:bg-slate-100"
                                    :class="{'bg-green-200': justAdded && category.id === item_id}">

                                    <td class="border-slate-200" style="padding: .5em">{{ category.name }}</td>
                                    <td class="border-slate-200">{{ new Date(category.created_at).toLocaleString() }}</td>
                                    <td class="border-slate-200">
                                        <div class="grid grid-cols-3 gap-0">
                                            <!-- <div class="mt-1">
                                                <Link :href="route('categories.edit', category.id)" class="text-gray-300 hover:text-gray-700 font-bold py-1 px-2 rounded w-8 text-3xl">
                                                    o
                                                </Link>
                                            </div>
                                            <div class="">
                                                <button
                                                    onclick="confirm('Are you sure you want to delete this Record?') || event.stopImmediatePropagation()"
                                                    class="text-red-300 hover:text-red-700 font-bold py-1 px-2 rounded w-8 text-3xl"
                                                    @click="destroy(category.id)">

                                                    x
                                                </button>
                                            </div>
                                            <div class="mt-1">
                                                <Link :href="route('categories.show', category.id)" class="text-blue-300 hover:text-blue-700 font-bold py-1 px-2 rounded w-8 text-3xl">
                                                    >
                                                </Link>
                                            </div> -->
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <pagination class="mt-6" :links="categories.links"></pagination>
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
        categories: Object,
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
                message: 'Category has been deleted successfully.'
            }
        },

        destroy(category) {
            // delete then reload list
            axios.delete("/categorys/" + category).then(response => {
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

                this.$inertia.get(this.route('categories.index'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
        }
    },
}
</script>
