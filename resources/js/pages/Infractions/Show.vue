<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { dashboard } from '@/routes';
import { index as infractionsIndex, edit as infractionEdit } from '@/routes/infractions';
import { show as dossierShow } from '@/routes/dossiers';
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import type { Infraction } from '@/types/infraction';

const props = defineProps<{
    infraction: Infraction
}>()

const breadcrumbs = [
    { title: 'Dashboard', href: dashboard().url },
    { title: 'Infractions', href: infractionsIndex().url },
    { title: props.infraction.numero_infraction, href: '#' },
];
</script>

<template>
    <Head :title="`Infraction ${infraction.numero_infraction}`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 space-y-6 max-w-5xl mx-auto">
            <Card class="bg-gray-50 shadow-md">
                <CardHeader>
                    <CardTitle class="text-2xl flex justify-between items-center">
                        <div>
                            Infraction {{ infraction.numero_infraction }}
                            <span class="ml-3 text-sm px-2 py-1 bg-gray-200 rounded-md">{{ infraction.statut_infraction }}</span>
                        </div>
                        <Button as-child variant="outline" size="sm">
                            <Link :href="infractionEdit(infraction).url">Éditer</Link>
                        </Button>
                    </CardTitle>
                </CardHeader>
            </Card>

            <Card class="shadow-sm">
                <CardContent class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="space-y-1">
                        <h3 class="text-sm text-gray-500 uppercase">Dossier Lié</h3>
                        <Link v-if="infraction.dossier" :href="dossierShow(infraction.dossier).url" class="text-blue-600 hover:underline">
                            {{ infraction.dossier.numero_dossier }}
                        </Link>
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-sm text-gray-500 uppercase">Date Constatation</h3>
                        <p>{{ new Date(infraction.date_constatation).toLocaleDateString() }}</p>
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-sm text-gray-500 uppercase">Niveau de gravité</h3>
                        <p>{{ infraction.niveau_gravite }} / 5</p>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <h3 class="text-sm text-gray-500 uppercase">Localisation précise</h3>
                        <div class="bg-gray-50 p-4 rounded-md border text-gray-700 whitespace-pre-wrap">
                            {{ infraction.localisation_precise }}
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
