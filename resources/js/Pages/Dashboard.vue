<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/components/DangerButton.vue';
import SecondaryButton from '@/components/SecondaryButton.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import Modal from '@/components/Modal.vue';

defineProps({
    users: Array,
})
const currentUser = usePage().props.auth.user;

const form = useForm({});

const selectedIDs = ref([])
const confirmingUserDeletion = ref(false);

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
};

const deleteUser = () => {
    form.delete(route('users.destroy', JSON.stringify(selectedIDs._rawValue)), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>
<style scoped>
.cursor-not-allowed {
  pointer-events: none;
}
</style>
<template>
    <Head title="Dashboard" ></Head>

    <AuthenticatedLayout>
        
        <template #header>
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
                <div>
                    <Link
                        class="inline-flex items-center px-4 py-2 mr-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        :href="route('users.create')"
                    >
                        Create User
                    </Link>
                    <DangerButton 
                        :class="{ 'cursor-not-allowed bg-grey-500': selectedIDs.length === 0 }"
                        :href="selectedIDs.length === 0 ? null : route('users.create')"
                         @click="confirmUserDeletion"
                    >Delete User</DangerButton>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 w-10"></th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Username</th>
                                <th class="px-4 py-2 w-72">Email</th>
                                <th class="px-4 py-2">Number</th>
                                <th class="px-4 py-2">Address</th>
                                <th class="px-4 py-2 w-20">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users" :key="user.id">
                                <td class="border px-4 py-2 w-20">
                                    <input
                                    type="checkbox"
                                    :value="user.id"
                                    v-model="selectedIDs" 
                                    v-if="user.id !== currentUser.id" />
                                </td>
                                <td class="border px-4 py-2">{{ user.first_name }} {{ user.last_name }}</td>
                                <td class="border px-4 py-2">{{ user.username }}</td>
                                <td class="border px-4 py-2 w-20">{{ user.email }}</td>
                                <td class="border px-4 py-2">{{ user.phone_number }}</td>
                                <td class="border px-4 py-2">{{ user.address }} {{ user.postcode }}</td>
                                <td class="border px-3 py-2">
                                    <Link
                                        tabIndex="1"
                                        class="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                        :href="route('users.edit', user.id)"
                                        v-if="user.id !== currentUser.id"
                                    >
                                        Edit
                                    </Link>
                                    <!-- <button
                                        @click="destroy(user.id)"
                                        tabIndex="-1"
                                        type="button"
                                        class="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                                    >
                                        Delete
                                    </button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete?
                </h2>
                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete Account
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
