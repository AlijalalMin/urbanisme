<script setup lang="ts">
import type { Dossier } from '@/types/dossier'
import DossierActions from './DossierActions.vue'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Folder } from 'lucide-vue-next';

interface Props {
    dossiers: Dossier[]
}

defineProps<Props>()
</script>

<template>
  <div class="overflow-x-auto">
    <Table>
      <TableHeader class="bg-slate-50/50 dark:bg-slate-800/50">
        <TableRow>
          <TableHead class="font-bold text-slate-900 dark:text-white">Numéro</TableHead>
          <TableHead class="font-bold text-slate-900 dark:text-white">Priorité</TableHead>
          <TableHead class="font-bold text-slate-900 dark:text-white">Statut</TableHead>
          <TableHead class="font-bold text-slate-900 dark:text-white">Plaignant</TableHead>
          <TableHead class="font-bold text-slate-900 dark:text-white">Date d'arrivée</TableHead>
          <TableHead class="font-bold text-slate-900 dark:text-white">Annexe</TableHead>
          <TableHead class="text-right font-bold text-slate-900 dark:text-white">Actions</TableHead>
        </TableRow>
      </TableHeader>

      <TableBody>
        <TableRow
          v-for="dossier in dossiers"
          :key="dossier.id"
          class="transition-colors hover:bg-blue-50/30 dark:hover:bg-blue-900/10"
        >
          <TableCell class="font-semibold text-blue-600 dark:text-blue-400 whitespace-nowrap">
            {{ dossier.numero_dossier }}
          </TableCell>
          <TableCell>
            <span :class="[
              'px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider',
              dossier.priorite === 'haute' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' :
              dossier.priorite === 'normale' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' :
              'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400'
            ]">
              {{ dossier.priorite }}
            </span>
          </TableCell>
          <TableCell>
             <span class="inline-flex items-center gap-1.5 text-sm text-slate-700 dark:text-slate-300">
                <span :class="[
                    'w-2 h-2 rounded-full',
                    dossier.statut === 'terminé' ? 'bg-green-500' : 
                    dossier.statut === 'en cours' ? 'bg-blue-500' : 'bg-slate-400'
                ]"></span>
                {{ dossier.statut }}
             </span>
          </TableCell>
          <TableCell class="whitespace-nowrap text-slate-600 dark:text-slate-400">{{ dossier.plaignant || 'Non renseigné' }}</TableCell>
          <TableCell class="whitespace-nowrap text-slate-600 dark:text-slate-400">{{ dossier.date_arrive }}</TableCell>
          <TableCell class="whitespace-nowrap text-slate-600 dark:text-slate-400">
            <div class="flex items-center gap-2">
                <span class="p-1 rounded bg-slate-100 dark:bg-slate-800"><Folder class="w-3 h-3" /></span>
                {{ dossier.annexe?.nom || '-' }}
            </div>
          </TableCell>

          <TableCell class="text-right">
            <DossierActions :dossier="dossier" />
          </TableCell>
        </TableRow>
        <TableRow v-if="dossiers.length === 0">
            <TableCell colspan="7" class="text-center py-12 text-slate-500 italic">
                Aucun dossier trouvé.
            </TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </div>
</template>