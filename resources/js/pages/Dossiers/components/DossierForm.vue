<script setup lang="ts">
import { useForm, Link, usePage } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { type DossierFormData } from '@/types/dossier';
import { index as dossiersIndex, store as dossiersStore, update as dossiersUpdate } from '@/routes/dossiers';
import type { Dossier } from '@/types/dossier';
import { computed, ref } from 'vue';

const props = defineProps<{
    dossier?: Dossier;
}>();

const emit = defineEmits(['success']);

const page = usePage();
const userId = (page.props.auth as any)?.user?.id;
const allAnnexes = (page.props.annexes as any) || [];
const districts = (page.props.districts as any) || [];

const isEditing = !!props.dossier;

const form = useForm<DossierFormData>({
    numero_dossier: props.dossier?.numero_dossier ?? '',
    objet: props.dossier?.objet ?? '',
    type_dossier: props.dossier?.type_dossier ?? '',
    priorite: props.dossier?.priorite ?? 'normale',
    source_signalement: props.dossier?.source_signalement ?? '',
    plaignant: props.dossier?.plaignant ?? '',
    accuse: props.dossier?.accuse ?? '',
    coordonnees_gps: props.dossier?.coordonnees_gps ?? '',
    adresse_complete: props.dossier?.adresse_complete ?? '',
    description_initiale: props.dossier?.description_initiale ?? '',
    date_arrive: props.dossier?.date_arrive ?? new Date().toISOString().split('T')[0],
    user_id: props.dossier?.user_id ?? userId,
    annexe_id: props.dossier?.annexe_id ?? null,
    district_id: props.dossier?.district_id ?? null,
    statut: props.dossier?.statut ?? 'nouveau',
});

// For filtering annexes, we use the form's district_id
const filteredAnnexes = computed(() => {
    // Ensure we compare with the same type (number)
    const selectedId = form.district_id ? Number(form.district_id) : null;
    if (!selectedId) return allAnnexes;
    return allAnnexes.filter((annexe: any) => Number(annexe.district_id) === selectedId);
});

const submit = () => {
    if (isEditing && props.dossier) {
        form.put(dossiersUpdate(props.dossier).url, {
            onSuccess: (page) => {
                const dossier = (page.props as any).flash?.dossier || (page.props as any).dossier;
                emit('success', dossier);
            },
        });
    } else {
        form.post(dossiersStore().url, {
            onSuccess: (page) => {
                const dossier = (page.props as any).flash?.dossier || (page.props as any).dossier;
                emit('success', dossier);
            },
        });
    }
};

const handleDistrictChange = (e: Event) => {
    const val = (e.target as HTMLSelectElement).value;
    form.district_id = val && val !== 'null' ? Number(val) : null;
    
    // If the currently selected annexe doesn't belong to the new district, reset it
    if (form.annexe_id) {
        const currentAnnexe = allAnnexes.find((a: any) => a.id === form.annexe_id);
        if (currentAnnexe && form.district_id && Number(currentAnnexe.district_id) !== Number(form.district_id)) {
            form.annexe_id = null;
        }
    }
};

const handleAnnexeChange = (e: Event) => {
    const val = (e.target as HTMLSelectElement).value;
    const annexeId = val && val !== 'null' ? Number(val) : null;
    form.annexe_id = annexeId;
    
    // Auto-select district if annexe is selected and district is empty
    if (annexeId) {
        const selectedAnnexe = allAnnexes.find((a: any) => a.id === annexeId);
        if (selectedAnnexe && selectedAnnexe.district_id) {
            form.district_id = Number(selectedAnnexe.district_id);
        }
    }
};
</script>

