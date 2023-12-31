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
import { useDebounceFn } from '@vueuse/core';
import InnerAuthenticatedLayout from '@/Layouts/InnerAuthenticatedLayout.vue';
const props = defineProps<{
    users: Paginator<UserResource>;
    filters: {
        search?: string;
        field?: string;
        direction?: 'asc' | 'desc';
    };
}>();

defineOptions({
    layout: AuthenticatedLayout,
});

const filters = ref<{
    search: string;
    sortField: string;
    direction: 'asc' | 'desc';
}>({
    search: props.filters.search ?? '',
    sortField: props.filters.field ?? '',
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

const search = useDebounceFn(() => {
    applyFilters();
});

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

    <InnerAuthenticatedLayout>
        <template #header>
            <h1 class="text-xl font-semibold leading-tight text-gray-800">Users</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the users</p>
        </template>

        <div class="py-12">
            <div class="rounded bg-white p-8">
                <div class="mt-8 flow-root overflow-hidden">
                    <div>
                        <div class="pb-5">
                            <TextInput v-model="filters.search" placeholder="search..." @keyup="search" />
                        </div>

                        <Table id="users-table">
                            <template #head>
                                <TableHeading
                                    class="w-4"
                                    sortable
                                    :direction="filters.sortField === 'id' ? filters.direction : null"
                                    scope="col"
                                    @sort="sortBy('id')"
                                    >ID</TableHeading
                                >
                                <TableHeading
                                    sortable
                                    :direction="filters.sortField === 'first_name' ? filters.direction : null"
                                    scope="col"
                                    @sort="sortBy('first_name')"
                                    >First Name</TableHeading
                                >
                                <TableHeading
                                    sortable
                                    :direction="filters.sortField === 'last_name' ? filters.direction : null"
                                    scope="col"
                                    @sort="sortBy('last_name')"
                                    >Surname</TableHeading
                                >
                                <TableHeading
                                    :direction="filters.sortField === 'email' ? filters.direction : null"
                                    sortable
                                    scope="col"
                                    @sort="sortBy('email')"
                                    >Email</TableHeading
                                >
                                <TableHeading
                                    class="w-8"
                                    :direction="filters.sortField === 'created_at' ? filters.direction : null"
                                    sortable
                                    scope="col"
                                    @sort="sortBy('created_at')"
                                    >Joined</TableHeading
                                >
                                <TableHeading class="w-4" scope="col"><span class="sr-only">Edit</span></TableHeading>
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
    </InnerAuthenticatedLayout>
</template>
