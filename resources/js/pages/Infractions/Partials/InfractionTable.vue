<script setup lang="ts">
import InfractionActions from './InfractionActions.vue'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Link } from '@inertiajs/vue3'
import { show as dossierShow } from '@/routes/dossiers'
import { AlertTriangle, Clock, CheckCircle2 } from 'lucide-vue-next';

defineProps<{
    infractions: any[]
}>()
</script>

<template>
  <div class="overflow-x-auto">
    <Table>
      <TableHeader class="bg-slate-50/50 dark:bg-slate-800/50">
        <TableRow>
          <TableHead class="font-bold text-slate-900 dark:text-white">Numéro</TableHead>
          <TableHead class="font-bold text-slate-900 dark:text-white">Dossier Lié</TableHead>
          <TableHead class="font-bold text-slate-900 dark:text-white">Date</TableHead>
          <TableHead class="font-bold text-slate-900 dark:text-white">Gravité</TableHead>
          <TableHead class="font-bold text-slate-900 dark:text-white">Statut</TableHead>
          <TableHead class="text-right font-bold text-slate-900 dark:text-white">Actions</TableHead>
        </TableRow>
      </TableHeader>

      <TableBody>
        <TableRow 
            v-for="infraction in infractions" 
            :key="infraction.id"
            class="transition-colors hover:bg-red-50/30 dark:hover:bg-red-900/10"
        >
          <TableCell class="font-semibold text-slate-900 dark:text-white">{{ infraction.numero_infraction }}</TableCell>
          <TableCell>
              <Link v-if="infraction.dossier" :href="dossierShow(infraction.dossier).url" class="inline-flex items-center gap-1.5 px-2 py-1 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 transition-colors">
                  <span class="w-1 h-1 rounded-full bg-blue-500"></span>
                  {{ infraction.dossier.numero_dossier }}
              </Link>
          </TableCell>
          <TableCell class="text-slate-600 dark:text-slate-400">{{ infraction.date_constatation ? new Date(infraction.date_constatation).toLocaleDateString() : '' }}</TableCell>
          <TableCell>
            <span :class="[
              'px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider inline-flex items-center gap-1',
              infraction.niveau_gravite === 'critique' || infraction.niveau_gravite === 'élevé' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' :
              infraction.niveau_gravite === 'moyen' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' :
              'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400'
            ]">
              <AlertTriangle v-if="infraction.niveau_gravite === 'critique'" class="w-3 h-3" />
              {{ infraction.niveau_gravite }}
            </span>
          </TableCell>
          <TableCell>
            <span class="inline-flex items-center gap-1.5 text-sm text-slate-700 dark:text-slate-300">
                <Clock v-if="infraction.statut_infraction === 'en cours'" class="w-4 h-4 text-blue-500" />
                <CheckCircle2 v-else-if="infraction.statut_infraction === 'résolu'" class="w-4 h-4 text-green-500" />
                {{ infraction.statut_infraction }}
             </span>
          </TableCell>
          <TableCell class="text-right">
            <InfractionActions :infraction="infraction" />
          </TableCell>
        </TableRow>
        <TableRow v-if="infractions.length === 0">
            <TableCell colspan="6" class="text-center py-12 text-slate-500 italic">
                Aucune infraction enregistrée.
            </TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </div>
</template>
