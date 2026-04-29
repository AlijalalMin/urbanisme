<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';
import { ShieldAlert, FileText, Activity, ArrowRight, Building2, MapPin } from 'lucide-vue-next';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Portail Urbanisme - Gestion des Infractions" />

    <div class="min-h-screen relative overflow-hidden bg-slate-50 selection:bg-blue-500 selection:text-white dark:bg-slate-950">
        <!-- Background Elements / Gradient blobs -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full opacity-30 dark:opacity-20 pointer-events-none">
                <div class="absolute -top-48 -left-48 w-96 h-96 rounded-full bg-blue-400 mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
                <div class="absolute top-48 -right-48 w-96 h-96 rounded-full bg-cyan-400 mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-48 left-1/2 w-96 h-96 rounded-full bg-indigo-400 mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
            </div>
            
            <!-- Grid Pattern -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9IiNFMkU4RjAiLz48L3N2Zz4=')] dark:bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9IiMzMzQxNTUiLz48L3N2Zz4=')] opacity-50 bg-[length:24px_24px]"></div>
        </div>

        <!-- Navigation -->
        <header class="relative z-10 w-full px-6 py-6 max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 p-2 rounded-xl shadow-lg shadow-blue-500/20">
                    <Building2 class="w-6 h-6 text-white" />
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">SSIC<span class="text-blue-600 dark:text-blue-400">Urbanisme</span></span>
            </div>
            
            <nav class="flex items-center gap-4">
                <template v-if="$page.props.auth.user">
                    <Link
                        :href="dashboard().url"
                        class="group relative inline-flex items-center justify-center gap-2 overflow-hidden rounded-full border border-slate-200 bg-white/50 px-6 py-2 text-sm font-medium text-slate-900 shadow-sm backdrop-blur-md transition-all hover:bg-slate-50 hover:shadow-md dark:border-slate-800 dark:bg-slate-900/50 dark:text-white dark:hover:bg-slate-800"
                    >
                        <span>Accéder au Dashboard</span>
                        <ArrowRight class="w-4 h-4 transition-transform group-hover:translate-x-1" />
                    </Link>
                </template>
                <template v-else>
                    <Link
                        :href="login().url"
                        class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors dark:text-slate-300 dark:hover:text-white"
                    >
                        Connexion
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="register().url"
                        class="inline-flex items-center justify-center rounded-full bg-blue-600 px-6 py-2 text-sm font-medium text-white shadow-lg shadow-blue-600/20 transition-all hover:bg-blue-700 hover:shadow-blue-600/40 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 dark:focus:ring-offset-slate-950"
                    >
                        S'inscrire
                    </Link>
                </template>
            </nav>
        </header>

        <!-- Hero Section -->
        <main class="relative z-10 flex flex-col items-center justify-center min-h-[calc(100vh-100px)] px-6">
            <div class="w-full max-w-4xl mx-auto text-center space-y-8 animate-fade-in-up">
                
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50/80 border border-blue-100 text-blue-600 text-xs font-semibold uppercase tracking-wider backdrop-blur-sm dark:bg-blue-500/10 dark:border-blue-500/20 dark:text-blue-400 mb-4">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    Portail de Gestion Officiel
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight dark:text-white">
                    Maîtrisez <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">l'Urbanisme</span><br />
                    en toute simplicité
                </h1>
                
                <p class="max-w-2xl mx-auto text-lg md:text-xl text-slate-600 dark:text-slate-400 leading-relaxed">
                    Une plateforme sécurisée de nouvelle génération pour la gestion des dossiers, le suivi des plaintes et le traitement complet des infractions urbaines.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-8">
                    <Link
                        v-if="!$page.props.auth.user"
                        :href="login().url"
                        class="group w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-full bg-slate-900 px-8 py-4 text-sm font-medium text-white shadow-xl shadow-slate-900/20 transition-all hover:bg-slate-800 hover:scale-105 hover:shadow-slate-900/40 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100 dark:focus:ring-white dark:shadow-white/10"
                    >
                        <span>Se connecter à l'espace agent</span>
                        <ArrowRight class="w-4 h-4 transition-transform group-hover:translate-x-1" />
                    </Link>
                    <Link
                        v-else
                        :href="dashboard().url"
                        class="group w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-full bg-blue-600 px-8 py-4 text-sm font-medium text-white shadow-xl shadow-blue-600/20 transition-all hover:bg-blue-700 hover:scale-105 hover:shadow-blue-600/40 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2"
                    >
                        <span>Ouvrir mon tableau de bord</span>
                        <ArrowRight class="w-4 h-4 transition-transform group-hover:translate-x-1" />
                    </Link>
                </div>
            </div>

            <!-- Features Cards -->
            <div class="w-full max-w-6xl mx-auto mt-24 grid grid-cols-1 md:grid-cols-3 gap-6 pb-20">
                <!-- Card 1 -->
                <div class="group relative overflow-hidden rounded-2xl bg-white/60 p-8 shadow-lg shadow-slate-200/50 backdrop-blur-xl border border-white transition-all hover:-translate-y-1 hover:shadow-xl dark:bg-slate-900/60 dark:shadow-none dark:border-slate-800">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-100 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity dark:bg-blue-900/30"></div>
                    <div class="relative z-10">
                        <div class="mb-4 inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
                            <FileText class="w-6 h-6" />
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2 dark:text-white">Dossiers Centralisés</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                            Gérez l'ensemble de vos dossiers d'urbanisme depuis une interface unique. Annexes, plaignants, et historiques en un clic.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="group relative overflow-hidden rounded-2xl bg-white/60 p-8 shadow-lg shadow-slate-200/50 backdrop-blur-xl border border-white transition-all hover:-translate-y-1 hover:shadow-xl dark:bg-slate-900/60 dark:shadow-none dark:border-slate-800">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-cyan-100 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity dark:bg-cyan-900/30"></div>
                    <div class="relative z-10">
                        <div class="mb-4 inline-flex items-center justify-center w-12 h-12 rounded-xl bg-cyan-100 text-cyan-600 dark:bg-cyan-900/50 dark:text-cyan-400">
                            <ShieldAlert class="w-6 h-6" />
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2 dark:text-white">Traitement des Infractions</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                            Suivez l'état de chaque infraction, de la constatation jusqu'à la résolution. Associez instantanément les infractions aux dossiers.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="group relative overflow-hidden rounded-2xl bg-white/60 p-8 shadow-lg shadow-slate-200/50 backdrop-blur-xl border border-white transition-all hover:-translate-y-1 hover:shadow-xl dark:bg-slate-900/60 dark:shadow-none dark:border-slate-800">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-100 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity dark:bg-indigo-900/30"></div>
                    <div class="relative z-10">
                        <div class="mb-4 inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-400">
                            <Activity class="w-6 h-6" />
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2 dark:text-white">Suivi en Temps Réel</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                            Bénéficiez d'une vue d'ensemble sur l'activité de vos services grâce au tableau de bord dynamique et aux données filtrables.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<style>
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
  animation: blob 7s infinite;
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
