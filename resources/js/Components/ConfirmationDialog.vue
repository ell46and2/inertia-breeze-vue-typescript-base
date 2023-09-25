<template>
    <Modal :show="true" @close="$emit('cancel')">
        <div class="flex flex-col gap-y-10 p-6">
            <div class="inline-flex w-full flex-col items-center justify-center gap-y-5 text-center">
                <h2 class="text-lg font-medium text-gray-900">
                    <slot name="header" />
                </h2>

                <slot />
            </div>

            <div class="flex flex-col gap-y-4 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                <SecondaryButton @click="$emit('cancel')">
                    <slot name="cancel-button"><span class="w-full text-center">Cancel</span></slot>
                </SecondaryButton>
                <DangerButton @click="$emit('confirm')">
                    <slot name="confirm-button"><span class="w-full text-center">Yes</span></slot>
                </DangerButton>
            </div>
        </div>
    </Modal>
</template>
<script setup lang="ts">
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

defineEmits<{
    (e: 'confirm'): void;
    (e: 'cancel'): void;
}>();
</script>
