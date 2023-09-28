<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Paginator } from '@/types/pagination';
import { UserResource } from '@/types/user-resource';
import { usePaginator } from '@/composables/usePaginator';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps<{
    users: Paginator<UserResource>;
}>();
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Users</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white p-8">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1 class="text-base font-semibold leading-6 text-gray-900">Users</h1>
                                <p class="mt-2 text-sm text-gray-700">A list of all the users</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 flow-root overflow-hidden">
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            <table class="w-full text-left">
                                <thead class="bg-white">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="relative isolate py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                                            ID
                                            <div
                                                class="absolute inset-y-0 right-full -z-10 w-screen border-b border-b-gray-200"></div>
                                            <div
                                                class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-b-gray-200"></div>
                                        </th>
                                        <th
                                            scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                                            First Name
                                        </th>
                                        <th
                                            scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                                            Surname
                                        </th>
                                        <th
                                            scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 md:table-cell">
                                            Email
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Joined
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in props.users.data" :key="user.id">
                                        <td class="relative py-4 pr-3 text-sm font-medium text-gray-900">
                                            {{ user.id }}
                                            <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100"></div>
                                            <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"></div>
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            {{ user.first_name }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            {{ user.last_name }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            {{ user.email }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            {{ user.created_at }}
                                        </td>
                                        <td class="relative py-4 pl-3 text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                                >Edit<span class="sr-only">, Lindsay Walton</span></a
                                            >
                                        </td>
                                    </tr>

                                    <!-- More people... -->
                                </tbody>
                            </table>

                            <Pagination :data="props.users" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
