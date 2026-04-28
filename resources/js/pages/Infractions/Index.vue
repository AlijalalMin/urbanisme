<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Head, Link } from '@inertiajs/vue3';
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
    { title: 'Dashboard', href: dashboard().url },
    { title: 'Infractions', href: infractionsIndex().url },
];
</script>

<template>
    <Head title="Infractions" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-6 p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold">Gestion des infractions</h1>
                <Button as-child>
                    <Link :href="infractionsCreate().url">
                        Nouvelle infraction
                    </Link>
                </Button>
            </div>
            
            <InfractionTable :infractions="infractions.data" />
        </div>
    </AppLayout>
</template>
