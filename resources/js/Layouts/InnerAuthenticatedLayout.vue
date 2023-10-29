<template>
    <div>
        <header v-if="$slots.header" class="rounded bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <slot />
    </div>
</template>
