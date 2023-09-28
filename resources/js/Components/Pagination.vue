<script setup lang="ts">
import { Paginator } from '@/types/pagination';
import { usePaginator } from '@/composables/usePaginator';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    data: Paginator<any>;
}>();

const { from, to, total, pages } = usePaginator(props.data);
</script>

<template>
    <div>
        <div class="flex space-x-2">
            <template v-for="page in pages" :key="page.label">
                <Link class="text-gray-800" v-if="page.isActive" :href="page.url">
                    <div>{{ page.label }}</div>
                </Link>
                <span class="text-gray-400" v-else>{{ page.label }}</span>
            </template>
        </div>
        <div>Showing {{ from }} to {{ to }} of {{ total }} results</div>
    </div>
</template>
