<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { usePage } from '@inertiajs/vue3';
import { index as infractionsIndex, store as infractionsStore, update as infractionsUpdate } from '@/routes/infractions';

const props = defineProps<{
    infraction?: any;
}>();

const page = usePage();
const dossiers = (page.props.dossiers as any) || [];

const isEditing = !!props.infraction;

const defaultData = {
    numero_infraction: props.infraction?.numero_infraction ?? '',
    date_constatation: props.infraction?.date_constatation ? props.infraction.date_constatation.split('T')[0] : new Date().toISOString().split('T')[0],
    localisation_precise: props.infraction?.localisation_precise ?? '',
    niveau_gravite: props.infraction?.niveau_gravite ?? 1,
    statut_infraction: props.infraction?.statut_infraction ?? 'nouvelle',
    dossier_id: props.infraction?.dossier_id ?? '',
};
</script>

<template>
    <Form
        :action="isEditing && infraction ? infractionsUpdate(infraction).url : infractionsStore().url"
        :method="isEditing ? 'put' : 'post'"
        :defaults="defaultData"
        #default="{ errors, processing }"
    >
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6 rounded-xl border border-border bg-card shadow-sm dark:border-border/60">
                <div class="space-y-1.5 md:col-span-2">
                    <Label for="dossier_id" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Dossier lié <span class="text-destructive text-xl mt-1">*</span></Label>
                    <select
                        id="dossier_id"
                        name="dossier_id"
                        required
                        class="flex h-9 w-full rounded-md border border-primary/30 bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        <option value="" disabled selected>Sélectionner un dossier</option>
                        <option v-for="dossier in dossiers" :key="dossier.id" :value="dossier.id">{{ dossier.numero_dossier }}</option>
                    </select>
                    <div v-if="errors.dossier_id" class="text-destructive text-xs mt-1">{{ errors.dossier_id }}</div>
                </div>

                <div class="space-y-1.5">
                    <Label for="numero_infraction" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Numéro Infraction <span class="text-destructive text-xl mt-1">*</span></Label>
                    <Input id="numero_infraction" name="numero_infraction" placeholder="Ex: INF-2024-001" required />
                    <div v-if="errors.numero_infraction" class="text-destructive text-xs mt-1">{{ errors.numero_infraction }}</div>
                </div>

                <div class="space-y-1.5">
                    <Label for="date_constatation" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Date de constatation <span class="text-destructive text-xl mt-1">*</span></Label>
                    <Input id="date_constatation" name="date_constatation" type="date" required />
                    <div v-if="errors.date_constatation" class="text-destructive text-xs mt-1">{{ errors.date_constatation }}</div>
                </div>

                <div class="space-y-1.5 md:col-span-2">
                    <Label for="localisation_precise" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Localisation précise <span class="text-destructive text-xl mt-1">*</span></Label>
                    <Input id="localisation_precise" name="localisation_precise" placeholder="Adresse ou détails..." required />
                    <div v-if="errors.localisation_precise" class="text-destructive text-xs mt-1">{{ errors.localisation_precise }}</div>
                </div>

                <div class="space-y-1.5">
                    <Label for="niveau_gravite" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Niveau de gravité (1-5) <span class="text-destructive text-xl mt-1">*</span></Label>
                    <Input id="niveau_gravite" name="niveau_gravite" type="number" min="1" max="5" required />
                    <div v-if="errors.niveau_gravite" class="text-destructive text-xs mt-1">{{ errors.niveau_gravite }}</div>
                </div>

                <div class="space-y-1.5">
                    <Label for="statut_infraction" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Statut <span class="text-destructive text-xl mt-1">*</span></Label>
                    <select
                        id="statut_infraction"
                        name="statut_infraction"
                        required
                        class="flex h-9 w-full rounded-md border border-primary/30 bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary"
                    >
                        <option value="nouvelle">Nouvelle</option>
                        <option value="en_traitement">En traitement</option>
                        <option value="verifiee">Vérifiée</option>
                        <option value="constatee">Constatée</option>
                        <option value="transmise">Transmise</option>
                    </select>
                    <div v-if="errors.statut_infraction" class="text-destructive text-xs mt-1">{{ errors.statut_infraction }}</div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <Button type="button" variant="outline" as-child>
                    <Link :href="infractionsIndex().url">Annuler</Link>
                </Button>
                <Button type="submit" :disabled="processing">
                    <span v-if="processing">Enregistrement…</span>
                    <span v-else>{{ isEditing ? 'Mettre à jour' : 'Créer l\'infraction' }}</span>
                </Button>
            </div>
        </div>
    </Form>
</template>
