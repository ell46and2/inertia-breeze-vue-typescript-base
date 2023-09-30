<script setup lang="ts">
import { Paginator } from '@/types/pagination';
import { usePaginator } from '@/composables/usePaginator';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    data: Paginator<any>;
    scrollTo?: string;
}>();

const paginator = computed(() => usePaginator(props.data));

const scroll = () => {
    if (!props.scrollTo) return;

    document.getElementById(props.scrollTo)?.scrollIntoView();
};
</script>

<template>
    <div>
        <div class="flex space-x-2">
            <template v-for="page in paginator.pages" :key="page.label">
                <Link
                    v-if="page.isActive"
                    @click="scroll"
                    :preserve-scroll="!!scrollTo"
                    class="text-gray-800"
                    :href="page.url ?? ''">
                    <div>{{ page.label }}</div>
                </Link>
                <span v-else class="text-gray-400">{{ page.label }}</span>
            </template>
        </div>
        <div>Showing {{ paginator.from }} to {{ paginator.to }} of {{ paginator.total }} results</div>
    </div>
</template>
