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
            current_password: '',
            password: '',
            password_confirmation: '',
        })

        return { form }
    }
}
</script>

<template>
    <Head title="User Profile" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Change Password
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-if="$page.props.flash.message" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            {{ $page.props.flash.message }}
                        </div>

                        <form @submit.prevent="form.put(route('profile.password.update', form.id))">
                            <div class="mb-3">
                                <BreezeLabel for="current_password" value="Current Password" />
                                <BreezeInput id="current_password" type="password" class="mt-1 block w-full" v-model="form.current_password" required/>
                                <div v-if="errors.current_password" class="text-red-600">
                                    {{ errors.current_password }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <BreezeLabel for="password" value="New Password" />
                                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required/>
                                <div v-if="errors.password" class="text-red-600">
                                    {{ errors.password }}
                                </div>
                            </div>
                            <div>
                                <BreezeLabel for="password_confirmation" value="Password Confirmation" />
                                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required/>
                                <div v-if="errors.password_confirmation" class="text-red-600">
                                    {{ errors.password_confirmation }}
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update Password
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

