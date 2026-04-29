<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { usePage } from '@inertiajs/vue3';
import { type DossierFormData } from '@/types/dossier';
import { store as dossiersStore, index as dossiersIndex } from '@/routes/dossiers';

const emit = defineEmits(['success']);

const page = usePage();
const userId = (page.props.auth as any).user.id;
const annexes = (page.props.annexes as any);

const form = useForm<DossierFormData>({
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
});

const submit = () => {
    form.post(dossiersStore().url, {
        onSuccess: (page) => {
            // If the backend returns the created dossier in the props or session
            // we might need to adjust this depending on what the backend does.
            // For now, let's assume we want to signal success to the parent.
            const dossier = (page.props as any).flash?.dossier || (page.props as any).dossier;
            emit('success', dossier);
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit">
        <div class="space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Section 1: Informations Générales -->
                <div class="lg:col-span-2 rounded-xl border border-border bg-card shadow-lg dark:border-border/60 dark:shadow-none overflow-hidden" style="border-top: 4px solid hsl(var(--primary))">
                    <div class="flex items-center gap-3 border-b border-border px-6 py-4 dark:border-border/60 bg-muted/20">
                        <span class="h-6 w-1.5 rounded-full bg-primary"></span>
                        <h2 class="text-sm font-bold uppercase tracking-wider text-foreground">Informations Générales</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6">
                        <div class="space-y-1.5">
                            <Label for="numero_dossier" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Numéro de dossier <span class="text-destructive">*</span></Label>
                            <Input id="numero_dossier" v-model="form.numero_dossier" placeholder="Ex: D-2024-001" required class="bg-background" />
                            <div v-if="form.errors.numero_dossier" class="text-destructive text-xs mt-1">{{ form.errors.numero_dossier }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="annexe_id" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Annexe <span class="text-destructive">*</span></Label>
                            <select
                                id="annexe_id"
                                v-model="form.annexe_id"
                                required
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary text-foreground outline-none"
                            >
                                <option :value="undefined" disabled>Sélectionner une annexe</option>
                                <option v-for="annexe in annexes" :key="annexe.id" :value="annexe.id">{{ annexe.nom }}</option>
                            </select>
                            <div v-if="form.errors.annexe_id" class="text-destructive text-xs mt-1">{{ form.errors.annexe_id }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="date_arrive" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Date d'arrivée <span class="text-destructive">*</span></Label>
                            <Input id="date_arrive" v-model="form.date_arrive" type="date" required class="bg-background" />
                            <div v-if="form.errors.date_arrive" class="text-destructive text-xs mt-1">{{ form.errors.date_arrive }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="type_dossier" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Type de dossier <span class="text-destructive">*</span></Label>
                            <select
                                id="type_dossier"
                                v-model="form.type_dossier"
                                required
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary text-foreground outline-none"
                            >
                                <option value="" disabled>Sélectionner un type</option>
                                <option value="permis_construire">Permis de construire</option>
                                <option value="lotissement">Lotissement</option>
                                <option value="plainte">Plainte</option>
                                <option value="autre">Autre</option>
                            </select>
                            <div v-if="form.errors.type_dossier" class="text-destructive text-xs mt-1">{{ form.errors.type_dossier }}</div>
                        </div>

                        <div class="space-y-1.5 md:col-span-2">
                            <Label for="objet" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Objet <span class="text-destructive">*</span></Label>
                            <Input id="objet" v-model="form.objet" placeholder="Objet du dossier" required class="bg-background" />
                            <div v-if="form.errors.objet" class="text-destructive text-xs mt-1">{{ form.errors.objet }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="priorite" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Priorité <span class="text-destructive">*</span></Label>
                            <select
                                id="priorite"
                                v-model="form.priorite"
                                required
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary text-foreground outline-none"
                            >
                                <option value="faible">Faible</option>
                                <option value="normale">Normale</option>
                                <option value="haute">Haute</option>
                            </select>
                            <div v-if="form.errors.priorite" class="text-destructive text-xs mt-1">{{ form.errors.priorite }}</div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Détails & Signalement -->
                <div class="rounded-xl border border-border bg-card shadow-lg dark:border-border/60 dark:shadow-none overflow-hidden" style="border-top: 4px solid hsl(var(--chart-2))">
                    <div class="flex items-center gap-3 border-b border-border px-6 py-4 dark:border-border/60 bg-muted/20">
                        <span class="h-6 w-1.5 rounded-full bg-chart-2"></span>
                        <h2 class="text-sm font-bold uppercase tracking-wider text-foreground">Détails & Signalement</h2>
                    </div>
                    <div class="space-y-5 p-6">
                        <div class="space-y-1.5">
                            <Label for="source_signalement" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Source du signalement <span class="text-destructive">*</span></Label>
                            <Input id="source_signalement" v-model="form.source_signalement" placeholder="Ex: Courrier, Visite…" required class="bg-background" />
                            <div v-if="form.errors.source_signalement" class="text-destructive text-xs mt-1">{{ form.errors.source_signalement }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="description_initiale" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Description initiale</Label>
                            <textarea
                                id="description_initiale"
                                v-model="form.description_initiale"
                                placeholder="Détails du dossier..."
                                rows="6"
                                class="flex min-h-[140px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors outline-none focus:ring-1 focus:ring-primary text-foreground placeholder:text-muted-foreground resize-none"
                            ></textarea>
                            <div v-if="form.errors.description_initiale" class="text-destructive text-xs mt-1">{{ form.errors.description_initiale }}</div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Localisation & Personnes -->
                <div class="lg:col-span-3 rounded-xl border border-border bg-card shadow-lg dark:border-border/60 dark:shadow-none overflow-hidden" style="border-top: 4px solid hsl(var(--chart-4))">
                    <div class="flex items-center gap-3 border-b border-border px-6 py-4 dark:border-border/60 bg-muted/20">
                        <span class="h-6 w-1.5 rounded-full bg-chart-4"></span>
                        <h2 class="text-sm font-bold uppercase tracking-wider text-foreground">Localisation & Personnes Concernées</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 p-6">
                        <div class="space-y-1.5">
                            <Label for="plaignant" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Plaignant <span class="normal-case font-normal">(optionnel)</span></Label>
                            <Input id="plaignant" v-model="form.plaignant" placeholder="Nom du plaignant" class="bg-background" />
                            <div v-if="form.errors.plaignant" class="text-destructive text-xs mt-1">{{ form.errors.plaignant }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="accuse" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Accusé <span class="normal-case font-normal">(optionnel)</span></Label>
                            <Input id="accuse" v-model="form.accuse" placeholder="Nom de l'accusé" class="bg-background" />
                            <div v-if="form.errors.accuse" class="text-destructive text-xs mt-1">{{ form.errors.accuse }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="coordonnees_gps" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Coordonnées GPS <span class="normal-case font-normal">(optionnel)</span></Label>
                            <Input id="coordonnees_gps" v-model="form.coordonnees_gps" placeholder="12.345, -67.890" class="bg-background" />
                            <div v-if="form.errors.coordonnees_gps" class="text-destructive text-xs mt-1">{{ form.errors.coordonnees_gps }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="adresse_complete" class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">Adresse complète <span class="normal-case font-normal">(optionnel)</span></Label>
                            <Input id="adresse_complete" v-model="form.adresse_complete" placeholder="Adresse du site concerné" class="bg-background" />
                            <div v-if="form.errors.adresse_complete" class="text-destructive text-xs mt-1">{{ form.errors.adresse_complete }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 rounded-xl border border-border bg-card px-6 py-4 shadow-lg dark:border-border/60 dark:shadow-none">
                <Button type="button" variant="outline" size="lg" as-child>
                    <Link :href="dossiersIndex().url">Annuler</Link>
                </Button>
                <Button type="submit" size="lg" :disabled="form.processing" class="min-w-40 shadow-md">
                    <span v-if="form.processing" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                        </svg>
                        Enregistrement…
                    </span>
                    <span v-else>Continuer vers l'étape 2</span>
                </Button>
            </div>
        </div>
    </form>
</template>
