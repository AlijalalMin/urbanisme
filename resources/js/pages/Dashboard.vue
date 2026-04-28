<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { 
    FileText, 
    ShieldAlert, 
    Activity, 
    TrendingUp, 
    Clock, 
    CheckCircle2,
    AlertCircle,
    ArrowUpRight
} from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tableau de bord',
        href: dashboard().url,
    }, 
];

defineProps<{
    stats: {
        total_dossiers: number;
        total_infractions: number;
        recent_activities: Array<{
            type: 'dossier' | 'infraction';
            title: string;
            description: string;
            time: string;
            id: number;
        }>;
    }
}>();

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
    <Head title="Tableau de bord" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 space-y-8">
            <div class="relative z-10 space-y-8 animate-fade-in-up">
                <!-- Welcome Banner -->
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 to-blue-900 p-8 text-white shadow-2xl dark:from-slate-900 dark:to-slate-800">
                    <div class="absolute top-0 right-0 -m-20 h-80 w-80 rounded-full bg-white/10 blur-3xl"></div>
                    <div class="relative z-10 space-y-2">
                        <h2 class="text-3xl font-bold tracking-tight">Ravi de vous revoir, {{ user?.name }} 👋</h2>
                        <p class="text-blue-100/80 max-w-xl text-lg">
                            Voici l'état actuel de vos dossiers et des interventions d'urbanisme en cours.
                        </p>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Dossiers -->
                    <div class="group relative overflow-hidden rounded-2xl bg-white/60 p-6 shadow-sm border border-white backdrop-blur-xl transition-all hover:shadow-lg dark:bg-slate-900/60 dark:border-slate-800">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
                                <FileText class="w-6 h-6" />
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full dark:bg-green-900/30 dark:text-green-400 flex items-center gap-1">
                                +12% <TrendingUp class="w-3 h-3" />
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Dossiers</h3>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-slate-900 dark:text-white">{{ stats.total_dossiers }}</span>
                                <span class="text-xs text-slate-400">ce mois</span>
                            </div>
                        </div>
                        <div class="mt-4 h-1 w-full bg-slate-100 rounded-full overflow-hidden dark:bg-slate-800">
                            <div class="h-full bg-blue-500 rounded-full w-2/3"></div>
                        </div>
                    </div>

                    <!-- Infractions -->
                    <div class="group relative overflow-hidden rounded-2xl bg-white/60 p-6 shadow-sm border border-white backdrop-blur-xl transition-all hover:shadow-lg dark:bg-slate-900/60 dark:border-slate-800">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-xl bg-red-100 text-red-600 dark:bg-red-900/50 dark:text-red-400">
                                <ShieldAlert class="w-6 h-6" />
                            </div>
                            <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full dark:bg-red-900/30 dark:text-red-400">
                                Actives
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400">Infractions</h3>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-slate-900 dark:text-white">{{ stats.total_infractions }}</span>
                                <span class="text-xs text-slate-400">en attente</span>
                            </div>
                        </div>
                        <div class="mt-4 h-1 w-full bg-slate-100 rounded-full overflow-hidden dark:bg-slate-800">
                            <div class="h-full bg-red-500 rounded-full w-1/3"></div>
                        </div>
                    </div>

                    <!-- Activité -->
                    <div class="group relative overflow-hidden rounded-2xl bg-white/60 p-6 shadow-sm border border-white backdrop-blur-xl transition-all hover:shadow-lg dark:bg-slate-900/60 dark:border-slate-800">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-xl bg-indigo-100 text-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-400">
                                <Activity class="w-6 h-6" />
                            </div>
                            <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-1 rounded-full dark:bg-blue-900/30 dark:text-blue-400">
                                Stable
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400">Taux de Résolution</h3>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-slate-900 dark:text-white">84%</span>
                                <span class="text-xs text-slate-400">+5% vs hier</span>
                            </div>
                        </div>
                        <div class="mt-4 h-1 w-full bg-slate-100 rounded-full overflow-hidden dark:bg-slate-800">
                            <div class="h-full bg-indigo-500 rounded-full w-[84%]"></div>
                        </div>
                    </div>

                    <!-- Temps moyen -->
                    <div class="group relative overflow-hidden rounded-2xl bg-white/60 p-6 shadow-sm border border-white backdrop-blur-xl transition-all hover:shadow-lg dark:bg-slate-900/60 dark:border-slate-800">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-xl bg-amber-100 text-amber-600 dark:bg-amber-900/50 dark:text-amber-400">
                                <Clock class="w-6 h-6" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400">Délai de Traitement</h3>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-slate-900 dark:text-white">4.2j</span>
                                <span class="text-xs text-slate-400">moyenne</span>
                            </div>
                        </div>
                        <div class="mt-4 h-1 w-full bg-slate-100 rounded-full overflow-hidden dark:bg-slate-800">
                            <div class="h-full bg-amber-500 rounded-full w-1/2"></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity / Main Content Area -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: Tasks/Alerts -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="rounded-2xl bg-white/60 p-6 shadow-sm border border-white backdrop-blur-xl dark:bg-slate-900/60 dark:border-slate-800">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Activités Récentes</h3>
                                <button class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">Tout voir</button>
                            </div>
                            
                            <div class="space-y-4">
                                <div v-for="activity in stats.recent_activities" :key="activity.id" class="flex items-start gap-4 p-4 rounded-xl transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-800/50">
                                    <div :class="[
                                        'mt-1 p-2 rounded-lg',
                                        activity.type === 'dossier' ? 'bg-blue-100 text-blue-600' : 'bg-red-100 text-red-600'
                                    ]">
                                        <FileText v-if="activity.type === 'dossier'" class="w-4 h-4" />
                                        <ShieldAlert v-else class="w-4 h-4" />
                                    </div>
                                    <div class="flex-1 space-y-1">
                                        <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                            {{ activity.title }}
                                        </p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">
                                            {{ activity.description }}
                                        </p>
                                    </div>
                                    <span class="text-xs text-slate-400">{{ activity.time }}</span>
                                </div>
                                <div v-if="stats.recent_activities.length === 0" class="text-center py-8 text-slate-500">
                                    Aucune activité récente.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Quick Actions & Status -->
                    <div class="space-y-6">
                        <div class="rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 p-6 text-white shadow-lg">
                            <h3 class="font-bold mb-4 flex items-center gap-2">
                                <AlertCircle class="w-5 h-5" /> Actions Rapides
                            </h3>
                            <div class="grid grid-cols-1 gap-3">
                                <button class="flex items-center justify-between w-full p-3 rounded-xl bg-white/10 border border-white/20 hover:bg-white/20 transition-all group text-sm font-medium">
                                    Nouveau Dossier
                                    <ArrowUpRight class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all" />
                                </button>
                                <button class="flex items-center justify-between w-full p-3 rounded-xl bg-white/10 border border-white/20 hover:bg-white/20 transition-all group text-sm font-medium">
                                    Signaler Infraction
                                    <ArrowUpRight class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all" />
                                </button>
                                <button class="flex items-center justify-between w-full p-3 rounded-xl bg-white/10 border border-white/20 hover:bg-white/20 transition-all group text-sm font-medium">
                                    Générer Rapport Mensuel
                                    <ArrowUpRight class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all" />
                                </button>
                            </div>
                        </div>

                        <!-- System Health Card -->
                        <div class="rounded-2xl bg-white/60 p-6 shadow-sm border border-white backdrop-blur-xl dark:bg-slate-900/60 dark:border-slate-800">
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4">État du Secteur</h3>
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs font-medium">
                                        <span class="text-slate-500">Zone Nord</span>
                                        <span class="text-green-600">Optimal</span>
                                    </div>
                                    <div class="h-1.5 w-full bg-slate-100 rounded-full dark:bg-slate-800">
                                        <div class="h-full bg-green-500 rounded-full w-[90%]"></div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs font-medium">
                                        <span class="text-slate-500">Zone Centre</span>
                                        <span class="text-amber-600">Chargé</span>
                                    </div>
                                    <div class="h-1.5 w-full bg-slate-100 rounded-full dark:bg-slate-800">
                                        <div class="h-full bg-amber-500 rounded-full w-[65%]"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
  animation: blob 10s infinite;
}
.animation-delay-2000 {
  animation-delay: 2s;
}
.animation-delay-4000 {
  animation-delay: 4s;
}
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
