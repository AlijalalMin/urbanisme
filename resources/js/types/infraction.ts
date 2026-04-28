import type { Dossier } from './dossier'

export interface Infraction {
    id: number
    numero_infraction: string
    date_constatation: string
    niveau_gravite: number
    localisation_precise: string | null
    description_faits: string | null
    mesures_prises: string | null
    statut_infraction: string
    user_id: number
    dossier_id: number
    created_at: string
    updated_at: string
    dossier?: Dossier
}
