<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import TextInput from '@/components/TextInput.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
const form = useForm({
    first_name: '',
    last_name: '',
    username: '',
    password: '',
    password_confirmation: '',
    email: '',
    address: '',
    postcode: '',
    phone_number: '',
});
const submit = () => {
    try {
    form.post(route('users.store'));
    } catch(err) {
        console.log({err})
    }
};
</script>
<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create User
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-between mb-6">
                            <Link
                                class="px-3 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                                :href="route('dashboard')"
                            >
                                <-
                            </Link>
                        </div>
                        <form name="createForm" @submit.prevent="submit">
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-5">

                                    <div class="mb-4">
                                        <InputLabel for="first_name" value="First Name" />

                                        <TextInput
                                            id="first_name" 
                                            type="text" 
                                            class="mt-1 w-full" 
                                            v-model="form.first_name" 
                                            autofocus
                                        required />
                                        <span class="text-red-600" v-if="form.errors.first_name">
                                            {{ form.errors.first_name }}
                                        </span>
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="last_name" value="Last Name" />

                                        <TextInput
                                            id="last_name" 
                                            type="text" 
                                            class="mt-1 w-full" 
                                            v-model="form.last_name"
                                            autofocus
                                            required />
                                        <span class="text-red-600" v-if="form.errors.last_name">
                                            {{ form.errors.last_name }}
                                        </span>
                                    </div>
                                    </div>
                                    <div class="flex items-center  gap-5">
                                    <div class="mb-4">
                                        <InputLabel for="username" value="Username" />

                                        <TextInput
                                            id="username" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            v-model="form.username"
                                            autofocus
                                            required />
                                        <span class="text-red-600" v-if="form.errors.username">
                                            {{ form.errors.username }}
                                        </span>
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="Email" value="Email Address" />

                                        <TextInput
                                            id="email" 
                                            type="email" 
                                            class="mt-1 block w-full" 
                                            v-model="form.email"
                                            autofocus
                                            required />
                                        <span class="text-red-600" v-if="form.errors.email">
                                            {{ form.errors.email }}
                                        </span>
                                    </div>
                                    </div>
                                    <div class="flex items-center  gap-5">
                                    <div class="mb-4">
                                        <InputLabel for="password" value="Password" />

                                        <TextInput
                                            id="password" 
                                            type="password" 
                                            class="mt-1 block w-full" 
                                            v-model="form.password"
                                            autofocus
                                            required />
                                        <span class="text-red-600 w-20" v-if="form.errors.password">
                                            {{ form.errors.password }}
                                        </span>
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="password_confirmation" value="Confirm Password" />

                                        <TextInput
                                            id="password_confirmation" 
                                            type="password" 
                                            class="mt-1 block w-full" 
                                            v-model="form.password_confirmation"
                                            autofocus
                                            required />
                                        <span class="text-red-600" v-if="form.errors.password_confirmation">
                                            {{ form.errors.password_confirmation }}
                                        </span>
                                    </div>
                                    </div>
                                    <div class="max-w-md">
                                    <div class="mb-4 flex items-center  w-full">
                                        <div class="w-full">
                                        <InputLabel for="address" value="Address" />

                                        <TextInput
                                            id="address" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            v-model="form.address"
                                            autofocus
                                            required />
                                        <span class="text-red-600" v-if="form.errors.address">
                                            {{ form.errors.address }}
                                        </span>
                                        </div>
                                    </div>
                            
                                    </div>
                                    
                                    <div class="flex items-center  gap-5">
                                    <div class="mb-4">
                                        <InputLabel for="postcode" value="Postcode" />

                                        <TextInput
                                            id="postcode" 
                                            type="number" 
                                            class="mt-1 block w-full" 
                                            v-model="form.postcode"
                                            autofocus
                                            required />
                                        <span class="text-red-600" v-if="form.errors.postcode">
                                            {{ form.errors.postcode }}
                                        </span>
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel for="phone_number" value="Phone Number" />
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                +63
                                            </span>
                                            <input id="phone_number" 
                                                type="tel" 
                                                pattern="9[0-9]{9}" 
                                                class="flex-1 block rounded-none rounded-r-md transition duration-150 ease-in-out sm:text-sm sm:leading-5" 
                                                v-model="form.phone_number" 
                                                autofocus 
                                                required />
                                        </div>
                                        <span class="text-red-600" v-if="form.errors.phone_number">
                                            {{ form.errors.phone_number }}
                                        </span>
                                    </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="flex items-center gap-4">
                                        <PrimaryButton :disabled="form.processing">Create</PrimaryButton>

                                        <Transition
                                            enter-active-class="transition ease-in-out"
                                            enter-from-class="opacity-0"
                                            leave-active-class="transition ease-in-out"
                                            leave-to-class="opacity-0"
                                        >
                                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                        </Transition>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>