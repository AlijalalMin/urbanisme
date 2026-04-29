<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Head, Link } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import { dashboard } from '@/routes';
import { index as infractionsIndex, create as infractionsCreate } from '@/routes/infractions';
import type { Infraction } from '@/types/infraction';
import InfractionTable from './Partials/InfractionTable.vue';

defineProps<{
    infractions: {
        data: Infraction[]
    }
}>()

const breadcrumbs = [
    { title: 'Tableau de bord', href: dashboard().url },
    { title: 'Infractions', href: infractionsIndex().url },
];
</script>

<template>
    <Head title="Infractions" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative p-6 space-y-8 animate-fade-in-up">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Gestion des infractions</h1>
                    <p class="text-slate-500 dark:text-slate-400">Suivi et traitement des infractions relevées.</p>
                </div>
                <Button as-child class="rounded-full bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/20 px-6">
                    <Link :href="infractionsCreate().url">
                        <div class="flex items-center gap-2">
                            <Plus class="w-4 h-4" />
                            <span>Nouvelle infraction</span>
                        </div>
                    </Link>
                </Button>
            </div>
            
            <div class="rounded-2xl overflow-hidden bg-white/60 shadow-sm border border-white backdrop-blur-xl dark:bg-slate-900/60 dark:border-slate-800">
                <InfractionTable :infractions="infractions.data" />
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
