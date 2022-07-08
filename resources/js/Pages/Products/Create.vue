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
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required/>
                                <div v-if="errors.name" class="text-red-600">
                                    {{ errors.name }}
                                </div>
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
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head, Link, BreezeAuthenticatedLayout, BreezeButton, BreezeInput, BreezeLabel
    },

    props: {
        errors: Object,
    },

    setup() {
        const form = useForm({
            name: '',
        })

        return { form }
    }
}
</script>
