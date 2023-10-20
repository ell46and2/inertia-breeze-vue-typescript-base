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
        sortField?: string;
        direction?: 'asc' | 'desc';
    };
}>();

const filters = ref<{
    search: string;
    sortField: string;
    direction: 'asc' | 'desc';
}>({
    search: props.filters.search ?? '',
    sortField: props.filters.sortField ?? '',
    direction: props.filters.direction ?? 'asc',
});

const resetFilters = () => {
    filters.value = {
        search: '',
        sortField: '',
        direction: 'asc',
    };
};

const loading = ref(false);

const applyFilters = () => {
    loading.value = true;
    router.reload({
        only: ['users'],
        data: {
            search: filters.value.search,
            field: filters.value.sortField,
            direction: filters.value.direction,
            page: 1,
        },
        preserveScroll: true,
        onSuccess: () => (loading.value = false),
    });
};

const search = () => {
    applyFilters();
};

const sortBy = (field: string) => {
    if (filters.value.sortField === field) {
        filters.value.direction = filters.value.direction === 'asc' ? 'desc' : 'asc';
    } else {
        filters.value.direction = 'asc';
    }

    filters.value.sortField = field;

    applyFilters();
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

                            <Table id="users-table">
                                <template #head>
                                    <TableHeading
                                        class="w-4"
                                        @sort="sortBy('id')"
                                        sortable
                                        :direction="filters.sortField === 'id' ? filters.direction : null"
                                        scope="col"
                                        >ID</TableHeading
                                    >
                                    <TableHeading
                                        @sort="sortBy('first_name')"
                                        sortable
                                        :direction="filters.sortField === 'first_name' ? filters.direction : null"
                                        scope="col"
                                        >First Name</TableHeading
                                    >
                                    <TableHeading
                                        @sort="sortBy('last_name')"
                                        sortable
                                        :direction="filters.sortField === 'last_name' ? filters.direction : null"
                                        scope="col"
                                        >Surname</TableHeading
                                    >
                                    <TableHeading
                                        @sort="sortBy('email')"
                                        :direction="filters.sortField === 'email' ? filters.direction : null"
                                        sortable
                                        scope="col"
                                        >Email</TableHeading
                                    >
                                    <TableHeading
                                        class="w-8"
                                        @sort="sortBy('created_at')"
                                        :direction="filters.sortField === 'created_at' ? filters.direction : null"
                                        sortable
                                        scope="col"
                                        >Joined</TableHeading
                                    >
                                    <TableHeading class="w-4" scope="col"
                                        ><span class="sr-only">Edit</span></TableHeading
                                    >
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

                            <Pagination class="pt-5" scroll-to="users-table" :data="users" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
