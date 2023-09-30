<template>
    <div class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-lg">
        <table class="divide-cool-gray-200 min-w-full divide-y">
            <thead>
                <tr>
                    <slot name="head" />
                </tr>
            </thead>

            <tbody class="divide-cool-gray-200 divide-y bg-white">
                <slot name="body" />
            </tbody>
        </table>
    </div>
</template>
