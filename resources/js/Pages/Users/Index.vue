<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
defineProps({
    users: Array,
})

const form = useForm({});
const destroy = (id) =>{
    if(confirm("Are you sure you want to Delete?")){
        form.delete(route('users.destroy', id));
    }
}

</script>

<template>
    <Head title="Dashboard" ></Head>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex items-center justify-between mb-6">
                        <Link
                            className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                            :href="route('users.create')"
                        >
                            Create User1
                        </Link>
                    </div>
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Username</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Number</th>
                                <th class="px-4 py-2">Address</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                            <tbody>
                                <tr v-for="user in users">
                                    <td className="border px-4 py-2"><input type="checkbox" /></td>
                                    <td className="border px-4 py-2">{{ user.first_name }} {{ user.last_name }}</td>
                                    <td className="border px-4 py-2">{{ user.username }}</td>
                                    <td className="border px-4 py-2">{{ user.email }}</td>
                                    <td className="border px-4 py-2">{{ user.phone_number }}</td>
                                    <td className="border px-4 py-2">{{ user.address }} {{ user.postcode }}</td>
                                    <td className="border px-4 py-2">
                                        <Link
                                            tabIndex="1"
                                            className="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                            :href="route('users.edit', user.id)"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="destroy(user.id)"
                                            tabIndex="-1"
                                            type="button"
                                            className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
