<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { destroy as dossierDestroy, show as dossierShow, edit as dossierEdit } from '@/routes/dossiers';
import type { Dossier } from '@/types/dossier';
import { Link, router } from '@inertiajs/vue3';

interface Props {
    dossier: Dossier
}

const props = defineProps<Props>()

function deleteDossier(): void {
    if (confirm(`Supprimer le dossier ${props.dossier.numero_dossier} ?`)) {
        router.delete(dossierDestroy(props.dossier).url);
    }
}
/* function editDossier(): void {
    router.push(dossiersUpdate(props.dossier).url);
} */
</script>

<template>
    <div class="flex gap-2">
        <Button as-child variant="outline">
            <Link :href="dossierShow(props.dossier).url">Voir</Link>
        </Button>
        <Button as-child variant="outline">
            <Link :href="dossierEdit(dossier).url">Éditer</Link>
        </Button>
        <Button variant="destructive" @click="deleteDossier">Supprimer</Button>
    </div>
</template>