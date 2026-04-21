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
        <div class="space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Section 1: Informations Générales -->
                <div class="lg:col-span-2 rounded-xl border border-border bg-card shadow-sm dark:border-border/60 dark:shadow-none overflow-hidden" style="border-top: 3px solid hsl(var(--primary))">
                    <div class="flex items-center gap-3 border-b border-border px-6 py-4 dark:border-border/60">
                        <span class="h-5 w-1 rounded-full bg-primary"></span>
                        <h2 class="text-sm font-semibold uppercase tracking-wider text-foreground">Informations Générales</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6">
                        <div class="space-y-1.5">
                            <Label for="numero_dossier" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Numéro de dossier <span class="text-destructive text-xl mt-1">*</span></Label>
                            <Input id="numero_dossier" name="numero_dossier" placeholder="Ex: D-2024-001" required class="bg-background border-primary/30 focus-visible:ring-primary" />
                            <div v-if="errors.numero_dossier" class="text-destructive text-xs mt-1">{{ errors.numero_dossier }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="annexe_id" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Annexe <span class="text-destructive text-xl mt-1">*</span></Label>
                            <select
                                id="annexe_id"
                                name="annexe_id"
                                required
                                class="flex h-9 w-full rounded-md border border-primary/30 bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary disabled:cursor-not-allowed disabled:opacity-50 text-foreground outline-none focus:border-primary/60"
                            >
                                <option value="" disabled selected>Sélectionner une annexe</option>
                                <option v-for="annexe in annexes" :key="annexe.id" :value="annexe.id">{{ annexe.nom }}</option>
                            </select>
                            <div v-if="errors.annexe_id" class="text-destructive text-xs mt-1">{{ errors.annexe_id }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="date_arrive" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Date d'arrivée <span class="text-destructive text-xl mt-1">*</span></Label>
                            <Input id="date_arrive" name="date_arrive" type="date" required class="bg-background border-primary/30 focus-visible:ring-primary" />
                            <div v-if="errors.date_arrive" class="text-destructive text-xs mt-1">{{ errors.date_arrive }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="type_dossier" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Type de dossier <span class="text-destructive text-xl mt-1">*</span></Label>
                            <select
                                id="type_dossier"
                                name="type_dossier"
                                required
                                class="flex h-9 w-full rounded-md border border-primary/30 bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary disabled:cursor-not-allowed disabled:opacity-50 text-foreground outline-none focus:border-primary/60"
                            >
                                <option value="" disabled selected>Sélectionner un type</option>
                                <option value="permis_construire">Permis de construire</option>
                                <option value="lotissement">Lotissement</option>
                                <option value="plainte">Plainte</option>
                                <option value="autre">Autre</option>
                            </select>
                            <div v-if="errors.type_dossier" class="text-destructive text-xs mt-1">{{ errors.type_dossier }}</div>
                        </div>

                        <div class="space-y-1.5 md:col-span-2">
                            <Label for="objet" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Objet <span class="text-destructive text-xl mt-1">*</span></Label>
                            <Input id="objet" name="objet" placeholder="Objet du dossier" required class="bg-background border-primary/30 focus-visible:ring-primary" />
                            <div v-if="errors.objet" class="text-destructive text-xs mt-1">{{ errors.objet }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="priorite" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Priorité <span class="text-destructive text-xl mt-1">*</span></Label>
                            <select
                                id="priorite"
                                name="priorite"
                                required
                                class="flex h-9 w-full rounded-md border border-primary/30 bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary disabled:cursor-not-allowed disabled:opacity-50 text-foreground outline-none focus:border-primary/60"
                            >
                                <option value="faible">Faible</option>
                                <option value="normale" selected>Normale</option>
                                <option value="haute">Haute</option>
                            </select>
                            <div v-if="errors.priorite" class="text-destructive text-xs mt-1">{{ errors.priorite }}</div>
                        </div>

                        <input type="hidden" name="statut" value="nouveau" />
                        <input type="hidden" name="user_id" :value="userId" />
                    </div>
                </div>

                <!-- Section 2: Détails & Signalement -->
                <div class="rounded-xl border border-border bg-card shadow-sm dark:border-border/60 dark:shadow-none overflow-hidden" style="border-top: 3px solid hsl(var(--chart-2))">
                    <div class="flex items-center gap-3 border-b border-border px-6 py-4 dark:border-border/60">
                        <span class="h-5 w-1 rounded-full bg-chart-2"></span>
                        <h2 class="text-sm font-semibold uppercase tracking-wider text-foreground">Détails & Signalement</h2>
                    </div>
                    <div class="space-y-5 p-6">
                        <div class="space-y-1.5">
                            <Label for="source_signalement" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Source du signalement <span class="text-destructive text-xl mt-1">*</span></Label>
                            <Input id="source_signalement" name="source_signalement" placeholder="Ex: Courrier, Visite…" required class="bg-background border-primary/30 focus-visible:ring-primary" />
                            <div v-if="errors.source_signalement" class="text-destructive text-xs mt-1">{{ errors.source_signalement }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="description_initiale" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Description initiale</Label>
                            <textarea
                                id="description_initiale"
                                name="description_initiale"
                                placeholder="Détails du dossier..."
                                rows="7"
                                class="flex min-h-[140px] w-full rounded-md border border-primary/30 bg-background px-3 py-2 text-sm shadow-sm transition-colors outline-none focus:ring-1 focus:ring-primary focus:border-primary/60 disabled:cursor-not-allowed disabled:opacity-50 text-foreground placeholder:text-muted-foreground resize-none"
                            ></textarea>
                            <div v-if="errors.description_initiale" class="text-destructive text-xs mt-1">{{ errors.description_initiale }}</div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Localisation & Personnes -->
                <div class="lg:col-span-3 rounded-xl border border-border bg-card shadow-sm dark:border-border/60 dark:shadow-none overflow-hidden" style="border-top: 3px solid hsl(var(--chart-4))">
                    <div class="flex items-center gap-3 border-b border-border px-6 py-4 dark:border-border/60">
                        <span class="h-5 w-1 rounded-full bg-chart-4"></span>
                        <h2 class="text-sm font-semibold uppercase tracking-wider text-foreground">Localisation & Personnes Concernées</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 p-6">
                        <div class="space-y-1.5">
                            <Label for="plaignant" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Plaignant <span class="normal-case font-normal">(optionnel)</span></Label>
                            <Input id="plaignant" name="plaignant" placeholder="Nom du plaignant" class="bg-background border-primary/30 focus-visible:ring-primary" />
                            <div v-if="errors.plaignant" class="text-destructive text-xs mt-1">{{ errors.plaignant }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="accuse" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Accusé <span class="normal-case font-normal">(optionnel)</span></Label>
                            <Input id="accuse" name="accuse" placeholder="Nom de l'accusé" class="bg-background border-primary/30 focus-visible:ring-primary" />
                            <div v-if="errors.accuse" class="text-destructive text-xs mt-1">{{ errors.accuse }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="coordonnees_gps" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Coordonnées GPS <span class="normal-case font-normal">(optionnel)</span></Label>
                            <Input id="coordonnees_gps" name="coordonnees_gps" placeholder="12.345, -67.890" class="bg-background border-primary/30 focus-visible:ring-primary" />
                            <div v-if="errors.coordonnees_gps" class="text-destructive text-xs mt-1">{{ errors.coordonnees_gps }}</div>
                        </div>

                        <div class="space-y-1.5">
                            <Label for="adresse_complete" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Adresse complète <span class="normal-case font-normal">(optionnel)</span></Label>
                            <Input id="adresse_complete" name="adresse_complete" placeholder="Adresse du site concerné" class="bg-background border-primary/30 focus-visible:ring-primary" />
                            <div v-if="errors.adresse_complete" class="text-destructive text-xs mt-1">{{ errors.adresse_complete }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 rounded-xl border border-border bg-card px-6 py-4 shadow-sm dark:border-border/60 dark:shadow-none">
                <Button type="button" variant="outline" size="lg" as-child>
                    <Link :href="dossiersIndex().url">Annuler</Link>
                </Button>
                <Button type="submit" size="lg" :disabled="processing" class="min-w-32">
                    <span v-if="processing" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                        </svg>
                        Enregistrement…
                    </span>
                    <span v-else>Créer le dossier</span>
                </Button>
            </div>
        </div>
    </Form>
</template>