<template>
    <form @submit.prevent="submit" class="space-y-6">
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
                        <Input id="numero_dossier" v-model="form.numero_dossier" placeholder="Ex: D-2024-001" required class="bg-background border-primary/30 focus-visible:ring-primary" />
                        <div v-if="form.errors.numero_dossier" class="text-destructive text-xs mt-1">{{ form.errors.numero_dossier }}</div>
                    </div>

                    <!-- District Selection -->
                    <div class="space-y-1.5">
                        <Label for="district_id" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">District <span class="text-destructive text-xl mt-1">*</span></Label>
                        <select
                            id="district_id"
                            :value="form.district_id"
                            @change="handleDistrictChange"
                            required
                            class="flex h-9 w-full rounded-md border border-primary/30 bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary disabled:cursor-not-allowed disabled:opacity-50 text-foreground outline-none focus:border-primary/60"
                        >
                            <option :value="null" disabled>Sélectionner un district</option>
                            <option v-for="district in districts" :key="district.id" :value="district.id">{{ district.nom }}</option>
                        </select>
                        <div v-if="form.errors.district_id" class="text-destructive text-xs mt-1">{{ form.errors.district_id }}</div>
                    </div>

                    <!-- Annexe Selection (Filtered) -->
                    <div class="space-y-1.5">
                        <Label for="annexe_id" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Annexe <span class="text-destructive text-xl mt-1">*</span></Label>
                        <select
                            id="annexe_id"
                            :value="form.annexe_id"
                            @change="handleAnnexeChange"
                            required
                            class="flex h-9 w-full rounded-md border border-primary/30 bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary disabled:cursor-not-allowed disabled:opacity-50 text-foreground outline-none focus:border-primary/60"
                        >
                            <option :value="null" disabled>Sélectionner une annexe</option>
                            <option v-for="annexe in filteredAnnexes" :key="annexe.id" :value="annexe.id">{{ annexe.nom }}</option>
                        </select>
                        <div v-if="form.errors.annexe_id" class="text-destructive text-xs mt-1">{{ form.errors.annexe_id }}</div>
                    </div>

                    <div class="space-y-1.5">
                        <Label for="date_arrive" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Date d'arrivée <span class="text-destructive text-xl mt-1">*</span></Label>
                        <Input id="date_arrive" v-model="form.date_arrive" type="date" required class="bg-background border-primary/30 focus-visible:ring-primary" />
                        <div v-if="form.errors.date_arrive" class="text-destructive text-xs mt-1">{{ form.errors.date_arrive }}</div>
                    </div>

                    <div class="space-y-1.5">
                        <Label for="type_dossier" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Type de dossier <span class="text-destructive text-xl mt-1">*</span></Label>
                        <select
                            id="type_dossier"
                            v-model="form.type_dossier"
                            required
                            class="flex h-9 w-full rounded-md border border-primary/30 bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary disabled:cursor-not-allowed disabled:opacity-50 text-foreground outline-none focus:border-primary/60"
                        >
                            <option value="" disabled>Sélectionner un type</option>
                            <option value="permis_construire">Permis de construire</option>
                            <option value="lotissement">Lotissement</option>
                            <option value="plainte">Plainte</option>
                            <option value="autre">Autre</option>
                        </select>
                        <div v-if="form.errors.type_dossier" class="text-destructive text-xs mt-1">{{ form.errors.type_dossier }}</div>
                    </div>

                    <div class="space-y-1.5">
                        <Label for="priorite" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Priorité <span class="text-destructive text-xl mt-1">*</span></Label>
                        <select
                            id="priorite"
                            v-model="form.priorite"
                            required
                            class="flex h-9 w-full rounded-md border border-primary/30 bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary disabled:cursor-not-allowed disabled:opacity-50 text-foreground outline-none focus:border-primary/60"
                        >
                            <option value="faible">Faible</option>
                            <option value="normale">Normale</option>
                            <option value="haute">Haute</option>
                        </select>
                        <div v-if="form.errors.priorite" class="text-destructive text-xs mt-1">{{ form.errors.priorite }}</div>
                    </div>

                    <div class="space-y-1.5 md:col-span-2">
                        <Label for="objet" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Objet <span class="text-destructive text-xl mt-1">*</span></Label>
                        <Input id="objet" v-model="form.objet" placeholder="Objet du dossier" required class="bg-background border-primary/30 focus-visible:ring-primary" />
                        <div v-if="form.errors.objet" class="text-destructive text-xs mt-1">{{ form.errors.objet }}</div>
                    </div>
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
                        <Input id="source_signalement" v-model="form.source_signalement" placeholder="Ex: Courrier, Visite…" required class="bg-background border-primary/30 focus-visible:ring-primary" />
                        <div v-if="form.errors.source_signalement" class="text-destructive text-xs mt-1">{{ form.errors.source_signalement }}</div>
                    </div>

                    <div class="space-y-1.5">
                        <Label for="description_initiale" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Description initiale</Label>
                        <textarea
                            id="description_initiale"
                            v-model="form.description_initiale"
                            placeholder="Détails du dossier..."
                            rows="7"
                            class="flex min-h-[140px] w-full rounded-md border border-primary/30 bg-background px-3 py-2 text-sm shadow-sm transition-colors outline-none focus:ring-1 focus:ring-primary focus:border-primary/60 disabled:cursor-not-allowed disabled:opacity-50 text-foreground placeholder:text-muted-foreground resize-none"
                        ></textarea>
                        <div v-if="form.errors.description_initiale" class="text-destructive text-xs mt-1">{{ form.errors.description_initiale }}</div>
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
                        <Input id="plaignant" v-model="form.plaignant" placeholder="Nom du plaignant" class="bg-background border-primary/30 focus-visible:ring-primary" />
                        <div v-if="form.errors.plaignant" class="text-destructive text-xs mt-1">{{ form.errors.plaignant }}</div>
                    </div>

                    <div class="space-y-1.5">
                        <Label for="accuse" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Accusé <span class="normal-case font-normal">(optionnel)</span></Label>
                        <Input id="accuse" v-model="form.accuse" placeholder="Nom de l'accusé" class="bg-background border-primary/30 focus-visible:ring-primary" />
                        <div v-if="form.errors.accuse" class="text-destructive text-xs mt-1">{{ form.errors.accuse }}</div>
                    </div>

                    <div class="space-y-1.5">
                        <Label for="coordonnees_gps" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Coordonnées GPS <span class="normal-case font-normal">(optionnel)</span></Label>
                        <Input id="coordonnees_gps" v-model="form.coordonnees_gps" placeholder="12.345, -67.890" class="bg-background border-primary/30 focus-visible:ring-primary" />
                        <div v-if="form.errors.coordonnees_gps" class="text-destructive text-xs mt-1">{{ form.errors.coordonnees_gps }}</div>
                    </div>

                    <div class="space-y-1.5">
                        <Label for="adresse_complete" class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Adresse complète <span class="normal-case font-normal">(optionnel)</span></Label>
                        <Input id="adresse_complete" v-model="form.adresse_complete" placeholder="Adresse du site concerné" class="bg-background border-primary/30 focus-visible:ring-primary" />
                        <div v-if="form.errors.adresse_complete" class="text-destructive text-xs mt-1">{{ form.errors.adresse_complete }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3 rounded-xl border border-border bg-card px-6 py-4 shadow-sm dark:border-border/60 dark:shadow-none">
            <Button type="button" variant="outline" size="lg" as-child>
                <Link :href="dossiersIndex().url">Annuler</Link>
            </Button>
            <Button type="submit" size="lg" :disabled="form.processing" class="min-w-32">
                <span v-if="form.processing" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                    </svg>
                    Enregistrement…
                </span>
                <span v-else>{{ isEditing ? 'Mettre à jour' : 'Continuer vers l\'étape 2' }}</span>
                </Button>
            </div>
    </form>
</template>
