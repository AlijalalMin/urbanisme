<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { PlusIcon } from 'lucide-vue-next';
import { ref } from 'vue';
import { store as requerantsStore } from '@/routes/requerants';

const props = defineProps<{
    dossierId: number
    inline?: boolean
}>();

const open = ref(false);

const form = useForm({
    nom: '',
    cin: '',
    contact: '',
    adresse: '',
    type_requerant: 'personne',
    ice: '',
    role: 'requerant',
    commentaire: '',
});

const submit = () => {
    form.post(requerantsStore(props.dossierId).url, {
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
        <form @submit.prevent="submit" class="bg-muted/30 p-6 rounded-xl border border-dashed border-primary/30">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <PlusIcon class="h-5 w-5 text-primary" />
                Ajouter un requérant
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2 col-span-1 md:col-span-2">
                    <Label for="nom">Nom / Raison Sociale</Label>
                    <Input id="nom" v-model="form.nom" required placeholder="Nom complet ou nom de l'entreprise" />
                    <div v-if="form.errors.nom" class="text-destructive text-xs">{{ form.errors.nom }}</div>
                </div>
                <div class="space-y-2">
                    <Label for="cin">CIN</Label>
                    <Input id="cin" v-model="form.cin" placeholder="Ex: AB123456" />
                </div>
                <div class="space-y-2">
                    <Label for="type_requerant">Type</Label>
                    <select
                        id="type_requerant"
                        v-model="form.type_requerant"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary"
                    >
                        <option value="personne">Personne Physique</option>
                        <option value="societe">Société</option>
                        <option value="administration">Administration</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <Label for="contact">Contact (Tél/Email)</Label>
                    <Input id="contact" v-model="form.contact" placeholder="Téléphone ou email" />
                </div>
                <div class="space-y-2">
                    <Label for="ice">ICE (si société)</Label>
                    <Input id="ice" v-model="form.ice" placeholder="Identifiant Commun de l'Entreprise" />
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
                        placeholder="Informations complémentaires..."
                        class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors focus-visible:outline-none focus:ring-1 focus:ring-primary"
                    ></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-6">
                <Button type="submit" :disabled="form.processing" class="shadow-sm">
                    <span v-if="form.processing">Enregistrement...</span>
                    <span v-else>Enregistrer ce requérant</span>
                </Button>
            </div>
        </form>
    </div>

    <!-- Dialog Mode (for Show page) -->
    <Dialog v-else v-model:open="open">
        <DialogTrigger as-child>
            <Button size="sm" class="flex items-center gap-2">
                <PlusIcon class="h-4 w-4" />
                Ajouter un requérant
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[500px]">
            <DialogHeader>
                <DialogTitle>Nouveau Requérant</DialogTitle>
            </DialogHeader>
            <form @submit.prevent="submit" class="space-y-4 py-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2 col-span-2">
                        <Label for="nom">Nom / Raison Sociale</Label>
                        <Input id="nom" v-model="form.nom" required />
                        <div v-if="form.errors.nom" class="text-destructive text-xs">{{ form.errors.nom }}</div>
                    </div>
                    <div class="space-y-2">
                        <Label for="cin">CIN</Label>
                        <Input id="cin" v-model="form.cin" />
                    </div>
                    <div class="space-y-2">
                        <Label for="type_requerant">Type</Label>
                        <select
                            id="type_requerant"
                            v-model="form.type_requerant"
                            class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                        >
                            <option value="personne">Personne Physique</option>
                            <option value="societe">Société</option>
                            <option value="administration">Administration</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <Label for="contact">Contact (Tél/Email)</Label>
                        <Input id="contact" v-model="form.contact" />
                    </div>
                    <div class="space-y-2">
                        <Label for="ice">ICE (si société)</Label>
                        <Input id="ice" v-model="form.ice" />
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
