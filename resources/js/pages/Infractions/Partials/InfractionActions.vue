<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { destroy as infractionDestroy, show as infractionShow, edit as infractionEdit } from '@/routes/infractions';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps<{
    infraction: any
}>()

function deleteInfraction(): void {
    if (confirm(`Supprimer l'infraction ${props.infraction.numero_infraction} ?`)) {
        router.delete(infractionDestroy(props.infraction).url);
    }
}
</script>

<template>
    <div class="flex gap-2 justify-end">
        <Button as-child variant="outline" size="sm">
            <Link :href="infractionShow(infraction).url">Voir</Link>
        </Button>
        <Button as-child variant="outline" size="sm">
            <Link :href="infractionEdit(infraction).url">Éditer</Link>
        </Button>
        <Button variant="destructive" size="sm" @click="deleteInfraction">Supprimer</Button>
    </div>
</template>
