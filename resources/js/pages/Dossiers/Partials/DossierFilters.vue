<script setup lang="ts">
import { Input } from '@/components/ui/input';
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps<{
    initialFilters?: {
        search?: string;
        status?: string;
    };
}>();

const search = ref(props.initialFilters?.search ?? '');
const status = ref(props.initialFilters?.status ?? '');

watch([search, status], () => {
    router.get(
        '/dossiers',
        { search: search.value, status: status.value },
        { preserveState: true, replace: true, preserveScroll: true },
    );
});
</script>

<template>
    <div class="flex flex-wrap gap-3">
        <Input
            v-model="search"
            placeholder="Rechercher un dossier…"
            class="max-w-xs"
        />
        <select
            v-model="status"
            class="h-9 rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors focus:outline-none focus:ring-1 focus:ring-ring"
        >
            <option value="">Tous les statuts</option>
            <option value="en_cours">En cours</option>
            <option value="termine">Terminé</option>
            <option value="archive">Archivé</option>
        </select>
    </div>
</template>