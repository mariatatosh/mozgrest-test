<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

import AppLayout from '@/Layouts/AppLayout.vue';
import Alert from '@/Components/Alert.vue';

const props = defineProps({
    query: {
        type: String,
        default: null,
    },
    translation: {
        type: String,
        default: null,
    },
    examples: {
        type: Array,
        default: null,
    },
});

const form = useForm({ query: props.query });

const hasTranslation = computed(() => props.query && props.translation );
const hasAlert = computed(() => usePage().props.hasOwnProperty('alert'));

function submit() {
    form.transform(data => ({ q: data.query })).get('');
}
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Поиск</h2>
        </template>

        <Alert v-if="hasAlert" :type="usePage().props.alert['type']" :message="usePage().props.alert['message']" />

        <form @submit.prevent="submit()" class="mb-3">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input
                    v-model="form.query"
                    type="search"
                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Введите слово..."
                    required
                >
                <button
                    type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    :disabled="form.processing"
                >
                    Найти
                </button>
            </div>
        </form>

        <div v-if="hasTranslation">
            <div class="mb-2">
                <h4 class="font-bold dark:text-white">Перевод</h4>

                <span class="block p-4 my-4 rounded bg-gray-50 border border-gray-300 dark:bg-gray-800">
                    {{ translation }}
                </span>
            </div>

            <div>
                <h4 class="font-bold dark:text-white">Примеры</h4>

                <p
                    v-for="(example, index) in examples"
                    :key="index"
                    class="rounded p-4 my-4 border-l-4 border-gray-300 border bg-gray-50 dark:border-gray-500 dark:bg-gray-800"
                >
                    <span class="font-bold">{{ example.original }}</span> — {{ example.translation }}
                </p>
            </div>
        </div>
    </AppLayout>
</template>
