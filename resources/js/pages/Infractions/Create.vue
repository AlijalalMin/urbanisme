<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import InfractionForm from './Partials/InfractionForm.vue';
import { index as infractionsIndex } from '@/routes/infractions';
import { dashboard } from '@/routes';

const breadcrumbs = [
    { title: 'Dashboard', href: dashboard().url },
    { title: 'Infractions', href: infractionsIndex().url },
    { title: 'Nouvelle infraction', href: '#' },
];
</script>

<template>
    <Head title="Nouvelle infraction" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 max-w-4xl mx-auto space-y-6">
            <h1 class="text-2xl font-bold tracking-tight">Nouvelle Infraction</h1>
            <InfractionForm />
        </div>
    </AppLayout>
</template>
