<template>
    <Head title="User Profile" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add New Product
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="form.post(route('products.store'))">
                            <div class="mb-3">
                                <BreezeLabel for="name" value="Name" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"/>
                                <Error v-if="errors.name" :message="errors.name"/>
                            </div>

                            <div class="mb-3">
                                <BreezeLabel for="category_id" value="Category" />
                                <select v-model="form.category_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-1/2">
                                    <option value="">Select category...</option>
                                    <option
                                        v-for="(category, key) in categories"
                                        :key="key"
                                        :value="key">

                                        {{ category }}
                                    </option>
                                </select>
                                <Error v-if="errors.category_id" :message="errors.category_id"/>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import Error from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head, Link, BreezeAuthenticatedLayout, BreezeButton, BreezeInput, BreezeLabel, Error
    },

    props: {
        errors: Object,
        categories: Object,
    },

    setup() {
        const form = useForm({
            name: '',
            category_id: '',
        })

        return { form }
    }
}
</script>
