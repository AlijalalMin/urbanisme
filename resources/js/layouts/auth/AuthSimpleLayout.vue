<script setup lang="ts">
import { home } from '@/routes';
import { Link } from '@inertiajs/vue3';
import { Building2 } from 'lucide-vue-next';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-slate-50 selection:bg-blue-500 selection:text-white dark:bg-slate-950 p-6">
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

        <div class="relative z-10 w-full max-w-md animate-fade-in-up">
            <div class="flex flex-col items-center gap-6">
                <!-- Logo -->
                <Link :href="home()" class="flex items-center gap-3 group transition-transform hover:scale-105">
                    <div class="bg-blue-600 p-2.5 rounded-xl shadow-lg shadow-blue-500/20">
                        <Building2 class="w-7 h-7 text-white" />
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">SSIC<span class="text-blue-600 dark:text-blue-400">Urbanisme</span></span>
                </Link>

                <!-- Auth Card -->
                <div class="w-full bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border border-white/40 dark:border-slate-800/40 shadow-2xl rounded-3xl p-8 md:p-10">
                    <div class="mb-8 text-center space-y-2">
                        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">{{ title }}</h1>
                        <p class="text-slate-600 dark:text-slate-400 text-sm">
                            {{ description }}
                        </p>
                    </div>

                    <slot />
                </div>

                <!-- Footer Link (Optional/External to card) -->
                <p class="text-center text-xs text-slate-500 dark:text-slate-500 mt-4">
                    &copy; {{ new Date().getFullYear() }} SSIC Urbanisme. Tous droits réservés.
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>
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
