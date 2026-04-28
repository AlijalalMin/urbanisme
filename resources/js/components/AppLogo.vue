
<template>
    <div
        class="flex aspect-square size-8 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-500/20"
    >
        <Building2 class="size-5" />
    </div>
    <div class="ml-2 grid flex-1 text-left text-sm">
        <span class="mb-0.5 truncate leading-tight font-bold text-slate-900 dark:text-white"
            >SSIC <span class="text-blue-600 dark:text-blue-400">Urbanisme</span></span
        >
    </div>
</template>

<script setup lang="ts">
import { Building2 } from 'lucide-vue-next';
</script>
