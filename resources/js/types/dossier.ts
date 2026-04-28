import type { Infraction } from './infraction'

export type DossierPriority = 'faible' | 'normale' | 'haute'

export interface Dossier {
    id: number
    numero_dossier: string
    objet: string
    type_dossier: string
    priorite: DossierPriority
    source_signalement: string
    plaignant?: string | null
    accuse?: string | null
    coordonnees_gps?: string | null
    adresse_complete?: string | null
    description_initiale?: string | null
    date_arrive: string
    statut: string
    created_at: string
    updated_at: string
    user_id: number
    annexe_id?: number | null
    district_id?: number | null
    annexe?: {
        id: number
        nom: string
        district_id?: number
    }
    district?: {
        id: number
        nom: string
    }
    user?: {
        id: number
        name: string
    }
    infractions?: Infraction[]
}

export interface DossierFormData {
    numero_dossier: string
    objet: string
    type_dossier: string
    priorite: DossierPriority
    source_signalement: string
    plaignant: string | null
    accuse: string | null
    coordonnees_gps: string | null
    adresse_complete: string | null
    description_initiale: string | null
    date_arrive: string
    user_id: number | null
    annexe_id: number | null
    district_id: number | null
    statut: string
}