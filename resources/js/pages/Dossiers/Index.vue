<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { dashboard } from '@/routes';
import { index as dossiersIndex, create as dossiersCreate } from '@/routes/dossiers';
import { type BreadcrumbItem } from '@/types';
import type { Dossier } from '@/types/dossier';
import { Head, Link } from '@inertiajs/vue3';
import DossierFilters from './components/DossierFilters.vue';
import DossierTable from './components/DossierTable.vue';

interface Props {
    dossiers?: {
        data: Dossier[]
        links: any[]
    }
}

const props = withDefaults(defineProps<Props>(), {
    dossiers: () => ({ data: [], links: [] }),
})

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Dossiers',
        href: dossiersIndex().url,
    },
];
</script>

<template>
    <Head title="Dossiers" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-6 p-4">

            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold">Gestion des dossiers</h1>
                <Button as-child>
                    <Link :href="dossiersCreate().url">
                        Nouveau dossier
                    </Link>
                </Button>
            </div>

            <DossierFilters />

            <DossierTable :dossiers="props.dossiers?.data ?? []" />

        </div>
    </AppLayout>
</template>
