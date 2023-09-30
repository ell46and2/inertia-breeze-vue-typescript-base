<template>
    <th v-bind="$attrs" class="bg-cool-gray-50 px-6 py-3">
        <span
            v-if="!props.sortable"
            class="text-cool-gray-500 text-left text-xs font-medium uppercase leading-4 tracking-wider">
            <slot></slot>
        </span>

        <button
            v-else
            v-bind="$attrs"
            class="text-cool-gray-500 group flex items-center space-x-1 text-left text-xs font-medium uppercase leading-4 tracking-wider focus:underline focus:outline-none">
            <span><slot /></span>
            <span class="relative flex items-center">
                <svg
                    v-if="props.direction === 'asc'"
                    class="h-3 w-3"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <svg
                    v-else-if="props.direction === 'desc'"
                    class="h-3 w-3"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
                <svg
                    v-else
                    class="h-3 w-3 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </span>
        </button>
    </th>
</template>

<script setup lang="ts">
const props = withDefaults(
    defineProps<{
        sortable?: boolean;
        direction?: 'asc' | 'desc' | null;
    }>(),
    {
        sortable: false,
        direction: null,
    },
);
</script>
