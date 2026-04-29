<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { PlusIcon } from 'lucide-vue-next';
import { ref } from 'vue';
import { store as auteursStore } from '@/routes/auteurs';

const props = defineProps<{
    dossierId: number
    inline?: boolean
}>();

const open = ref(false);

const form = useForm({
    nom: '',
    prenom: '',
    cin: '',
    statut_professionnel: 'personne',
    telephone: '',
    adresse: '',
    ville: '',
    raison_sociale: '',
    ice: '',
    role_auteur: 'auteur',
    commentaire: '',
});

const submit = () => {
    form.post(auteursStore(props.dossierId).url, {
        onSuccess: () => {
            form.reset();
            if (!props.inline) {
                open.value = false;
            }
        },
    });
};
</script>

<template>
    <!-- Inline Mode -->
    <div v-if="inline" class="space-y-4">
        <form @submit.prevent="submit" class="bg-muted/30 p-6 rounded-xl border border-dashed border-destructive/30">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <PlusIcon class="h-5 w-5 text-destructive" />
                Identifier un auteur
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <Label for="nom">Nom</Label>
                    <Input id="nom" v-model="form.nom" required placeholder="Nom de famille" />
                    <div v-if="form.errors.nom" class="text-destructive text-xs">{{ form.errors.nom }}</div>
                </div>
                <div class="space-y-2">
                    <Label for="prenom">Prénom</Label>
                    <Input id="prenom" v-model="form.prenom" placeholder="Prénom" />
                </div>
                <div class="space-y-2">
                    <Label for="cin">CIN</Label>
                    <Input id="cin" v-model="form.cin" placeholder="Ex: AB123456" />
                </div>
                <div class="space-y-2">
                    <Label for="statut_professionnel">Statut</Label>
                    <select
                        id="statut_professionnel"
                        v-model="form.statut_professionnel"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary"
                    >
                        <option value="personne">Personne Physique</option>
                        <option value="entreprise">Entreprise / Société</option>
                        <option value="agent_public">Agent Public</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <Label for="raison_sociale">Raison Sociale</Label>
                    <Input id="raison_sociale" v-model="form.raison_sociale" placeholder="Si entreprise" />
                </div>
                <div class="space-y-2">
                    <Label for="ice">ICE</Label>
                    <Input id="ice" v-model="form.ice" placeholder="Si entreprise" />
                </div>
                <div class="space-y-2">
                    <Label for="telephone">Téléphone</Label>
                    <Input id="telephone" v-model="form.telephone" placeholder="N° de téléphone" />
                </div>
                <div class="space-y-2">
                    <Label for="ville">Ville</Label>
                    <Input id="ville" v-model="form.ville" placeholder="Ville de résidence" />
                </div>
                <div class="space-y-2 col-span-1 md:col-span-2">
                    <Label for="adresse">Adresse</Label>
                    <Input id="adresse" v-model="form.adresse" placeholder="Adresse complète" />
                </div>
                <div class="space-y-2 col-span-1 md:col-span-2">
                    <Label for="commentaire">Commentaire</Label>
                    <textarea
                        id="commentaire"
                        v-model="form.commentaire"
                        rows="2"
                        placeholder="Informations sur l'infraction ou l'auteur..."
                        class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary"
                    ></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-6">
                <Button type="submit" variant="secondary" :disabled="form.processing" class="shadow-sm border border-destructive/20">
                    <span v-if="form.processing">Enregistrement...</span>
                    <span v-else>Enregistrer cet auteur</span>
                </Button>
            </div>
        </form>
    </div>

    <!-- Dialog Mode (for Show page) -->
    <Dialog v-else v-model:open="open">
        <DialogTrigger as-child>
            <Button size="sm" variant="secondary" class="flex items-center gap-2">
                <PlusIcon class="h-4 w-4" />
                Identifier l'auteur
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[600px]">
            <DialogHeader>
                <DialogTitle>Identification de l'Auteur de l'Infraction</DialogTitle>
            </DialogHeader>
            <form @submit.prevent="submit" class="space-y-4 py-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <Label for="nom">Nom</Label>
                        <Input id="nom" v-model="form.nom" required />
                        <div v-if="form.errors.nom" class="text-destructive text-xs">{{ form.errors.nom }}</div>
                    </div>
                    <div class="space-y-2">
                        <Label for="prenom">Prénom</Label>
                        <Input id="prenom" v-model="form.prenom" />
                    </div>
                    <div class="space-y-2">
                        <Label for="cin">CIN</Label>
                        <Input id="cin" v-model="form.cin" />
                    </div>
                    <div class="space-y-2">
                        <Label for="statut_professionnel">Statut</Label>
                        <select
                            id="statut_professionnel"
                            v-model="form.statut_professionnel"
                            class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                        >
                            <option value="personne">Personne Physique</option>
                            <option value="entreprise">Entreprise / Société</option>
                            <option value="agent_public">Agent Public</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <Label for="raison_sociale">Raison Sociale</Label>
                        <Input id="raison_sociale" v-model="form.raison_sociale" />
                    </div>
                    <div class="space-y-2">
                        <Label for="ice">ICE</Label>
                        <Input id="ice" v-model="form.ice" />
                    </div>
                    <div class="space-y-2">
                        <Label for="telephone">Téléphone</Label>
                        <Input id="telephone" v-model="form.telephone" />
                    </div>
                    <div class="space-y-2">
                        <Label for="ville">Ville</Label>
                        <Input id="ville" v-model="form.ville" />
                    </div>
                    <div class="space-y-2 col-span-2">
                        <Label for="adresse">Adresse</Label>
                        <Input id="adresse" v-model="form.adresse" />
                    </div>
                    <div class="space-y-2 col-span-2">
                        <Label for="commentaire">Commentaire</Label>
                        <textarea
                            id="commentaire"
                            v-model="form.commentaire"
                            rows="2"
                            class="flex min-h-[60px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                        ></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <Button type="button" variant="outline" @click="open = false">Annuler</Button>
                    <Button type="submit" :disabled="form.processing">Enregistrer</Button>
                </div>
            </form>
        </DialogContent>
    </Dialog>
</template>
