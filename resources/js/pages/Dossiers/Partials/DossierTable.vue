<script setup lang="ts">
import type { Dossier } from '@/types/dossier'
import DossierActions from './DossierActions.vue'
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
            <TableHead>Objet</TableHead>
            <TableHead>Priorité</TableHead>
            <TableHead>Statut</TableHead>
            <TableHead>Plaignant</TableHead>
            <TableHead>Accusé</TableHead>
            <TableHead>Coordonnées GPS</TableHead>
            <TableHead>Adresse complète</TableHead>
            <TableHead>Description initiale</TableHead>
            <TableHead>Date d'arrivée</TableHead>
            <TableHead>Utilisateur</TableHead>
            <TableHead>Annexe</TableHead>
            <TableHead class="text-right">Actions</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          <TableRow
            v-for="dossier in dossiers"
            :key="dossier.id"
          >
            <TableCell>{{ dossier.numero_dossier }}</TableCell>
            <TableCell>{{ dossier.objet }}</TableCell>
            <TableCell>{{ dossier.priorite }}</TableCell>
            <TableCell>{{ dossier.statut }}</TableCell>
            <TableCell>{{ dossier.plaignant }}</TableCell>
            <TableCell>{{ dossier.accuse }}</TableCell>
            <TableCell>{{ dossier.coordonnees_gps }}</TableCell>
            <TableCell>{{ dossier.adresse_complete }}</TableCell>
            <TableCell>{{ dossier.description_initiale }}</TableCell>
            <TableCell>{{ dossier.date_arrive }}</TableCell>
            <TableCell>{{ dossier.user?.name }}</TableCell>
            <TableCell>{{ dossier.annexe?.nom }}</TableCell>

            <TableCell class="text-right">
              <DossierActions :dossier="dossier" />
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </CardContent>
  </Card>
</template>