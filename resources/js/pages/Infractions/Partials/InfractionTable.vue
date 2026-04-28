<script setup lang="ts">
import InfractionActions from './InfractionActions.vue'
import { Card, CardContent } from '@/components/ui/card'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Link } from '@inertiajs/vue3'
import { show as dossierShow } from '@/routes/dossiers'

defineProps<{
    infractions: any[]
}>()
</script>

<template>
  <Card>
    <CardContent>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Numéro</TableHead>
            <TableHead>Dossier Lié</TableHead>
            <TableHead>Date</TableHead>
            <TableHead>Gravité</TableHead>
            <TableHead>Statut</TableHead>
            <TableHead class="text-right">Actions</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          <TableRow v-for="infraction in infractions" :key="infraction.id">
            <TableCell class="font-medium">{{ infraction.numero_infraction }}</TableCell>
            <TableCell>
                <Link v-if="infraction.dossier" :href="dossierShow(infraction.dossier).url" class="text-blue-600 hover:underline">
                    {{ infraction.dossier.numero_dossier }}
                </Link>
            </TableCell>
            <TableCell>{{ infraction.date_constatation ? new Date(infraction.date_constatation).toLocaleDateString() : '' }}</TableCell>
            <TableCell>{{ infraction.niveau_gravite }}</TableCell>
            <TableCell>{{ infraction.statut_infraction }}</TableCell>
            <TableCell class="text-right">
              <InfractionActions :infraction="infraction" />
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </CardContent>
  </Card>
</template>
