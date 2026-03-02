<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import DossierForm from './Partials/DossierForm.vue';
import { index as dossiersIndex, create as dossiersCreate } from '@/routes/dossiers';
import { dashboard } from '@/routes';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Dossiers',
        href: dossiersIndex().url,
    },
    {
        title: 'Nouveau dossier',
        href: dossiersCreate().url,
    },
];
</script>

<template>
    <Head title="Nouveau dossier" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h2 class="text-xl font-semibold mb-6">Informations du dossier</h2>
                <DossierForm />
            </div>
        </div>
    </AppLayout>
</template>
