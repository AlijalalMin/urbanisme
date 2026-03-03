<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { usePage } from '@inertiajs/vue3';
import { type DossierFormData } from '@/types/dossier';
import { index as dossiersIndex, store as dossiersStore } from '@/routes/dossiers';

const page = usePage();
const userId = (page.props.auth as any).user.id;
const annexes = (page.props.annexes as any);

const defaultData: DossierFormData = {
    numero_dossier: '',
    objet: '',
    type_dossier: '',
    priorite: 'normale',
    source_signalement: '',
    plaignant: '',
    accuse: '',
    coordonnees_gps: '',
    adresse_complete: '',
    description_initiale: '',
    date_arrive: new Date().toISOString().split('T')[0],
    user_id: userId,
    statut: 'nouveau',
};
</script>

<template>
    <Form
        :action="dossiersStore().url"
        method="post"
        :defaults="defaultData"
        #default="{
            errors,
            processing,
        }"
    >
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <Label for="numero_dossier">Numéro de dossier</Label>
                <Input id="numero_dossier" name="numero_dossier" placeholder="Ex: D-2024-001" required />
                <div v-if="errors.numero_dossier" class="text-red-500 text-sm">{{ errors.numero_dossier }}</div>
            </div>

            <input type="hidden" name="user_id" :value="userId" />
            <div class="space-y-2">
                <Label for="annexe_id">Annexe</Label>
                <select
                    name="annexe_id"
                    required
                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                >
                    <option value="" disabled selected>Sélectionner une annexe</option>
                    <option v-for="annexe in annexes" :key="annexe.id" :value="annexe.id">{{ annexe.nom }}</option>
                </select>
                <div v-if="errors.annexe_id" class="text-red-500 text-sm">{{ errors.annexe_id }}</div>
            </div>

            <div class="space-y-2">
                <Label for="date_arrive">Date d'arrivée</Label>
                <Input id="date_arrive" name="date_arrive" type="date" required />
                <div v-if="errors.date_arrive" class="text-red-500 text-sm">{{ errors.date_arrive }}</div>
            </div>

            <div class="space-y-2 md:col-span-2">
                <Label for="objet">Objet</Label>
                <Input id="objet" name="objet" placeholder="Objet du dossier" required />
                <div v-if="errors.objet" class="text-red-500 text-sm">{{ errors.objet }}</div>
            </div>

            <div class="space-y-2">
                <Label for="type_dossier">Type de dossier</Label>
                <select
                    name="type_dossier"
                    required
                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                >
                    <option value="" disabled selected>Sélectionner un type</option>
                    <option value="permis_construire">Permis de construire</option>
                    <option value="lotissement">Lotissement</option>
                    <option value="plainte">Plainte</option>
                    <option value="autre">Autre</option>
                </select>
                <div v-if="errors.type_dossier" class="text-red-500 text-sm">{{ errors.type_dossier }}</div>
            </div>

            <div class="space-y-2">
                <Label for="priorite">Priorité</Label>
                <select
                    name="priorite"
                    required
                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                >
                    <option value="" disabled>Sélectionner la priorité</option>
                    <option value="faible">Faible</option>
                    <option value="normale" selected>Normale</option>
                    <option value="haute">Haute</option>
                </select>
                <div v-if="errors.priorite" class="text-red-500 text-sm">{{ errors.priorite }}</div>
            </div>

            <div class="space-y-2">
                <Label for="statut">Statut</Label>
                <select
                    name="statut"
                    required
                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                >
                    <option value="nouveau" selected>Nouveau</option>
                    <option value="en_cours">En cours</option>
                    <option value="cloture">Clôturé</option>
                    <option value="archive">Archivé</option>
                </select>
                <div v-if="errors.statut" class="text-red-500 text-sm">{{ errors.statut }}</div>
            </div>

            <div class="space-y-2">
                <Label for="source_signalement">Source du signalement</Label>
                <Input id="source_signalement" name="source_signalement" placeholder="Ex: Courrier, Visite, etc." required />
                <div v-if="errors.source_signalement" class="text-red-500 text-sm">{{ errors.source_signalement }}</div>
            </div>

            <div class="space-y-2">
                <Label for="plaignant">Plaignant (optionnel)</Label>
                <Input id="plaignant" name="plaignant" placeholder="Nom du plaignant" />
                <div v-if="errors.plaignant" class="text-red-500 text-sm">{{ errors.plaignant }}</div>
            </div>

            <div class="space-y-2">
                <Label for="accuse">Accusé (optionnel)</Label>
                <Input id="accuse" name="accuse" placeholder="Nom de l'accusé" />
                <div v-if="errors.accuse" class="text-red-500 text-sm">{{ errors.accuse }}</div>
            </div>

            <div class="space-y-2">
                <Label for="coordonnees_gps">Coordonnées GPS (optionnel)</Label>
                <Input id="coordonnees_gps" name="coordonnees_gps" placeholder="Ex: 12.345, -67.890" />
                <div v-if="errors.coordonnees_gps" class="text-red-500 text-sm">{{ errors.coordonnees_gps }}</div>
            </div>

            <div class="space-y-2 md:col-span-2">
                <Label for="adresse_complete">Adresse complète (optionnel)</Label>
                <Input id="adresse_complete" name="adresse_complete" placeholder="Adresse du site concerné" />
                <div v-if="errors.adresse_complete" class="text-red-500 text-sm">{{ errors.adresse_complete }}</div>
            </div>

            <div class="space-y-2 md:col-span-2">
                <Label for="description_initiale">Description initiale</Label>
                <textarea
                    id="description_initiale"
                    name="description_initiale"
                    placeholder="Détails du dossier..."
                    rows="4"
                    class="flex min-h-[60px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                ></textarea>
                <div v-if="errors.description_initiale" class="text-red-500 text-sm">{{ errors.description_initiale }}</div>
            </div>

            <div class="flex justify-end gap-3 md:col-span-2 mt-4">
                <Button type="button" variant="outline" as-child>
                    <Link :href="dossiersIndex().url">Annuler</Link>
                </Button>
                <Button type="submit" :disabled="processing">
                    {{ processing ? 'Enregistrement...' : 'Créer le dossier' }}
                </Button>
            </div>
        </div>
    </Form>
</template>
