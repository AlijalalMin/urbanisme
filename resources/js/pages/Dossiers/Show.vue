<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge, type BadgeVariants } from '@/components/ui/badge';
import { dashboard } from '@/routes';
import { index as dossiersIndex, edit as dossierEdit } from '@/routes/dossiers';
import { create as infractionCreate, show as infractionShow } from '@/routes/infractions';
import { type BreadcrumbItem } from '@/types';
import type { Dossier } from '@/types/dossier';
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
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
                        <div class="flex items-center gap-3">
                            Dossier {{ dossier.numero_dossier }}
                            <Badge :variant="statusColor(dossier.statut)">
                                {{ dossier.statut }}
                            </Badge>
                        </div>
                        <Button as-child variant="outline" size="sm">
                            <Link :href="dossierEdit(dossier).url">
                                Éditer
                            </Link>
                        </Button>
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

                    <div class="space-y-2 md:col-span-2">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Adresse complète</h3>
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-100 text-gray-700 whitespace-pre-wrap leading-relaxed">
                            {{ dossier.adresse_complete || 'Non renseignée' }}
                        </div>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Description initiale</h3>
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-100 text-gray-700 whitespace-pre-wrap leading-relaxed">
                            {{ dossier.description_initiale || 'Aucune description fournie' }}
                        </div>
                    </div>
                </CardContent>
            </Card>

            <!-- Infractions Section -->
            <Card class="shadow-sm border border-gray-200">
                <CardHeader class="border-b bg-gray-50/50 pb-4">
                    <CardTitle class="text-lg font-semibold text-gray-800 flex items-center justify-between">
                        Infractions liées
                        <Button as-child variant="outline" size="sm">
                            <Link :href="infractionCreate().url">Nouvelle Infraction</Link>
                        </Button>
                    </CardTitle>
                </CardHeader>
                <CardContent class="p-0">
                    <div v-if="dossier.infractions && dossier.infractions.length > 0" class="divide-y">
                        <div v-for="infraction in dossier.infractions" :key="infraction.id" class="p-4 flex items-center justify-between hover:bg-gray-50">
                            <div>
                                <p class="font-medium text-gray-900">{{ infraction.numero_infraction }}</p>
                                <p class="text-sm text-gray-500">Gravité: {{ infraction.niveau_gravite }} | Statut: {{ infraction.statut_infraction }}</p>
                            </div>
                            <Button as-child variant="ghost" size="sm">
                                <Link :href="infractionShow(infraction).url">Voir Détails</Link>
                            </Button>
                        </div>
                    </div>
                    <div v-else class="p-8 text-center text-gray-500">
                        Aucune infraction liée à ce dossier.
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>