<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
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
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Dossiers',
        href: dossiersIndex().url,
    },
    {
        title: props.dossier.numero_dossier,
        href: '#',
    },
]);
</script>

<template>
    <Head :title="`Dossier ${dossier.numero_dossier}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <Card>
                <CardHeader>
                    <CardTitle>
                        Dossier {{ dossier.numero_dossier }}
                    </CardTitle>
                </CardHeader>

                <CardContent class="space-y-4">

                    <div>
                        <h3 class="font-medium">Objet</h3>
                        <p>{{ dossier.objet }}</p>
                    </div>

                    <div>
                        <h3 class="font-medium">Priorité</h3>
                        <p>{{ dossier.priorite }}</p>
                    </div>

                    <div>
                        <h3 class="font-medium">Créé par</h3>
                        <p>{{ dossier.user?.name }}</p>
                    </div>

                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>