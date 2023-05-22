<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    topics: {
        type: Array,
        required: true,
    },
    wordGroups: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Словарь</h2>
        </template>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th
                        v-for="(topic, index) in topics"
                        :key="index"
                        scope="col"
                        class="px-6 py-3 text-center font-semibold text-sm"
                    >
                        {{ topic }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="(wordGroup, index) in wordGroups"
                    :key="index"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center"
                >
                    <td
                        v-for="(word, index) in wordGroup"
                        :key="index"
                        class="px-6 py-4 w-1/2"
                    >
                        {{ word }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
