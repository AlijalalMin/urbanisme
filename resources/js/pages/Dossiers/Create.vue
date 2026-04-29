<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import DossierForm from './components/DossierForm.vue';
import RequerantForm from '@/pages/Requerants/components/RequerantForm.vue';
import AuteurForm from '@/pages/Auteurs/components/AuteurForm.vue';
import { index as dossiersIndex, create as dossiersCreate, show as dossiersShow } from '@/routes/dossiers';
import { dashboard } from '@/routes';
import { ref, computed } from 'vue';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { CheckIcon, UserIcon, FileTextIcon, ShieldAlertIcon } from 'lucide-vue-next';
import { store as auteursStore } from '@/routes/auteurs';

const props = defineProps<{
    annexes: any[]
    dossier?: any
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard().url },
    { title: 'Dossiers', href: dossiersIndex().url },
    { title: 'Nouveau dossier', href: dossiersCreate().url },
];

const currentStep = ref(props.dossier ? 2 : 1);
const createdDossierId = ref<number | null>(props.dossier?.id || null);

const steps = [
    { id: 1, title: 'Dossier', description: 'Informations de base', icon: FileTextIcon },
    { id: 2, title: 'Requérants', description: 'Qui signale ?', icon: UserIcon },
    { id: 3, title: 'Auteurs', description: 'Qui est responsable ?', icon: ShieldAlertIcon },
];

const handleDossierCreated = (dossier: any) => {
    // If we're using Inertia's redirect, the props will be updated automatically.
    // If we're staying on page, we need to update these.
    if (dossier) {
        createdDossierId.value = dossier.id;
        currentStep.value = 2;
    }
};

const nextStep = () => {
    if (currentStep.value < 3) {
        currentStep.value++;
    }
};

const prevStep = () => {
    if (currentStep.value > 1) {
        currentStep.value--;
    }
};

const submitAuteur = (form: { post: (arg0: string) => void; }) => {
    form.post(auteursStore(props.dossier?.id).url);
};
</script>

<template>
    <Head title="Nouveau dossier" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-5xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold tracking-tight text-foreground">Création de dossier</h1>
                <p class="mt-2 text-muted-foreground text-lg">Suivez les étapes pour enregistrer un nouveau dossier complet.</p>
            </div>

            <!-- Stepper -->
            <div class="mb-10">
                <div class="relative flex justify-between">
                    <div class="absolute top-5 left-0 w-full h-0.5 bg-muted -z-10"></div>
                    <div
                        v-for="step in steps"
                        :key="step.id"
                        class="flex flex-col items-center group"
                    >
                        <div
                            :class="[
                                'w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all duration-300',
                                currentStep >= step.id
                                    ? 'bg-primary border-primary text-primary-foreground shadow-lg shadow-primary/20'
                                    : 'bg-background border-muted text-muted-foreground'
                            ]"
                        >
                            <component :is="currentStep > step.id ? CheckIcon : step.icon" class="h-5 w-5" />
                        </div>
                        <div class="mt-3 text-center">
                            <p :class="['text-sm font-semibold', currentStep >= step.id ? 'text-foreground' : 'text-muted-foreground']">
                                {{ step.title }}
                            </p>
                            <p class="text-xs text-muted-foreground hidden sm:block">{{ step.description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step Content -->
            <div class="space-y-6">
                <!-- Step 1: Dossier -->
                <div v-if="currentStep === 1" class="animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <DossierForm @success="handleDossierCreated" />
                </div>

                <!-- Step 2: Requerants -->
                <div v-if="currentStep === 2" class="animate-in fade-in slide-in-from-right-4 duration-500">
                    <Card class="border-t-4 border-t-blue-500 shadow-xl">
                        <CardHeader>
                            <CardTitle class="text-2xl">Étape 2 : Enregistrement des Requérants</CardTitle>
                            <CardDescription>Identifiez la personne ou l'entité à l'origine du signalement.</CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-6">
                            <RequerantForm :dossier-id="createdDossierId!" inline />
                            <div class="flex justify-between pt-6 border-t">
                                <Button variant="outline" @click="prevStep">Retour</Button>
                                <Button @click="nextStep">Suivant : Identification de l'auteur</Button>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Step 3: Auteurs -->
                <div v-if="currentStep === 3" class="animate-in fade-in slide-in-from-right-4 duration-500">
                    <Card class="border-t-4 border-t-red-500 shadow-xl">
                        <CardHeader>
                            <CardTitle class="text-2xl">Étape 3 : Identification de l'Auteur de l'Infraction</CardTitle>
                            <CardDescription>Enregistrez les informations sur la personne ou l'entité responsable.</CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-6">
                            <AuteurForm :dossierId="dossier.id" @submit="submitAuteur" />
                            <div class="flex justify-between pt-6 border-t">
                                <Button variant="outline" @click="prevStep">Retour</Button>
                                <Button as-child>
                                    <Link :href="dossiersShow(createdDossierId!).url">
                                        Terminer et voir le dossier
                                    </Link>
                                </Button>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
