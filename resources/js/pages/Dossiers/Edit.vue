<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import DossierForm from './components/DossierForm.vue';
import { index as dossiersIndex } from '@/routes/dossiers';
import { dashboard } from '@/routes';
import type { Dossier } from '@/types/dossier';

const props = defineProps<{
    dossier: Dossier;
}>();

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
        title: `Édition : ${props.dossier.numero_dossier}`,
        href: '#',
    },
];
</script>

<template>
    <Head :title="`Éditer le dossier ${dossier.numero_dossier}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="min-h-full bg-muted/40 dark:bg-background px-4 py-8 sm:px-6 lg:px-10">
            <div class="mb-8">
                <h1 class="text-2xl font-bold tracking-tight text-foreground">Éditer le dossier {{ dossier.numero_dossier }}</h1>
                <p class="mt-1 text-sm text-muted-foreground">Mettez à jour les informations du dossier.</p>
            </div>
            <DossierForm :dossier="dossier" />
        </div>
    </AppLayout>
</template>
