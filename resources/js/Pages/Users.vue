<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Paginator } from '@/types/pagination';
import { UserResource } from '@/types/user-resource';
import Pagination from '@/Components/Pagination.vue';
import { reactive, ref } from 'vue';
import Table from '@/Components/Table/Table.vue';
import TableHeading from '@/Components/Table/TableHeading.vue';
import TableRow from '@/Components/Table/TableRow.vue';
import TableCell from '@/Components/Table/TableCell.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/Form/TextInput.vue';

const props = defineProps<{
    users: Paginator<UserResource>;
    filters: {
        search?: string;
        column?: string;
        direction?: string;
    };
}>();

const filters = ref<{
    search: string;
    column: string;
    direction: string;
}>({
    search: props.filters.search ?? '',
    column: props.filters.column ?? '',
    direction: props.filters.direction ?? '',
});

const resetFilters = () => {
    filters.value = {
        search: '',
        column: '',
        direction: '',
    };
};

const loading = ref(false);

const search = () => {
    loading.value = true;
    router.reload({
        only: ['users'],
        data: {
            search: filters.value.search,
            page: 1,
        },
        preserveScroll: true,
        onSuccess: (page) => (loading.value = false),
    });
};
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
                            <div class="pb-5">
                                <TextInput v-model="filters.search" placeholder="search..." @keyup="search" />
                            </div>

                            <Table>
                                <template #head>
                                    <TableHeading sortable direction="asc" scope="col">ID</TableHeading>
                                    <TableHeading sortable scope="col">First Name</TableHeading>
                                    <TableHeading sortable scope="col">Surname</TableHeading>
                                    <TableHeading sortable scope="col">Email</TableHeading>
                                    <TableHeading sortable scope="col">Joined</TableHeading>
                                    <TableHeading scope="col"><span class="sr-only">Edit</span></TableHeading>
                                </template>
                                <template #body>
                                    <TableRow v-for="user in props.users.data" :key="user.id">
                                        <TableCell>{{ user.id }}</TableCell>
                                        <TableCell>{{ user.first_name }}</TableCell>
                                        <TableCell>{{ user.last_name }}</TableCell>
                                        <TableCell>{{ user.email }}</TableCell>
                                        <TableCell>{{ user.created_at }}</TableCell>
                                        <TableCell class="text-right">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                                >Edit<span class="sr-only"
                                                    >, {{ user.first_name }} {{ user.last_name }}</span
                                                ></a
                                            >
                                        </TableCell>
                                    </TableRow>
                                </template>
                            </Table>

                            <Pagination v-if="!loading" class="pt-5" :data="users" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
