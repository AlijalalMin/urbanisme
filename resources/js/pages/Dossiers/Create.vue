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
        <div class="min-h-full bg-muted/40 dark:bg-background px-4 py-8 sm:px-6 lg:px-10">
            <div class="mb-8">
                <h1 class="text-2xl font-bold tracking-tight text-foreground">Nouveau dossier</h1>
                <p class="mt-1 text-sm text-muted-foreground">Remplissez les informations du dossier pour le créer dans le système.</p>
            </div>
            <DossierForm />
        </div>
    </AppLayout>
</template>
