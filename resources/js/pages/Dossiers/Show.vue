<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Badge } from '@/components/ui/badge';
import { dashboard } from '@/routes';
import { index as dossiersIndex, edit as dossierEdit } from '@/routes/dossiers';
import { create as infractionCreate, show as infractionShow } from '@/routes/infractions';
import { type BreadcrumbItem } from '@/types';
import type { Dossier } from '@/types/dossier';
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { computed } from 'vue';
import { 
    Calendar, 
    User, 
    FileText, 
    MapPin, 
    AlertCircle, 
    Plus, 
    Edit, 
    ArrowLeft,
    Tag,
    Building
} from 'lucide-vue-next';

interface Props {
    dossier: Dossier
}

const props = defineProps<Props>()

const breadcrumbs = computed<BreadcrumbItem[]>(() => [
    { title: 'Tableau de bord', href: dashboard().url },
    { title: 'Dossiers', href: dossiersIndex().url },
    { title: props.dossier.numero_dossier, href: '#' },
]);

const statusStyles = (status: string) => {
    switch(status?.toLowerCase()) {
        case 'nouveau': return 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400';
        case 'en cours': return 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400';
        case 'terminé': return 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400';
        case 'rejeté': return 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400';
        default: return 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400';
    }
}
</script>

<template>
    <Head :title="`Dossier ${dossier.numero_dossier}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative p-6 space-y-8 animate-fade-in-up">
            <!-- Header Action Bar -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <Link :href="dossiersIndex().url" class="p-2 rounded-full bg-white shadow-sm border border-slate-200 text-slate-600 hover:text-blue-600 hover:border-blue-200 transition-all dark:bg-slate-900 dark:border-slate-800 dark:text-slate-400">
                        <ArrowLeft class="w-5 h-5" />
                    </Link>
                    <div>
                        <div class="flex items-center gap-3">
                            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Dossier {{ dossier.numero_dossier }}</h1>
                            <span :class="['px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider', statusStyles(dossier.statut)]">
                                {{ dossier.statut }}
                            </span>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 mt-1">Géré par {{ dossier.user?.name }} • Créé le {{ dossier.date_arrive }}</p>
                    </div>
                </div>
                <Button as-child class="rounded-full bg-white text-slate-900 border border-slate-200 hover:bg-slate-50 shadow-sm px-6 dark:bg-slate-900 dark:text-white dark:border-slate-800 dark:hover:bg-slate-800">
                    <Link :href="dossierEdit(dossier).url">
                        <div class="flex items-center gap-2">
                            <Edit class="w-4 h-4" />
                            <span>Éditer le dossier</span>
                        </div>
                    </Link>
                </Button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Details (Left 2 Columns) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- General Information -->
                    <div class="rounded-3xl bg-white/60 p-8 shadow-sm border border-white backdrop-blur-xl dark:bg-slate-900/60 dark:border-slate-800">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                            <FileText class="w-5 h-5 text-blue-500" /> Informations Générales
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-1">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Objet du dossier</span>
                                <p class="text-slate-900 dark:text-slate-200 font-medium text-lg leading-snug">{{ dossier.objet }}</p>
                            </div>
                            
                            <div class="space-y-1">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Priorité</span>
                                <div class="flex items-center gap-2 mt-1">
                                    <span :class="[
                                        'w-3 h-3 rounded-full',
                                        dossier.priorite === 'haute' ? 'bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.5)]' : 'bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]'
                                    ]"></span>
                                    <span class="text-slate-900 dark:text-slate-200 font-medium capitalize">{{ dossier.priorite }}</span>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">District</span>
                                <div class="flex items-center gap-2 mt-1 text-slate-900 dark:text-slate-200">
                                    <MapPin class="w-4 h-4 text-slate-400" />
                                    <span class="font-medium">{{ dossier.district?.nom || dossier.annexe?.district?.nom || 'Non spécifié' }}</span>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Annexe / Service</span>
                                <div class="flex items-center gap-2 mt-1 text-slate-900 dark:text-slate-200">
                                    <Building class="w-4 h-4 text-slate-400" />
                                    <span class="font-medium">{{ dossier.annexe?.nom || 'Non spécifié' }}</span>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Plaignant</span>
                                <div class="flex items-center gap-2 mt-1 text-slate-900 dark:text-slate-200">
                                    <User class="w-4 h-4 text-slate-400" />
                                    <span class="font-medium">{{ dossier.plaignant || 'Anonyme' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 space-y-6">
                            <div class="space-y-3">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                    <MapPin class="w-3.5 h-3.5" /> Adresse Complète
                                </span>
                                <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100 text-slate-700 dark:bg-slate-800/50 dark:border-slate-800 dark:text-slate-300 leading-relaxed italic">
                                    {{ dossier.adresse_complete || 'Aucune adresse spécifiée' }}
                                </div>
                            </div>

                            <div class="space-y-3">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                    <Tag class="w-3.5 h-3.5" /> Description de la situation
                                </span>
                                <div class="bg-white p-6 rounded-2xl border border-slate-100 text-slate-700 shadow-inner dark:bg-slate-900/40 dark:border-slate-800 dark:text-slate-300 leading-relaxed">
                                    {{ dossier.description_initiale || 'Aucune description détaillée fournie.' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Info (Right Column) -->
                <div class="space-y-8">
                    <!-- Infractions Related -->
                    <div class="rounded-3xl bg-white/60 p-6 shadow-sm border border-white backdrop-blur-xl dark:bg-slate-900/60 dark:border-slate-800">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <AlertCircle class="w-5 h-5 text-red-500" /> Infractions
                            </h3>
                            <Link :href="infractionCreate().url" class="text-blue-600 hover:text-blue-700 transition-colors p-1.5 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/30">
                                <Plus class="w-5 h-5" />
                            </Link>
                        </div>
                        
                        <div v-if="dossier.infractions && dossier.infractions.length > 0" class="space-y-3">
                            <Link 
                                v-for="infraction in dossier.infractions" 
                                :key="infraction.id" 
                                :href="infractionShow(infraction).url"
                                class="group block p-4 rounded-2xl border border-slate-100 bg-white shadow-sm hover:border-red-200 hover:shadow-md transition-all dark:bg-slate-900 dark:border-slate-800 dark:hover:border-red-900"
                            >
                                <div class="flex items-start justify-between">
                                    <div class="space-y-1">
                                        <p class="font-bold text-slate-900 dark:text-white text-sm group-hover:text-red-600 transition-colors">{{ infraction.numero_infraction }}</p>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400 uppercase">{{ infraction.niveau_gravite }}</span>
                                            <span class="text-[10px] font-medium text-slate-400">{{ infraction.statut_infraction }}</span>
                                        </div>
                                    </div>
                                    <ArrowLeft class="w-4 h-4 text-slate-300 group-hover:text-red-400 rotate-180 transition-all" />
                                </div>
                            </Link>
                        </div>
                        <div v-else class="text-center py-8 px-4 rounded-2xl bg-slate-50/50 border border-dashed border-slate-200 dark:bg-slate-800/30 dark:border-slate-700">
                            <p class="text-sm text-slate-500 italic">Aucune infraction liée.</p>
                            <Link :href="infractionCreate().url" class="text-xs text-blue-600 font-bold mt-2 inline-block hover:underline">Signaler une infraction</Link>
                        </div>
                    </div>

                    <!-- Additional Metadata / Stats -->
                    <div class="rounded-3xl bg-gradient-to-br from-slate-800 to-slate-900 p-6 text-white shadow-lg">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Historique & Flux</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-400 flex items-center gap-2"><Calendar class="w-4 h-4" /> Réception</span>
                                <span class="font-medium">{{ dossier.date_arrive }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-400 flex items-center gap-2"><User class="w-4 h-4" /> Agent</span>
                                <span class="font-medium">{{ dossier.user?.name || '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out forwards;
}
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>