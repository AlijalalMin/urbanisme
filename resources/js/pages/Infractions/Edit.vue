<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import InfractionForm from './Partials/InfractionForm.vue';
import { index as infractionsIndex } from '@/routes/infractions';
import { dashboard } from '@/routes';

const props = defineProps<{
    infraction: any
}>();

const breadcrumbs = [
    { title: 'Dashboard', href: dashboard().url },
    { title: 'Infractions', href: infractionsIndex().url },
    { title: `Édition : ${props.infraction.numero_infraction}`, href: '#' },
];
</script>

<template>
    <Head :title="`Éditer l'infraction ${infraction.numero_infraction}`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 max-w-4xl mx-auto space-y-6">
            <h1 class="text-2xl font-bold tracking-tight">Éditer Infraction {{ infraction.numero_infraction }}</h1>
            <InfractionForm :infraction="infraction" />
        </div>
    </AppLayout>
</template>
