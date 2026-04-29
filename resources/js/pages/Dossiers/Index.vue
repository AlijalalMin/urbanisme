<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { dashboard } from '@/routes';
import { index as dossiersIndex, create as dossiersCreate } from '@/routes/dossiers';
import type { BreadcrumbItemType } from '@/types';
import type { Dossier } from '@/types/dossier';
import { Head, Link } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import DossierFilters from './components/DossierFilters.vue';
import DossierTable from './components/DossierTable.vue';

interface Props {
    dossiers?: {
        data: Dossier[];
        links: any[];
    };
    filters?: {
        search?: string;
        status?: string;
    };
}

const props = withDefaults(defineProps<Props>(), {
    dossiers: () => ({ data: [], links: [] }),
    filters: () => ({ search: '', status: '' }),
});

const breadcrumbs: BreadcrumbItemType[] = [
    {
        title: 'Tableau de bord',
        href: dashboard.url(),
    },
    {
        title: 'Dossiers',
        href: dossiersIndex.url(),
    },
];
</script>

<template>
    <Head title="Dossiers" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative p-6 space-y-8 animate-fade-in-up">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Gestion des dossiers</h1>
                    <p class="text-slate-500 dark:text-slate-400">Consultez et gérez l'ensemble des dossiers d'urbanisme.</p>
                </div>
                <Button as-child class="rounded-full bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/20 px-6">
                    <Link :href="dossiersCreate.url()">
                        <div class="flex items-center gap-2">
                            <Plus class="w-4 h-4" />
                            <span>Nouveau dossier</span>
                        </div>
                    </Link>
                </Button>
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl bg-white/60 p-6 shadow-sm border border-white backdrop-blur-xl dark:bg-slate-900/60 dark:border-slate-800">
                    <DossierFilters :initial-filters="props.filters" />
                </div>

                <div class="rounded-2xl overflow-hidden bg-white/60 shadow-sm border border-white backdrop-blur-xl dark:bg-slate-900/60 dark:border-slate-800">
                    <DossierTable :dossiers="props.dossiers?.data ?? []" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out forwards;
}
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
