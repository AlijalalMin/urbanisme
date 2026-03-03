<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge, type BadgeVariants } from '@/components/ui/badge';
import { dashboard } from '@/routes';
import { index as dossiersIndex } from '@/routes/dossiers';
import { type BreadcrumbItem } from '@/types';
import type { Dossier } from '@/types/dossier';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Props {
    dossier: Dossier
}

const props = defineProps<Props>()

const breadcrumbs = computed<BreadcrumbItem[]>(() => [
    { title: 'Dashboard', href: dashboard().url },
    { title: 'Dossiers', href: dossiersIndex().url },
    { title: props.dossier.numero_dossier, href: '#' },
]);

// Optional: Map statuses to badge colors
const statusColor = (status: string): BadgeVariants['variant'] => {
    switch(status?.toLowerCase()) {
        case 'nouveau': return 'blue';
        case 'en cours': return 'yellow';
        case 'terminé': return 'green';
        case 'rejeté': return 'red';
        default: return 'gray';
    }
}
</script>

<template>
    <Head :title="`Dossier ${dossier.numero_dossier}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 space-y-6">
            <!-- Header Card -->
            <Card class="bg-gray-50 shadow-md border border-gray-200">
                <CardHeader class="pb-2">
                    <CardTitle class="text-2xl font-semibold text-gray-800 flex items-center justify-between">
                        Dossier {{ dossier.numero_dossier }}
                        <Badge :variant="statusColor(dossier.statut)">
                            {{ dossier.statut }}
                        </Badge>
                    </CardTitle>
                </CardHeader>
            </Card>

            <!-- Main Info Grid -->
            <Card class="shadow-sm border border-gray-200">
                <CardContent class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Objet</h3>
                        <p class="text-gray-700">{{ dossier.objet }}</p>
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Priorité</h3>
                        <p class="text-gray-700">{{ dossier.priorite }}</p>
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Créé par</h3>
                        <p class="text-gray-700">{{ dossier.user?.name }}</p>
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Annexe</h3>
                        <p class="text-gray-700">{{ dossier.annexe?.nom }}</p>
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Date d'arrivée</h3>
                        <p class="text-gray-700">{{ dossier.date_arrive }}</p>
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Plaignant</h3>
                        <p class="text-gray-700">{{ dossier.plaignant }}</p>
                    </div>

                    <div class="space-y-1 md:col-span-2">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Adresse complète</h3>
                        <p class="text-gray-700">{{ dossier.adresse_complete }}</p>
                    </div>

                    <div class="space-y-1 md:col-span-2">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Description initiale</h3>
                        <p class="text-gray-700">{{ dossier.description_initiale }}</p>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>