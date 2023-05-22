<script setup>
import { Link } from '@inertiajs/vue3';

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';

const lang = window.location.pathname.split('/')[1];
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <ApplicationLogo
                                    class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                                />
                            </div>

                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dictionary', { lang })" :active="route().current('dictionary')">
                                    Словарь
                                </NavLink>
                                <NavLink :href="route('search', { lang })" :active="route().current('search')">
                                    Поиск
                                </NavLink>
                            </div>
                        </div>

                        <div>
                            <Link v-if="lang === 'es'" :href="route('dictionary', { lang: 'ru' })" class="hover:opacity-50">
                                Русский
                            </Link>
                            <Link v-else :href="route('dictionary', { lang: 'es' })" class="hover:opacity-50">
                                España
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>

            <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <slot />
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
