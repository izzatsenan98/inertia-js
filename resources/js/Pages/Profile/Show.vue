<template>
    <Head title="User Profile" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Profile
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- <div v-if="$page.props.flash.message" class="text-green-500 mb-4" role="alert">
                            {{ $page.props.flash.message }}
                        </div> -->
                        <div v-if="$page.props.flash.message" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            {{ $page.props.flash.message }}
                        </div>

                        <form @submit.prevent="form.put(route('profile.user.update', form.id))">
                            <div class="mb-3">
                                <BreezeLabel for="name" value="Name" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"/>
                                <Error v-if="errors.name" :message="errors.name"/>
                            </div>
                            <div>
                                <BreezeLabel for="email" value="Email" />
                                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" autocomplete="username"/>
                                <Error v-if="errors.email" :message="errors.email"/>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update
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
        user: Object,
        errors: Object,
    },

    setup(props) {
        // const form = useForm({
        //     id: props.user.id,
        //     name: props.user.name,
        //     email: props.user.email,
        // });

        const form = useForm(props.user)

        return { form }
    },

    // Testing watch
    watch: {
        user: {
            handler(n, o) {
                console.log(n.name)
                console.log(o.name)
            },
            deep: true
        }
    },
}
</script>
