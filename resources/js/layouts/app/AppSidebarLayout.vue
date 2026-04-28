<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell variant="sidebar">
        <AppSidebar />
        <AppContent variant="sidebar" class="overflow-x-hidden relative">
            <!-- Global Background Elements -->
            <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden opacity-50 dark:opacity-30">
                <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-400/10 blur-3xl animate-blob"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-indigo-400/10 blur-3xl animate-blob animation-delay-4000"></div>
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9IiNFMkU4RjAiLz48L3N2Zz4=')] dark:bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9IiMzMzQxNTUiLz48L3N2Zz4=')] bg-[length:20px_20px] opacity-40"></div>
            </div>

            <div class="relative z-10 flex flex-col h-full">
                <AppSidebarHeader :breadcrumbs="breadcrumbs" />
                <slot />
            </div>
        </AppContent>
    </AppShell>
</template>

<style>
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
  animation: blob 15s infinite;
}
.animation-delay-4000 {
  animation-delay: 4s;
}
</style>
