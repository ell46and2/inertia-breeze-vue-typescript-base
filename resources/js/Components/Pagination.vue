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
    <div v-if="paginator.pages.length > 1">
        <div class="-mb-1 flex flex-wrap">
            <template v-for="item in paginator.items" :key="item.label">
                <div v-if="!item.url" class="mb-1 mr-1 rounded border px-4 py-3 text-sm leading-4 text-gray-400">
                    <span v-html="item.label" />
                </div>
                <Link
                    v-else
                    class="mb-1 mr-1 rounded border px-4 py-3 text-sm leading-4 hover:bg-blue-200 focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'bg-blue-700 text-white': item.isCurrent }"
                    :href="item.url"
                    :preserve-scroll="!!scrollTo"
                    @click="scroll"
                    ><span v-html="item.label" />
                </Link>
            </template>
        </div>
    </div>
</template>
