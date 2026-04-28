<script setup lang="ts">
import type { Dossier } from '@/types/dossier'
import DossierActions from './DossierActions.vue'
import { Card, CardContent } from '@/components/ui/card'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'

interface Props {
    dossiers: Dossier[]
}

defineProps<Props>()
</script>

<template>
  <Card>
    <CardContent>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Numéro</TableHead>
            <TableHead>Priorité</TableHead>
            <TableHead>Statut</TableHead>
            <TableHead>Plaignant</TableHead>
            <TableHead>Adresse complète</TableHead>
            <TableHead>Description initiale</TableHead>
            <TableHead>Date d'arrivée</TableHead>
            <TableHead>Annexe</TableHead>
            <TableHead class="text-right">Actions</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          <TableRow
            v-for="dossier in dossiers"
            :key="dossier.id"
          >
            <TableCell class="align-top font-medium whitespace-nowrap">{{ dossier.numero_dossier }}</TableCell>
            <TableCell class="align-top">{{ dossier.priorite }}</TableCell>
            <TableCell class="align-top">{{ dossier.statut }}</TableCell>
            <TableCell class="align-top whitespace-nowrap">{{ dossier.plaignant }}</TableCell>
            <TableCell class="align-top max-w-[150px] truncate" :title="dossier.adresse_complete || ''">{{ dossier.adresse_complete }}</TableCell>
            <TableCell class="align-top max-w-[250px] truncate" :title="dossier.description_initiale || ''">{{ dossier.description_initiale }}</TableCell>
            <TableCell class="align-top whitespace-nowrap">{{ dossier.date_arrive }}</TableCell>
            <TableCell class="align-top whitespace-nowrap">{{ dossier.annexe?.nom }}</TableCell>

            <TableCell class="align-top text-right">
              <DossierActions :dossier="dossier" />
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </CardContent>
  </Card>
</template>