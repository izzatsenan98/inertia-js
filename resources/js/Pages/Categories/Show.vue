<template>
    <Head title="View Category" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                View Category
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-4 gap-0">
                            <div class="font-bold">Name</div>
                            <div class="col-span-3 mb-2">{{ category.name }}</div>

                            <div class="font-bold">Description</div>
                            <div class="col-span-3 mb-2">{{ category.description }}</div>

                            <div class="font-bold">Created At</div>
                            <div class="col-span-3 mb-2">{{ categoryAlt.created_at }}</div>

                            <div class="font-bold">Updated At</div>
                            <div class="col-span-3 mb-2">{{ categoryAlt.updated_at }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head, Link, BreezeAuthenticatedLayout
    },

    props: {
        category: Object,
        categoryAlt: Object,
        category: String,
    },
}
</script>
